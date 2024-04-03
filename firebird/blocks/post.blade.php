<div class="col-lg-4 service_section mt-3">
    <div class="box mt-0 mb-2 service_container pt-4 pb-4" style="margin: 0">
        @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
        @if ($banner)
            <div class="entry-img" style="background-image: url('{{ $banner }}')">
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
    </div>
</div>
