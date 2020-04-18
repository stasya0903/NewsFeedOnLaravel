<header class="blog-header py-3 container-fluid">
    <div class="row flex-nowrap justify-content-between align-items-center ml-3 mr-3">
        <form class=" d-flex justify-content-center md-form form-sm mt-0">
            <i class="fas fa-search" aria-hidden="true"></i>
            <input class="bg-transparent form-control form-control-sm ml-3 w-75 form-underline" type="text"
                   placeholder="Search"
                   aria-label="Search">
        </form>
        <div class="col-4 text-center">
            <h2 class="logo"><a href="{{route('Home')  }}">New<span>s</span></a></h2>
        </div>

        <div class="col-2 d-flex justify-content-sm-between align-items-center">
            <!-- Authentication Links -->
            @guest
                <a class="btn btn-sm btn-outline-secondary pink-bgHover" href="{{route('login')}}">Войти</a>
                @if (Route::has('register'))
                    <a class="btn btn-sm btn-outline-secondary pink-bgHover"
                       href="{{route('register')}}">Регистрация</a>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Выйти') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            {{ __('Изменить профиль') }}
                        </a>
                    </div>
                </li>
            @endguest
        </div>
    </div>
</header>
