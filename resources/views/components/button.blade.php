@props(['class'=>'btn btn-outline-primary'])

<button {{ $attributes->class([
"{$class}",
])->merge([
    'type'=>'butten',
]) }}>
    {{ $slot }}
</button>
