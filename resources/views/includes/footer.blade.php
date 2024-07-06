{{-- <footer>
    <nav>
          <a href="/about">О КОМПАНИИ</a>
          <a href="/services">УСЛУГИ</a>
          <a href="/"><img src="{{ config('app.img') }}logo.svg" alt="Логотип"></a>
          <a href="/contacts">КОНТАКТЫ</a>
          <a href="/vacancy">ВАКАНСИИ</a>

    </nav>
      <p style="padding-top:15px; font-size: 15px;font-weight: 700;">&copy; {{ date('Y') }} intaktix.ru. Все права защищены. |<a href="/privacy-policy">Политика конфиденциальности</a></p>
      &copy; {{ date('Y') }} intaktix.ru
    </footer> --}}

<!-- Footer -->
<footer class="text-center text-lg-start bg-body-tertiary text-muted">
    <!-- Section: Social media -->
{{--    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">--}}
{{--        <!-- Left -->--}}
{{--        <div class="me-5 d-none d-lg-block">--}}
{{--            <span>{{ __('Свяжитесь с нами в социальных сетях:') }}</span>--}}
{{--        </div>--}}
{{--        <!-- Left -->--}}

{{--        <!-- Right -->--}}
{{--        <div>--}}
{{--            <a href="" class="me-4 text-reset">--}}
{{--                <i class="fab fa-facebook-f" style="color: #313131;"></i>--}}
{{--            </a>--}}
{{--            <a href="" class="me-4 text-reset">--}}
{{--                <i class='fab fa-twitter'></i>--}}
{{--            </a>--}}
{{--            <a href="" class="me-4 text-reset">--}}
{{--                <i class="fab fa-google"></i>--}}
{{--            </a>--}}
{{--            <a href="" class="me-4 text-reset">--}}
{{--                <i class="fab fa-instagram"></i>--}}
{{--            </a>--}}
{{--            <a href="" class="me-4 text-reset">--}}
{{--                <i class="fab fa-linkedin"></i>--}}
{{--            </a>--}}
{{--            <a href="" class="me-4 text-reset">--}}
{{--                <i class="fab fa-github"></i>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <!-- Right -->--}}
{{--    </section>--}}
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
        <hr>
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <h6 class="text-uppercase fw-bold mb-4">

                        <img src="{{ config('app.img') }}logo.svg" class="card-img-top">

                    </h6>
                    <p>
                        {{__('Специализация в строительстве, модернизации и техническом обслуживании волоконно-оптических линий связи.')}}
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-4 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        <a href="{{ route('service.index') . '#service' }}">{{ __('Услуги') }}</a>
                    </h6>
                    @foreach ($services as $service)
                    <p class="recent_info">
                        <a href="{{ route('service.show', $service->id) }}" class="text-reset recent_info">{{ $service->title }}</a>
                    </p>
                    @endforeach
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-1 col-xl-1 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                       {{ __('Полезные ссылки') }}
                    </h6>
                    <p class="recent_info">
                        <a href="{{ route('news.index') . '#news' }}" class="text-reset">{{__('Новости') }}</a>
                    </p>
                    <p class="recent_info">
                        <a href="{{ route('vacancy.index') . '#vacancy' }}" class="text-reset">{{__('Вакансии') }}</a>
                    </p>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4"><a href="{{ route('contacts') . '#contacts' }}">{{ __('Контакты') }}</a></h6>
                    <p class="recent_info"><i class="fas fa-home me-3"></i>
                        <a href="{{ route('contacts') . '#contacts' }}"> г. Красноярск, <br>ул. Мате Залки, 2д,<br> 660118, Россия </a></p>
                    <p class="recent_info">
                        <i class="fas fa-envelope me-3"></i>
                        <a href="mailto:to-vols@intaktika.ru">to-vols@intaktika.ru</a>
                    </p>
                    <p class="recent_info"><i class="fas fa-phone"></i><a href="tel:+79676169767" > +7-967-616-97-67</a></p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4">
        &copy; {{ date('Y') }} intaktix.ru
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
