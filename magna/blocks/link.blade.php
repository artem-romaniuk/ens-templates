<div class="icon-box mb-4" style="text-align: initial;">
    <h4 class="title mb-0">
        @if ($link->type == \App\Enums\LinkType::URL->value)
            <a class="link" href="{{ $link->link }}" target="_blank" rel="nofollow">
                {{ $link->title ?? $link->name }}
            </a>
        @endif

        @if ($link->type == \App\Enums\LinkType::EMAIL->value)
            <a class="link" href="mailto:{{ $link->link }}" target="_blank" rel="nofollow">
                {{ $link->title ?? $link->name }}
            </a>
        @endif
    </h4>
    <div class="description">{!! $link->description !!}</div>
    <div class="sub-title">
        @if ($link->type == \App\Enums\LinkType::URL->value)
            <a class="link" href="{{ $link->link }}" target="_blank" rel="nofollow">
                {{ str_replace(['http://', 'https://'], '', rtrim($link->link, '/')) }}
            </a>
        @endif

        @if ($link->type == \App\Enums\LinkType::EMAIL->value)
            <a class="link" href="mailto:{{ $link->link }}" target="_blank" rel="nofollow">
                {{ $link->link }}
            </a>
        @endif
    </div>
</div>
