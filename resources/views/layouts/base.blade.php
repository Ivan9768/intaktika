<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page.title', 'intaktika')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="{{ asset('/public/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">


</head>

<body>
    <div class="d-flex flex-column justify-content-between min-vh-100">

        @include('includes.header')

        <main class="flex-grow-1">

            @yield('content')

        </main>

        @include('includes.footer')

    </div>

    <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
