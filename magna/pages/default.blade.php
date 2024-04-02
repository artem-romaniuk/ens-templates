@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <main id="main">
        @if (! empty($data['banner']))
            @php($banner = $data['banner'][0])
            <section class="d-flex justify-content-center flex-column align-items-center page-banner" 
                    style="
                        background-image: url('{{ $banner['image']['url'] ?? '' }}'); 
                        @if(empty($banner['image']['url'])) height: 100px !important; padding: 30px 0px !important; @endif
                        @if(($template_settings['header']['logo_position']['value'] ?? '') == 'under_menu' && ! empty($template_settings['header']['logo_position']['apply'])) padding: 90px 0px 35px !important;  @endif">
                <h2 
                    class="animate__animated animate__fadeInDown text-center" 
                    style="
                        @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                        @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                    {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                </h2>

                @if (! empty($banner['subtitle']['text']))
                    <p 
                        class="animate__animated animate__fadeInUp" 
                        style="
                            @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                            @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                        {{ $banner['subtitle']['text'] }}
                    </p>
                @endif
            </section>
        @endif

        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">{{ $name ?? '' }}</h2>
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>{{ $name ?? '' }}</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class="container py-0 page-content">
            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
    </main>
@endsection
