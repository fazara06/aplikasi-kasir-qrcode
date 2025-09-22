<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

{{-- Meta Tag Dasar untuk SEO --}}
<title>{{ ($title ?? '') ? $title . ' - ' . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}</title>
<meta name="description" content="{{ $description ?? 'Deskripsi default untuk aplikasi Anda.' }}">

{{-- Ikon untuk Berbagai Perangkat --}}
<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="manifest" href="/site.webmanifest"> {{-- Untuk PWA & "Add to Homescreen" --}}
<meta name="theme-color" content="#ffffff"> {{-- Warna tema untuk browser mobile --}}

{{-- Open Graph / Facebook / WhatsApp (Untuk tampilan saat link di-share) --}}
<meta property="og:title" content="{{ $title ?? config('app.name') }}">
<meta property="og:description" content="{{ $description ?? 'Deskripsi default untuk aplikasi Anda.' }}">
<meta property="og:image" content="{{ $ogImage ?? asset('/og-image.jpg') }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title ?? config('app.name') }}">
<meta name="twitter:description" content="{{ $description ?? 'Deskripsi default untuk aplikasi Anda.' }}">
<meta name="twitter:image" content="{{ $ogImage ?? asset('/og-image.jpg') }}">

{{-- Optimasi Pemuatan Font --}}
<link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet" />

{{-- Aset Aplikasi (CSS & JS) --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])