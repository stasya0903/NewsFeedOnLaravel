@extends('layouts.errors')

@section('title', __('Not Found'))
@section('code', '404')
@section('message')
    @empty($exception->getMessage())
    <h2>Ничего не найдено</h2>
    @endisset
    <h2>{{$exception->getMessage()}}</h2>

@endsection
