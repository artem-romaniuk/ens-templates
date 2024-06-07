@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <main id="main">
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>{{ $title ?? $name ?? '' }}</h2>
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('pages.single', 'blog') }}">Blog</a></li>
                        <li>{{ $title ?? $name ?? '' }}</li>
                    </ol>
                </div>
            </div>
        </section>

        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="@if($similar->isNotEmpty()) col-lg-8 @else col-lg-12 @endif entries">
                        <article class="entry entry-single">
                            @if (! empty($data['banner']))
                                @php($banner = $data['banner'][0])
                                @if (! empty($banner['image']['url']))
                                    <div class="entry-img">
                                        <img src="{{ $banner['image']['url'] }}" alt="" class="img-fluid">
                                    </div>
                                @endif
                            @endif

                            <h2 class="entry-title">
                                {!! $title ?? $name !!}
                            </h2>

                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i>{{ $author->name }}</li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i><time datetime="2020-01-01">{{ $created_at }}</time></li>
                                </ul>
                            </div>

                            @if (! empty($description))
                                <div class="entry-content page-content">
                                    {!! $description !!}
                                </div>
                            @endif

                            <div class="entry-content page-content">
                                @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' =>  $content ?? ''])
                            </div>
                        </article>
                    </div>

                    @if($similar->isNotEmpty())
                        <div class="col-lg-4">
                            <div class="sidebar">
                                <h3 class="sidebar-title">Recent Posts</h3>
                                <div class="sidebar-item recent-posts">
                                    @foreach($similar as $post)
                                        <div class="post-item clearfix">
                                            @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
                                            @if ($banner)
                                                <img src="{{ $banner }}" alt="{{ $post->name }}">
                                            @endif

                                            <h4><a href="{{ route('posts.single', $post->slug) }}">{{ $post->name }}</a></h4>
                                            <time datetime="2020-01-01">{{ $post->created_at?->format('F d, Y') ?? '' }}</time>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection
