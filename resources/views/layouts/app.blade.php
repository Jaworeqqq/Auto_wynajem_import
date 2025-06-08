<!DOCTYPE html>
<html lang="pl" class="@if(request()->cookie('theme')=='dark') dark @endif">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title','AutoRent')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif }</style>

</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 antialiased">

{{-- Hero i nagłówek --}}
<header class="relative">
    <div class="h-64 bg-cover bg-center" style="background-image:url('https://www.gstatic.com/webp/gallery/1.webp')">
        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center">
            <div class="container mx-auto px-6">
                <h1 class="text-4xl md:text-5xl font-bold text-white drop-shadow-lg">Wynajem długoterminowy samochodów</h1>
                <p class="mt-2 text-lg text-gray-200/90">Szeroki wybór, najlepsze ceny, pełna elastyczność.</p>
            </div>
        </div>
    </div>
    <nav class="bg-white dark:bg-gray-800 shadow-md">
        <div class="container mx-auto flex items-center justify-between py-4 px-6">
            <a href="{{ route('cars.index') }}" class="text-2xl font-bold text-brand hover:text-brand-dark">AutoRent</a>
            <div class="flex items-center space-x-4">
                <button
                    x-data
                    @click="$dispatch('toggle-theme')"
                    class="p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition"
                >
                    <svg x-show="!document.documentElement.classList.contains('dark')" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a. . ."/></svg>
                    <svg x-show="document.documentElement.classList.contains('dark')" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-200" fill="currentColor" viewBox="0 0 20 20"><path d="M17. . ."/></svg>
                </button>
                <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-brand">Kontakt</a>
            </div>
        </div>
    </nav>
</header>

<main class="container mx-auto px-6 py-8">
    @yield('content')
</main>

<footer class="bg-white dark:bg-gray-800 border-t dark:border-gray-700">
    <div class="container mx-auto py-6 text-center text-sm text-gray-500 dark:text-gray-400">
        © {{ date('Y') }} AutoRent. Wszelkie prawa zastrzeżone.
    </div>
</footer>

<script>
    document.addEventListener('toggle-theme', () => {
        const isDark = document.documentElement.classList.toggle('dark');
        document.cookie = `theme=${isDark ? 'dark' : 'light'};path=/;max-age=31536000`;
    });
</script>
</body>
</html>
