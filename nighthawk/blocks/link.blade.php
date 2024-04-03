<div class="col-lg-12">
    <article class="d-flex flex-column position-relative pb-2">
        <h2 class="title">
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
        </h2>

        <div class="content">
            {!! $link->description !!}
        </div>

        <div class="sub-title mt-3">
            @if ($link->type == \App\Enums\LinkType::URL->value)
                <a href="{{ $link->link }}" target="_blank" rel="nofollow">
                    {{ str_replace(['http://', 'https://'], '', rtrim($link->link, '/')) }}
                </a>
            @endif

            @if ($link->type == \App\Enums\LinkType::EMAIL->value)
                <a href="mailto:{{ $link->link }}" target="_blank" rel="nofollow">
                    {{ $link->link }}
                </a>
            @endif
        </div>
    </article>
</div>
