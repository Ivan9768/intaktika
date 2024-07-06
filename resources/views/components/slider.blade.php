<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" style="padding: 0;">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="0" class="active" aria-current="true"
            aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="4" aria-label="Slide 5"></button>
    </div>
    <div class="carousel-inner">
        <x-slide class="active">
             <x-slot:title>{{ __('Передовая группа компаний') }}</x-slot:title>
            <x-slot:about>{{ __('Специализация в строительстве, модернизации и техническом обслуживании
                            волоконно-оптических линий связи') }}</x-slot:about>
            <x-slot:img>b1.png</x-slot:img>
            <a href={{ route('service.index')  . '#service'  }}><button class="btn btn-outline-primary">{{ __('Подробнее') }}</button></a>
            </x-slide>

            <x-slide>
                <x-slot:title>{{ __('С более чем') }}</x-slot:title>
                <h1 class="pb-2" style="font-size: 70px">{{ __('15-летним опытом работы') }}</h1>
                <x-slot:img>b2.png</x-slot:img>
                <a href={{ route('home')  . '#experience'  }}><button class="btn btn-outline-primary">{{ __('Подробнее') }}</button></a>
            </x-slide>

            <x-slide>
                <x-slot:title>{{ __('Разработано более') }}</x-slot:title>
                <h1 style="font-size: 80px">{{ __('100 проектов') }}</h1>
                <h1 class="pb-2">{{ __('по строительству сетей связи') }}</h1>
                <x-slot:img>b3.png</x-slot:img>
                <a href={{ route('home') . '#projects'  }}><button class="btn btn-outline-primary">{{ __('Подробнее') }}</button></a>
            </x-slide>

            <x-slide>
                <x-slot:title>{{ __('Свяжитесь с нами') }}</x-slot:title>
                <x-slot:about>{{ __('любым удобным для вас способом') }}</x-slot:about>
                <x-slot:img>b4.png</x-slot:img>
                <a href={{ route('contacts') . '#contacts'  }}><button class="btn btn-outline-primary">{{ __('Подробнее') }}</button></a>
            </x-slide>

            <x-slide>
                <x-slot:title>{{ __('Мы рады приветствовать') }}</x-slot:title>
                <x-slot:about>{{ __('новых и талантливых специалистов, готовых присоединиться к нашей
                                команде и вместе развивать современные коммуникационные сети!') }}</x-slot:about>
                <x-slot:img>b5.png</x-slot:img>
                <a href={{ route('vacancy.index') . '#vacancy' }}><button class="btn btn-outline-primary">{{ __('Подробнее') }}</button></a>
            </x-slide>

    </div>
</div>
