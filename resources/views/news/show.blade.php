@extends('layouts.base')

@section('page.title', 'Новости')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('news.index') }}#news">{{ __('Новости') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{ __('Назад') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $news->title }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                <div class="row left_content">
                    <div class="image-container">
                        <img src="/storage/app/public/{{ $news->img }}">
                    </div>
                    <h2 class="py-2">{{ $news->title }}</h2>
                    <h6>{{ $news->datetime_publication }}</h6>
                    <p> {{ $news->info }}
                    </p>
                </div>

                </section>


            </div>
{{--            <div class="col-1"></div>--}}
            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 single_blog ps-5">
                <div class="right_content recent_posts">
                    <h2>{{ __('Последние новости') }}</h2>
                    <hr>
                    @foreach ($newsAll as $new)
                        @php
                            // Разбиваем URL по символу "/"
                            $urlParts = explode('/', request()->url());
                            // Извлекаем последний элемент, который должен быть цифрой
                            $urlId = end($urlParts);
                        @endphp

                        @if($urlId == $new->id)
                            <!-- Код, который выполнится, если id в URL совпадает с id новости -->
                        @else
                        <section class="recent_info">
                            <a href="{{ route('news.show', $new->id) }}">
                                <img src="{{ $new->img }}" alt="">
                                <h3>{{ $new->title }}</h3>
                                <p>{{ $new->datetime_publication }}</p>
                            </a>
                        </section>
                        <hr>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>



@endsection
