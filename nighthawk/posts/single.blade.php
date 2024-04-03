@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', 'page-blog')

@section('content')
    <main id="main">
        <div class="breadcrumbs d-flex align-items-center" style="background-image: url('{{ $data['banner'][0]['image']['url'] ?? '' }}');">
            <div class="container position-relative d-flex flex-column align-items-center">
                <h2>{{ $title ?? $name ?? '' }}</h2>
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('pages.single', 'blog') }}">Blog</a></li>
                    <li>{{ $title ?? $name ?? '' }}</li>
                </ol>
            </div>
        </div>

        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <div class="row g-5">
                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                        <article class="blog-details">
                            @if (! empty($data['banner']))
                                @php($banner = $data['banner'][0])
                                @if (! empty($banner['image']['url']))
                                    <div class="post-img">
                                        <img src="{{ $banner['image']['url'] }}" alt="" class="img-fluid">
                                    </div>
                                @endif
                            @endif

                            <h2 class="title">{{ $title ?? $name ?? '' }}</h2>

                            <div class="meta-top">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i>{{ $author->name }}</li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i><time datetime="2020-01-01">{{ $created_at }}</time></li>
                                </ul>
                            </div>

                            <div class="content page-content">
                                @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' =>  $content ?? ''])
                            </div>
                        </article>
                    </div>

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
                        <div class="sidebar ps-lg-4">
                            @if($similar->isNotEmpty())
                                <div class="sidebar-item recent-posts">
                                <h3 class="sidebar-title">Recent Posts</h3>
                                    <div class="mt-3">
                                        @foreach($similar as $post)
                                            <div class="post-item mt-3">
                                                @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
                                                @if ($banner)
                                                    <img src="{{ $banner }}" alt="{{ $post->name }}" class="flex-shrink-0">
                                                @endif
                                                <div>
                                                    <h4><a href="{{ route('posts.single', $post->slug) }}">{{ $post->name }}</a></h4>
                                                    <time datetime="2020-01-01">{{ $post->created_at?->format('F d, Y') ?? '' }}</time>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
