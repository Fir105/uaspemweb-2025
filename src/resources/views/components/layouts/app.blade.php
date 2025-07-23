<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'UAS Pemweb' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-900">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4">
            <h1 class="text-2xl font-bold">{{ $header ?? 'Selamat Datang' }}</h1>
        </div>
    </header>

    <main class="py-8">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
