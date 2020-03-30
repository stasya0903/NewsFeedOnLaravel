    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <h2 class="logo"><a href="{{route('Home')  }}">New<span>s</span></a></h2>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a href="{{route('Home')  }}" class="nav-link">welcome page</a></li>
                        <li class="nav-item"><a href="{{ route('news.index') }}" class="nav-link">News</a></li>
                        <li class="nav-item"><a href="{{ route('news.categories.index') }}" class="nav-link">Categories</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

