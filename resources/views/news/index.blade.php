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
                    {{--<div class="col-md-6">
                        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative ">
                            <div class="col p-4 d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 ">{{$categories[$item->category_id]->title}}</strong>
                                <h3 class="mb-0 yellow">{{$item->title}}</h3>
                                <div class="mb-1 text-muted">{{$item->updated_at->format('d/m')}}</div>
                                <a href="{{ route('news.show', $item->id) }}" class="stretched-link text-dark hoverYellow">Подробнее</a>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <img class="d-block" src="{{$item->image ?? 'https://via.placeholder.com/150x100'}}"alt="...">
                            </div>
                        </div>
                    </div>--}}
                    <div class="col-md-4 d-flex">
                        <div class="blog-entry justify-content-end">
                            <a href="#" class="block-20"
                               style="background-image: url({{$item->image ?? 'https://via.placeholder.com/150x100'}})">
                            </a>
                            <div class="text p-4 float-right d-block">
                                <div class="topper d-flex align-items-center">
                                    <div class="one py-2 pl-3 pr-1 align-self-stretch">
                                        <span class="day">{{$item->updated_at->format('d')}}</span>
                                    </div>
                                    <div class="two pl-0 pr-3 py-2 align-self-stretch">
                                        <span class="mos">{{Date::parse($item->created_at)->format('F')}}</span>
                                    </div>
                                </div>
                                <h3 class="heading mb-3">{{$item->title}}</h3>

                                <p><a href="#" class="btn-custom"><span class="ion-ios-arrow-round-forward mr-3"></span>Read
                                        more</a></p>
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
                        {{$news->links()}}
                    </div>
                </div>
            </div>
        </div>



@endsection


