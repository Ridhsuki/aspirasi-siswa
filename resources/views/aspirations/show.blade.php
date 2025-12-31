<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aspirasi - OSIS SMAN 3 Kepulauan Aru</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        /* Copy semua style dari main.blade.php ke sini, atau pindahkan ke file css terpisah */
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

        .btn-back {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            text-decoration: none;
            color: #334EAC;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .btn-back:hover {
            transform: translateX(-5px);
            background: white;
        }

        /* Style Post & Comments (Sama seperti main.blade.php) */
        .post {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 20px;
            margin-bottom: 20px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.18);
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

        /* Style untuk Reply Section (Langsung ditampilkan) */
        .reply-section {
            margin-top: 30px;
            border-top: 2px solid #D0E3FF;
            padding-top: 20px;
        }

        .reply-form-container {
            margin-bottom: 25px;
        }

        .reply-input-wrapper {
            display: flex;
            gap: 10px;
            margin-bottom: 5px;
        }

        .reply-input-wrapper input {
            flex: 1;
            padding: 12px 15px;
            border: 2px solid #BAD6EB;
            border-radius: 15px;
            outline: none;
            background: rgba(255, 255, 255, 0.9);
        }

        .btn-small {
            background: #334EAC;
            color: white;
            border: none;
            padding: 0 25px;
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

        .anon-option {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 10px 0;
            font-size: 13px;
            color: #555;
            cursor: pointer;
        }

        .delete-btn {
            background: none;
            border: none;
            color: #dc3545;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 12px;
            font-size: 12px;
            margin-left: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="{{ route('aspirations.index') }}" class="btn-back">← Kembali ke Beranda</a>

        @php
            $isAspirationOwner = Auth::id() === $aspiration->user_id;
            $showAspirationName = !$aspiration->is_anonymous || $isAspirationOwner;
        @endphp

        <div class="post">
            <div class="post-header">
                @if (!$showAspirationName)
                    <div class="avatar" style="background: #9ca3af;">?</div>
                @else
                    <div class="avatar" style="background: linear-gradient(45deg, #334EAC, #F7CE3E, #BAD6EB, #081F5C);">
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

                        @if (!$aspiration->is_anonymous && $aspiration->user->role === 'admin')
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
                        <button type="submit" class="delete-btn">🗑️ Hapus</button>
                    </form>
                @endif
            </div>

            <div class="post-content">{{ $aspiration->content }}</div>

            <div class="reply-section">
                <h3 style="margin-bottom: 15px; color: #334EAC;">Komentar & Balasan
                    ({{ $aspiration->replies->count() }})</h3>

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
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        @if (session('success'))
            Toastify({
                text: "{{ session('success') }}",
                duration: 4000,
                close: true,
                gravity: "top",
                position: "right",
                style: {
                    background: "linear-gradient(to right, #28a745, #20c997)",
                    borderRadius: "10px"
                }
            }).showToast();
        @endif
    </script>
</body>

</html>
