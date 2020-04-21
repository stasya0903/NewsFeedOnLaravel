<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain"
                aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->routeIs('Home')?'active':'' }}"><a
                        href="{{ route('Home') }}" class="nav-link">Главная</a></li>


                @auth()
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item dropdown"><a class='nav-link dropdown-toggle'
                                                         href="{{route('admin.index') }}"
                                                         id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
                                                         aria-expanded="false">Админка</a>
                            <div class="dropdown-menu bg-light " aria-labelledby="dropdown01">
                                <a href="{{route('admin.index')}}" class="dropdown-item hoverYellow ">Главная</a>
                                <a href="{{route('admin.news.create')}}" class="dropdown-item hoverYellow ">Добавить
                                    новость</a>
                                <a href="{{route('admin.news.index')}}" class="dropdown-item hoverYellow ">Редактировать
                                    новости</a>

                                <a href="{{route('admin.users.edit')}}" class="dropdown-item hoverYellow ">Редактировать
                                    статус пользователей</a>
                                <a href="{{route('admin.news.export')}}" class="dropdown-item hoverYellow ">Выгрузить
                                    новости</a>
                                <a href="{{route('admin.parser')}}" class="dropdown-item hoverYellow ">Запарсить новости</a>
                            </div>
                        </li>
                        <li class="nav-item {{ request()->routeIs('admin.index')?'active':'' }}">
                            <a href="{{route('admin.index')}}" class="nav-link">Главная</a>
                        </li>
                    @endif
                @endauth
                <li class="nav-item {{ request()->routeIs('news.index')?'active':'' }}"><a
                        href="{{ route('news.index') }}" class="nav-link">News</a></li>
                <li class="nav-item {{ request()->routeIs('news.categories.index')?'active':'' }}"><a
                        href="{{ route('news.categories.index') }}" class="nav-link">Categories</a></li>
            </ul>
        </div>
    </div>
</nav>


