<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Умный Дракоша - @yield('title','Конкурс для младших классов')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="/images/favicon.png" />

    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <link rel="stylesheet" href="/css/{{css()}}">
    {{--<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=cyrillic" rel="stylesheet">--}}

</head>
<body>

    <div class="main">
        @if( App\User::isAdmin( Auth::user() ) )
            <ul class="admin-panel">
                <li><a href="{{route('adminzone')}}"><i class="fa fa-cog" aria-hidden="true"></i>Управление</a></li>
            </ul>
        @endif

        <header>@include('parts/header')</header>
        <main class="content"  id="main-content">@yield('content')</main>
        <footer>@include('parts/footer')</footer>
    </div>




    <script src='https://www.google.com/recaptcha/api.js' async></script>
    <script src="/js/{{js()}}" async></script>
</body>
</html>