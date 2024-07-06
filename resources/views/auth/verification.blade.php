@extends('layouts.base')

@section('page.title', 'Вход в intaktika')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <x-card>
                    <x-card-header>{{ __('Введите 6-ти значный код подтверждения') }}</x-card-header>
                    <h6 class="p-3">{{ __('Мы отправили код на ') }} {{ Auth::user()->email }}</h6>

                    <x-card-body>
                        <x-form method="POST" action="{{ route('verification.verify') }}">
                            @csrf
                            <x-form-item>


                                <div class="col-md-0 sm-0">
                                    <input type="text" class="code-input" maxlength="1" inputmode="numeric" name="code[]"
                                        required autofocus>
                                    <input type="text" class="code-input" maxlength="1" inputmode="numeric"
                                        name="code[]" required>
                                    <input type="text" class="code-input" maxlength="1" inputmode="numeric"
                                        name="code[]" required>
                                    <input type="text" class="code-input" maxlength="1" inputmode="numeric"
                                        name="code[]" required>
                                    <input type="text" class="code-input" maxlength="1" inputmode="numeric"
                                        name="code[]" required>
                                    <input type="text" class="code-input" maxlength="1" inputmode="numeric"
                                        name="code[]" required>
                                </div>



                            </x-form-item>
                            @if (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif

                            <x-button type="submit">
                                {{ __('Отправить') }}
                            </x-button>

{{--                            @if (Route::has('password.request'))--}}
{{--                                <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                    {{ __('Не пришел код?') }}--}}
{{--                                </a>--}}
{{--                            @endif--}}
                        </x-form>
                    </x-card-body>
                </x-card>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.code-input').keyup(function() {
                var maxLength = parseInt($(this).attr('maxlength'));
                var currentLength = $(this).val().length;
                if (currentLength >= maxLength) {
                    $(this).next('.code-input').focus();
                }
            });
        });
    </script>
@endsection
