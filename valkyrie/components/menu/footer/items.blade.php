@foreach($items as $item)
    @continue(empty($item['children']))

    <div class="col-md-4 pt-5">
        <h2 class="h2 border-bottom pb-3 border-light">{{ $item['name'] }}</h2>

        <ul class="list-unstyled text-light footer-link-list">
            @foreach($item['children'] as $children)
                <li>
                    <a
                        href="{{ $children['properties']['url'] ?? '#' }}"
                        class="text-decoration-none footer-link"
                        @if (! empty($children['properties']['target']) && $children['properties']['target'] == '_blank') target="_blank" @endif
                    >{{ $children['name'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endforeach
