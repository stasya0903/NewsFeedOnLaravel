@extends("layouts.main")


@section('menu')
    @include('menu')
@endsection

@section("content")
    <div class="container">
        <div class="row justify-content-lg-around mr-3 mb-5">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header pink-bg text-white text-center">{{ __('Добавить источник')  }}</div>

                    <div class="card-body">
                        <form enctype="multipart/form-data" method="POST" action="{{ route('admin.resource.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="xmlSrc"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Xml Источник') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control
                                           @error('xmlSrc'){{'is-invalid'}}@enderror"
                                           name="xmlSrc"
                                           value="{{old('xmlSrc')}}"
                                           placeholder="Введите валидный источник новостей">
                                    @error('xmlSrc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
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
                        <div class="card-header pink-bg text-white text-center">{{ __('Загрузить новости')  }}</div>
                        <div class="card-body">

                                <a href="{{route('admin.parser')}}"
                                    class="btn btn-outline-secondary pink-bgHover">
                                    {{ __('Запарсить новости со всех источников') }}
                                </a>

                            <example-component :total-steps="{{session('totalSteps') ?? 0}}"></example-component>
                        </div>
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
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($resources as $item)
                <tr>
                    <form method="POST" action="{{route('admin.resource.destroy',$item)}}">
                        @csrf
                        @method("DELETE")
                        <td><p><a href="{{route('admin.resource.show', $item)}}">{{ $item->title  }} </a></p></td>
                        <td><p><a href="{{ $item->link  }} ">{{ $item->link  }}</a>  </p></td>
                        <td><p><a href="{{ $item->xmlSrc  }}">{{ $item->xmlSrc  }}</a>  </p>
                        </td>
                        <td>
                            <img src="{{$item->image}}" alt="" class="img-thumbnail bg-transparent border-0">
                        </td>
                        <td><input type="submit" value="Удалить"></td>

                    </form>
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
