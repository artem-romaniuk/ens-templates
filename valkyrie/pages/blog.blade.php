@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <section class="bg-success py-5" style="background-image: url('{{ $data['banner'][0]['image']['url'] ?? '' }}'); background-size: cover;">
        <div class="container">
            @if (! empty($data['banner']))
                @php($banner = $data['banner'][0])
            @endif
            <div class="row align-items-center py-5">
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

    <div class="shows-events-tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 tabs-content mt-4">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="sidebar mb-4">
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <form action="{{ route('pages.single', 'blog') }}" class="contact-form" method="get">
                                            <fieldset>
                                                <input type="text" name="search" class="form-control mb-2" placeholder="Enter keyword.." value="{{ request('search') }}">
                                            </fieldset>
                                            <button type="submit" class="btn btn-success" style="width: 100%; height: 38px; line-height: 8px">Search</button>
                                        </form>
                                    </div>

                                    @if (isset($categories) && $categories->isNotEmpty())
                                        <div class="col-lg-12">
                                            <div class="category">
                                                <h6 class="h2 mb-2">Category</h6>
                                                <ul class="list-unstyled pl-3">
                                                    @foreach($categories as $category)
                                                        <li class="mb-1">
                                                            <a class="text-decoration-none" href="{{ route('pages.single', array_merge(array_filter(request()->query()), ['slug' => 'blog', 'category' => $category->id, 'page' => 1])) }}">{{ $category->name }} <span>({{ $category->posts_count }})</span></a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            @if (! empty($posts))
                                <div class="row">
                                    @foreach($posts as $post)
                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="card h-100">
                                                @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
                                                @if ($banner)
                                                    <a href="{{ route('posts.single', $post->slug) }}" class="post-thumb" style="background-image: url('{{ $banner }}'); background-position: center center; background-size: cover;">

                                                    </a>
                                                @endif

                                                <div class="card-body">
                                                    <ul class="list-unstyled d-flex justify-content-between">
                                                        <li class="text-muted text-right">{{ $post->created_at?->format('F d, Y') ?? '' }}</li>
                                                    </ul>
                                                    <a href="{{ route('posts.single', $post->slug) }}" class="h2 text-decoration-none text-dark entry-title">{{ $post->name }}</a>
                                                    <div class="card-text post-short-description mt-2">
                                                        {!! $post->description ?? '' !!}
                                                    </div>
                                                    <div class="mt-3">
                                                        <a href="{{ route('posts.single', $post->slug) }}" class="text-muted entry-title">Read More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    @if ($posts->lastPage() > 1)
                                        {{ $posts->onEachSide(2)->appends(request()->query())->links('vendor.pagination.valkyrie') }}
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="container py-0 page-content">
        @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
    </section>
@endsection
