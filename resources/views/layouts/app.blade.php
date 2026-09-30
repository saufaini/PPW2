<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Home') | Portofolio Saya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col bg-slate-50 font-sans text-slate-700 antialiased">
    @include('layouts.navigation')

    <main class="mx-auto w-full max-w-5xl flex-1 px-4 py-8">
        @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if (session('info'))    <div class="alert alert-info">{{ session('info') }}</div> @endif
        @if (session('error'))   <div class="alert alert-danger">{{ session('error') }}</div> @endif

        @yield('content')
    </main>

    <footer class="bg-indigo-700 py-4 text-center text-sm font-medium text-white">
        &copy; {{ date('Y') }} Portofolio Saya. All rights reserved.
    </footer>
</body>
</html>