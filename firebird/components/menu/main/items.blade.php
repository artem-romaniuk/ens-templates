@foreach($items as $item)
    <li class="nav-item @if (! empty($item['children'])) submenu dropdown @endif @if (url()->current() == ($item['properties']['url'] ?? '#')) active @endif">
        <div style="display: flex; justify-content: space-between;">
            <a
                class="nav-link @if (! empty($item['children'])) submenu dropdown @endif @if (url()->current() == ($item['properties']['url'] ?? '#')) active @endif"
                href="{{ $item['properties']['url'] ?? '#' }}"
                @if (! empty($item['properties']['target']) && $item['properties']['target'] == '_blank') target="_blank" @endif
            >{{ $item['name'] }}</a>

            @if (! empty($item['children']))
                <span class="expand-submenu"><i class="bi bi-plus"></i></span>
            @endif
        </div>

        @if (! empty($item['children']))
            <ul class="dropdown-menu">
                @include('themes.' . current_theme() . '.components.menu.main.items', ['items' => $item['children']])
            </ul>
        @endif
    </li>
@endforeach