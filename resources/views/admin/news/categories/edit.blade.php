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
                        <form method="POST" action="{{route('admin.category.update',$item)}}">
                            @csrf
                            @method("PUT")
                            <td>
                                <input id="title" type="text"
                                       class="form-control bg-transparent border-0 {{($errors->{$item->slug}->first('title')) ?'is-invalid' : ''}}"
                                       name="title"
                                       value="{{ $item->title  }}">
                                @if ($errors->{$item->slug}->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        {{$errors->{$item->slug}->first('title')}}
                                        </span>
                                @endif
                            </td>
                            <td>
                                <input id="slot" type="text"
                                       class="form-control bg-transparent  border-0 {{($errors->{$item->slug}->first('slug')) ?'is-invalid' : ''}}"
                                       name="slug"
                                       value="{{ $item->slug}}">

                                @if ($errors->{$item->slug}->has('slug'))
                                    <span class="invalid-feedback" role="alert">
                                        {{$errors->{$item->slug}->first('slug')}}
                                        </span>
                                @endif

                            </td>

                            <td>
                                <button class="bg-transparent border-0" type="submit">
                                    <span class="icon-update fontSize30"></span>
                                </button>
                            </td>


                        </form>
                        <td>
                            <form method="POST" action="{{route('admin.category.destroy',$item)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-transparent border-0">
                                    <span class="icon-edit text-dark fontSize30"></span>
                                </button>
                            </form>
                        </td>


                    </tr>


                @endforeach
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.category.store') }}">
                    @csrf
                    <tr>
                        <td>
                            <input id="title" type="text"
                                   class="bg-transparent form-control @error('title') is-invalid @enderror" name="title"
                                   value="{{ old('title') }}">

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </td>
                        <td>
                            <input id="slot" type="text"
                                   class="bg-transparent form-control @error('slug') is-invalid @enderror" name="slug"
                                   value="{{ old('slug') }}">

                            @error('slug')
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
