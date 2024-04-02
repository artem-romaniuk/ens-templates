<div class="col-12 col-md-12 mb-12 mb-4">
    <div class="card h-100">
        <div class="card-body">
            <h5 class="entry-title">
                {{ $link->title ?? $link->name }}
            </h5>

            <div class="description">{!! $link->description !!}</div>

            @if ($link->type == \App\Enums\LinkType::URL->value)
                <a href="{{ $link->link }}" class="text-muted" target="_blank" rel="nofollow">
                    {{ str_replace(['http://', 'https://'], '', rtrim($link->link, '/')) }}
                </a>
            @endif

            @if ($link->type == \App\Enums\LinkType::EMAIL->value)
                <a href="mailto:{{ $link->link }}" class="text-muted" target="_blank" rel="nofollow">
                    {{ $link->link }}
                </a>
            @endif
        </div>
    </div>
</div>
