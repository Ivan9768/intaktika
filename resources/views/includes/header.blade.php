<header>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <div class="navbar-brand">
                <a href="{{ route('home') }}">
                    <img src="{{ config('app.img') }}logo.svg" alt="Logo">
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-collapse"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a href="{{ route('news.index') }}#news"
                            class="nav-link ms-3 link-header">{{ __('НОВОСТИ') }}</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('service.index')}}#services"
                            class="nav-link ms-3 link-header">{{ __('УСЛУГИ') }}</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('vacancy.index') }}#vacancy"
                            class="nav-link ms-3 link-header">{{ __('ВАКАНСИИ') }}</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('contacts') }}#contacts"
                            class="nav-link ms-3 link-header">{{ __('КОНТАКТЫ') }}</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link ms-3 link-header">{{ __('О КОМПАНИИ') }}</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link ms-3" href="{{ route('login') }}">{{ __('ВХОД') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link ms-3" href="{{ route('register') }}">{{ __('РЕГИСТРАЦИЯ') }}</a>
                            </li>
                        @endif
                    @else
                        <div class="me-3" style="margin: 5px">
                            <button type="button" style="font-size: 14px" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceRequestModal">
                                ОСТАВИТЬ ЗАЯВКУ
                            </button>
                        </div>
                        <li class="nav-item dropdown mt-1">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 14px;">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->role === 'admin')
                                    <div class="dropdown-item">
                                        <a href="{{ route('news.admin') }}">Админ панель</a>
                                    </div>
                                @else
                                    <div class="dropdown-item">
                                        <a href="{{ route('user.user') }}">Личный кабинет</a>
                                    </div>
                                @endif

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>

                                    {{ __('Выйти') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="modal fade mt-4" id="serviceRequestModal" tabindex="-1" role="dialog" aria-labelledby="serviceRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="formMessage" class="alert mt-3" style="display: none;"></div>


            <div class="modal-header">
                <h5 class="modal-title" id="serviceRequestModalLabel">Заявка на услугу</h5>
                <button style="background-color: #dc3545; border: none; color: white" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="serviceRequestForm" action="{{ route('apply.service') }}" method="POST">
                    @csrf
                    <input name="user_id" type="hidden" value="{{ auth()->user()->id ?? ''}}" required>
                    <div class="form-group mb-3">
                        <label for="name">Имя:</label>
                        <div class="form-control" readonly>{{ auth()->user()->name ?? '' }}</div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email:</label>
                        <div class="form-control" readonly>{{ auth()->user()->email ?? '' }}</div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="telephone">Номер мобильного телефона:</label>
                        <div class="form-control" readonly>{{ auth()->user()->telephone ?? '' }}</div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="service">Услуга:</label>
                        <select class="form-select" id="service" name="service_id">
                            @foreach ($services as $service)
                                <option value="{{ $service->id}}">{{ $service->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="message">Сообщение:</label>
                        <textarea class="form-control" id="message" name="comment" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Отправить</button>
                    <p style="font-size: 12px;">Изменить данные профиля можно в <a style="color: #9ED241;" href="{{ route('user.user') }}">личном кабинете</a></p>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        // Событие перед открытием модального окна
        $('#serviceRequestModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Кнопка, которая открыла модальное окно
            var serviceId = button.data('service-id'); // Извлечь значение data-service-id

            // Найти select и установить выбранное значение
            var modal = $(this);
            modal.find('.modal-body select#service').val(serviceId);
        });
        $('#serviceRequestForm').on('submit', function(event) {
            // Остановить отправку формы для обработки через AJAX
            event.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var formData = form.serialize();

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                success: function(response) {

                    // Отображение успешного сообщения
                    $('#formMessage').removeClass('alert-danger').addClass('alert-success').text('Заявка на услугу успешно добавлена.').show();
                    setTimeout(function() {
                        $('#serviceRequestModal').modal('hide');
                    }, 3000);

                },
                error: function(response) {
                    // Отображение ошибки
                    $('#formMessage').removeClass('alert-success').addClass('alert-danger').text('Ошибка. Не удалось отправить заявку.').show();
                }
            });
        });

        // Отображение сообщения при загрузке страницы, если есть
        @if(session('success'))
        $('#formMessage').addClass('alert-success').text('{{ session('success') }}').show();
        @endif
        @if(session('error'))
        $('#formMessage').addClass('alert-danger').text('{{ session('error') }}').show();
        @endif
    });
</script>
