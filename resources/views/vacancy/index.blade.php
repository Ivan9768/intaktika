@extends('layouts.base')

@section('page.title', 'Вакансии')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <x-slider>

    </x-slider>


    <div class="vacancy" id="vacancy" style="padding-top: 15px;">
        <x-title>
            {{ __('ВАКАНСИИ') }}
        </x-title>
        <div class="vacancy container py-3">
            <div class="row justify-content-center">
                @foreach ($vacancy as $item)
                    <div class="col-md-8 col-lg-8 col-xl-8 mb-8">
                        <div class="vacancy-item pb-4">

                            <div class="card"
                                style="border-radius: 20px; background-color: #313131; color: #fff; min-width:300px;">
                                <div class="card-body" style="padding: 30px;">
                                    <h4 class="card-title" style="font-weight: 600; max-width: 800px">{{ $item->vacancy }}</h4>
                                    <h5 class="card-text py-2" style="font-weight: 300;">{{ $item->intro }}</h5>
                                    <button class="btn btn-outline-primary" style="float: right; margin: 0 0 20px 0">
                                        <a href="{{ route('vacancy.show', $item->id) }}">{{ __('Откликнуться') }}
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>





@endsection
