@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <div class="page-heading-rent-venue" 
         style="
            background-image: url('{{ $data['banner'][0]['image']['url'] ?? '' }}'); 
            background-size: cover; 
            @if (empty($data['banner'][0]['image']['url'])) padding: 20px 0px !important; @endif">
        <div class="container">
            @if (! empty($data['banner']))
                @php($banner = $data['banner'][0])
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center" style="
                            @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                            @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                        {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                    </h2>

                    @if (! empty($banner['subtitle']['text']))
                        <span style="
                                @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                                @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                            {{ $banner['subtitle']['text'] }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="shows-events-tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 tabs-content mt-4">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="sidebar mb-4">
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <form action="{{ route('pages.single', 'blog') }}" class="contact-form" method="get">
                                            <fieldset>
                                                <input type="text" name="search" class="mb-1" placeholder="Enter keyword.." value="{{ request('search') }}">
                                            </fieldset>
                                            <button type="submit" class="button" style="width: 100%; height: 38px; line-height: 8px">Search</button>
                                        </form>
                                    </div>

                                    @if (isset($categories) && $categories->isNotEmpty())
                                        <div class="col-lg-12">
                                            <div class="category">
                                                <h6 class="mb-2">Category</h6>
                                                <ul>
                                                    @foreach($categories as $category)
                                                        <li>
                                                            <a href="{{ route('pages.single', array_merge(array_filter(request()->query()), ['slug' => 'blog', 'category' => $category->id, 'page' => 1])) }}">{{ $category->name }} <span>({{ $category->posts_count }})</span></a>
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
                                <div class="row tickets-page mb-0">
                                    @foreach($posts as $post)
                                        <div class="col-lg-6">
                                            <div class="ticket-item">
                                                @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
                                                @if ($banner)
                                                    <div class="thumb post-thumb" style="background-image: url('{{ $banner }}'); background-position: center center; background-size: cover;">

                                                    </div>
                                                @endif
                                                <div class="down-content pt-2">
                                                    <h4 class="mb-2">{{ $post->name }}</h4>
                                                    <ul>
                                                        <li><i class="fa fa-clock-o mt-1"></i> {{ $post->created_at?->format('F d, Y') ?? '' }}</li>
                                                    </ul>
                                                    <div class="post-short-description">
                                                        {!! $post->description ?? '' !!}
                                                    </div>
                                                    <div class="main-dark-button mt-3">
                                                        <a href="{{ route('posts.single', $post->slug) }}">Read More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @if ($posts->lastPage() > 1)
                                        <div class="col-lg-12">
                                            <div class="pagination mt-2 mb-4">
                                                {{ $posts->onEachSide(2)->appends(request()->query())->links('vendor.pagination.ascot') }}
                                            </div>
                                        </div>
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
