@foreach($items as $item)
    @continue(empty($item['children']))

    <div class="col-lg-3 col-md-6 footer-links">
        <h4>{{ $item['name'] }}</h4>
        <ul>
            @foreach($item['children'] as $children)
                <li>
                    <i class="bx bx-chevron-right"></i>
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
