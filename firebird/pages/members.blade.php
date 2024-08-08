@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', 'sub_page')

@section('content')
    <div class="hero_area">
        @includeIf('themes.' . current_theme() . '.layouts.includes.header')
    </div>

    @if (! empty($data['banner']))
        @php($banner = $data['banner'][0])
        <section class="d-flex justify-content-center flex-column align-items-center page-banner" style="background-image: url('{{ $banner['image']['url'] ?? '' }}'); min-height: 90px; max-height: 300px; background-size: cover; @if($banner['image']['url']) height: 300px; @else margin-top: 10px; @endif">
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

    @auth()
        <section class="container py-0" style="margin-bottom: 24px;">
            @includeIf('includes.members-info')
        </section>
    @endauth

    <section class="container py-0">
        @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
    </section>
@endsection
