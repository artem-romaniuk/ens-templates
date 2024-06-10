<div class="{{ $class ?? 'col-lg-4' }} py-3">
    <div class="card-blog" style="height: 100%; max-width: 100%;">
        <div class="header">
            @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
            @if ($banner)
                <div class="post-thumb" style="background-image: url('{{ $banner }}'); background-position: center center; background-size: cover;">
                </div>
            @endif
        </div>
        <div class="body">
            <h5 class="post-title"><a href="{{ route('posts.single', $post->slug) }}">{{ $post->name }}</a></h5>
            <div class="post-date">Posted on <a href="{{ route('posts.single', $post->slug) }}">{{ $post->created_at?->format('F d, Y') ?? '' }}</a></div>

            @if (! empty($post->description))
                <div class="post-short-description" style="padding-top: 16px;">
                    {!! $post->description !!}
                </div>
            @endif
        </div>
    </div>
</div>
