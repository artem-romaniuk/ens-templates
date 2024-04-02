@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', '')

@section('content')
    @if (! empty($data['banner']))
        @if(count($data['banner']) > 1)
            <div id="heroCarousel" class="carousel slide" data-ride="carousel" data-interval="{{ $data['hero_section']['delay'] ?? 5000 }}" style="height: 100%;">
                <div class="carousel-inner">
                    @foreach($data['banner'] as $banner)
                        <div class="main-banner carousel-item @if ($loop->first) active @endif" style="background: url('{{ $banner['image']['url'] ?? '' }}'); background-size: cover; height: 550px">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="main-content">
                                            @if (! empty($banner['subtitle']['text']))
                                                <h6 style="
                                                    @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }} !important; @endif
                                                    @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px !important; @endif">
                                                    {{ $banner['subtitle']['text'] }}
                                                </h6>
                                            @endif

                                            <h2 style="
                                                @if (! empty($banner['title']['color'])) color: {{ $banner['title']['color'] }} !important; @endif
                                                @if (! empty($banner['title']['font_size'])) font-size: {{ $banner['title']['font_size'] }}px !important; @endif">
                                                    {{ $banner['title']['text'] ?? '' }}
                                                </h2>

                                            @if (! empty($banner['description']['text']))
                                                <p class="text-lg text-grey mb-5" 
                                                    style="
                                                    @if (! empty($banner['description']['color'])) color: {{ $banner['description']['color'] }}; @endif
                                                    @if (! empty($banner['description']['font_size'])) font-size: {{ $banner['description']['font_size'] }}px; @endif"
                                                    >
                                                    {{ $banner['description']['text'] }}
                                                </p>
                                            @endif

                                            @if (! empty($banner['button']['url']) && ! empty($banner['button']['text']))
                                                <div class="main-white-button">
                                                    <a href="{{ filter_var($banner['button']['url'], FILTER_VALIDATE_URL) ? $banner['button']['url'] : '#' }}">{{ $banner['button']['text'] }}</a>
                                                </div>
                                            @endif
                                        </div>
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
                </div>
            </div>
        @else
        <div id="heroCarousel" class="carousel slide" data-ride="carousel" style="height: 100%;">
            <div class="carousel-inner">
                @foreach($data['banner'] as $banner)
                    <div class="main-banner carousel-item @if ($loop->first) active @endif" 
                        style="
                            @if($banner['image']['url']) 
                                background: url('{{ $banner['image']['url'] ?? '' }}'); background-size: cover; height: 550px;
                            @else
                                background: url('');
                                height: auto;
                                padding: 30px 0 0 0; 
                            @endif
                            "
                        >
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="main-content">
                                        @if (! empty($banner['subtitle']['text']))
                                            <h6 style="
                                                @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }} !important; @endif
                                                @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px !important; @endif">
                                                {{ $banner['subtitle']['text'] }}
                                            </h6>
                                        @endif

                                        <h2 style="
                                            @if (! empty($banner['title']['color'])) color: {{ $banner['title']['color'] }} !important; @endif
                                            @if (! empty($banner['title']['font_size'])) font-size: {{ $banner['title']['font_size'] }}px !important; @endif">
                                                {{ $banner['title']['text'] ?? '' }}
                                            </h2>

                                        
                                        @if (! empty($banner['description']['text']))
                                            <p class="text-lg text-grey mb-5" 
                                                style="
                                                @if (! empty($banner['description']['color'])) color: {{ $banner['description']['color'] }}; @endif
                                                @if (! empty($banner['description']['font_size'])) font-size: {{ $banner['description']['font_size'] }}px; @endif"
                                                >
                                                {{ $banner['description']['text'] }}
                                            </p>
                                        @endif

                                        @if (! empty($banner['button']['url']) && ! empty($banner['button']['text']))
                                            <div class="main-white-button">
                                                <a href="{{ filter_var($banner['button']['url'], FILTER_VALIDATE_URL) ? $banner['button']['url'] : '#' }}">{{ $banner['button']['text'] }}</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    @endif

    <section class="container py-0 page-content">
        @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
    </section>
@endsection
