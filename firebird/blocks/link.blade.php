<div class="col-lg-12 service_section mt-3">
    <div class="box mt-0 mb-2 service_container pt-4 pb-4" style="margin: 0">
        <div class="detail-box">
            <h5 class="entry-title">
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

            <div class="description">{!! $link->description !!}</div>

            <div class="sub-title">
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
        </div>
    </div>
</div>
