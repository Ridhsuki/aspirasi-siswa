@extends('aspirations.layouts.app')
@section('content')
    <div class="container">
        <div class="header">
            <h1>OSIS SMA NEGERI 3 KEPULAUAN ARU</h1>
            <p>Ayo! Berbagi Kritik, Saran dan Masukan demi Kemajuan bersama dengan OSIS SMA NEGERI 3 KEPULAUAN ARU</p>

            <div class="user-bar">
                <span>Halo, <strong>{{ Auth::user()->name }}</strong> 👋</span>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn" onclick="return confirm('Yakin ingin keluar?')">
                        Log Out
                    </button>
                </form>
            </div>
        </div>

        <div class="permanent-notice">
            <strong>⚠️ Peringatan Penting</strong>
            Semua pesan dan balasan bersifat permanen dan tidak akan terhapus.
            Hanya pembuat pesan & admin yang dapat menghapus postingan tersebut. Harap bijak dalam berkomentar.
        </div>

        <div class="post-form">
            <h2 style="margin-bottom: 15px; color: #334EAC;">✍️ Tulis Aspirasi</h2>
            <form action="{{ route('aspirations.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea name="content" id="postContent" placeholder="Apa yang sedang kamu pikirkan? (Maksimal 500 karakter)"
                        maxlength="500" required oninput="updateCharCount(this)"></textarea>

                    @error('content')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <label class="anon-option">
                    <input type="checkbox" name="is_anonymous" checked>
                    <span>Kirim sebagai <strong>Anonim</strong> (Sembunyikan nama saya)</span>
                </label>

                <div class="tweet-actions">
                    <span class="char-count" id="charCount">0/500</span>
                    <button type="submit" class="btn">📝 Kirim</button>
                </div>
            </form>
        </div>

        <div class="posts-container">
            @forelse($aspirations as $aspiration)
                @php
                    $isAspirationOwner = Auth::id() === $aspiration->user_id;
                    $showAspirationName = !$aspiration->is_anonymous || $isAspirationOwner;
                @endphp

                <div class="post" x-data="{ openReply: false }">
                    <a href="{{ route('aspirations.show', $aspiration->id) }}"
                        style="text-decoration: none; color: inherit;">
                        <div class="post-header">
                            @if (!$showAspirationName)
                                <div class="avatar" style="background: #9ca3af;">?</div>
                            @else
                                <div class="avatar"
                                    style="background: linear-gradient(45deg, #334EAC, #F7CE3E, #BAD6EB, #081F5C);">
                                    {{ substr($aspiration->user->name, 0, 1) }}
                                </div>
                            @endif

                            <div class="post-info">
                                <h3>
                                    @if ($aspiration->is_anonymous)
                                        @if ($isAspirationOwner)
                                            {{ $aspiration->user->name }} <span class="badge-anon-owner">(Diposting sbg
                                                Anonim)</span>
                                        @else
                                            Seseorang (Anonim)
                                        @endif
                                    @else
                                        {{ $aspiration->user->name }}
                                    @endif

                                    @if (!$aspiration->is_anonymous && $aspiration->role === 'admin')
                                        <span class="badge-admin">Admin</span>
                                    @endif
                                </h3>
                                <div class="timestamp">{{ $aspiration->created_at->diffForHumans() }}</div>
                            </div>

                            @if ($isAspirationOwner)
                                <form action="{{ route('aspirations.destroy', $aspiration->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus aspirasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn" title="Hapus">🗑️ Hapus</button>
                                </form>
                            @endif
                        </div>

                        <div class="post-content">
                            {{ Str::limit($aspiration->content, 200, '...') }}
                            {{-- @if (Str::length($aspiration->content) > 200)
                                <a href="{{ route('aspirations.show', $aspiration->id) }}" class="read-more-btn">
                                    Baca Selengkapnya
                                </a>
                            @endif --}}
                        </div>
                    </a>

                    <div class="post-actions">
                        <button class="action-btn" @click="openReply = !openReply">
                            💬 Balas ({{ $aspiration->replies->count() }})
                        </button>
                    </div>

                    <div class="reply-section" x-show="openReply" style="display: none;">
                        <div class="reply-form-container">
                            <form action="{{ route('aspirations.reply.store', $aspiration->id) }}" method="POST">
                                @csrf
                                <div class="reply-input-wrapper">
                                    <input type="text" name="content" placeholder="Tulis balasan..." required
                                        autocomplete="off">
                                    <button type="submit" class="btn-small">Kirim</button>
                                </div>
                                <label class="anon-option">
                                    <input type="checkbox" name="is_anonymous">
                                    <span>Balas sbg Anonim</span>
                                </label>
                            </form>
                        </div>

                        @foreach ($aspiration->replies as $reply)
                            @php
                                $isReplyOwner = Auth::id() === $reply->user_id;
                                $showReplyName = !$reply->is_anonymous || $isReplyOwner;
                            @endphp

                            <div class="comment">
                                <div class="comment-header">
                                    @if (!$showReplyName)
                                        <div class="comment-avatar" style="background: #9ca3af;">?</div>
                                    @else
                                        <div class="comment-avatar"
                                            style="background: linear-gradient(45deg, #F7CE3E, #334EAC, #BAD6EB);">
                                            {{ substr($reply->user->name, 0, 1) }}
                                        </div>
                                    @endif

                                    <div style="flex: 1;">
                                        <h4 style="font-size: 14px; margin:0;">
                                            @if ($reply->is_anonymous)
                                                @if ($isReplyOwner)
                                                    {{ $reply->user->name }} <span class="badge-anon-owner">(Anonim)</span>
                                                @else
                                                    Seseorang (Anonim)
                                                @endif
                                            @else
                                                {{ $reply->user->name }}
                                            @endif
                                        </h4>
                                        <div style="font-size: 11px; color: #888;">
                                            {{ $reply->created_at->diffForHumans() }}
                                        </div>
                                    </div>

                                    @if ($isReplyOwner)
                                        <form action="{{ route('replies.destroy', $reply->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus komentar ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                style="background:none; border:none; color:#dc3545; cursor:pointer; font-size:12px;">✖</button>
                                        </form>
                                    @endif
                                </div>
                                <div class="comment-content">{{ $reply->content }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <h3>🌟 Belum ada tweet</h3>
                    <p>Jadilah yang pertama berbagi pemikiran!</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
