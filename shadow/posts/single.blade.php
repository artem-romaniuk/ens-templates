@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', 'sub_page')

@section('content')
    <div class="hero_area">
        @includeIf('themes.' . current_theme() . '.layouts.includes.header')
    </div>

    <div class="page-section pt-4">
        <div class="container">
            <nav aria-label="Breadcrumb">
                <ul class="breadcrumb p-0 mb-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pages.single', 'blog') }}">Blog</a></li>
                    <li class="breadcrumb-item active">{{ $title ?? $name ?? '' }}</li>
                </ul>
            </nav>

            <div class="row">
                <div class="@if($similar->isNotEmpty()) col-lg-8 @else col-lg-12 @endif">
                    <div class="blog-single-wrap pt-0">
                        <div class="header">
                            @if (! empty($data['banner']))
                                @php($banner = $data['banner'][0])
                                @if (! empty($banner['image']['url']))
                                    <div class="post-thumb">
                                        <img src="{{ $banner['image']['url'] }}" alt="">
                                    </div>
                                @endif
                            @endif

                            <div class="meta-header" style="transform: translateY(14px);">
                                <div class="post-author">
                                    by {{ $author->name }}
                                </div>

                                <div class="post-sharer">
                                </div>
                            </div>
                        </div>

                        <h1 class="post-title">{!! $title ?? $name !!}</h1>

                        <div class="post-meta">
                            <div class="post-date">
                                <span class="icon">
                                    <span class="mai-time-outline"></span>
                                </span>
                                <a>{{ $created_at }}</a>
                            </div>
                        </div>

                        @if (! empty($description))
                            <div class="post-content page-content" style="margin-bottom: 24px;">
                                {!! $description !!}
                            </div>
                        @endif

                        <div class="post-content page-content">
                            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' =>  $content ?? ''])
                        </div>
                    </div>
                </div>

                @if($similar->isNotEmpty())
                    <div class="col-lg-4">
                        <div class="widget">
                            <div class="widget-box">
                                <h4 class="widget-title">Recent Post</h4>
                                <div class="divider"></div>

                                @foreach($similar as $post)
                                    <div class="blog-item">
                                        @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
                                        @if ($banner)
                                            <a class="post-thumb" href="{{ route('posts.single', $post->slug) }}">
                                                <img src="{{ $banner }}" alt="{{ $post->name }}">
                                            </a>
                                        @endif

                                        <div class="content">
                                            <h6 class="post-title">
                                                <a href="{{ route('posts.single', $post->slug) }}">{{ $post->name }}</a>
                                            </h6>
                                            <div class="meta">
                                                <a href="#"><span class="mai-calendar"></span> {{ $post->created_at?->format('F d, Y') ?? '' }}</a>
                                                <a href="#"><span class="mai-person"></span> {{ $post->author->name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
