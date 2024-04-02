<div class="col-lg-4 py-3 wow fadeInUp">
    <div class="card-blog">
        @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
        @if ($banner)
            <div class="header">
                <div class="post-thumb" style="background-image: url('{{ $banner }}'); background-position: center center; background-size: cover;">
{{--                    <img src="../assets/img/blog/blog-2.jpg" alt="">--}}
                </div>
            </div>
        @endif
        <div class="body">
            <h5 class="post-title">
                <a href="{{ route('posts.single', $post->slug) }}">{{ $post->name }}</a>
            </h5>
            <div class="post-date">Posted on <a href="{{ route('posts.single', $post->slug) }}">{{ $post->created_at?->format('F d, Y') ?? '' }}</a></div>

{{--            @if (! empty($post->description))--}}
{{--                <div class="post-short-description">--}}
{{--                    {!! $post->description !!}--}}
{{--                </div>--}}
{{--            @endif--}}
        </div>
    </div>
</div>
