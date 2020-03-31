<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@section('title')Страница @show</title>
    <!-- Styles -->

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="d-flex flex-column h-100" data-gr-c-s-loaded="true">
@include('header')
@yield('menu')

<main role="main" class="flex-shrink-0 page-content py-4">
   @yield('content')

</main>
@yield('footer')
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
