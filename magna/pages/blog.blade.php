@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <main id="main">
        @if (! empty($data['banner']))
            @php($banner = $data['banner'][0])
            <section class="d-flex justify-content-center flex-column align-items-center page-banner" style="background-image: url('{{ $banner['image']['url'] ?? '' }}'); @if(empty($banner['image']['url'])) height: 100px !important; padding: 30px 0px !important; @endif">
                <h2
                    class="animate__animated animate__fadeInDown text-center"
                    style="
                        @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                        @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                    {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                </h2>

                @if (! empty($banner['subtitle']['text']))
                    <p
                        class="animate__animated animate__fadeInUp text-center"
                        style="
                            @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                            @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                        {{ $banner['subtitle']['text'] }}
                    </p>
                @endif
            </section>
        @endif

        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">{{ $name ?? '' }}</h2>
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>{{ $name ?? '' }}</li>
                    </ol>
                </div>
            </div>
        </section>

        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-8 entries">
                        @if (! empty($posts))
                            @foreach($posts as $post)
                                <article class="entry">
                                    @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
                                    @if ($banner)
                                        <div class="entry-img" style="background-image: url('{{ $banner }}')">
{{--                                            <img src="{{ $banner }}" alt="" class="img-fluid">--}}
                                        </div>
                                    @endif

                                    <h2 class="entry-title">
                                        <a href="{{ route('posts.single', $post->slug) }}">{{ $post->name }}</a>
                                    </h2>

                                    <div class="entry-meta">
                                        <ul>
                                            <li class="d-flex align-items-center"><i class="bi bi-person"></i>
                                                <a href="{{ route('posts.single', $post->slug) }}">{{ $post->author?->name ?? '' }}</a>
                                            </li>
                                            <li class="d-flex align-items-center"><i class="bi bi-clock"></i>
                                                <a href="{{ route('posts.single', $post->slug) }}">
                                                    <time datetime="2020-01-01">{{ $post->created_at?->format('F d, Y') ?? '' }}</time>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="entry-content">
                                        @if (! empty($post->description))
                                            <div class="post-short-description">
                                                {!! $post->description !!}
                                            </div>
                                        @endif

                                        <div class="read-more">
                                            <a href="{{ route('posts.single', $post->slug) }}">Read More</a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        @endif

                        @if ($posts->lastPage() > 1)
                            <div class="blog-pagination">
                                {{ $posts->onEachSide(2)->appends(request()->query())->links('vendor.pagination.moderna') }}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-4">
                        <div class="sidebar">
                            <h3 class="sidebar-title">Search</h3>
                            <div class="sidebar-item search-form">
                                <form action="{{ route('pages.single', 'blog') }}" method="get">
                                    <input type="text" name="search" value="{{ request('search') }}">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </form>
                            </div>

                            @if (isset($categories) && $categories->isNotEmpty())
                                <h3 class="sidebar-title">Categories</h3>
                                <div class="sidebar-item categories">
                                    <ul>
                                        @foreach($categories as $category)
                                            <li>
                                                <a href="{{ route('pages.single', array_merge(array_filter(request()->query()), ['slug' => 'blog', 'category' => $category->id, 'page' => 1])) }}">{{ $category->name }} <span>({{ $category->posts_count }})</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container py-0 page-content">
            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
    </main>
@endsection
