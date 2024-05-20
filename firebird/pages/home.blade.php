@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', '')

@section('content')
    @includeIf('themes.' . current_theme() . '.layouts.includes.header')
    
    <div class="hero_area sticky-top">
        @if (! empty($data['banner']))
            <section class="slider_section ">
                <div id="customCarousel1" class="carousel slide" data-ride="carousel" data-interval="{{ $data['hero_section']['delay'] ?? 5000 }}" style="height: 100%;">
                    <div class="carousel-inner" style="height: 100%; position: relative;">
                        @foreach($data['banner'] as $banner)
                            <div class="carousel-item @if ($loop->first) active @endif" style="padding-top: 200px; position: absolute; top: 0; bottom: 0; left: 0; right: 0; background: url('{{ $banner['image']['url'] ?? '' }}') top center; background-size: cover; min-height: 200px;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-10 mx-auto">
                                            <div class="detail-box">
                                                <h1 style="
                                                    @if (! empty($banner['title']['color'])) color: {{ $banner['title']['color'] }} !important; @endif
                                                    @if (! empty($banner['title']['font_size'])) font-size: {{ $banner['title']['font_size'] }}px !important; @endif">
                                                    {{ $banner['title']['text'] ?? '' }}
                                                </h1>

                                                <h3 style="
                                                    @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }} !important; @endif
                                                    @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px !important; @endif">
                                                    {{ $banner['subtitle']['text'] ?? '' }}
                                                </h3>

                                                @if (! empty($banner['description']))
                                                    <p style="
                                                        @if (! empty($banner['description']['color'])) color: {{ $banner['description']['color'] }}; @endif
                                                        @if (! empty($banner['description']['font_size'])) font-size: {{ $banner['description']['font_size'] }}px; @endif
                                                    ">
                                                        {{ $banner['description']['text'] }}
                                                    </p>
                                                @endif

                                                <div class="btn-box">
                                                    @if (! empty($banner['button']['url']) && ! empty($banner['button']['text']))
                                                        <a href="{{ filter_var($banner['button']['url'], FILTER_VALIDATE_URL) ? $banner['button']['url'] : '#' }}" class="btn1">{{ $banner['button']['text'] }}</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <ol class="carousel-indicators" style="position: absolute; bottom: 30px;">
                            @foreach($data['banner'] as $banner)
                                <li data-target="#customCarousel1" data-slide-to="{{ $loop->index }}" class="@if ($loop->first) active @endif"></li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </section>
        @endif
    </div>

    <section class="container py-0">
            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
@endsection
