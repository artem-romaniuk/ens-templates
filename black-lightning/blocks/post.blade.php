<div class="col-md-6 col-xl-4 mb-6">
    <div class="post-item post3-item-style">
        @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
        @if ($banner)
            <a
                href="{{ route('posts.single', $post->slug) }}"
                class="image d-block"
                style="background-image: url('{{ $banner }}');background-size:cover;background-position:center;height:250px;width:100%"
            >
            </a>
        @endif

        <div class="content" style="height: 250px;">
            <ul class="post-meta post3-meta">
                <li class="post-date"><span>Date:</span> {{ $post->created_at?->format('F d, Y') ?? '' }}</li>
            </ul>
            <h4 class="title">
                <a class="default-link" href="{{ route('posts.single', $post->slug) }}">{{ $post->name }}</a>
            </h4>
            @if (! empty($post->description))
                <div class="post-short-description">
                    {!! $post->description !!}
                </div>
            @endif
        </div>
    </div>
</div>
