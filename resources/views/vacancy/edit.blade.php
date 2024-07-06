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
                <li class="breadcrumb-item"><a href="{{ route('vacancy.admin') }}">{{ __('Вакансии') }}</a></li>
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
                    <h1 class="h2">{{ __('Редактировать вакансию') }}</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="{{ route('vacancy.admin') }}">
                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                                <span data-feather="calendar"></span>
                                {{ __('Cписок') }}
                            </button>
                        </a>
                    </div>
                </div>
                <form action="{{ route('vacancy.update', $news->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group py-2">
                        <label>{{__('Название')}}</label>
                        <input style="margin: 0" class="form-control" type="text" name="vacancy" value="{{ $news->vacancy }}" required>
                    </div>

                    <div class="form-group py-2">
                        <label>{{__('Описание')}}</label>
                        <textarea style="margin: 0" class="form-control" name="intro" required>{{ $news->intro }}</textarea>
                    </div>

                    <div class="form-group py-2">
                        <label>{{__('Обязанности')}}</label>
                        <textarea style="margin: 0" class="form-control height150" name="duties" required>{{ $news->duties }}</textarea>
                    </div>

                    <div class="form-group py-2">
                        <label>{{__('Требования')}}</label>
                        <textarea style="margin: 0" class="form-control height150" name="requirements" required>{{ $news->requirements }}</textarea>
                    </div>

                    <div class="form-group py-2">
                        <label>{{__('Условия')}}</label>
                        <textarea style="margin: 0" class="form-control height150" name="conditions" required>{{ $news->conditions }}</textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary" style="margin-top: 12px">Отправить</button>
                    </div>
                </form>
            </div>



        </div>
    </div>
@endsection
