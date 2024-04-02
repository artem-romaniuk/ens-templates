@foreach($items as $item)
    @continue(empty($item['children']))

    <div class="col-sm-3 col-md-8 col-lg-3 mx-auto">
        <div class="info_links">
            <h4>{{ $item['name'] }}</h4>

            <div class="info_links_menu">
                @foreach($item['children'] as $children)
                    <a
                        class="footer-link"
                        href="{{ $children['properties']['url'] ?? '#' }}"
                        @if (! empty($children['properties']['target']) && $children['properties']['target'] == '_blank') target="_blank" @endif
                    >{{ $children['name'] }} @if (($item['properties']['url'] ?? '#') == url()->current()) <span class="sr-only">(current)</span> @endif</a>
                @endforeach
            </div>
        </div>
    </div>
@endforeach
