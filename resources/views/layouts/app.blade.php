<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GoNews') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- {{ $news->title }}', '{{ $news->title }}', '{{ $news->image }} --}}
    <!-- OG meta tags -->
    {{-- <meta property="og:title" content="{{ $news->title }}">
    <meta property="og:description" content="{{ $news->title }}">
    <meta property="og:image" content="{{ $news->image }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter meta tags -->
    <meta name="twitter:title" content="{{ $news->title }}">
    <meta name="twitter:description" content="{{ $news->content }}">
    <meta name="twitter:image" content="{{ $news->image }}">
    <meta name="twitter:card" content="summary_large_image"> --}}

    <!-- Scripts -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <!-- Slick Carousel -->
    <link rel="stylesheet" href="{{ asset('plugins/slick-carousel/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/slick-carousel/slick-theme.css') }}">
    <!-- main stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        @include('layouts.navbar')
        @include('layouts.secondnav')

        <main class="py-4">
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
</body>

</html>
