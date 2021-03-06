<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{route('orders')}}">Управление заявками</a></li>
                <li><a href="{{route('tasks')}}">Задания</a></li>
                <li><a href="{{route('admin.results')}}">Результаты</a></li>
                <li><a href="{{route('admin.feedback')}}">Обратная связь</a></li>
                {{--<li><a href="{{route('admin.answers')}}">Ответы</a></li>--}}
                {{--<li><a href="{{route('adminzone')}}">Настройки конкурса</a></li>--}}
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/">На сайт</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>