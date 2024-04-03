@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', 'sub_page')

@section('content')
    <div class="hero_area">
        @includeIf('themes.' . current_theme() . '.layouts.includes.header')
    </div>

    @if (! empty($data['banner']))
        @php($banner = $data['banner'][0])
        <section class="d-flex justify-content-center flex-column align-items-center page-banner" style="background-image: url('{{ $banner['image']['url'] ?? '' }}'); min-height: 90px; max-height: 300px; background-size: cover; @if($banner['image']['url']) height: 300px @endif">
            <h2 class="animate__animated animate__fadeInDown text-center" 
                style="
                    @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                    @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
            </h2>

            @if (! empty($banner['subtitle']['text']))
                <p class="animate__animated animate__fadeInUp" 
                    style="
                        @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                        @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                    {{ $banner['subtitle']['text'] }}
                </p>
            @endif
        </section>
    @endif

    <section class="py-4 blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 entries">
                    @if (! empty($posts))
                        @foreach($posts as $post)
                            <section class="service_section mb-4">
                                <div class="service_container mx-0 pt-3 pb-3">
                                    <article class="entry box mt-0">
                                        @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
                                        @if ($banner)
                                            <div class="entry-img" style="min-height: 350px; background-image: url('{{ $banner }}');">
                                            </div>
                                        @endif

                                        <div class="detail-box">
                                            <h5 class="entry-title">
                                                <a href="{{ route('posts.single', $post->slug) }}">{{ $post->name }}</a>
                                            </h5>
                                            <div class="meta-top entry-meta">
                                                <ul style="padding: 0;">
                                                    <li><a href="{{ route('posts.single', $post->slug) }}">{{ $post->author?->name ?? '' }}</a></li>
                                                    <li><a href="{{ route('posts.single', $post->slug) }}"><time datetime="2022-01-01">{{ $post->created_at?->format('F d, Y') ?? '' }}</time></a></li>
                                                </ul>
                                            </div>
                                            @if (! empty($post->description))
                                                <div class="post-short-description">
                                                    {!! $post->description !!}
                                                </div>
                                            @endif

                                            <a href="{{ route('posts.single', $post->slug) }}" class="mt-2 d-block">Read More</a>
                                        </div>
                                    </article>
                                </div>
                            </section>
                        @endforeach

                        @if ($posts->lastPage() > 1)
                            <div class="blog-pagination mb-4">
                                {{ $posts->onEachSide(2)->appends(request()->query())->links('vendor.pagination.moderna') }}
                            </div>
                        @endif
                    @endif
                </div>

                <div class="col-lg-4 entries sidebar">
                    <section class="service_section mb-4">
                        <div class="service_container mx-0 py-3">
                            <div class="sidebar-item search-form">
                                <form action="{{ route('pages.single', 'blog') }}" class="d-flex" method="get">
                                    <input type="text" placeholder="Search" class="mb-0" name="search" value="{{ request('search') }}">
                                    <button class="cta-btn mt-0 ml-2" type="submit">Go</button>
                                </form>
                            </div>
                        </div>
                    </section>

                    @if (isset($categories) && $categories->isNotEmpty())
                        <section class="service_section mb-4">
                            <div class="service_container mx-0 py-3">
                            
                                <h5 class="sidebar-title">Categories</h5>
                                <div class="sidebar-item categories box mt-4">
                                    <ul class="detail-box px-2 mt-0">
                                        @foreach($categories as $category)
                                            <li>
                                                <a href="{{ route('pages.single', array_merge(array_filter(request()->query()), ['slug' => 'blog', 'category' => $category->id, 'page' => 1])) }}">{{ $category->name }} <span>({{ $category->posts_count }})</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </section>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="container py-0">
            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
@endsection
