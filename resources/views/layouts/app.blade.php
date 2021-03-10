<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Toudou - @yield('title')</title>
    <!-- Styles -->

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
   

</head>

<body class="dark:bg-black">
    @section('sidebar')
        <div class="bg-light dark:bg-black h-24 flex justify-between p-6 items-center">
            <a href="/" class="flex space-x-4 items-center cursor-pointer">
                <img src="{{ asset('images/cloudy.svg') }}" width="60" height="60">
                <span class="text-white font-bold text-5xl hover:text-opacity-70">toudou</span>
            </a>
        @section('share')
        @show
        @guest <a href="/login"><i class="flex fa fa-user-circle fa-4x text-white hover:text-opacity-70"></i></a>
        @endguest
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">
                    <i class="flex fa fa-user-circle fa-4x text-white hover:text-opacity-70"></i>
                </button>
            </form>

        @endauth
    </div>
@show
@yield('content')
@yield('scripts')

<script>
    if (localStorage.getItem("darkmode") !== null) {
        const html = document.getElementsByTagName('html')[0];
        if (localStorage.getItem("darkmode") === 'true') {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }
    }

</script>

</body>

</html>
