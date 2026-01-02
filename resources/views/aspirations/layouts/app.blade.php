<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.partials.seo')
    <title>@yield('title', 'Aspirasi Siswa') | {{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="{{ minify('assets/css/asp.css') }}">
    @stack('styles')
</head>

<body>
    @yield('content')
    @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="{{ minify('assets/js/asp.js') }}"></script>
    <script>
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
