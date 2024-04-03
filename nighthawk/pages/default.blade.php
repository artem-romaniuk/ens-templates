@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', '')

@section('content')
    <main id="main">
        @if (! empty($data['banner']))
            @php($banner = $data['banner'][0])
            <div class="breadcrumbs d-flex align-items-center" style="
                background-image: url('{{ $banner['image']['url'] ?? '' }}'); 
                @if(empty($banner['image']['url'])) padding: 85px 0 20px 0; @endif 
                @if(($template_settings['header']['logo_position']['value'] ?? '') == 'under_menu' && ! empty($template_settings['header']['logo_position']['apply'])) padding: 130px 0 20px 0; @endif">
                <div class="container position-relative d-flex flex-column align-items-center">

                    <h2 style="
                            @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                            @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                        {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                    </h2>

                    @if (! empty($banner['subtitle']['text']))
                        <p style="
                                @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                                @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                            {{ $banner['subtitle']['text'] }}
                        </p>
                    @endif

                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>{{  $name ?? '' }}</li>
                    </ol>

                </div>
            </div>
        @endif

        <section class="container py-0 page-content">
            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
    </main>
@endsection
