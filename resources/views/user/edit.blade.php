



<x-card-body>
    <x-form method="POST" action="{{ route('register') }}">
        @csrf
        @method('PUT')

        <x-form-item>
            <x-label>{{ __('Имя') }}</x-label>

            <div class="col-md-6">
                <input id="name" type="name"
                       class="form-control @error('name') is-invalid @enderror" name="name"
                       value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                @enderror
            </div>
        </x-form-item>

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
            <x-label>{{ __('Номер мобильного телефона') }}</x-label>

            <div class="col-md-6">
                <input id="telephone" type="number"
                       class="form-control @error('telephone') is-invalid @enderror" name="telephone"
                       value="{{ old('telephone') }}" required autocomplete="telephone" autofocus>

                @error('telephone')
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
                       required autocomplete="password_confirmation">

                @error('password')
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                @enderror
            </div>
        </x-form-item>

        <x-form-item>
            <x-label>{{ __('Повторите пароль') }}</x-label>

            <div class="col-md-6">
                <input id="password_confirmation" type="password"
                       class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                       required autocomplete="password_confirmation">

                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                @enderror

                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label style="font-size: 14.5px" class="form-check-label" for="flexCheckDefault">
                        {{__('Я согласен с ')}}<a style="color: #9ED241" href="{{ route('privacyPolicy') }}">{{__('условиями передачи информации')}}</a>
                    </label>
                </div>

            </div>
        </x-form-item>


        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <x-button type="submit">
                    {{ __('Отправить') }}
                </x-button>


            </div>
        </div>
    </x-form>
</x-card-body>
