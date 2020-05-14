@extends('layouts.main')

@section('title')
    @parent {{$news['title']}}
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <section class="ftco-degree-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <p class="mb-5">
                            <img src="{{$news->image}}" alt="" class="img-fluid">
                        </p>
                        <p><a class="text-black-50" href="{{$resource->url}}">
                                {{$resource->title}}
                            </a></p>
                        <h2 class="mb-3"><a href="{{$news->guid}}">
                                {{$news->title}}
                            </a></h2>
                        <p>{{$news->text}}</p>

                    </div>
                    <div class="col-lg-4 sidebar pl-lg-5">

                        <div class="sidebar-box">
                            <h3>Еще по теме</h3>
                            @foreach($newsToPromote as $news)
                                <div class="block-21 mb-4 d-flex">
                                    <a class="blog-img mr-4" style="background-image: url({{$news->image}});"></a>
                                    <div class="text">
                                        <h3 class="heading"><a href="{{route('news.show',$news)}}">{{$news->title}}</a>
                                        </h3>
                                        <div class="meta">
                                            <div><a href="#"><span
                                                        class="icon-calendar"></span> {{Date::parse($news->created_at)->format('d/m/Y')}}
                                                </a></div>
                                            <div><a href="#"><span
                                                        class="icon-clock-o"></span> {{Date::parse($news->created_at)->format('H:m')}}
                                                </a></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="sidebar-box">
                            <h3>Вам могут понравиться следующие категории</h3>
                            <div class="tagcloud">
                                @foreach($categories as $category)
                                    <a href="{{route('news.categories.show', $category)}}" class="tag-cloud-link">{{$category->title}}</a>
                                @endforeach
                            </div>
                        </div>

                        <div class="sidebar-box">
                            <h3>Paragraph</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem
                                necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa
                                sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        {{-- <div class="row mt-4">


     <div class="col-md-8 blog-main">
         <div class="card-img d-flex">
             <img class='m-5 img-thumbnail' src="{{$news->image ?? 'https://via.placeholder.com/150x100'}}" alt="newsPic">
         </div>

         <h3 class="pb-4  mb-4 font-italic border-bottom">

             <img src="{{$resource->image ?? ''}}" alt="">
             <p>{{$category->title}}</p>
         </h3>
         <div class="blog-post">
             <h2 class="blog-post-title">
                 {{ $news->title }}
             </h2>
             <p class="blog-post-meta">{{$news->created_at }}
                --}}{{-- <a href="{{$resource->link}}" class="yellow">{{$resource->title}}</a>--}}{{--

             </p>
             <p>{{ $news->text }}</p>
             --}}{{--<p><a href="{{$news->guid ?? $resource->link}}" class="yellow"> Смотреть в источнике</a></p>--}}{{--

         </div>
     </div>
     <aside class="col-md-4 blog-sidebar">
         <div class="p-4 mb-3 bg-light rounded">
             <h4 class="font-italic">Реклама</h4>
             <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
         </div>
     </aside>
 </div>--}}

    </div>
@endsection


