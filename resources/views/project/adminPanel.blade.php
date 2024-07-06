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
                        <h1 class="h2">{{ __('Проекты') }}</h1>

                        <div class="form-check-inline">
                            <form class="form-check-inline" action="{{ route('project.admin') }}" method="GET">
                                <button style=" font-size: 14px;" class="btn btn-sm btn-outline-secondary" type="submit">
                                    {{__('Старые')}}
                                    <i class="bi bi-sort-numeric-down"></i>
                                </button>
                            </form>
                            <form class="form-check-inline" action="{{ route('project.dateSearch') }}" method="GET">
                                <button style="font-size: 14px;" class="btn btn-sm btn-outline-secondary" type="submit">
                                    {{__('Новые')}}
                                    <i class="bi bi-sort-numeric-up-alt"></i>
                                </button>
                            </form>
                        </div>


                        <form action="{{ route('project.search') }}" method="GET">
                            <input type="text" name="q" placeholder="Найти" value="{{ request('q') }}"
                                style="border:1px solid #131313; border-radius: 15px; padding:0 10px">
                            <button style="background: none; border:none" class="bi bi-search" type="submit">
                            </button>
                        </form>

                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                                <a href="{{ route('project.admin') }}"><button type="button"
                                        class="btn btn-sm btn-outline-secondary dropdown-toggle">
                                        <span data-feather="calendar"></span>
                                        {{ __('Cписок') }}
                                    </button></a>
                                <a href="{{ route('project.create') }}"><button type="button"
                                        class="btn btn-sm btn-outline-secondary">{{ __('Добавить проект') }}
                                        <i class="bi bi-plus-circle-fill"></i>
                                    </button>
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive"  id="project-container">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Заголовок</th>
                                    <th>Анонс</th>
                                    <th>Доступ</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($news->isEmpty())
                                    <p>Проекты не найдены</p>
                                @else
                                    @foreach ($news as $newsItem)
                                        <tr>
                                            <td>{{ $newsItem->id }}</td>
                                            <td>{{ $newsItem->title }}</td>
                                            <td>
                                                <div class="text-cell" id="intro-{{ $newsItem->id }}">
                                                    {{ $newsItem->intro }}</div>
                                                <span class="expand-btn"
                                                    onclick="toggleContent('intro-{{ $newsItem->id }}', this)">Показать
                                                    больше</span>
                                            </td>
                                            <td>

                                                    @if ($newsItem->active === 0)
                                                        <p class="link-active-red">{{ __('Скрыт') }}</p>
                                                    @else
                                                        <p class="link-active-green">{{ __('Открыт') }}</p>
                                                    @endif


                                            </td>
                                            <td style="min-width: 160px">
                                                <div class="btn-group-line">

                                                    @if ($newsItem->active === 0)
                                                        <form class="pb-2" action="{{ route('project.updateActive', $newsItem->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="active" value="1">
                                                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                                {{ __('Опубликовать') }}

                                                                <i class="bi bi-toggle-on"></i>

                                                            </button>
                                                        </form>
                                                    @else
                                                        <form class="pb-2" action="{{ route('project.updateActive', $newsItem->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="active" value="0">
                                                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                                {{ __('Скрыть') }}

                                                                <i class="bi bi-toggle-off"></i>

                                                            </button>
                                                        </form>
                                                    @endif

                                                    <form action="{{ route('project.edit', $newsItem->id) }}" method="get">
                                                        <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                            {{ __('Редактировать') }}

                                                            <i class="bi bi-pencil-fill"></i>

                                                        </button>
                                                    </form>

                                                    <form class="py-2" action="{{ route('project.destroy', $newsItem->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            {{ __('Удалить') }}

                                                            <i class="bi bi-trash3-fill"></i>

                                                        </button>
                                                    </form>
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
