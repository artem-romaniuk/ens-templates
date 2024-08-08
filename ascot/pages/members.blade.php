@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <div class="page-heading-rent-venue"
        style="
            background-image: url('{{ $data['banner'][0]['image']['url'] ?? '' }}');
            background-size: cover;
            @if (empty($data['banner'][0]['image']['url'])) padding: 20px 0px !important; @endif">
        <div class="container">
            @if (! empty($data['banner']))
                @php($banner = $data['banner'][0])
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center"
                        style="
                            @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                            @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                        {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                    </h2>

                    @if (! empty($banner['subtitle']['text']))
                        <span style="
                                @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                                @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                            {{ $banner['subtitle']['text'] }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @auth()
        <section class="container py-0 page-content" style="margin-bottom: 24px;">
            @includeIf('includes.members-info')
        </section>
    @endauth

    <section class="container py-0 page-content">
        @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
    </section>
@endsection
