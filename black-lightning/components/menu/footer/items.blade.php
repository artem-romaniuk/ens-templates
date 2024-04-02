@foreach($items as $item)
    @continue(empty($item['children']))

    <div class="col-md-6 footer-widget-nav{{ $loop->iteration }}">
        <h4 class="footer-widget-title">{{ $item['name'] }}</h4>
        <h4 class="collapsed-title collapsed" data-bs-toggle="collapse" data-bs-target="#dividerId-1" aria-expanded="false">{{ $item['name'] }}</h4>
        <div id="dividerId-1" class="widget-collapse-body collapse">
            <ul class="footer-widget-nav">
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
