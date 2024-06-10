<div class="{{ $class ?? 'col-lg-4' }}">
    <div class="ticket-item">
        @php($banner = $post->data['banner'][0]['image']['url'] ?? null)
        @if ($banner)
            <div class="thumb post-thumb" style="background-image: url('{{ $banner }}'); background-position: center center; background-size: cover;">

            </div>
        @endif
        <div class="down-content pt-2" style="height: 240px;">
            <h4 class="mb-2">{{ $post->name }}</h4>
            <ul style="padding: 0; margin: 0;">
                <li style="list-style: none;"><i class="fa fa-clock-o mt-1"></i> {{ $post->created_at?->format('F d, Y') ?? '' }}</li>
            </ul>
            <div class="post-short-description">
                {!! $post->description ?? '' !!}
            </div>
            <div class="main-dark-button mt-3">
                <a href="{{ route('posts.single', $post->slug) }}">Read More</a>
            </div>
        </div>
    </div>
</div>
