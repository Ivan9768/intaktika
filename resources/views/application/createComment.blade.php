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
                <li class="breadcrumb-item"><a href="{{ route('application.admin') }}">{{ __('Отклики на вакансии') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{ __('Назад') }}</a></li>
{{--                <li class="breadcrumb-item active" aria-current="page">{{ $news->title }}</li>--}}
            </ol>
        </nav>
        <div class="row">

            <x-nav-admin></x-nav-admin>

            <div class="col-12 col-md-6 mx-auto">
                <div class="d-flex justify-content-center">
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <h1 class="h2">{{ __('Пригласить на собеседование') }}</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="{{ route('application.admin') }}">
                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                                <span data-feather="calendar"></span>
                                {{ __('Cписок') }}
                            </button>
                        </a>
                    </div>
                </div>
                <form action="{{ route('application.updateStatusCreateComment', $news->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                        <input class="form-control" type="hidden" name="status" value="приглашение на собеседование" required>

                    <div class="form-group py-2">
                        <label>Назначьте дату и время собеседования</label>
                        <input class="form-control" type="datetime-local" name="date_interview" required>
                    </div>

                    <div class="form-group py-2">
                        <label>По желанию добавьте комментарий (до 1000 символов)</label>
                        <textarea class="form-control" name="comment"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary" style="margin-top: 12px">Отправить</button>
                    </div>
                </form>
            </div>



        </div>
    </div>
@endsection
