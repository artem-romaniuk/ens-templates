@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <main class="main-content">
        @if (! empty($data['banner']))
            <div class="hero-slider-section position-relative mb-8">
                <div class="swiper hero-slider-container">
                    <div class="swiper-wrapper">
                        @foreach($data['banner'] as $banner)
                            <div class="swiper-slide hero-slide-item">
                                <div class="container-fluid">
                                    <div class="hero-slide-content">
                                        <h2 class="hero-slide-sub-title" style="@if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }} !important; @endif @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">{{ $banner['subtitle']['text'] ?? '' }}</h2>
                                        <h1 class="hero-slide-title" style="@if (! empty($banner['title']['color'])) color: {{ $banner['title']['color'] }} !important; @endif @if (! empty($banner['title']['font_size'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">{{ $banner['title']['text'] ?? '' }}</h1>

                                        @if (! empty($banner['description']))
                                            <p class="hero-slide-desc" style="@if (! empty($banner['description']['color'])) color: {{ $banner['description']['color'] }}; @endif @if (! empty($banner['description']['font_size'])) font-size: {{ $banner['description']['font_size'] }}px; @endif" >{{ $banner['description']['text'] }}</p>
                                        @endif

                                        @if (! empty($banner['button']['url']) && ! empty($banner['button']['text']))
                                            <a class="btn btn-primary btn-icon-right" href="{{ filter_var($banner['button']['url'], FILTER_VALIDATE_URL) ? $banner['button']['url'] : '#' }}">
                                                <span>{{ $banner['button']['text'] }}</span> <i class="icofont-double-right icon"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="hero-slide-shape-one"></div>
                                <div class="hero-slide-thumb">
                                    @if (! empty($banner['image']['url']))
                                        <img src="{{ $banner['image']['url'] }}" width="1208" height="804" alt="{{ $banner['title']['text'] ?? '' }}">
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="swiper-pagination" style="position: absolute; bottom: -45px;"></div>
            </div>
        @endif

        <section class="container py-0 page-content">
        	@includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
    </main>
@endsection

@push('scripts')
    @if(! empty($data['banner']) && count($data['banner']) > 1)
        <script>
            // Hero Slider JS
            var mainlSlider2 = new Swiper('.hero-slider-container', {
                slidesPerView : 1,
                slidesPerGroup: 1,
                    nextButton: '.arrow-left',
                    prevButton: '.arrow-right',
                loop: true,
                autoplay: {
                    delay: {{ $data['hero_section']['delay'] ?? 5000 }},
                },
                spaceBetween: 0,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                }
            });
        </script>
    @endif
@endpush
