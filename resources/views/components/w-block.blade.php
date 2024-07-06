<div class="white-block">
    <div class="container">
        <div class="row" style="padding: 45px 0; display: flex; justify-content: center; align-items: center;">
            <div class="col-sm-6">
                <img src="{{ config('app.img') }}{{ $img }}" class="card-img-top">
            </div>
            <div class="col-sm-6">
                <p style="margin-bottom: 0; padding-top: 30px">{{ $title }} <br>
                    {{ $about ?? ' ' }}</p>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
