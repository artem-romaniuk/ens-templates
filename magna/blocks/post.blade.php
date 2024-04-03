<div class="col-md-6 col-xl-6 mb-6 blog py-0 px-2">
    <article class="entry">
        @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
        @if ($banner)
            <div class="entry-img" style="background-image: url('{{ $banner }}')">
{{--                <img src="{{ $banner }}" alt="" class="img-fluid">--}}
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

            <div class="read-more mt-4">
                <a href="{{ route('posts.single', $post->slug) }}">Read More</a>
            </div>
        </div>
    </article>
</div>
