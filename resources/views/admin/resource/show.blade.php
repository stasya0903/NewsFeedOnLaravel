@extends('layouts.main')

@section('title')
    {{$resource->title}}
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container pt-5">
        <div class="p-4 p-md-5 mb-4 text-white rounded pink-bg">
            <div class="col-md-6 px-0">
                <h1 class="display-4 text-white">{{$resource->title}}</h1>
            </div>
        </div>
        <div class="row d-flex">
            @forelse($news as $item)
                <div class="col-md-3 d-flex">
                    <div class="blog-entry">
                        <img src="{{$item->image ?? 'https://via.placeholder.com/150x100'}}" class="card-img-top" alt="...">
                        <div class="text p-4 float-left d-block">
                            <h3 class="heading text-left">{{$item->title}}</h3>
                            <p><a href="{{ route('news.show', $item->id)}}" class="btn-custom"><span
                                        class="more ion-ios-arrow-round-forward mr-2"></span>Подробнее</a></p>
                        </div>
                    </div>
                </div>
            @empty
                Нет новостей
            @endforelse
        </div>
    </div>
@endsection


