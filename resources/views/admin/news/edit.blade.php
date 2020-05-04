@extends('layouts.main')

@section('title')
    @parent Новости
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">

        @if ($errors->count() > 0)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
        @endif

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
                        <form method="POST" action="{{route('admin.news.update',$item)}}">
                            @csrf
                            @method('PUT')
                            <td>
                                <textarea cols="40"
                                          rows="1"
                                          id="title{{$item->id}}" type="text"
                                          class="border-0 bg-transparent  @error('title') is-invalid @enderror"
                                          name="title"
                                >{{ $item->title }} </textarea>
                            </td>
                            <td>
                                <select name="category_id" id="category"
                                        class="border-0 bg-transparent form-control @error('category') is-invalid @enderror">
                                    @foreach($categories as $category)
                                        <option @if ($category->id == $item->category_id) selected
                                                @endif value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td class="text-center">
                                <button class="bg-transparent border-0" type="submit" >
                                    <span class="icon-update fontSize30"></span></button>
                            </td>

                            <td class="text-center">
                                <a href="{{route('admin.news.edit', $item->id) }}">
                                <span class="icon-edit text-dark fontSize30"></span></a>
                            </td>
                        </form>
                        <td class="align-items-center text-center">
                            <form method="POST" action="{{route('admin.news.destroy',$item)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-transparent border-0">
                                    <span class="icon-delete fontSize30"></span>
                                </button>
                            </form>
                        </td>


                    </tr>

                @endforeach

                </tbody>
            </table>

            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        {{$news->links("pagination::default")}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
