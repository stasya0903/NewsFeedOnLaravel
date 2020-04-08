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
                    <th>Категория</th>
                    <th>Обновить</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                </tr>
                </thead>
                <tbody>
                @foreach($news as $item)

                        <tr>
                            <form method="POST" action="{{route('admin.news.update',$item->id)}}">
                                @csrf
                            <td>
                                <textarea cols="40"
                                          rows="1"
                                          id="title" type="text"
                                          class="border-0 bg-transparent  @error('title') is-invalid @enderror"
                                          name="title"
                                          required>{{ $item->title }} </textarea>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </td>
                            <td>
                                <select name="category_id" id="category"
                                        class="border-0 bg-transparent form-control @error('category') is-invalid @enderror">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td><input type="submit"></td>

                    <td><a href="{{route('admin.news.editOne', $item->id) }}"> update </a></td>

                        <td>
                            </form>
                            <form method="POST" action="{{route('admin.news.delete',$item->id)}}">
                            @csrf
                            @method('DELETE')
                            <input type="submit">
                            </form>
                        </td>



                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
