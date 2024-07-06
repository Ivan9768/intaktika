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
                <main role="main" style="margin-left: 30px;">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                        <h1 class="h2">{{ __('Заявки на услуги') }}</h1>

                        <div class="form-check-inline">
                            <form class="form-check-inline" action="{{ route('application-service.admin') }}" method="GET">
                                <button style=" font-size: 14px;" class="btn btn-sm btn-outline-secondary" type="submit">
                                    {{__('Старые')}}
                                    <i class="bi bi-sort-numeric-down"></i>
                                </button>
                            </form>
                            <form class="form-check-inline" action="{{ route('application-service.dateSearch') }}" method="GET">
                                <button style="font-size: 14px;" class="btn btn-sm btn-outline-secondary" type="submit">
                                    {{__('Новые')}}
                                    <i class="bi bi-sort-numeric-up-alt"></i>
                                </button>
                            </form>
                        </div>


                        <form action="{{ route('application-service.search') }}" method="GET">
                            <input type="text" name="q" placeholder="Найти" value="{{ request('q') }}"
                                style="border:1px solid #131313; border-radius: 15px; padding:0 10px">
                            <button style="background: none; border:none" class="bi bi-search" type="submit">
                            </button>
                        </form>

                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                                <a href="{{ route('application-service.admin') }}"><button type="button"
                                        class="btn btn-sm btn-outline-secondary dropdown-toggle">
                                        <span data-feather="calendar"></span>
                                        {{ __('Cписок') }}
                                    </button></a>
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive"  id="project-container">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Услуга</th>
                                    <th>Пользователь</th>
                                    <th>Сообщение</th>
                                    <th>Статус</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($news->isEmpty())
                                    <p>Заявки не найдены</p>
                                @else
                                    @foreach ($news as $newsItem)
                                        <tr style="max-width: 80px">
                                            <td>{{ $newsItem->id }}</td>
                                            <td style="max-width: 200px">{{ $newsItem->service->title }}</td>
                                            <td style="max-width: 300px">
                                                <div class="text-cell" id="intro-{{ $newsItem->id }}">
                                                    {{ $newsItem->user->name }}<br>
                                                    {{ $newsItem->user->email }}<br>
                                                    {{ $newsItem->user->telephone }}<br>
                                                </div>
                                            </td>
                                            <td>{{ $newsItem->comment }}</td>
                                            <td>
                                                    @if ($newsItem->status === "не обработано")
                                                        <p class="link-active">{{ __('Не обработано') }}</p>
                                                    @endif
                                                    @if ($newsItem->status === "одобрено")
                                                        <p class="link-active-green">{{ __('Одобрено') }}</p><br>
                                                    @endif
                                                        @if ($newsItem->status === "в процессе")
                                                            <p class="link-active-green">{{ __('В процессе') }}</p><br>
                                                        @endif
                                                    @if ($newsItem->status === "отказ")
                                                        <p class="link-active-red">{{ __('Отказ') }}</p>
                                                    @endif
                                                        @if ($newsItem->status === "завершено")
                                                            <p class="link-active-red">{{ __('Завершено') }}</p>
                                                        @endif
                                                        @if ($newsItem->status === "приостановлено")
                                                            <p class="link-active-orange">{{ __('Проиостановлено') }}</p>
                                                        @endif
                                            </td>
                                            <td style="min-width: 200px">
                                                <div class="btn-group-line">

                                                    @if ($newsItem->status === 'не обработано')
                                                        <form class="py-2" action="{{ route('application-service.updateStatus', $newsItem->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status" value="одобрено">
                                                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                                                {{ __('Одобрить') }}

                                                                <i class="bi bi-check-lg"></i>
                                                            </button>
                                                        </form>
                                                        <form class="py-2" action="{{ route('application-service.updateStatus', $newsItem->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status" value="отказ">
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                {{ __('Отказать') }}

                                                                <i class="bi bi-x-lg"></i>
                                                            </button>
                                                        </form>
                                                    @endif

                                                        @if ($newsItem->status === 'одобрено')
                                                            <form class="py-2" action="{{ route('application-service.updateStatus', $newsItem->id) }}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="в процессе">
                                                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                                                    {{ __('Запустить процесс') }}

                                                                    <i class="bi bi-check-lg"></i>
                                                                </button>
                                                            </form>
                                                            <form class="py-2" action="{{ route('application-service.updateStatus', $newsItem->id) }}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="приостановлено">
                                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                    {{ __('Приостановить') }}

                                                                    <i class="bi bi-x-lg"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        @if ($newsItem->status === 'в процессе')
                                                            <form class="py-2" action="{{ route('application-service.updateStatus', $newsItem->id) }}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="завершено">
                                                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                                                    {{ __('Завершить') }}

                                                                    <i class="bi bi-check-lg"></i>
                                                                </button>
                                                            </form>
                                                            <form class="py-2" action="{{ route('application-service.updateStatus', $newsItem->id) }}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="приостановлено">
                                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                    {{ __('Приостановить') }}

                                                                    <i class="bi bi-x-lg"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        @if ($newsItem->status === 'приостановлено')
                                                            <form class="py-2" action="{{ route('application-service.updateStatus', $newsItem->id) }}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="в процессе">
                                                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                                                    {{ __('Запустить процесс') }}

                                                                    <i class="bi bi-check-lg"></i>
                                                                </button>
                                                            </form>
                                                            <form class="py-2" action="{{ route('application-service.updateStatus', $newsItem->id) }}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="отказ">
                                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                    {{ __('Отказать') }}

                                                                    <i class="bi bi-x-lg"></i>
                                                                </button>
                                                            </form>
                                                        @endif




                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </main>
                <div class="d-flex justify-content-center">
                    {{ $news->links('vendor.pagination.bootstrap-4') }}
                </div>


                <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
                        crossorigin="anonymous"></script>
                <script>
                    let currentPage = {{ $news->currentPage() }}; // Текущая страница

                    $(document).on('click', '.pagination a', function(e) {
                        e.preventDefault();
                        var url = $(this).attr('href');
                        var newPage = $(this).text(); // Новая страница

                        // Определение направления анимации
                        if (parseInt(newPage) > currentPage) {
                            $('#project-container').addClass('slide-out-left');
                        } else {
                            $('#project-container').addClass('slide-out-right');
                        }

                        getProjects(url, newPage);
                        window.history.pushState("", "", url);
                    });

                    function getProjects(url, newPage) {
                        $.ajax({
                            url: url
                        }).done(function(data) {
                            setTimeout(function() {
                                var newProjects = $(data).find('#project-container').html();
                                $('#project-container').html(newProjects).removeClass('slide-out-left slide-out-right');

                                if (parseInt(newPage) > currentPage) {
                                    $('#project-container').addClass('slide-in-right');
                                } else {
                                    $('#project-container').addClass('slide-in-left');
                                }

                                // Обновляем текущую страницу
                                currentPage = parseInt(newPage);

                                // Обновляем пагинацию
                                var newPagination = $(data).find('#pagination-container').html();
                                $('#pagination-container').html(newPagination);

                                // Удаляем классы анимации после завершения
                                $('#project-container').on('animationend', function() {
                                    $(this).removeClass('slide-in-left slide-in-right');
                                });
                            }, 500); // Продолжительность анимации выезда
                        }).fail(function() {
                            alert('Projects could not be loaded.');
                        });
                    }
                </script>


            </div>
        </div>
    </div>
    <script>
        function toggleContent(id, element) {
            var textCell = document.getElementById(id);
            textCell.classList.toggle('expanded');
            if (textCell.classList.contains('expanded')) {
                element.textContent = 'Свернуть';
            } else {
                element.textContent = 'Показать больше';
            }
        }
    </script>

@endsection