@extends('layouts.main')

@section('title')
    @parent {{$news->title}}
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row mt-4">
            <form enctype="multipart/form-data" method="POST" action="{{ route('admin.news.update', $news->id) }}">
                @csrf
                @method('PUT')

                <div class="row justify-content-md-center">


                    <div class="col-4 card mb-4 justify-content-md-center">
                        <div class="card-body">
                            <h5 class="card-title">загрузить новое изображение</h5>
                            <label for="text"
                                   class="card-title">{{ __('Добавить изображение') }}
                            </label>
                            <div class="">
                                <div class="form-check">
                                    <div class="form-group">
                                        <input type="file" name="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <img src="https://via.placeholder.com/250x150" class="card-img-top" alt="...">
                    </div>

                </div>

                <h3 class="pb-4  mb-4 font-italic border-bottom">
                    Источник
                </h3>
                <div class="blog-post">
                    <h2 class="blog-post-title">
                        <input id="title" type="text"
                               class="blog-post-title bg-transparent border-0 @error('title') is-invalid @enderror"
                               name="title"
                               value="{{ $news->title }}" required>
                    </h2>
                    <p class="blog-post-meta">January 1, 2014 by <span class="yellow">Mark</span></p>
                    <textarea cols="150"
                              rows="25"
                              id="title" type="text"
                              class="border-0 bg-transparent  @error('title') is-invalid @enderror"
                              name="text"
                              required>{{ $news->text }} </textarea>
                </div>
                <div class="col-md-8 offset-md-5">
                    <button type="submit" class="btn btn-outline-secondary pink-bgHover">
                        Обновить новость
                    </button>

                </div>
            </form>
        </div>

    </div>
@endsection


