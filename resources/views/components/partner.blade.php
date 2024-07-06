@props(['name','img'])
<div class="col-sm-3 mb-4">
    <div class="card border-1 ms-4">
        <div class="card-body">
            <div class="item-card">
                <img style="margin-bottom: 20px; width: 100%; height: 100%; object-fit: contain;"
                src="/storage/app/public/{{ $img }}" class="card-img-top" alt="{{ $name }}">
            </div>
        </div>
    </div>
</div>
