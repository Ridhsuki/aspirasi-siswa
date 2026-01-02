@extends('aspirations.layouts.app')
@section('content')
    <div class="container">
        <div class="header">
            <h1>OSIS SMA NEGERI 3 KEPULAUAN ARU</h1>
            <p>Ayo! Berbagi Kritik, Saran dan Masukan demi Kemajuan bersama dengan OSIS SMA NEGERI 3 KEPULAUAN ARU</p>

            <div class="modern-user-bar">
                <div class="profile-info">
                    <div class="user-avatar">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="user-text">
                        <span class="greeting">Halo, Selamat Datang 👋</span>
                        <span class="username">{{ Auth::user()->name }}</span>
                    </div>
                </div>

                <div class="user-actions">
                    <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
                        class="btn-dashboard">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                        Dashboard
                    </a>
                </div>
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

        <div class="posts-container" id="postsContainer">
            @include('aspirations.partials.list', ['aspirations' => $aspirations])
            @if ($aspirations->isEmpty())
                <div class="empty-state">
                    <h3>🌟 Belum ada tweet</h3>
                    <p>Jadilah yang pertama berbagi pemikiran!</p>
                </div>
            @endif
        </div>
        <div style="text-align: center; margin-top: 20px; color: #6b7280; font-size: 0.9em;">
            Menampilkan: <strong id="displayedCount">{{ $aspirations->count() }}</strong>
            dari <strong>{{ $aspirations->total() }}</strong> data.
        </div>
        @if ($aspirations->hasMorePages())
            <div style="text-align: center; margin: 20px 0;">
                <button id="loadMoreBtn" class="btn" style="background: #e5e7eb; color: #374151;">
                    Load More...
                </button>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        let page = 1;
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        const container = document.getElementById('postsContainer');
        const displayedCount = document.getElementById('displayedCount');

        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                page++;
                const originalText = loadMoreBtn.innerText;
                loadMoreBtn.innerText = 'Memuat...';
                loadMoreBtn.disabled = true;

                fetch(`?page=${page}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        if (html.trim() === "") {
                            loadMoreBtn.style.display = 'none';
                        } else {
                            container.insertAdjacentHTML('beforeend', html);

                            const currentTotal = document.querySelectorAll('.posts-container .post').length;

                            if (displayedCount) {
                                displayedCount.innerText = currentTotal;
                            }

                            loadMoreBtn.innerText = 'Load More...';
                            loadMoreBtn.disabled = false;
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        loadMoreBtn.innerText = 'Gagal memuat';
                        loadMoreBtn.disabled = false;
                    });
            });
        }
    </script>
@endpush
