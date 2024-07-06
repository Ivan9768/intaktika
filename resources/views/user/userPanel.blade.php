@extends('layouts.base')

@section('page.title', 'Личный кабинет')

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
                                <a class="nav-link active" href="{{ route('user.user') }}">
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
                            @if($user->role === 'partner')
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
                    <h2 class="mb-4">Личный кабинет</h2>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-right form-label-custom">{{ __('Роль') }}</label>
                                <div class="col-md-6 d-flex align-items-center">
                                    <p class="form-control-plaintext form-control-plaintext-custom">
                                        @if ($user->role === '0')
                                            <span>{{ __('Гость') }}</span>
                                        @endif
                                        @if ($user->role === 'user')
                                            <span>{{ __('Подтвержденный пользователь') }}</span>
                                        @endif
                                        @if ($user->role === 'admin')
                                            <span>{{ __('Администратор') }}</span>
                                        @endif
                                        @if ($user->role === 'partner')
                                            <span>{{ __('Партнер') }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @foreach ([
                                ['Имя', 'name', $user->name],
                                ['Адрес электронной почты', 'email', $user->email],
                                ['Номер мобильного телефона', 'telephone', $user->telephone],
                                ['Пароль', 'password', '********']
                            ] as [$label, $field, $value])
                                <div class="row mb-3">
                                    <label class="col-md-4 col-form-label text-md-right form-label-custom">{{ __($label) }}</label>
                                    <div class="col-md-6 d-flex align-items-center">
                                        <p class="form-control-plaintext form-control-plaintext-custom">
                                            <span>{{ $value }}</span>
                                            <i class="bi bi-pencil-fill edit-button" role="button" onclick="editField(this)"></i>
                                        </p>
                                        <div class="form-control-editable">
                                            @if ($field === 'password')
                                                <input type="password" class="form-control" value="">
                                            @else
                                                <input type="text" class="form-control" value="{{ $value }}">
                                            @endif
                                            <button style="font-size: 14px" class="btn btn-outline-primary mt-2" onclick="saveField(this, '{{ $field }}')">Сохранить</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <script>
        function editField(button) {
            const formControl = button.closest('.d-flex');
            formControl.querySelector('.form-control-plaintext').style.display = 'none';
            formControl.querySelector('.form-control-editable').style.display = 'block';
        }

        function saveField(button, field) {
            const formControl = button.closest('.d-flex');
            const newValue = formControl.querySelector('.form-control-editable input').value;

            // Отправляем данные на сервер с помощью AJAX
            $.ajax({
                url: '{{ route('user.save') }}',
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                contentType: 'application/json',
                dataType: 'json',
                data: JSON.stringify({
                    field_name: field,
                    new_value: newValue
                }),
                success: function(data) {
                    console.log('Success:', data);
                    // Обновляем данные на странице после успешного сохранения
                    const plaintextSpan = formControl.querySelector('.form-control-plaintext span');
                    if (plaintextSpan) {
                        plaintextSpan.innerText = newValue;
                    }
                    formControl.querySelector('.form-control-plaintext').style.display = 'flex';
                    formControl.querySelector('.form-control-editable').style.display = 'none';
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    console.error('Status:', status);
                    console.error('Response:', xhr.responseText);
                }
            });
        }
    </script>
@endsection
