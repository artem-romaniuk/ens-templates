<div class="col-lg-6">
    <article class="d-flex flex-column">
        @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
        @if ($banner)
            <div class="post-img">
                <img src="{{ $banner }}" alt="{{ $post->name }}" class="img-fluid">
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
