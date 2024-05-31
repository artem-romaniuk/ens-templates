<div class="col-md-6 col-xl-4 mb-6">
    <div class="post-item post3-item-style">
        @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
        @if ($banner)
            <a
                href="{{ route('posts.single', $post->slug) }}"
                class="image d-block custom-link"
                style="background-image: url('{{ $banner }}');background-size:cover;background-position:center;height:250px;width:100%"
            >
            </a>
        @endif

        <div class="content">
            <ul class="post-meta post3-meta">
                <li class="post-date"><span>Date:</span> {{ $post->created_at?->format('F d, Y') ?? '' }}</li>
            </ul>
            <h4 class="title">
                <a href="{{ route('posts.single', $post->slug) }}">{{ $post->name }}</a>
            </h4>
            @if (! empty($post->description))
                <div class="post-short-description">
                    {!! $post->description !!}
                </div>
            @endif
        </div>
    </div>
</div>
