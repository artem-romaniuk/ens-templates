@foreach($items as $item)
    @continue(empty($item['children']))

    <div class="col-lg-4">
        <div class="links">
            <h4>{{ $item['name'] }}</h4>
            <ul>
                @foreach($item['children'] as $children)
                    <li>
                        <a
                            href="{{ $children['properties']['url'] ?? '#' }}"
                            @if (! empty($children['properties']['target']) && $children['properties']['target'] == '_blank') target="_blank" @endif
                        >{{ $children['name'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endforeach
