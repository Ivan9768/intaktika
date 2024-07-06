@extends('layouts.base')

@section('page.title', 'Вакансии')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('vacancy.index') }}#vacancy">{{ __('Вакансии') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{ __('Назад') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $vacancy->vacancy }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                <div class="row left_content">

                <h2 class="py-2">{{ $vacancy->vacancy }}</h2>
                <h5>{{ __('Описание') }}</h5>
                <p> {{ $vacancy->intro }}</p>

                <h5>{{ __('Обязанности:') }}</h5>
                <ul>
                    <?php
                    $duties = $vacancy->duties;
                    $sentences = explode('.', $duties);
                    array_pop($sentences);
                    foreach ($sentences as $sentence) {
                        echo '<li class="linas">' . trim($sentence) . '.' . '</li>';
                    }
                    ?>
                </ul>

                <h5>{{ __('Требования:') }}</h5>
                <ul >
                    <?php
                    $duties = $vacancy->requirements;
                    $sentences = explode('.', $duties);
                    array_pop($sentences);
                    foreach ($sentences as $sentence) {
                        echo '<li class="linas">' . trim($sentence) . '.' . '</li>';
                    }
                    ?>
                </ul>

                <h5>{{ __('Условия:') }}</h5>
                <ul>
                    <?php
                    $duties = $vacancy->duties;
                    $sentences = explode('.', $duties);
                    array_pop($sentences);
                    foreach ($sentences as $sentence) {
                        echo '<li class="linas">' . trim($sentence) . '.' . '</li>';
                    }
                    ?>
                </ul>
            </div>


        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 single_blog" style="min-width: 250px;max-width:500px;">
            <div class="right_content recent_posts"
                style="background-color: #313131; color:#ffffff;border-radius:20px; padding:30px;">
                <h3 class="d-flex justify-content-center">{{ __('Откликнуться на вакансию') }}</h3>
                <x-card-body>
                    <x-form method="POST" action="{{ route('apply') }}" enctype="multipart/form-data">
                        @csrf
                        <input name="vacancy_id" type="hidden" value="{{ $vacancy->id }}">
                        <label class="col-md-8 col-form-label">
                            {{ __('Загрузите резюме') }}
                        </label>
                        <div class="col-md-6" style="width:100%">
                            <input id="resume" type="file"
                                class="form-control @error('resume') is-invalid @enderror" name="resume" required
                                autocomplete="current-password" accept=".pdf,.doc,.docx">

                            @error('resume')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-check mt-3 mb-4">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                            <label style="font-size: 14.5px" class="form-check-label" for="flexCheckDefault">
                                {{__('Я согласен с ')}}<a style="color: #9ED241" href="{{ route('privacyPolicy') }}">{{__('условиями передачи информации')}}</a>
                            </label>
                        </div>



                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <x-button type="submit">
                                    {{ __('Отправить') }}
                                </x-button>

                            </div>

                        </div>

                    </x-form>
                </x-card-body>
            </div>
        </div>


    </div>
@endsection
