@extends("layouts.main")


@section('menu')
    @include('menu')
@endsection

@section("content")
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pink-bg text-white text-center">@if(!$news->id){{ __('Добавить новость') }} @else {{ __('Обновить новость') }} @endif</div>

                    <div class="card-body">
                        <form enctype="multipart/form-data"
                              method="POST"
                              action="@if(!$news->id){{ route('admin.news.store') }}@else{{ route('admin.news.update', $news) }}@endif">
                            @csrf
                            @if($news->id) @method('PUT') @endif
                            <div class="form-group row">
                                <label for="title"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Заголовок') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror" name="title"
                                           value="{{  old('title') ?? $news->title}}" >
                                    @error('title')
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
                                            <option @if ($item->id == old('category_id') || $item->id == $news->category_id) selected @endif value="{{$item->id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>

                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="text"
                                       class="col-md-12 col-form-label text-md-center">{{ __('Текст новости') }}</label>

                                <div class="col-md-12">
                                    <textarea id="title" type="text"
                                              class="form-control @error('text') is-invalid @enderror"
                                              name="text"
                                              id="summary-ckeditor"
                                              >{{ old('text') ?? $news->text }}</textarea>
                                    @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row">

                                <div class="col-md-6 offset-md-4">

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="private"
                                               id="private" {{ old('private') ? 'checked' : '' ?? $item->isPrivate ? 'checked' : ''  }}>

                                        <label class="form-check-label" for="private">
                                            {{ __('Приватная') }}
                                        </label>
                                        @error('private')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="text"
                                       class="col-md-4 col-form-label text-md-right @error('image') is-invalid @enderror">{{ __('Добавить изображение') }}
                                    </label>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <div class="form-group">
                                            <input type="file" name="image" class="@error('image') is-invalid @enderror">
                                            @error('image')
                                            <span class="invalid-feedback" role="alert" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror

                                        </div>

                                    </div>


                                </div>

                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-outline-secondary pink-bgHover">
                                        @if($news->id){{ __('Обновить новость') }}@else{{ __('Добавить новость') }}@endif
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script> var options = {
            filebrowserImageBrowseUrl: '/filemanager?type=Images',
            filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: '/filemanager?type=Files',
            filebrowserUploadUrl: '/filemanager/upload?type=Files&_token={{ csrf_token() }}'
        };
        CKEDITOR.replace( 'text', options );
    </script>
@endsection
