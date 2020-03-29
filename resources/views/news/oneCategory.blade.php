@extends('layouts.main')

@section('title')
    {{$category['title']}}
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
        <h3>{{$category['title']}}</h3>
        @foreach($news as $item )
            {{$item['title']}} <a href="{{ route('news.show', $item['id']) }}">Подробнее...</a><br>
        @endforeach
@endsection

@section('footer')
    @include('footer')
@endsection
