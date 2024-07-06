<div {{ $attributes->class([
    'carousel-item ',
])
 }}>
    <div class="slider-container">
        <!-- Slide 1 -->
        <div class="slide">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 m-auto"> <!-- Контент слева -->
                        <div class="row justify-content-center">
                            <h1>{{ $title }}</h1>

                            @isset($about)
                            <p style="font-size: 25px">{{ $about }}</p>
                            @endisset

                            {{ $slot }}
                        </div>
                    </div>
                    <div class="col-md-6 m-auto"> <!-- Контент справа -->
                        <div class="row justify-content-center">
                            <img src="{{ config('app.img') }}{{ $img }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
