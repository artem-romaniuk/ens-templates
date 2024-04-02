@foreach($items as $item)
    @continue(empty($item['children']))

    <div class="col-lg-3 py-3">
        <h5>{{ $item['name'] }}</h5>
        <ul class="footer-menu">
            @foreach($item['children'] as $children)
                <li>
                    <a
                        class="footer-link"
                        href="{{ $children['properties']['url'] ?? '#' }}"
                        @if (! empty($children['properties']['target']) && $children['properties']['target'] == '_blank') target="_blank" @endif
                    >{{ $children['name'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endforeach
