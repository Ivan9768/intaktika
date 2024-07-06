@extends('layouts.base')

@section('page.title', 'Мои отклики')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <style>
        .form-control-plaintext-custom {
            background-color: #f8f9fa;
            border-radius: .25rem;
            padding: .375rem .75rem;
            border: 1px solid #ced4da;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .form-control-plaintext-c {
            background-color: #f8f9fa;
            border-radius: .25rem;
            padding: .375rem .75rem;
            border: 1px solid #ced4da;
            width: 100%;
            display: flex;
            justify-content: start;
            align-items: center;
        }
        .form-control-editable {
            display: none;
            width: 100%;
        }
        .edit-button {
            margin-left: 10px;
            cursor: pointer;
            color: #9ED241;
        }
    </style>

    <div class="container py-5">
        <div class="row">
            <div class="col-2 text-center" style="background-color: #313131; border-radius:20px;">
                <nav class="col-md-0 d-none d-md-block custom-bg sidebar py-5">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="text-start nav-item admin" style="max-width: 165px">
                                <a class="nav-link" href="{{ route('user.user') }}">
                                    <i class="bi bi-person-fill"></i>
                                    <span data-feather="news">{{ __("Профиль") }} </span>
                                </a>
                            </li>
                            <li class="text-start nav-item admin" style="max-width: 165px">
                                <a class="nav-link active" href="{{ route('user.application') }}">
                                    <i class="bi bi-file-earmark-person-fill"></i>
                                    <span data-feather="news">{{ __("Мои отклики") }} </span>
                                </a>
                            </li>
                            <li class="text-start nav-item admin" style="max-width: 165px">
                                <a class="nav-link" href="{{ route('user.application-service') }}">
                                    <i class="bi bi-card-list"></i>
                                    <span data-feather="news">{{ __("Мои заявки") }} </span>
                                </a>
                            </li>
                            @if(auth()->user()->role === 'partner')
                                <li class="text-start nav-item admin dropdown" style="max-width: 165px">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                       data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="bi bi-graph-up-arrow me-1"></span>
                                        <span data-feather="layers">{{ __("Статистика") }}</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('user.analytic' )}}">По объектам УЦН</a>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-1"></div>
            <div class="col-8">
                <main role="main">
                    <h2 class="mb-4">Мои отклики</h2>
                            @if ($applications->isEmpty())
                                <p class="text-center">Нет откликов</p> <br>
                                <p class="text-center">Чтобы отслеживать свои отклики отправьте резюме на выбранную вакансию.</p>

                     <div class="row">
                         <div class="d-flex justify-content-center">
                             <button class="btn btn-outline-primary">
                                 <a href="{{ route('vacancy.index') . '#vacancy' }}">Смотреть вакансии</a>
                             </button>
                         </div>

                     </div>


                            @else
                                @foreach ($applications as $application)
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="resume-entry m-2">
                                                <div class="row mb-3">
                                                    <label class="col-md-4 col-form-label text-md-right form-label-custom">{{ __('Вакансия') }}</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-plaintext form-control-plaintext-custom">{{ $application->vacancy->vacancy }}</p>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label class="col-md-4 col-form-label text-md-right form-label-custom">{{ __('Статус') }}</label>
                                                    <div class="col-md-6">
                                                        @if ($application->status === "не обработано")
                                                            <p style="font-size: 16px;" class="link-active form-control-plaintext form-control-plaintext-c">{{ __('Не обработано') }}</p>
                                                        @endif
                                                        @if ($application->status === "приглашение на собеседование")
                                                            <p style="font-size: 16px;" class="link-active-green form-control-plaintext form-control-plaintext-c">{{ __('Приглашение на собеседование') }}</p>
                                                        @endif
                                                        @if ($application->status === "отказ")
                                                            <p style="font-size: 16px; float: left" class="link-active-red form-control-plaintext form-control-plaintext-c" >{{ __('Отказ') }}</p>
                                                        @endif

                                                    </div>
                                                </div>

                                                @if ($application->date_interview)
                                                    <div class="row mb-3">
                                                        <label class="col-md-4 col-form-label text-md-right form-label-custom">{{ __('Дата и время собеседования') }}</label>
                                                        <div class="col-md-6">
                                                            <p class="form-control-plaintext form-control-plaintext-custom">{{ $application->date_interview }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($application->comment)
                                                    <div class="row mb-3">
                                                        <label class="col-md-4 col-form-label text-md-right form-label-custom">{{ __('Комментарий администратора') }}</label>
                                                        <div class="col-md-6">
                                                            <p class="form-control-plaintext form-control-plaintext-custom">{{ $application->comment }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                </main>
            </div>
        </div>
    </div>
@endsection
