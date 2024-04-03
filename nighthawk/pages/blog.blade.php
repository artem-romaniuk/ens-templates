@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', 'page-blog')

@section('content')
    <main id="main">
        @if (! empty($data['banner']))
            @php($banner = $data['banner'][0])
            <div class="breadcrumbs d-flex align-items-center" style="
                background-image: url('{{ $banner['image']['url'] ?? '' }}'); 
                @if(empty($banner['image']['url'])) padding: 85px 0 20px 0; @endif 
                @if(($template_settings['header']['logo_position']['value'] ?? '') == 'under_menu' && ! empty($template_settings['header']['logo_position']['apply'])) padding: 130px 0 20px 0; @endif">
                <div class="container position-relative d-flex flex-column align-items-center">

                    <h2 
                        style="
                            @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                            @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                        {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                    </h2>

                    @if (! empty($banner['subtitle']['text']))
                        <p 
                            style="
                                @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                                @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                            {{ $banner['subtitle']['text'] }}
                        </p>
                    @endif

                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>{{  $name ?? '' }}</li>
                    </ol>
                </div>
            </div>
        @endif

        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <div class="row g-5">
                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                        @if (! empty($posts))
                            <div class="row gy-5 posts-list">
                                @foreach($posts as $post)
                                    <div class="col-lg-6">
                                        <article class="d-flex flex-column">
                                            @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
                                            @if ($banner)
                                                <div class="post-img" style="background-image: url('{{ $banner }}')">
{{--                                                    <img src="{{ $banner }}" alt="{{ $post->name }}" class="img-fluid">--}}
                                                </div>
                                            @endif

                                            <h2 class="title">
                                                <a href="{{ route('posts.single', $post->slug) }}">{{ $post->name }}</a>
                                            </h2>

                                            <div class="meta-top">
                                                <ul>
                                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="{{ route('posts.single', $post->slug) }}">{{ $post->author?->name ?? '' }}</a></li>
                                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ route('posts.single', $post->slug) }}"><time datetime="2022-01-01">{{ $post->created_at?->format('F d, Y') ?? '' }}</time></a></li>
                                                </ul>
                                            </div>

                                            <div class="content mb-3">
                                                @if (! empty($post->description))
                                                    <div class="post-short-description">
                                                        {!! $post->description !!}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="read-more mt-auto align-self-end">
                                                <a href="{{ route('posts.single', $post->slug) }}">Read More <i class="bi bi-arrow-right"></i></a>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if ($posts->lastPage() > 1)
                            <div class="blog-pagination">
                                {{ $posts->onEachSide(2)->appends(request()->query())->links('vendor.pagination.moderna') }}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
                        <div class="sidebar ps-lg-4">
                            <div class="sidebar-item search-form">
                                <h3 class="sidebar-title">Search</h3>
                                <form action="{{ route('pages.single', 'blog') }}" method="get">
                                    <input type="text" name="search" value="{{ request('search') }}">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </form>
                            </div>

                            @if (isset($categories) && $categories->isNotEmpty())
                                <div class="sidebar-item categories">
                                    <h3 class="sidebar-title">Categories</h3>
                                    <ul class="mt-3">
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
