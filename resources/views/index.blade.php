@extends('layouts.main')

@section('title')
    @parent Главная
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <p>Здравствуйте!</p>
@endsection
@section('footer')
    @include('footer')
@endsection
