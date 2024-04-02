@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <main class="main-content">
        @if (! empty($data['banner']))
            @if (count($data['banner']) > 1)
                <div class="hero-slider-section position-relative mb-8">
                    <div class="swiper hero-slider-container">
                        <div class="swiper-wrapper">
                            @foreach($data['banner'] as $banner)
                                <div class="swiper-slide hero-slide-item">
                                    <div class="container-fluid">
                                        <div class="hero-slide-content">
                                            <h2 class="hero-slide-sub-title" style="@if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">{{ $banner['subtitle']['text'] ?? '' }}</h2>
                                            <h1 class="hero-slide-title" style="@if (! empty($banner['title']['color'])) color: {{ $banner['title']['color'] }}; @endif @if (! empty($banner['title']['font_size'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">{{ $banner['title']['text'] ?? '' }}</h1>

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
            @else
                @php($banner = $data['banner'][0])
                <div class="section page-header-area" @if (! empty($banner['image']['url'])) data-bg-img="'{{ $banner['image']['url'] }}'" @endif>
                    <div class="container">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-sm-auto text-center text-sm-start">
                                <h1 class="page-header-title" @if (! empty($banner['title']['color'])) style="color: {{ $banner['title']['color'] }};" @endif>{{ $banner['title']['text'] ?? '' }}</h1>
                                @if (! empty($banner['subtitle']['text']))
                                    <p class="link-nav" @if (! empty($banner['subtitle']['color'])) style="color: {{ $banner['subtitle']['color'] }};" @endif>{{ $banner['subtitle']['text'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        @includeif('themes.' . current_theme() . '.editor.index', ['blocks' => $data['content']['blocks'] ?? []])
    </main>
@endsection
