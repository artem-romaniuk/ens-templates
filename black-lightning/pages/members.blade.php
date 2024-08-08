@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    @if (! empty($data['banner']))
        @php($banner = $data['banner'][0])
        <div class="section page-header-area" @if (! empty($banner['image']['url'])) data-bg-img="'{{ $banner['image']['url'] }}'" @endif
            style="@if (empty($banner['image']['url'])) padding: 0px 0px 20px 0px !important; @endif">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-sm-auto text-center text-sm-start">
                        <h1
                            class="page-header-title"
                            style="
                                @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                                @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                            {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                        </h1>
                        @if (! empty($banner['subtitle']['text']))
                            <p
                                class="link-nav"
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
    @endif

    @auth()
        <section class="container py-0 page-content" style="margin-bottom: 24px;">
            @includeIf('includes.members-info')
        </section>
    @endauth

    <section class="container py-0 page-content">
        @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
    </section>
@endsection
