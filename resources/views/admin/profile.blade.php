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
                    <th>Имя</th>
                    <th>email</th>
                    <th>Зарегистрирован</th>
                    <th>Обновлен</th>
                    <th>статус</th>
                    <th>обновить статус</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $item)
                    <tr>
                        <form method="POST" action="{{route('admin.category.update',$item)}}">
                            @csrf
                            @method("PUT")
                            <td>{{ $item->name  }}</td>
                            <td>{{$item}}</td>

                            <td><input type="submit"></td>


                        </form>
                        <td>
                        <form method="POST" action="{{route('admin.category.destroy',$item)}}">
                            @csrf
                            @method('DELETE')
                            <input type="submit">
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
                                   value="{{ old('title') }}" required>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </td>
                        <td>
                            <input id="slot" type="text"
                                   class="bg-transparent form-control @error('slug') is-invalid @enderror" name="slug"
                                   value="{{ old('slug') }}" required>

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
