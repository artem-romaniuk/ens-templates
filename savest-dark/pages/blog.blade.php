@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <main class="main-content">
        @if (! empty($data['banner']))
            @php($banner = $data['banner'][0])
            <div class="section page-header-area" @if (! empty($banner['image']['url'])) data-bg-img="'{{ $banner['image']['url'] }}'" @endif>
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-sm-auto text-center text-sm-start">
                            <h1 class="page-header-title" style="@if (! empty($banner['title']['color'])) color: {{ $banner['title']['color'] }}; @endif @if (! empty($banner['title']['font_size'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">{{ $banner['title']['text'] ?? '' }}</h1>
                            @if (! empty($banner['subtitle']['text']))
                                <p class="link-nav" style="@if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">{{ $banner['subtitle']['text'] }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (! empty($posts))
            <div class="blog-post-section section" style="padding-top: 90px; padding-bottom: 30px;">
                <div class="container">
                    <div class="row mb-n6">
                        @foreach($posts as $post)
                            @include('themes.' . current_theme() . '.blocks.post', ['post' => $post])
                        @endforeach

                        @if ($posts->lastPage() > 1)
                            <div class="col-12 mt-2 mt-md-8 mb-6">
                                {{ $posts->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
    </main>
@endsection
