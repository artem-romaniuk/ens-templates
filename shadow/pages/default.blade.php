@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <header>
        @include('themes.' . current_theme() . '.layouts.includes.header')

        <div class="container">
            @if (! empty($data['banner']))
                @php($banner = $data['banner'][0])
            @endif
            <div class="page-banner" style="background-image: url('{{ $data['banner'][0]['image']['url'] ?? '' }}'); background-size: cover; @if(empty($data['banner'][0]['image']['url'])) height: 150px; @endif">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-md-6">
                        <nav aria-label="Breadcrumb">
                            <ul class="breadcrumb justify-content-center py-0 bg-transparent">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">{{ $name ?? '' }}</li>
                            </ul>
                        </nav>
                        <h1
                            class="text-center"
                            style="
                                @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                                @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                            {{ (! empty($banner['title']['text']) ? $banner['title']['text'] : null) ?? (! empty($banner['image']['url']) ? null : $title) ?? (! empty($banner['image']['url']) ? null : $name) ?? null }}
                        </h1>

                        @if (! empty($banner['subtitle']['text']))
                            <p
                                class="text-center"
                                style="
                                    @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                                    @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                                {{ $banner['subtitle']['text'] }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="container py-0 page-content">
        @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
    </section>
@endsection
