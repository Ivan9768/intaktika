<div class="black-block">
    <div class="container">
        <div class="row" style="padding: 45px 0px;display: flex;justify-content: center;align-items: center;">
            <div class="col-md-6">
                <h5 style="font-weight: 700;">{{ $title ?? '' }}</h5>
                <p style="margin-bottom: 0; padding-bottom: 30px">{{ $about }}</p>
            </div>

            @isset($img)
                <div class="col-sm-6">
                    <img src="{{ config('app.img') }}{{ $img }}" class="card-img-top">
                </div>
            @endisset
        </div>
    </div>
</div>
