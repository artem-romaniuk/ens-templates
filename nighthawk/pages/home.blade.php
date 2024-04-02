@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', 'page-index')

@section('content')
    @if (! empty($data['banner']))
        <div class="main-slider slides position-relative ">
            <div class="slides-1 swiper">
                <div class="swiper-wrapper">
                    @foreach($data['banner'] as $banner)
                        <section class="hero d-flex align-items-center swiper-slide" style="background: url('{{ $banner['image']['url'] ?? '' }}') top center; background-size: cover;">
                            <div class="container item">
                                <div class="row">
                                    <div class="col-xl-4">
                                        <h2 data-aos="fade-up" 
                                            style="
                                            @if (! empty($banner['title']['color'])) color: {{ $banner['title']['color'] }} !important; @endif
                                            @if (! empty($banner['title']['font_size'])) font-size: {{ $banner['title']['font_size'] }}px !important; @endif">
                                            {{ $banner['title']['text'] ?? '' }}
                                        </h2>

                                        <h4 data-aos="fade-up" 
                                            style="
                                            @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }} !important; @endif
                                            @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px !important; @endif">
                                            {{ $banner['subtitle']['text'] ?? '' }}
                                        </h4>

                                        @if (! empty($banner['description']))
                                            <blockquote data-aos="fade-up" data-aos-delay="100" 
                                                style="
                                                @if (! empty($banner['description']['color'])) color: {{ $banner['description']['color'] }}; @endif
                                                @if (! empty($banner['description']['font_size'])) font-size: {{ $banner['description']['font_size'] }}px; @endif
                                                ">
                                                <p>{{ $banner['description']['text'] }}</p>
                                            </blockquote>
                                        @endif

                                        <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                                            @if (! empty($banner['button']['url']) && ! empty($banner['button']['text']))
                                                <a href="{{ filter_var($banner['button']['url'], FILTER_VALIDATE_URL) ? $banner['button']['url'] : '#' }}" class="btn-get-started">{{ $banner['button']['text'] }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    @endif

    <main id="main">
        <section class="container py-0 page-content">
           @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
    </main>
@endsection

@push('scripts')
    @if(! empty($data['banner']) && count($data['banner']) > 1)
        <script>
            /**
             * Init swiper slider with 1 slide at once in desktop view
             */
            new Swiper('.slides-1', {
                speed: 600,
                loop: true,
                autoplay: {
                delay: {{ $data['hero_section']['delay'] ?? 5000 }},
                disableOnInteraction: false
                },
                slidesPerView: 'auto',
                pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true
                },
                navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
                }
            });

            /**
             * Init swiper slider with 3 slides at once in desktop view
             */
            new Swiper('.slides-3', {
                speed: 600,
                loop: true,
                autoplay: {
                delay: {{ $data['hero_section']['delay'] ?? 5000 }},
                disableOnInteraction: false
                },
                slidesPerView: 'auto',
                pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true
                },
                navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 40
                },

                1200: {
                    slidesPerView: 3,
                }
                }
            });
        </script>
    @endif
    
@endpush
