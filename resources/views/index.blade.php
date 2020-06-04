@extends('layouts.main')

@section('title')
    @parent Главная
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="pink-bg">
        <div class="container">
            <div class="text-white rounded bg-transparent">
                <div class="col-md-12 px-0">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @guest
                        <div class="lead text-center justify-content-lg-around d-lg-flex">
                            <div> Для доступа ко всем ресурсам:</div>
                            <div>
                                <a href="{{route('register')}}" class="text-white">
                                    <i class="fas fa-user-plus"></i>
                                    Зарегистрируйтесь
                                </a>
                            </div>
                            <div>
                                <a href="{{route('login')}}" class="text-white">
                                    <i class="fas fa-sign-in-alt"></i>
                                    Войдите в систему
                                </a>
                            </div>
                        </div>
                    @else
                        <p class="lead text-center">
                            Добро пожаловать {{ Auth::user()->name }} </p>
                    @endguest
                </div>
            </div>

        </div>
    </div>

    @forelse($news as $item)
        <div class="case container mt-3">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-8 d-flex">
                    <a href="{{route('news.show', $item)}}" class="img w-80 mb-3 mb-md-0"
                       style="background-image: url({{$item->image}});"></a>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-4 d-flex">
                    <div class="text w-80 pl-md-3">
                        <span class="subheading">{{$categories[$item->category_id]->title}}</span>
                        <h2><a href="{{route('news.show', $item)}}">{{$item->title}}</a></h2>
                        <div class="meta">
                            <p class="mb-0">
                                <a href="#">{{Date::parse($item->created_at)->format('d/m/Y')}}</a> |
                                <a href="#">@if($item->getAgeInHours() > 0){{$item->getAgeInHours()}}
                                    {{Lang::choice('час|часа|часов', $item->getAgeInHours(), [], 'ru')}}  назад</a>
                                @else
                                    Меньше часа назад
                                @endif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        Нет новостей
    @endforelse

@endsection
