@extends('layouts.main')

@section('title')
    @parent {{$news['title']}}
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <h2>{{ $news['title'] }}</h2>
    <p>{{ $news['text'] }}</p>
@endsection

@section('footer')
    @include('footer')
@endsection
