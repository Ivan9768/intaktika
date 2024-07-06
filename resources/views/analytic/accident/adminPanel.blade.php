@extends('layouts.base')

@section('page.title', 'Панель администратора')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container py-5">
        <div class="row">
            <x-nav-admin></x-nav-admin>

            <div class="col-10">

                <main>
                    <script src="https://intaktix.ru/libs/js/iframeResizer.js"></script>

                    <iframe src="https://intaktix.ru/metabase/public/dashboard/6db953d6-5c5e-4c39-81ee-40d2a377a5dd#titled=false&refresh=60" onload="iFrameResize({heightCalculationMethod: 'lowestElement'}, this)" id="iFrameResizer" scrolling="no" style="overflow: hidden; width: 100%; height: 1868px;" frameborder="0"></iframe>
                </main>
            </div>



            </div>
        </div>

@endsection
