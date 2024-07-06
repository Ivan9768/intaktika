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

                    <iframe src="https://intaktix.ru/metabase/public/dashboard/34a792e0-b1bd-46c0-9cde-db9ec31b50f2#titled=false&refresh=60" onload="iFrameResize({heightCalculationMethod: 'lowestElement'}, this)" id="iFrameResizer" scrolling="no" style="overflow: hidden; width: 100%; height: 1868px;" frameborder="0"></iframe>
                </main>
            </div>



            </div>
        </div>

@endsection
