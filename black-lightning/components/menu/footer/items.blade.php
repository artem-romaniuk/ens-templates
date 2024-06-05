@foreach($items as $item)
    <li>
        <a
            href="{{ $item['properties']['url'] ?? '#' }}"
            @if (! empty($item['properties']['target']) && $item['properties']['target'] == '_blank') target="_blank" @endif
            class="default-link" >{{ $item['name'] }}</a>
    </li>
    @if (! empty($item['children']))
        @include('themes.' . current_theme() . '.components.menu.footer.items', ['items' => $item['children']])
    @endif
@endforeach
