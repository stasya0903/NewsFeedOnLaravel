@extends("layouts.main")


@section('menu')
    @include('menu')
@endsection

@section("content")
    <div class="container">
        <div class="row justify-content-lg-around mb-5">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header text-center">{{ __('Добавить источник ')  }}</div>

                    <div class="card-body">
                        <form enctype="multipart/form-data" method="POST" action="{{ route('admin.resource.store') }}">
                            @csrf
                            <div class="form-group">

                                <input id="title" type="text"
                                       class="form-control
                                           @error('xmlSrc'){{'is-invalid'}}@enderror"
                                       name="xmlSrc"
                                       value="{{old('xmlSrc')}}"
                                       placeholder="Введите валидный XML источник ">
                                @error('xmlSrc')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-3">
                                    <button type="submit" class="btn btn-outline-secondary pink-bgHover">
                                        {{ __('Добавить источник') }}
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div id="app">
                    <div class="card">
                        <div class="card-header text-center">{{ __('Загрузка Новостей')  }}</div>
                        <div class="card-body ">

                            <a href="{{route('admin.parser')}}"
                               class="btn btn-outline-secondary pink-bgHover">
                                {{ __('Запарсить новости со всех источников') }}
                            </a>


                            <example-component :total-steps="{{session('totalSteps') ?? 0}}"></example-component>
                        </div>


                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div id="app">
                    <div class="card">
                        <div class="card-header text-center">{{ __('Удаление новостей')  }}</div>
                        <form enctype="multipart/form-data"
                              method="POST"
                              action="{{route('admin.news.deleteOld')}}">
                            @csrf
                            @method('DELETE')

                            <div class="card-body">
                                @if($maximumNewsAge >= 0)
                                    <div class="form-group row">
                                        <label for="days"
                                               class="col-md-8 col-form-label text-md-right">
                                            {{ __('Удалить новости загруженные более дней назад') }}</label>

                                        <div class="col-sm-4">
                                            <select name="days_ago" id="days_ago"
                                                    class="form-control">
                                                @foreach( $NewsAgeArray as $day)
                                                    <option selected
                                                            value="{{ $day }}">{{ $day }}</option>
                                                @endforeach
                                            </select>


                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-outline-secondary pink-bgHover">
                                                {{ __('Удалить') }}
                                            </button>

                                        </div>
                                    </div>
                                @else
                                    <div class="card-body">
                                        Все новости актуальны. Нет новостей добавленых более 1 дня назад
                                    </div>
                                @endif


                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>


        <table class="table table-striped mt-2">
            <thead>
            <tr>
                <th>Название</th>
                <th>Url</th>
                <th>XML Url</th>
                <th>Картинка</th>
                <th class="align-items-center text-center">Загрузить новости</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($resources as $item)
                <tr>

                    <td><p><a href="{{route('admin.resource.show', $item)}}">{{ $item->title  }} </a></p></td>
                    <td><p><a href="{{ $item->link  }} ">{{ $item->link  }}</a></p></td>
                    <td><p><a href="{{ $item->xmlSrc  }}">{{ $item->xmlSrc  }}</a></p>
                    </td>
                    <td>
                        <img src="{{$item->image}}" alt="" class="img-thumbnail bg-transparent border-0">
                    </td>
                    <td class="align-items-center text-center">
                        <p>
                            <a href="{{route('admin.parseByResource', $item)}}">
                                <span class="fas fa-arrow-circle-down fontSize30"></span>
                            </a>
                        </p>
                    </td>
                    <td class="align-items-center text-center">
                        <form method="POST" action="{{route('admin.resource.destroy',$item)}}">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="bg-transparent border-0 text-center">
                                <span class="icon-delete fontSize30"></span>
                            </button>
                        </form>
                    </td>


                </tr>

            @empty
                <tr>
                    <td>Нет Ресурсов</td>
                </tr>
            @endforelse

            </tbody>
        </table>

    </div>
@endsection
