@extends('layouts.main')

@section('title')
    @parent Новости
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="p-4 p-md-5 mb-4 text-white rounded pink-bg">
            <div class="col-md-6 px-0">
                <h1 class="display-4">Категории</h1>
                <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and
                    efficiently about what’s most interesting in this post’s contents.</p>
                <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
            </div>
        </div>
        <div class="row d-flex align-items-baseline justify-content-center">
            @forelse($categories as $item)
                <div class="card m-2 text-center">
                    <div class="card-body">
                        <a class='simpleHeader grey hoverYellow'
                           href="{{ route('news.categories.show', $item->slug) }}">{{$item->title}}</a>
                    </div>
                </div>
            @empty
                Нет категорий
            @endforelse
        </div>
    </div>
@endsection
