<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown"><a class='nav-link dropdown-toggle' href="{{route('admin.index') }}" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Админка</a>
                    <div class="dropdown-menu bg-light " aria-labelledby="dropdown01">
                        <a href="{{route('admin.news.index')}}" class="dropdown-item hoverYellow ">Главная</a>
                        <a href="{{route('admin.news.create')}}" class="dropdown-item hoverYellow ">Добавить новость</a>
                        <a href="{{route('admin.news.export')}}" class="dropdown-item hoverYellow ">Выгрузить новости</a>
                    </div></li>
                    <li class="nav-item"><a href="{{ route('admin.news.index') }}" class="nav-link">Новости</a></li>
                    <li class="nav-item"><a href="{{ route('admin.news.categories.index') }}" class="nav-link">Категории</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

