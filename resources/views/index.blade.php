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
            <div class="text-white rounded bg-transparent p-3">
                <div class="col-md-12 px-0">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @guest
                        <p class="lead">
                            <a href="{{route('login')}}" class="text-white font-weight-bold font-italic">Зарегистрируйтесь</a>
                            </p>
                        <p>Для доступа ко всем ресурсам.</p>

                    @else
                            <p class="lead">
                                Добро пожаловать
                            </p>
                            <p>{{ Auth::user()->name }} </p>

                    @endguest


                </div>
            </div>

        </div>
    </div>

@isset($news)
            <div class="case container mt-4">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-8 d-flex">
                        <a href="{{route('news.show', $news)}}" class="img w-100 mb-3 mb-md-0"
                           style="background-image: url({{$news->image}});"></a>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-4 d-flex">
                        <div class="text w-100 pl-md-3">
                            <span class="subheading">{{$category->title}}</span>
                            <h2><a href="{{route('news.show', $news)}}">{{$news->title}}</a></h2>
                            <div class="meta">
                                <p class="mb-0">
                                    <a href="#">{{Date::parse($news->created_at)->format('d/m/Y')}}</a> |
                                    <a href="#">@if($hoursAgo > 0){{$hoursAgo}}
                                        {{Lang::choice('час|часа|часов', $hoursAgo, [], 'ru')}}  назад</a>
                                @else
                                    Меньше часа назад
                                @endif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endisset
@endsection
