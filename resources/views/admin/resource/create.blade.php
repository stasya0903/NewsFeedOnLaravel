@extends("layouts.main")


@section('menu')
    @include('menu')
@endsection

@section("content")
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
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
                                           class="form-control @if($error){{'is-invalid'}}@endif"
                                           name="xmlSrc"
                                           placeholder="Введите валидный источник новостей">
                                    @if($error)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $error }}</strong>
                                    </span>
                                    @endif

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
        </div>
    </div>
@endsection
