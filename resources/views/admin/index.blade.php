@extends('layouts.main')

@section('menu')
    @include('menu')
@endsection

@section('content')

        <div class="pink-bg">
            <div class="container">
            <div class="text-white rounded bg-transparent p-3">
                <div class="col-md-12 px-0">

                    <p class="lead">
                        Добро пожаловать в Админку
                    </p>
                    <p>{{ Auth::user()->name }} </p>

                </div>
            </div>
        </div>
    </div>

@endsection

