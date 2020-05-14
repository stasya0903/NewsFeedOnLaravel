@extends('layouts.main')

@section('title')
    @parent Новости
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
        <div class="container pt-5">
            <div class="row d-flex">
                @forelse($news as $item)
                    <div class="col-md-4 d-flex">
                        <div class="blog-entry justify-content-end">
                            <a href="{{route('news.show', $item)}}" class="block-20"
                               style="background-image: url({{$item->image ?? 'https://via.placeholder.com/150x100'}})">
                            </a>
                            <div class="text p-4 float-right d-block">
                                <div class="topper d-flex align-items-center">
                                    <div class="py-0 pl-3 pr-1 align-self-stretch">
                                    </div>
                                    <div class="pl-0 pr-3 py-2 align-self-stretch">
                                        <span class="day">
                                            {{$categories[$item->category_id]->title}}</span>
                                    </div>
                                </div>
                                <h3 class="heading mb-3">{{$item->title}}</h3>

                                <p>
                                    <a href="{{route('news.show',$item)}}" class="btn-custom">
                                        <span class="ion-ios-arrow-round-forward mr-3"></span>
                                        Подробней</a>
                                </p>
                            </div>
                        </div>
                    </div>

                @empty
                    Нет новостей
                @endforelse


            </div>

            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        {{$news->links("pagination::default")}}
                    </div>
                </div>
            </div>
        </div>



@endsection


