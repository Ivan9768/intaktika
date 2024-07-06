@extends('layouts.base')

@section('page.title', 'Вход в intaktika')

@section('content')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 m-4">
                <x-card>
                    <x-card-header>{{ __('Вход') }}</x-card-header>


                    <x-card-body>
                        <x-form method="POST" action="{{ route('login') }}">
                            @csrf

                            <x-form-item>
                                <x-label>{{ __('Адрес электронной почты') }}</x-label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </x-form-item>

                            <x-form-item>
                                <x-label>{{ __('Пароль') }}</x-label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </x-form-item>

                            <div class="row mb-0 col-md-8 offset-md-4">
                                <x-form-item>
                                        <x-checkbox name="remember">
                                            {{ __('Запомнить меня') }}
                                        </x-checkbox>
                                </x-form-item>
                            </div>

            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <x-button type="submit">
                        {{ __('Войти') }}
                    </x-button>

{{--                    @if (Route::has('password.request'))--}}
{{--                        <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                            {{ __('Забыли свой пароль?') }}--}}
{{--                        </a>--}}
{{--                    @endif--}}
                </div>
            </div>
            </x-form>
            </x-card-body>
            </x-card>
        </div>
    </div>
    </div>

@endsection
