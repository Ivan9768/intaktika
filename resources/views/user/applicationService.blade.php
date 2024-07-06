@extends('layouts.base')

@section('page.title', 'Мои заявки')

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
                                <a class="nav-link" href="{{ route('user.application') }}">
                                    <i class="bi bi-file-earmark-person-fill"></i>
                                    <span data-feather="news">{{ __("Мои отклики") }} </span>
                                </a>
                            </li>
                            <li class="text-start nav-item  admin" style="max-width: 165px">
                                <a class="nav-link active" href="{{ route('user.application-service') }}">
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
                    <h2 class="mb-4">Мои заявки</h2>
                    @if ($applications->isEmpty())
                        <p class="text-center">Нет заявок</p> <br>
                        <p class="text-center">Чтобы их отслеживать оставьте заявку на выбранную услугу.</p>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-outline-primary">
                                    <a href="{{ route('service.index') . '#services' }}">Смотреть услуги</a>
                                </button>
                            </div>
                        </div>
                    @else
                        <div id="application-list">
                            @foreach ($applications as $application)
{{--                                @if ($application->status === "не обработано")--}}
{{--                                    <button style="background-color: #dc3545; border: none; color: white; float: right; border-radius: 5px" type="button" class="close" aria-label="Close">--}}
{{--                                        <span>&times;</span>--}}
{{--                                    </button>--}}
{{--                                @endif--}}
                                <div class="card mb-4 application-item">
                                    <div class="card-body">


                                        <div class="resume-entry m-2">

                                            <div class="row mb-3">
                                                <label class="col-md-4 col-form-label text-md-right form-label-custom">{{ __('Дата') }}</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-plaintext form-control-plaintext-custom">{{ $application->created_at }}</p>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-md-4 col-form-label text-md-right form-label-custom">{{ __('Услуга') }}</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-plaintext form-control-plaintext-custom">{{ $application->service->title }}</p>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-md-4 col-form-label text-md-right form-label-custom">{{ __('Статус') }}</label>
                                                <div class="col-md-6">
                                                    @if ($application->status === "не обработано")
                                                        <p class="link-active">{{ __('Не обработано') }}</p>
                                                    @endif
                                                    @if ($application->status === "одобрено")
                                                        <p class="link-active-green">{{ __('Одобрено') }}</p><br>
                                                    @endif
                                                    @if ($application->status === "в процессе")
                                                        <p class="link-active-green">{{ __('В процессе') }}</p><br>
                                                    @endif
                                                    @if ($application->status === "отказ")
                                                        <p class="link-active-red">{{ __('Отказ') }}</p>
                                                    @endif
                                                    @if ($application->status === "завершено")
                                                        <p class="link-active-red">{{ __('Завершено') }}</p>
                                                    @endif
                                                    @if ($application->status === "приостановлено")
                                                        <p class="link-active-orange">{{ __('Проиостановлено') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            @if ($application->comment)
                                                <div class="row mb-3">
                                                    <label class="col-md-4 col-form-label text-md-right form-label-custom">{{ __('Сообщение') }}</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-plaintext form-control-plaintext-custom">{{ $application->comment }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div id="pagination-container" class="d-flex justify-content-center">
                            {{ $applications->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    @endif
                </main>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        let currentPage = {{ $applications->currentPage() }}; // Текущая страница

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var newPage = $(this).data('page'); // Новая страница

            // Определение направления анимации
            if (parseInt(newPage) > currentPage) {
                $('#application-list').addClass('slide-out-left');
            } else {
                $('#application-list').addClass('slide-out-right');
            }

            getApplications(url, newPage);
            window.history.pushState("", "", url);
        });

        function getApplications(url, newPage) {
            $.ajax({
                url: url
            }).done(function(data) {
                setTimeout(function() {
                    var newApplications = $(data).find('#application-list').html();
                    $('#application-list').html(newApplications).removeClass('slide-out-left slide-out-right');

                    if (parseInt(newPage) > currentPage) {
                        $('#application-list').addClass('slide-in-right');
                    } else {
                        $('#application-list').addClass('slide-in-left');
                    }

                    // Обновляем текущую страницу
                    currentPage = parseInt(newPage);

                    // Обновляем пагинацию
                    var newPagination = $(data).find('#pagination-container').html();
                    $('#pagination-container').html(newPagination);

                    // Удаляем классы анимации после завершения
                    $('#application-list').on('animationend', function() {
                        $(this).removeClass('slide-in-left slide-in-right');
                    });
                }, 500); // Продолжительность анимации выезда
            }).fail(function() {
                alert('Applications could not be loaded.');
            });
        }
    </script>
@endsection
