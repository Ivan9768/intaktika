@extends('layouts.base')

@section('page.title', 'Услуги')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <x-slider>

    </x-slider>


<div id="services" class="service" style="padding-top: 15px;">
    <x-title>
        {{ __('УСЛУГИ') }}
    </x-title>

    <section class="py-0">
        <div class="container px-2 px-lg-2 mt-4">
            <div class="row gx-4 gx-lg-3 row-cols-xl-3 row-cols-md-2 row-cols-lg-2 row-cols-sm-2 row-cols-xs-0 justify-content-center" id="project-container">
                @foreach ($service as $new)
                <x-box>
                    <x-slot:img>{{ $new->img }}</x-slot:img>
                    <x-slot:title>{{ $new->title }}</x-slot:title>
                    <x-slot:intro>{{ $new->intro }}</x-slot:intro>
                    <x-slot:link>{{ route('service.show', $new->id) }}</x-slot:link>

                        <button type="button" style="font-size: 14px;margin: 0 0 20px 0;"class="btn btn-primary" data-bs-toggle="modal" data-service-id="{{ $new->id }}" data-bs-target="#serviceRequestModal">
                            ОСТАВИТЬ ЗАЯВКУ
                        </button>

                </x-box>
                @endforeach
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-center">
        {{$service->links('vendor.pagination.bootstrap-4') }}
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>
    <script>
        let currentPage = {{ $service->currentPage() }}; // Текущая страница

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





@endsection
