@extends("layouts.main")


@section('menu')
    @include('admin.menu')
@endsection

@section("content")


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pink-bg text-white">{{ __('Добавить новость') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.create') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="title"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Название') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror" name="title"
                                           value="{{ old('title') }}" required>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Категория') }}</label>

                                <div class="col-md-6">
                                    <select name="category_id" id="category"
                                            class="form-control @error('category') is-invalid @enderror">
                                        @foreach($categories as $item)
                                            <option value="{{$item['id']}}">{{$item['title']}}</option>
                                        @endforeach
                                    </select>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="text"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Текст новости') }}</label>

                                <div class="col-md-6">
                                    <textarea id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror" name="text"
                                              value="{{ old('title') }}" required>{{ old('text') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="private"
                                               id="private" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Приватная') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-outline-secondary pink-bgHover">
                                        {{ __('Добавить новость') }}
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
