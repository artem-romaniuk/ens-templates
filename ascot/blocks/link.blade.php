<div class="col-lg-12 mb-2 ticket-item">
    <div class="down-content" style="min-width: 100%">
        <div class="body">
            <h5 class="post-title entry-title">
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
            </h5>

            <div class="description my-2">{!! $link->description !!}</div>

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
</div>
