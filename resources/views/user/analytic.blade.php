@extends('layouts.base')

@section('page.title', 'Личный кабинет')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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
                            <li class="text-start nav-item admin" style="max-width: 165px">
                                <a class="nav-link" href="{{ route('user.application-service') }}">
                                    <i class="bi bi-card-list"></i>
                                    <span data-feather="news">{{ __("Мои заявки") }} </span>
                                </a>
                            </li>
                            @if(auth()->user()->role === 'partner')
                                <li class="text-start nav-item admin dropdown" style="max-width: 165px">
                                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
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

            <div class="col-10">

                <main>
                    <script src="https://intaktix.ru/libs/js/iframeResizer.js"></script>

                    <iframe src="https://intaktix.ru/metabase/public/dashboard/34a792e0-b1bd-46c0-9cde-db9ec31b50f2#titled=false&refresh=60" onload="iFrameResize({heightCalculationMethod: 'lowestElement'}, this)" id="iFrameResizer" scrolling="no" style="overflow: hidden; width: 100%; height: 1868px;" frameborder="0"></iframe>
                </main>
            </div>



            </div>
        </div>

@endsection
