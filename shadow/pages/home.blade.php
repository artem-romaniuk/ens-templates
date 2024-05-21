@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', '')

@section('content')
    <header>
        @include('themes.' . current_theme() . '.layouts.includes.header')

        @if (! empty($data['banner']))
            <div style="
                @if( empty(settings('logo_settings.header.height')) || settings('logo_settings.header.height') == 'auto') padding-top: 0; @endif
                @if(  settings('logo_settings.header.height') == 50) padding-top: 3%; @endif
                @if(  settings('logo_settings.header.height') == 100) padding-top: 3.5%; @endif
                @if(  settings('logo_settings.header.height') == 150) padding-top: 6%; @endif
                @if(  settings('logo_settings.header.height') == 200) padding-top: 8%; @endif
                @if(  settings('logo_settings.header.height') == 250) padding-top: 11.5%; @endif
            ">
                <div id="heroCarousel" class="carousel slide" data-ride="carousel" data-interval="{{ $data['hero_section']['delay'] ?? 5000 }}" style="height: 100%;">
                    <div class="container carousel-inner">
                        @foreach($data['banner'] as $banner)
                            <div class="page-banner home-banner carousel-item @if ($loop->first) active @endif" style="background: url('{{ $banner['image']['url'] ?? '' }}'); background-size: cover; height: 440px">
                                <div class="row align-items-center flex-wrap-reverse h-100">
                                    <div class="col-md-6 py-5 wow fadeInLeft">
                                        <h1 class="mb-4"
                                            style="line-height: 1.2;
                                                @if (! empty($banner['title']['color'])) color: {{ $banner['title']['color'] }} !important; @endif
                                                @if (! empty($banner['title']['font_size'])) font-size: {{ $banner['title']['font_size'] }}px !important; @endif"
                                                >
                                            {{ $banner['title']['text'] ?? '' }}
                                        </h1>

                                        @if (! empty($banner['subtitle']['text']))
                                            <h2
                                                class="mb-3"
                                                style="line-height: 1.2;
                                                    @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }} !important; @endif
                                                    @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                                                {{ $banner['subtitle']['text'] }}
                                            </h2>
                                        @endif

                                        @if (! empty($banner['description']['text']))
                                            <p class="text-lg text-grey mb-5"
                                                style="
                                                    @if (! empty($banner['description']['color'])) color: {{ $banner['description']['color'] }} !important; @endif
                                                    @if (! empty($banner['description']['font_size'])) font-size: {{ $banner['description']['font_size'] }}px !important; @endif
                                                    ">
                                                {{ $banner['description']['text'] }}
                                            </p>
                                        @endif

                                        @if (! empty($banner['button']['url']) && ! empty($banner['button']['text']))
                                            <a href="{{ filter_var($banner['button']['url'], FILTER_VALIDATE_URL) ? $banner['button']['url'] : '#' }}" class="btn btn-primary">{{ $banner['button']['text'] }}</a>
                                        @endif
                                    </div>
                                    <div class="col-md-6 py-5 wow zoomIn">
                                        <div class="img-fluid text-center">
                                            <img src="../assets/img/banner_image_1.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <ol class="carousel-indicators" style="position: absolute; bottom: 30px;">
                            @foreach($data['banner'] as $banner)
                                <li data-target="#heroCarousel" data-slide-to="{{ $loop->index }}" class="@if ($loop->first) active @endif"></li>
                            @endforeach
                        </ol>

    {{--                    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">--}}
    {{--                        <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>--}}
    {{--                    </a>--}}

    {{--                    <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">--}}
    {{--                        <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>--}}
    {{--                    </a>--}}
                    </div>
                </div>
            </div>
        @endif
    </header>

    <section class="container py-0 page-content">
            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
@endsection
