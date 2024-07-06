@extends('layouts.base')

@section('page.title', 'Главная')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <x-slider>

    </x-slider>
<dev id="experience">
    <x-w-block>
        <x-slot:title>{{ __('Мы гордимся своей репутацией качественного и надежного партнера в области связи.') }}</x-slot:title>
        <x-slot:about>{{ __('Наша цель - обеспечить надежное и быстрое подключение к современным коммуникационным сетям, открывая новые возможности и перспективы для наших клиентов.') }}</x-slot:about>
        <x-slot:img>k1.png</x-slot:img>
    </x-w-block>
</dev>
    <x-b-block>
        <x-slot:title>{{ __('Ключевыми принципами группы компаний являются:') }}</x-slot:title>
        <x-slot:about>{{ __('Мы динамичная команда экспертов, обладающая глубокими знаниями и навыками в области строительства и модернизации волоконно-оптических линий связи. Наши специалисты обеспечивают высочайший уровень технической компетентности и понимания специфики работы с современными коммуникационными технологиями.') }}</x-slot:about>
        <x-slot:img>k2.png</x-slot:img>
    </x-b-block>

    <x-w-block>
        <x-slot:title>{{ __('Мы активно следим') }}</x-slot:title>
        <x-slot:about>{{ __('за последними технологическими тенденциями в области коммуникаций и постоянно совершенствуем наши навыки и знания. Наша команда постоянно обучается и проходит сертификацию, чтобы быть в курсе всех новых разработок и инноваций.') }}</x-slot:about>
        <x-slot:img>k3.png</x-slot:img>
    </x-w-block>
    <div class="service" style="background-color: #313131" id="projects">
    <x-b-block>
        <x-slot:title>{{ __('Мы гордимся нашим портфолио успешно завершенных проектов,') }}</x-slot:title>
        <x-slot:about>{{ __('которые включают в себя как небольшие местные установки, так и крупномасштабные объекты связи.') }}<br><br>
            {{ __('Наша экспертиза простирается на все стадии проекта - от проектирования и прокладки волоконных линий до интеграции и обслуживания систем связи.') }}
        </x-slot:about>
        <x-slot:img>k4.png</x-slot:img>

    </x-b-block>
    <div class="black-block" style="height: 15px; border-top: 15px dashed #ffffff; background: #313131;"></div>


        <x-title>
            <x-slot:margin>0</x-slot:margin>
            <x-slot:color>white</x-slot:color>
            <div class="py-5">
                {{ __('НАШИ ПРОЕКТЫ') }}
            </div>
        </x-title>

        <section class="py-1">
            <div class="container px-0 px-lg-2">
                <div class="row gx-4 gx-lg-5 row-cols-xl-4 row-cols-md-4 row-cols-lg-4 row-cols-sm-2 row-cols-xs-0 justify-content-center"
                    id="project-container">
                    @foreach ($project as $item)
                        <x-box>
                            <x-slot:img>{{ $item->img }}</x-slot:img>
                            <x-slot:title>{{ $item->title }}</x-slot:title>
                            <x-slot:intro>{{ $item->intro }}</x-slot:intro>
                        </x-box>
                    @endforeach
                </div>
            </div>
        </section>

        <div class="d-flex justify-content-center">
            {{ $project->links('vendor.pagination.bootstrap-4') }}
        </div>


        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>
        <script>
            let currentPage = {{ $project->currentPage() }}; // Текущая страница

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


    <x-w-block>
        <x-slot:title>{{ __('Среди наших клиентов:') }}</x-slot:title>
        <ul>
            <x-linas>{{ __('Все федеральные телекоммуникационные компании.') }}</x-linas>
            <x-linas>{{ __('Представители государственного сектора.') }}</x-linas>
            <x-linas>{{ __('Крупные региональные телекоммуникационные компании осуществляющие деятельность на территории Иркутской области, Красноярского края и в республике Хакасия.') }}</x-linas>

        </ul>
        <x-slot:img>k5.png</x-slot:img>
    </x-w-block>
    <div class="black-block" style="height: 15px; border-top: 15px dashed #313131; background: none;"></div>

    <x-title>
        {{ __('НАШИ ПАРТНЁРЫ') }}
    </x-title>

    <div class="marquee">
        <div class="marquee-content d-flex py-4">
            @foreach ($partners as $item)
                <x-partner class="partner-item">
                    <x-slot:img>{{ $item->img }}</x-slot:img>
                    <x-slot:name>{{ $item->name }}</x-slot:name>
                </x-partner>
            @endforeach
        </div>
    </div>




    <div class="black-block">
        <div class="container">
            <div class="row" style="padding: 45px 0px;display: flex;justify-content: center;align-items: center;">
                <div class="col-md-8">
                    <p style="margin-bottom: 0; padding-bottom: 30px">
                        {{ __('Мы всегда готовы к диалогу со всеми заинтересованными лицами по вопросам проектирования и строительства любых объектов связи (волоконно-оптические линии, мультисервисные сети, стационарные сооружения объектов связи).') }}
                    </p>
                </div>

                <div class="col-md-2">

                </div>

                {{-- <div class="row"> --}}
                <div class="col-md-2 px-5">
                    <a href="{{ route('contacts') . '#contacts' }}"><x-button>{{ __('Контакты') }}</x-button></a>
                </div>
                {{-- </div> --}}

            </div>
        </div>
    </div>


@endsection
