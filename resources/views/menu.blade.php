

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a href="{{route('Home')  }}" class="nav-link">welcome page</a></li>
                        <li class="nav-item"><a href="{{ route('news.index') }}" class="nav-link">News</a></li>
                        <li class="nav-item"><a href="{{ route('news.categories.index') }}" class="nav-link">Categories</a></li>
                    </ul>
                </div>
            </div>
        </nav>


