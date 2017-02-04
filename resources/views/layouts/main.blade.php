<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Умный Дракоша - @yield('title','Конкурс для младших классов')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="main">
        <header>@include('parts/header')</header>
        <main class="content">@yield('content')</main>
        <footer>@include('parts/footer')</footer>
    </div>

    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <link rel="stylesheet" href="/css/app2.css">
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/vue-resource@1.1.2/dist/vue-resource.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vex-js/3.0.0/js/vex.combined.min.js"></script>

    <script>vex.defaultOptions.className = 'vex-theme-default'</script>
    <script src="/js/app.js"></script>
</body>
</html>