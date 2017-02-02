<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Главная страница</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="main">
        <header>@include('parts/header')</header>
        <div class="slider">@include('parts/slider')</div>
        <div class="content">@yield('content')</div>
        <footer>@include('parts/footer')</footer>
    </div>
<link rel="stylesheet" href="/css/app2.css">
</body>
</html>