@extends("layouts.main")


@section('menu')
    @include('admin.menu')
@endsection

@section("content")


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pink-bg text-white">{{ __('Загрузить новости') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.news.export') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Выберите формат') }}</label>

                                <div class="col-md-6">
                                    <select name="format" id="format">
                                            <option value="JSON">JSON</option>
                                            <option value="EXCEL">EXCEL</option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-outline-secondary pink-bgHover">
                                        {{ __('Загрузить') }}
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
