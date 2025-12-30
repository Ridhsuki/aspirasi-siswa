<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aspirasi Siswa - OSIS SMAN 3 Kepulauan Aru</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #334EAC 0%, #7096D1 50%, #D0E3FF 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            min-height: 100vh;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 20px;
            text-align: center;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .header h1 {
            background: linear-gradient(45deg, #334EAC, #081F5C);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 2.5em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 1.1em;
        }

        .permanent-notice {
            background: linear-gradient(135deg, #FFF9F0, #FFEAA7);
            color: #856404;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
            border: 2px solid #F7CE3E;
            font-size: 14px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(247, 206, 62, 0.2);
        }

        .permanent-notice strong {
            display: block;
            margin-bottom: 5px;
            color: #B7791F;
        }

        .post-form {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #BAD6EB;
            border-radius: 15px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            min-height: 120px;
            resize: vertical;
            font-family: inherit;
        }

        .form-group textarea:focus {
            outline: none;
            border-color: #334EAC;
            box-shadow: 0 0 0 3px rgba(51, 78, 172, 0.1);
            transform: translateY(-2px);
        }

        /* Style Checkbox Anonim */
        .anon-option {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 15px 7px;
            font-size: 13px;
            color: #555;
            cursor: pointer;
        }

        .anon-option input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
            accent-color: #334EAC;
        }

        .tweet-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #BAD6EB;
        }

        .char-count {
            color: #7096D1;
            font-size: 14px;
        }

        .char-count.warning {
            color: #F7CE3E;
            font-weight: bold;
        }

        .btn {
            background: linear-gradient(45deg, #334EAC, #081F5C);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(51, 78, 172, 0.3);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(51, 78, 172, 0.4);
        }

        .post {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 20px;
            margin-bottom: 20px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.18);
            transition: all 0.3s ease;
            animation: slideIn 0.5s ease-out;
        }

        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
            margin-right: 15px;
        }

        .post-info h3 {
            margin: 0;
            color: #333;
            font-size: 18px;
        }

        .post-info .timestamp {
            color: #7096D1;
            font-size: 14px;
            margin-top: 5px;
        }

        .badge-admin {
            background-color: #e0f2fe;
            color: #0369a1;
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 10px;
            margin-left: 5px;
        }

        .badge-anon-owner {
            font-size: 12px;
            color: #666;
            font-style: italic;
            font-weight: normal;
            margin-left: 5px;
        }

        .post-content {
            margin: 20px 0;
            line-height: 1.6;
            font-size: 16px;
            color: #333;
            word-wrap: break-word;
            white-space: pre-line;
        }

        .post-actions {
            display: flex;
            gap: 20px;
            padding-top: 15px;
            border-top: 1px solid #BAD6EB;
            align-items: center;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            background: none;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #7096D1;
            font-weight: 500;
        }

        .action-btn:hover {
            background: rgba(51, 78, 172, 0.1);
            color: #334EAC;
        }

        .delete-btn {
            background: none;
            border: none;
            color: #dc3545;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 12px;
            font-size: 12px;
            transition: all 0.3s ease;
            opacity: 0.7;
            margin-left: auto;
        }

        .delete-btn:hover {
            background: rgba(220, 53, 69, 0.1);
            opacity: 1;
        }

        .reply-section {
            margin-top: 20px;
            border-top: 2px solid #D0E3FF;
            padding-top: 20px;
        }

        .reply-form-container {
            margin-bottom: 15px;
        }

        .reply-input-wrapper {
            display: flex;
            gap: 10px;
            margin-bottom: 5px;
        }

        .reply-input-wrapper input {
            flex: 1;
            padding: 10px 15px;
            border: 2px solid #BAD6EB;
            border-radius: 15px;
            outline: none;
            background: rgba(255, 255, 255, 0.9);
        }

        .btn-small {
            background: #334EAC;
            color: white;
            border: none;
            padding: 0 20px;
            border-radius: 15px;
            cursor: pointer;
            font-weight: bold;
        }

        .comment {
            background: rgba(208, 227, 255, 0.3);
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 15px;
            border-left: 4px solid #334EAC;
        }

        .comment-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .comment-avatar {
            width: 35px;
            height: 35px;
            background: linear-gradient(45deg, #F7CE3E, #334EAC, #BAD6EB);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
            margin-right: 10px;
        }

        .comment-content {
            margin-left: 45px;
            line-height: 1.5;
            color: #555;
        }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #7096D1;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }

        .empty-state h3 {
            margin-bottom: 10px;
            color: #334EAC;
            font-size: 24px;
        }

        .user-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 15px;
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            margin-top: 11px;
        }

        .user-bar span {
            font-size: 14px;
            color: #333;
        }

        .user-bar .logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .user-bar .logout-btn:hover {
            background-color: #c82333;
        }

        .text-error {
            color: #dc3545;
            font-size: 0.85em;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .header h1 {
                font-size: 2em;
            }

            .user-bar {
                flex-direction: column;
                text-align: center;
            }

            .user-bar span {
                margin-bottom: 8px;
            }

            .user-bar .logout-btn {
                width: 100%;
                margin-top: 10px;
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
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

                    <div class="post-content">{{ $aspiration->content }}</div>

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
                                                    {{ $reply->user->name }} <span
                                                        class="badge-anon-owner">(Anonim)</span>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        function updateCharCount(textarea) {
            const maxLength = 500;
            const currentLength = textarea.value.length;
            const counter = document.getElementById('charCount');

            counter.textContent = `${currentLength}/${maxLength}`;

            if (currentLength > 450) {
                counter.classList.add('warning');
            } else {
                counter.classList.remove('warning');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {

            @if (session('success'))
                Toastify({
                    text: "{{ session('success') }}",
                    duration: 4000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "linear-gradient(to right, #28a745, #20c997)",
                        borderRadius: "10px",
                        boxShadow: "0 4px 15px rgba(0, 0, 0, 0.2)",
                        fontWeight: "bold"
                    },
                    onClick: function() {}
                }).showToast();
            @endif

            // Cek Jika ada Error Validasi
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    Toastify({
                        text: "⚠️ {{ $error }}",
                        duration: 5000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        style: {
                            background: "linear-gradient(to right, #dc3545, #fd7e14)",
                            borderRadius: "10px",
                            boxShadow: "0 4px 15px rgba(0, 0, 0, 0.2)",
                            fontWeight: "bold"
                        },
                    }).showToast();
                @endforeach
            @endif
        });
    </script>
</body>

</html>
