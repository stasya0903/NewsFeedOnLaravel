@extends('layouts.main')

@section('title')
    @parent Новости
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div id="app">

    </div>

    <div class="container">
        <div class="">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Слот</th>
                    <th>Обновить</th>
                    <th>Удалить</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $item)
                    <tr>
                        <form method="POST" action="{{route('admin.news.categories.update',$item->id)}}">
                            @csrf
                            <td>
                                <input id="title" type="text"
                                       class="form-control bg-transparent border-0 @error('title') is-invalid @enderror"
                                       name="title"
                                       value="{{ $item->title }}" required>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </td>
                            <td>
                                <input id="slot" type="text"
                                       class="form-control bg-transparent  border-0 @error('title') is-invalid @enderror"
                                       name="slot"
                                       value="{{ $item->slug}}" required>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </td>

                            <td><input type="submit"></td>


                        </form>
                        <td>
                        <form method="POST" action="{{route('admin.news.categories.delete',$item->id)}}">
                            @csrf
                            @method('DELETE')
                            <input type="submit">
                        </form>
                        </td>


                    </tr>


                @endforeach
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.news.categories.store') }}">
                    @csrf
                    <tr>
                        <td>
                            <input id="title" type="text"
                                   class="bg-transparent form-control @error('title') is-invalid @enderror" name="title"
                                   value="{{ old('title') }}" required>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </td>
                        <td>
                            <input id="slot" type="text"
                                   class="bg-transparent form-control @error('title') is-invalid @enderror" name="slot"
                                   value="{{ old('slug') }}" required>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </td>
                        <td colspan="2">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-outline-secondary pink-bgHover">
                                    {{ __('Добавить категорию') }}
                                </button>

                            </div>
                        </td>
                    </tr>
                </form>

                </tbody>
            </table>
        </div>
    </div>
@endsection
