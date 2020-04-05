@extends('layouts.main')

@section('title')
    @parent {{$news->title}}
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">

<div class="row mt-4">


    <div class="col-md-8 blog-main">
        <div class="card-img d-flex">
            <img class='m-5 img-thumbnail' src="https://via.placeholder.com/250x150" alt="newsPic">
        </div>

        <h3 class="pb-4  mb-4 font-italic border-bottom">
            Источник
        </h3>
        <div class="blog-post">
            <h2 class="blog-post-title">
                {{ $news->title }}
            </h2>
            <p class="blog-post-meta">January 1, 2014 by <span class="yellow">Mark</span></p>
            <p>{{ $news->text }}</p>
        </div>
    </div>
    <aside class="col-md-4 blog-sidebar">
        <div class="p-4 mb-3 bg-light rounded">
            <h4 class="font-italic">About</h4>
            <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
        </div>
    </aside>
</div>

    </div>
@endsection


