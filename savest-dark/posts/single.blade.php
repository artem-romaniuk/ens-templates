@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    @if (! empty($data['banner']))
        @php($banner = $data['banner'][0])
        <div class="section page-header-area" @if (! empty($banner['image']['url'])) data-bg-img="'{{ $banner['image']['url'] }}'" @endif>
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-sm-auto text-center text-sm-start">
                        <h1 class="page-header-title" @if (! empty($banner['title']['color'])) style="color: {{ $banner['title']['color'] }};" @endif>{{ $banner['title']['text'] ?? '' }}</h1>
                        @if (! empty($banner['subtitle']['text']))
                            <p class="link-nav" @if (! empty($banner['subtitle']['color'])) style="color: {{ $banner['subtitle']['color'] }};" @endif>{{ $banner['subtitle']['text'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <main class="main-content">
        <div class="blog-details-section section section-padding-t">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="post-details-info text-center mt-n2" style="margin-bottom: 16px;">
                            <div class="meta">
                                @if (isset($author))
                                    <span class="author">By <a href="#">{{ $author->full_name }}</a></span>
                                    <span class="dots"></span>
                                @endif
                                <span class="post-date">{{ $created_at }}</span>
                                <span class="dots"></span>
                                <span class="post-time">{{ $created_at_humans }}</span>
                            </div>
                            <h4 class="title">{{ $name }}</h4>
                        </div>
                    </div>

                    <div class="col-lg-10">
                        @if (! empty($description))
                            <div class="post-details-content mt-0" style="padding-bottom: 24px;">
                                {!! $description !!}
                            </div>
                        @endif

                        <div class="post-details-content mt-0">
                            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' =>  $content ?? ''])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($similar->isNotEmpty())
            <div class="blog-related-section section bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="related-post-title-wrap">
                                <h4 class="title">You may also like</h4>
                                <!--== Add Swiper Arrows ==-->
                                <div class="related-post-swiper-btn-wrap">
                                    <div class="related-post-swiper-btn-prev">
                                        <i class="icofont-long-arrow-left"></i>
                                    </div>
                                    <div class="related-post-swiper-btn-next">
                                        <i class="icofont-long-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="swiper related-post-slider-container">
                                <div class="swiper-wrapper">
                                    @foreach($similar as $post)
                                        <div class="swiper-slide">
                                            <div class="post-item post4-item-style">
                                                @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
                                                @if ($banner)
                                                    <a href="{{ route('posts.single', $post->slug) }}" class="image">
                                                        <img src="{{ $banner }}" width="350" height="270" alt="{{ $post->name }}">
                                                    </a>
                                                @endif
                                                <div class="content">
                                                    @if (! empty($post->author))
                                                        <div class="post-author">
                                                            <span>By</span> <a href="#">{{ $post->author->full_name }}</a>
                                                        </div>
                                                    @endif
                                                    <h4 class="title">
                                                        <a href="{{ route('posts.single', $post->slug) }}">{{ $post->name }}</a>
                                                    </h4>
                                                    <ul class="post-meta post4-meta">
                                                        <li class="post-date">{{ $post->created_at?->format('d F, y') ?? '' }}</li>
                                                        <li class="post-dot"><span></span></li>
                                                        <li class="post-time">{{ $post->created_at?->diffForHumans() ?? '' }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </main>
@endsection
