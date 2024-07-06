@foreach ($project as $item)
    <x-box>
        <x-slot:img>{{ $item->img }}</x-slot:img>
        <x-slot:title>{{ $item->title }}</x-slot:title>
        <x-slot:intro>{{ $item->intro }}</x-slot:intro>
    </x-box>
@endforeach
{{--
<!-- Ссылки пагинации -->
<div class="d-flex justify-content-center mt-4">
    {{ $project->links('vendor.pagination.bootstrap-4') }}
</div> --}}
