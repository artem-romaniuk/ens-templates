<div class="events-details-content mb-3">
    <h3 class="title">
        @if ($link->type == \App\Enums\LinkType::URL->value)
            <a href="{{ $link->link }}" target="_blank" rel="nofollow">
                {{ $link->title ?? $link->name }}
            </a>
        @endif

        @if ($link->type == \App\Enums\LinkType::EMAIL->value)
            <a href="mailto:{{ $link->link }}" target="_blank" rel="nofollow">
                {{ $link->title ?? $link->name }}
            </a>
        @endif
    </h3>
    <div class="mt-1">{!! $link->description !!}</div>
    <div class="sub-title">
        @if ($link->type == \App\Enums\LinkType::URL->value)
            <a href="{{ $link->link }}" target="_blank" rel="nofollow" class="custom-link">
                {{ str_replace(['http://', 'https://'], '', rtrim($link->link, '/')) }}
            </a>
        @endif

        @if ($link->type == \App\Enums\LinkType::EMAIL->value)
            <a href="mailto:{{ $link->link }}" target="_blank" rel="nofollow" class="custom-link">
                {{ $link->link }}
            </a>
        @endif
    </div>
</div>
