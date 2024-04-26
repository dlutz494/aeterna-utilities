<!DOCTYPE html>
<script lang="js">
    if (localStorage.getItem('theme'))
        if (localStorage.getItem('theme') === 'dark') {
            document.querySelector('html').setAttribute('data-theme', 'dark');
        } else {
            document.querySelector('html').setAttribute('data-theme', 'light');
        }
    else {
        if (window.matchMedia('(prefers-color-scheme: dark)').matches === true) {
            document.querySelector('html').setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.querySelector('html').setAttribute('data-theme', 'light');
            localStorage.setItem('theme', 'light');
        }
    }
</script>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased bg-blue-300 dark:bg-blue-950">
        @inertia
    </body>
</html>
