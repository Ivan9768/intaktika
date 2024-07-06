@extends('layouts.base')
@section('content')


    <div class="container py-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">

            <x-nav-admin></x-nav-admin>

            <div class="col-12 col-md-6 mx-auto">
                <div class="d-flex justify-content-center">
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <h1 class="h2">{{ __('Добавить услугу') }}</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="{{ route('service.admin') }}">
                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                                <span data-feather="calendar"></span>
                                {{ __('Cписок') }}
                            </button>
                        </a>
                    </div>
                </div>
                <form action="{{ route('service.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group py-2">
                        <label>Заголовок</label>
                        <input style="margin: 0" class="form-control" type="text" name="title" required>
                    </div>

                    <div class="form-group py-2">
                        <label>Краткий анонс</label>
                        <textarea style="margin: 0" class="form-control height150" name="intro" required></textarea>
                    </div>

                    <div class="form-group py-2">
                        <label>Описание</label>
                        <textarea style="margin: 0" class="form-control height150" name="info" required></textarea>
                    </div>

                    <div class="container py-3" style="margin: 0; padding: 0; width: 100%;">
                        <input style="margin: 0;" class="inputfile" id="file" type="file" name="img"
                            accept=".png,.svg,.jpg" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary" style="margin-top: 12px">Отправить</button>
                    </div>
                </form>
            </div>



        </div>
    </div>
@endsection
