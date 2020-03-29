@extends('layouts.main')

@section('title')
    @parent Новости
@endsection

@section('content')
    @forelse($news as $item)
            <a href="{{ route('news.show', $item['id']) }}">Подробнее...</a><br>
        <hr>
    @empty
        Нет новостей
    @endforelse
@endsection
