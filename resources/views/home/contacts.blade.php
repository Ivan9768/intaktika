@extends('layouts.base')

@section('page.title', 'Контакты')

@section('content')

    <x-slider>

    </x-slider>


    <div class="contacts" id="contacts" style="padding-top: 50px;">

        <div class="container">
            <h1 style="margin: 20px 0 ">{{ __('КОНТАКТЫ') }}</h1>

            <div class="row">
                <div class="col-12 col-md-5">



                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6" style="padding: 0">
                                    <img src="{{ config('app.img') }}ava-dir1.png" class="img-fluid"
                                        alt="Фото Гаврилова Максима Александровича">
                                </div>
                                <div class="col-12 col-md-6" style="padding: 0">
                                    <h4 class="card-title" style="font-weight: 700;">
                                        {{ __('Гаврилов Максим Александрович') }}</h4>
                                    <p class="card-text">{{ __('Директор ЗАО “Интактика”') }}</p>
                                    <img src="{{ config('app.img') }}text-obl.png" class="img-fluid" alt="Область текста"
                                        style="margin-left: -30px;">
                                    <p class="card-text"
                                        style="max-width: 100%; font-size: 14px; margin: -60px 0 32px 0; color: white; font-weight: 600;">
                                        {{ __('По вопросам строительства и реконструкции объектов связи.') }}
                                    </p>
                                    <div class="mt-3">
                                        <img src="{{ config('app.img') }}icon-tel.png" class="img-fluid"
                                            style="margin-right: 10px;" alt="Иконка телефона">
                                        <a style="color: #9ED241;" href="tel:+79676169777">+7-967-616-97-77</a>
                                    </div>
                                    <div class="mt-2">
                                        <img src="{{ config('app.img') }}icon-mail.png" class="img-fluid"
                                            style="margin-right: 10px;" alt="Иконка почты">
                                        <a style="color: #9ED241;" href="mailto:office@intaktika.ru">office@intaktika.ru</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6" style="padding: 0">
                                    <img src="{{ config('app.img') }}ava-dir2.png" class="img-fluid"
                                        alt="Фото Гаврилова Максима Александровича">
                                </div>
                                <div class="col-12 col-md-6" style="padding: 0">
                                    <h4 class="card-title" style="font-weight: 700;">{{ __('Мушников Кирилл Сергеевич') }}
                                    </h4>
                                    <p class="card-text">{{ __('Директор ООО “Интактика”') }}</p>
                                    <img src="{{ config('app.img') }}text-obl.png" class="img-fluid" alt="Область текста"
                                        style="margin-left: -30px;">
                                    <p class="card-text"
                                        style="max-width: 100%; font-size: 14px; margin: -60px 0 32px 0; color: white; font-weight: 600;">
                                        {{ __(' По вопросам технического обслуживания объектов связи.') }}
                                    </p>
                                    <div class="mt-3">
                                        <img src="{{ config('app.img') }}icon-tel.png" class="img-fluid"
                                            style="margin-right: 10px;" alt="Иконка телефона">
                                        <a style="color: #9ED241;" href="tel:+79676169777">+7-967-616-97-67</a>
                                    </div>
                                    <div class="mt-2">
                                        <img src="{{ config('app.img') }}icon-mail.png" class="img-fluid"
                                            style="margin-right: 10px;" alt="Иконка почты">
                                        <a style="color: #9ED241;"
                                            href="mailto:office@intaktika.ru">to-vols@intaktika.ru</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-md-7">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <a href="https://2gis.ru/Красноярск/search/Красноярск, микрорайон Северный, улица Мате Залки, 2Д"
                                    target="_blank" title="Перейти на 2gis">
                                    <img src="{{ config('app.img') }}icon-place.png" class="img-fluid"
                                        style="margin-right: 10px;" alt="Иконка места">
                                </a>
                                <h4 class="card-title"
                                    style="font-weight: 600; font-size: 18px; color: #9ED241; margin: 0;">
                                    660118, Красноярский край, г. Красноярск, ул. Мате Залки, 2д
                                </h4>
                            </div>
                            <div class="map-container" style="margin-top: 20px;">
                                <iframe
                                    src="https://yandex.ru/map-widget/v1/?um=constructor%3A174db7d5802e299dc0b9d442a58c78eb5b86f2a01ea0073f894a4884dbb6ba57&amp;source=constructor"
                                    width="100%" height="500" frameborder="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
