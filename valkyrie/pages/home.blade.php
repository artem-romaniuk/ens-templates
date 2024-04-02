@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', '')

@section('content')
    @if (! empty($data['banner']))
        <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="{{ $data['hero_section']['delay'] ?? 5000 }}">
            <ol class="carousel-indicators">
                @foreach($data['banner'] as $banner)
                    <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="{{ $loop->index }}" class=" @if ($loop->first) active @endif"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($data['banner'] as $banner)
                    <div class="carousel-item @if ($loop->first) active @endif" style="background-image: url('{{ $banner['image']['url'] ?? '' }}'); background-repeat: no-repeat; background-size: cover">
                        <div class="container">
                            <div class="row p-5">
                                <div class="mx-auto col-md-8 col-lg-6 order-lg-last">

                                </div>
                                <div class="col-lg-6 mb-0 d-flex align-items-center">
                                    <div class="text-align-left align-self-center">
                                        <h1 class="h1 text-success" 
                                            style="
                                                @if (! empty($banner['title']['color'])) color: {{ $banner['title']['color'] }} !important; @endif
                                                @if (! empty($banner['title']['font_size'])) font-size: {{ $banner['title']['font_size'] }}px; @endif
                                            ">
                                            {{ $banner['title']['text'] ?? '' }}
                                        </h1>

                                        <h3 class="h2" style="
                                                @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }} !important; @endif
                                                @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif
                                            ">
                                            {{ $banner['subtitle']['text'] ?? '' }}
                                        </h3>

                                        @if (! empty($banner['description']))
                                            <p style="
                                                @if (! empty($banner['description']['color'])) color: {{ $banner['description']['color'] }} !important; @endif
                                                @if (! empty($banner['description']['font_size'])) font-size: {{ $banner['description']['font_size'] }}px; @endif
                                            ">{{ $banner['description']['text'] }}</p>
                                        @endif

                                        <div class="btn-box">
                                            @if (! empty($banner['button']['url']) && ! empty($banner['button']['text']))
                                                <a href="{{ filter_var($banner['button']['url'], FILTER_VALIDATE_URL) ? $banner['button']['url'] : '#' }}" class="btn btn-success">{{ $banner['button']['text'] }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
                <i class="fas fa-chevron-left"></i>
            </a>
            <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    @endif

    <section class="container py-0 page-content">
        @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
    </section>
@endsection
