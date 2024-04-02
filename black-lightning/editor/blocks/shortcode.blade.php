@if (isset($data['id']))
    @php($data = shortcode($data['id']))

    @if (! empty($data['entity']))
        @if ($data['entity'] == 'posts' && $data['items']->isNotEmpty())
            <div class="blog-post-section section" style="padding-top: 90px; padding-bottom: 30px;">
                <div class="container">
                    <div class="row my-3">
                        @if (! empty($data['title']))
                            <h2>{{ $data['title'] }}</h2>
                        @endif
                    </div>
                    <div class="row mb-n6">
                        @foreach($data['items'] as $post)
                            <div class="col-md-6 col-xl-4 mb-6">
                                <div class="post-item post3-item-style">
                                    @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
                                    @if ($banner)
                                        <a href="{{ route('posts.single', $post->slug) }}" class="image">
                                            <img src="{{ $banner }}" width="475" height="475" alt="{{ $post->name }}">
                                        </a>
                                    @endif

                                    <div class="content">
                                        <ul class="post-meta post3-meta">
                                            <li class="post-date"><span>Date:</span> {{ $post->created_at?->format('F d, Y') ?? '' }}</li>
{{--                                            <li class="post-info">--}}
{{--                                                <ul class="d-flex">--}}
{{--                                                    <li class="post-comment"><span>Comment:</span> 8,962</li>--}}
{{--                                                    <li class="post-like ms-2"><span>Like:</span> 78K</li>--}}
{{--                                                </ul>--}}
{{--                                            </li>--}}
                                        </ul>
                                        <h4 class="title">
                                            <a href="{{ route('posts.single', $post->slug) }}">{{ $post->name }}</a>
                                        </h4>
                                        @if (! empty($post->description))
                                            <p>{{ $post->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($data['entity'] == 'events' && $data['items']->isNotEmpty())
            <div class="blog-post-section section" style="padding-top: 90px; padding-bottom: 30px;">
                <div class="container">
                    <div class="row my-3">
                        @if (! empty($data['title']))
                            <h2>{{ $data['title'] }}</h2>
                        @endif
                    </div>

                    <div class="row mb-n6">
                        @foreach($data['items'] as $event)
                            <div class="col-md-6 col-xl-4 mb-6">
                                <div class="post-item post3-item-style">
                                    @php($banner = $event->data['banner'][0]['image']['url'] ?? null)
                                    @if ($banner)
                                        {{--                                        <a href="{{ route('posts.single', $event->slug) }}" class="image">--}}
                                        <img src="{{ $banner }}" width="475" height="475" alt="{{ $event->name }}">
                                        {{--                                        </a>--}}
                                    @endif

                                    <div class="content">
                                        <ul class="post-meta post3-meta pb-1">
                                            <li class="post-date">{{ $event->start_at?->format('F d, Y') ?? '' }}</li>
                                            <li class="post-date">{{ $event->start_at?->format('H:i') ?? '' }}</li>
                                        </ul>
                                        <ul class="post-meta post3-meta pb-1">
                                            @if (($event->start_at?->format('F d, Y') ?? '') != ($event->end_at?->format('F d, Y') ?? ''))
                                                <li class="post-date">{{ $event->end_at?->format('F d, Y') ?? '' }}</li>
                                            @endif
                                            @if (($event->start_at?->format('H:i') ?? '') != ($event->end_at?->format('H:i') ?? ''))
                                                <li class="post-date">{{ $event->end_at?->format('H:i') ?? '' }}</li>
                                            @endif
                                        </ul>
                                        <h4 class="title">
{{--                                            <a href="{{ route('posts.single', $post->slug) }}">--}}
                                                {{ $event->name }}
{{--                                            </a>--}}
                                        </h4>
                                        @if (! empty($event->location))
                                            <p>{{ $event->location }}</p>
                                        @endif
                                        @if (! empty($event->description))
                                            <p>{{ $event->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endif
@endif
