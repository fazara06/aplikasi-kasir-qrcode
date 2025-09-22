<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{-- Judul halaman dinamis untuk SEO yang lebih baik --}}
        <title>{{ ($title ?? '') ? $title . ' - ' . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}</title>
        
        {{-- Partial ini idealnya berisi link ke CSS (Vite) dan font --}}
        @include('partials.head')

        {{-- Stack untuk menambahkan tag tambahan di head dari halaman lain --}}
        @stack('head')
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-100 dark:text-gray-100 dark:bg-zinc-800 transition-colors duration-300">

        {{-- Slot utama untuk konten halaman --}}
        <main>
            {{ $slot }}
        </main>

        {{-- Directive untuk script dari package --}}
        @fluxScripts

        {{-- Stack untuk menambahkan script khusus dari halaman lain --}}
        @stack('scripts')
    </body>
</html>