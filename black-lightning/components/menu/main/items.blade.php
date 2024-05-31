@if ($side)
    @foreach($items as $item)
        <li>
            <a class="default-link" href="{{ $item['properties']['url'] ?? '#' }}" @if (($item['properties']['url'] ?? '#') == url()->current()) class="active" @endif @if (! empty($item['properties']['target']) && $item['properties']['target'] == '_blank') target="_blank" @endif>{{ $item['name'] }}</a>

            @if (! empty($item['children']))
                <ul class="sub-menu">
                    @include('themes.' . current_theme() . '.components.menu.main.items', ['items' => $item['children']])
                </ul>
            @endif
        </li>
    @endforeach
@else
    @foreach($items as $item)
        <li @if (! empty($item['children'])) class="has-submenu" @endif>
            <a class="default-link" href="{{ $item['properties']['url'] ?? '#' }}" @if (($item['properties']['url'] ?? '#') == url()->current()) class="active" @endif @if (! empty($item['properties']['target']) && $item['properties']['target'] == '_blank') target="_blank" @endif>{{ $item['name'] }}</a>

            @if (! empty($item['children']))
                <ul class="submenu-nav">
                    @include('themes.' . current_theme() . '.components.menu.main.items', ['items' => $item['children']])
                </ul>
            @endif
        </li>
    @endforeach
@endif
