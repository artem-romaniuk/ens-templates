@foreach($items as $item)
    @if (! empty($item['children']))
        <li class="dropdown">
            <a href="{{ $item['properties']['url'] ?? '#' }}"><span>{{ $item['name'] }}</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <ul style="@if($align == 'burger') visibility: visible; @endif">
                @include('themes.' . current_theme() . '.components.menu.main.items', ['items' => $item['children']])
            </ul>
        </li>
    @else
        <li><a @if (($item['properties']['url'] ?? '#') == url()->current()) class="active" @endif href="{{ $item['properties']['url'] ?? '#' }}">{{ $item['name'] }}</a></li>
    @endif
@endforeach
