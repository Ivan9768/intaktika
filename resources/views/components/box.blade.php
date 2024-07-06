<div class="col mb-2 " style="min-width: 250px;">
    <div class="card h-100">
        <!-- Product image-->
        <div class="image-container">
        <img src="/storage/app/public/{{ $img ?? ''}}">
        </div>
        <!-- Product details-->
        <div class="card-body p-4">
            <div class="text-lift">
                <!-- Product name-->
                <h5 class="fw-bolder">{{ $title ?? ''}}</h5>
                <!-- Product price-->
                {{ $intro ?? ''}}
            </div>
        </div>
        <!-- Product actions-->
        <div class="card-footer p-0 pt-0 border-top-0 bg-transparent">
            <div class="d-flex justify-content-evenly m-1">
                @isset($link)
                    <button class="btn btn-outline-primary" style="margin: 0 0 20px 0">
                        <a href="{{ $link ?? '' }}">{{ __('Подробнее') }}
                        </a>
                    </button>
                    {{ $slot }}
                @endisset
            </div>
        </div>
    </div>
</div>
