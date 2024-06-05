@foreach($items as $item)
    <li>
        <a
            href="{{ $item['properties']['url'] ?? '#' }}"
            class="text-decoration-none footer-link"
            @if (! empty($item['properties']['target']) && $item['properties']['target'] == '_blank') target="_blank" @endif
        >{{ $item['name'] }}</a>
    </li>
    @if (! empty($item['children']))
        @include('themes.' . current_theme() . '.components.menu.footer.items', ['items' => $item['children']])
    @endif
@endforeach
