@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <section class="bg-success @if($data['banner'][0]['image']['url']) py-5 @endif" style="background-image: url('{{ $data['banner'][0]['image']['url'] ?? '' }}'); background-size: cover;">
        <div class="container">
            @if (! empty($data['banner']))
                @php($banner = $data['banner'][0])
            @endif
            <div class="row align-items-center py-{{ $data['banner'][0]['image']['url'] ? 5 : 4 }}">
                <div class="col-md-12 text-white">
                    <h1 style="
                            @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                            @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                        {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                    </h1>

                    @if (! empty($banner['subtitle']['text']))
                        <h3 style="
                                @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                                @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                            {{ $banner['subtitle']['text'] }}
                        </h3>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="container py-0 page-content">
        @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
    </section>
@endsection
