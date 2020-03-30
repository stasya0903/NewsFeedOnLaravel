<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@section('title')Страница @show</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="d-flex flex-column h-100" data-gr-c-s-loaded="true">
@yield('menu')
<main role="main" class="flex-shrink-0 page-content">
   @yield('content')

</main>
@yield('footer')
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
