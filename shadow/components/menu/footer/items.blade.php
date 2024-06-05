@foreach($items as $item)
    <li>
        <a
            class="footer-link"
            href="{{ $item['properties']['url'] ?? '#' }}"
            @if (! empty($item['properties']['target']) && $item['properties']['target'] == '_blank') target="_blank" @endif
        >{{ $item['name'] }}</a>
    </li>
    @if (! empty($item['children']))
        @include('themes.' . current_theme() . '.components.menu.footer.items', ['items' => $item['children']])
    @endif
@endforeach
