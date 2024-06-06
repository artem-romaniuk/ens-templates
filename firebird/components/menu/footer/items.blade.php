<div class="info_links">
    <div class="info_links_menu flex-column">
        @foreach($items as $item)
            <div>
                <a
                    class="footer-link"
                    href="{{ $item['properties']['url'] ?? '#' }}"
                    @if (! empty($item['properties']['target']) && $item['properties']['target'] == '_blank') target="_blank" @endif
                >{{ $item['name'] }} @if (($item['properties']['url'] ?? '#') == url()->current()) <span class="sr-only">(current)</span> @endif</a>
            </div>
        @endforeach

        @if (! empty($item['children']))
            @include('themes.' . current_theme() . '.components.menu.footer.items', ['items' => $item['children']])
        @endif
    </div>
</div>

