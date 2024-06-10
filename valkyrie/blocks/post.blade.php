<div class="col-12 {{ $class ?? 'col-md-4' }} mb-4">
    <div class="card h-100 card-post">
        @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
        @if ($banner)
            <a href="{{ route('posts.single', $post->slug) }}" class="post-thumb" style="background-image: url('{{ $banner }}'); background-position: center center; background-size: cover;">

            </a>
        @endif

        <div class="card-body">
            <ul class="list-unstyled d-flex justify-content-between">
                <li class="text-muted text-right">{{ $post->created_at?->format('F d, Y') ?? '' }}</li>
            </ul>
            <a href="{{ route('posts.single', $post->slug) }}" class="h2 text-decoration-none text-dark entry-title">{{ $post->name }}</a>
            <div class="card-text post-short-description mt-2">
                {!! $post->description ?? '' !!}
            </div>
            <div class="mt-3">
                <a href="{{ route('posts.single', $post->slug) }}" class="text-muted entry-title">Read More</a>
            </div>
        </div>
    </div>
</div>
