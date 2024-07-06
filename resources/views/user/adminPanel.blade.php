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
                        <h1 class="h2">{{ __('Пользователи') }}</h1>
                        <div class="row">

                            <div class="form-check-inline">
                                <form class="form-check-inline" action="{{ route('user.admin') }}" method="GET">
                                    <button style=" font-size: 14px;" class="btn btn-sm btn-outline-secondary" type="submit">
                                        {{__('Старые')}}
                                        <i class="bi bi-sort-numeric-down"></i>
                                    </button>
                                </form>
                                <form class="form-check-inline" action="{{ route('user.dateSearch') }}" method="GET">
                                    <button style="font-size: 14px;" class="btn btn-sm btn-outline-secondary" type="submit">
                                        {{__('Новые')}}
                                        <i class="bi bi-sort-numeric-up-alt"></i>
                                    </button>
                                </form>
                            </div>


                        </div>


                        <form action="{{ route('user.search') }}" method="GET">
                            <input type="text" name="q" placeholder="Найти" value="{{ request('q') }}"
                                style="border:1px solid #131313; border-radius: 15px; padding:0 10px">
                            <button style="background: none; border:none" class="bi bi-search" type="submit">
                            </button>
                        </form>

                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                                <a href="{{ route('user.admin') }}"><button type="button"
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
                                    <th>Данные пользователя</th>
                                    <th>Подтверждение почты</th>
                                    <th>Роль</th>
                                    <th>Доступ</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($news->isEmpty())
                                    <p>Пользователи не найдены</p>
                                @else
                                    @foreach ($news as $newsItem)
                                        <tr>
                                            <td style="font-size: 14px;">{{ $newsItem->id }}</td>
                                            <td style="min-width: 200px; font-size: 14px;">
                                                {{ $newsItem->name}}<br>
                                                {{ $newsItem->email}}<br>
                                                {{ $newsItem->telephone }}
                                            </td>

                                            <td> @if ($newsItem->email_verified_at === NULL)
                                                    <p class="link-active-red">{{ __('Не подтверждена') }}</p>
                                                @else
                                                    <p class="link-active-green">{{ __('Подтверждена') }}</p>
                                                @endif
                                            </td>
                                            <td style="max-width: 150px">
                                                @if ($newsItem->role === '0')
                                                    <p class="link-active">{{ __('Гость') }}</p>
                                                @endif
                                                @if ($newsItem->role === 'user')
                                                    <p class="link-active">{{ __('Подтвержденный пользователь') }}</p>
                                                @endif
                                                @if ($newsItem->role === 'admin')
                                                    <p class="link-active">{{ __('Администратор') }}</p>
                                                @endif
                                                @if ($newsItem->role === 'partner')
                                                    <p class="link-active">{{ __('Партнер') }}</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($newsItem->active === 0)
                                                    <p class="link-active-red">{{ __('Ограничен') }}</p>
                                                @else
                                                    <p class="link-active-green">{{ __('Полный') }}</p>
                                                @endif
                                            </td>
                                            <td style="min-width: 240px">
                                                <div class="btn-group-line">
                                                @if ($newsItem->role === 'user')
                                                        <form  class="pb-2" action="{{ route('user.updateRole', $newsItem->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="role" value="partner" required>
                                                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                                {{ __('Назначить партнёром') }}
                                                                <i class="bi bi-person-check-fill"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if ($newsItem->role === 'partner')
                                                        <form class="pb-2"  action="{{ route('user.updateRole', $newsItem->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="role" value="user" required>
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                {{ __('Лишить статуса партнера') }}
                                                                <i class="bi bi-person-x-fill"></i>
                                                            </button>
                                                        </form>
                                                @endif
                                                    @if ($newsItem->active === 1 && $newsItem->role !== 'admin')
                                                        <form  action="{{ route('user.updateActive', $newsItem->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="active" value="0" required>
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                {{ __('Забанить') }}
                                                                <i class="bi bi-shield-fill-x"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if ($newsItem->active === 0 && $newsItem->role !== 'admin')

                                                    <form  action="{{ route('user.updateActive', $newsItem->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="active" value="1" required>
                                                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                                {{ __('Разбанить') }}
                                                                <i class="bi bi-shield-fill-minus"></i>
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
