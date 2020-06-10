<header class="blog-header py-3 container-fluid w-100">
    <div class="row flex-nowrap justify-content-between align-items-center ml-3 mr-3">
        <form class=" d-flex justify-content-center md-form form-sm mt-0">
            <i class="line-height-3 fas fa-search" aria-hidden="true"></i>
            <input class="bg-transparent form-control form-control-sm ml-3 w-75 form-underline" type="text"
                   aria-label="Search">
        </form>

        <Search></Search>
        <search></search>

        <div class="d-flex justify-content-sm-between align-items-center">
            <!-- Authentication Links -->
            @guest
                <div class="d-flex justify-content-between">
                    <div class="m-2">
                        <a class="btn btn-sm btn-outline-secondary pink-bgHover" href="{{route('login')}}">
                            <span class="d-none d-lg-inline">Войти</span>
                            <span class="d-lg-none d-sm-inline d-xs-inline">
                                <i class="fas fa-sign-in-alt"></i>
                            </span>
                        </a>
                    </div>
                    <div class="m-2">
                        @if (Route::has('register'))
                            <a class="btn btn-sm btn-outline-secondary pink-bgHover"
                               href="{{route('register')}}">
                                <span class="d-none d-lg-inline"> Регистрация</span>

                            <span class="d-lg-none d-sm-inline d-xs-inline">
                                <i class="fas fa-user-plus"></i>
                            </span>
                            </a>
                    </div>
                </div>

            @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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

