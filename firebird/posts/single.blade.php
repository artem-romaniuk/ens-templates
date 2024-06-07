@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', 'sub_page')

@section('content')
    <div class="hero_area">
        @includeIf('themes.' . current_theme() . '.layouts.includes.header')
    </div>

    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="@if($similar->isNotEmpty()) col-lg-8 @else col-lg-12 @endif entries">
                    <section class="service_section">
                        <div class="service_container mx-0 pt-3">
                            <article class="entry">
                                @if (! empty($data['banner']))
                                    @php($banner = $data['banner'][0])
                                    @if (! empty($banner['image']['url']))
                                        <div class="mb-3">
                                            <img src="{{ $banner['image']['url'] }}" alt="" class="img-fluid">
                                        </div>
                                    @endif
                                @endif

                                <h2 class="entry-title">
                                    {!! $title ?? $name !!}
                                </h2>

                                <div class="entry-meta">
                                    <ul style="padding: 0">
                                        <li class="d-flex align-items-center"><i class="bi bi-person"></i>{{ $author->name }}</li>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i><time datetime="2020-01-01">{{ $created_at }}</time></li>
                                    </ul>
                                </div>

                                @if (! empty($description))
                                    <div class="entry-content page-content" style="margin: 16px 0 24px 0;">
                                        {!! $description !!}
                                    </div>
                                @endif

                                <div class="entry-content page-content">
                                    @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' =>  $content ?? ''])
                                </div>
                            </article>
                        </div>
                    </section>
                </div>

                @if($similar->isNotEmpty())
                    <div class="col-lg-4 entries">
                        <h4 class="sidebar-title">Recent Posts</h4>
                        <div class="sidebar-item recent-posts">
                            @foreach($similar as $post)
                                <section class="service_section mb-4">
                                    <div class="service_container mx-0 py-3">
                                        <div class="container ">
                                            <div class="row">
                                                <div class="col-md-5 px-0">
                                                    @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
                                                    @if ($banner)
                                                        <img src="{{ $banner }}" style="max-width: 100%" alt="{{ $post->name }}">
                                                    @endif
                                                </div>
                                                <div class="col-md-7">
                                                    <h5 class="mb-0"><a href="{{ route('posts.single', $post->slug) }}">{{ $post->name }}</a></h5>
                                                    <time datetime="2020-01-01" style="font-size: 14px">{{ $post->created_at?->format('F d, Y') ?? '' }}</time>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
