<div class="col-2 text-center" style="background-color: #313131; border-radius:20px;">
    <nav class="col-md-0 d-none d-md-block custom-bg sidebar py-5">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="text-start nav-item admin" style="max-width: 165px">
                    <a class="nav-link " href="{{ route('news.admin') }}">
                        <span class="bi bi-newspaper me-1"></span>
                        <span data-feather="news">{{ __("Новости") }} </span>
                    </a>
                </li>
                <li class="text-start nav-item admin" style="max-width: 165px">
                    <a class="nav-link" href="{{ route('service.admin') }}">
                        <span class="bi bi-files me-1"></span>
                        <span data-feather="news">{{ __("Услуги") }} </span>

                    </a>
                </li>
                <li class="text-start nav-item admin" style="max-width: 165px">
                    <a class="nav-link" href="{{ route('project.admin') }}">
                        <span class="bi bi-folder-check me-1"></span>
                        <span data-feather="projects">{{ __("Проекты") }}</span>
                    </a>
                </li>
                <li class="text-start nav-item admin" style="max-width: 165px">
                    <a class="nav-link" href="{{ route('partner.admin') }}">
                        <span class="bi bi-person-bounding-box me-1"></span>
                        <span data-feather="layers">{{ __("Партнёры") }}</span>
                    </a>
                </li>
                <li class="text-start nav-item admin" style="max-width: 165px">
                    <a class="nav-link " href="{{ route('vacancy.admin') }}">
                        <span class="bi bi-card-text me-1"></span>
                        <span data-feather="vacancies">{{ __("Вакансии") }}</span>
                    </a>
                </li>
                <li class="text-start nav-item admin" style="max-width: 165px">
                    <a class="nav-link" href="{{ route('application.admin') }}">
                        <span class="bi bi-file-earmark-person-fill me-1"></span>
                        <span data-feather="bar-chart-2"> {{ __("Отклики на вакансии") }}</span>
                    </a>
                </li>
                <li class="text-start nav-item admin" style="max-width: 165px">
                    <a class="nav-link" href="{{ route('application-service.admin') }}">
                        <span class="bi bi-file-earmark-person-fill me-1"></span>
                        <span data-feather="bar-chart-2"> {{ __("Заявки на услуги") }}</span>
                    </a>
                </li>
                <li class="text-start nav-item admin" style="max-width: 165px">
                    <a class="nav-link" href="{{ route('user.admin') }}">
                        <span class="bi bi-person-fill me-1"></span>
                        <span data-feather="layers">{{ __("Пользователи") }}</span>

                    </a>
                </li>

                <li class="text-start nav-item admin dropdown" style="max-width: 165px">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="bi bi-graph-up-arrow me-1"></span>
                    <span data-feather="layers">{{ __("Статистика") }}</span>
                </a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('analytic.objects.admin' )}}">По объектам УЦН</a>
                        <li><hr class="dropdown-divider"></li>
                        <a class="dropdown-item" href="{{ route('analytic.accident.admin' )}}">По аварийным
                            заявкам</a>
                    </ul>
                </li>

                </li>
            </ul>
        </div>
    </nav>
</div>
