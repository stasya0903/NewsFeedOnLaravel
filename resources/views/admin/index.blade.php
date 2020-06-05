@extends('layouts.main')

@section('menu')
    @include('menu')
@endsection

@section('content')

    <div class="pink-bg">
        <div class="container">
            <div class="text-white rounded bg-transparent p-3">
                <div class="col-md-12 px-0">

                    <p class="lead">
                        Добро пожаловать в Админку
                    </p>
                </div>
            </div>
        </div>

    </div>

    <div class="container">

        <div class="card m-3">
            <div class="card-header">Редактировать</div>
            <div class="row d-flex align-items-baseline m-3 justify-content-around  border-dark border-1">

                <a href="{{route('admin.news.index')}}" class="font-weight-bolder">
                    <button type="submit" class="btn btn-lg btn-outline-secondary pink-bgHover">
                        <i class="fas fa-newspaper"></i>
                        Новости
                    </button>
                </a>
                <a href="{{route('admin.category.index')}}" class="font-weight-bolder">
                    <button type="submit" class="btn btn-lg btn-outline-secondary pink-bgHover">
                        <i class="fas fa-list-ul"></i>
                        Категории
                    </button>
                </a>
                <a href="{{route('admin.resource.index')}}" class="font-weight-bolder">
                    <button type="submit" class="btn btn-lg btn-outline-secondary pink-bgHover">
                        <i class="fas fa-rss"></i>
                        Ресурсы
                    </button>
                </a>
                <a href="{{route('admin.users.edit')}}" class="font-weight-bolder">
                    <button type="submit" class="btn btn-lg btn-outline-secondary pink-bgHover">
                        <i class="fas fa-users"></i>
                        Cтатус пользователей
                    </button>
                </a>

            </div>
        </div>
        <div class="card m-3">
            <div class="card-header">Скачать</div>
            <div class="row d-flex align-items-baseline m-3 justify-content-around  border-dark border-1">

                <a href="{{route('admin.news.export')}}" class="font-weight-bolder">
                    <button type="submit" class="btn btn-lg btn-outline-secondary pink-bgHover">
                        <i class="fas fa-newspaper"></i>
                        Новости
                    </button>
                </a>


            </div>
        </div>


    </div>






@endsection

