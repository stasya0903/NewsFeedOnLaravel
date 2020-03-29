@extends('layouts.main')

@section('title')
    @parent новости
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
        @foreach($news as $item )
            {{$item['title']}} <a href="{{ route('news.show', $item['id']) }}">Подробнее...</a><br>
        @endforeach
@endsection

@section('footer')
    @include('footer')
@endsection
