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
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('partner.admin') }}">{{ __('Партнеры') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{ __('Назад') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $news->title }}</li>
            </ol>
        </nav>
        <div class="row">

            <x-nav-admin></x-nav-admin>

            <div class="col-12 col-md-6 mx-auto">
                <div class="d-flex justify-content-center">
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <h1 class="h2">{{ __('Редактировать партнера') }}</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="{{ route('service.admin') }}">
                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                                <span data-feather="calendar"></span>
                                {{ __('Cписок') }}
                            </button>
                        </a>
                    </div>
                </div>
                <form action="{{ route('partner.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group py-2">
                        <label>Название</label>
                        <input style="margin: 0" class="form-control" type="text" name="name" value="{{ $news->name }}" required>
                    </div>

                    <div class="container py-3" style="margin: 0; padding: 0; width: 100%;">
                        <input style="margin: 0;" class="inputfile" id="file" type="file" name="img"
                            accept=".png,.svg,.jpeg" required>

                        Предыдущее фото:
                        <img  style="min-width: 70px;max-width: 70px;" src="/storage/app/public/{{ $news->img }}">

                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary" style="margin-top: 12px">Отправить</button>
                    </div>
                </form>
            </div>



        </div>
    </div>
@endsection
