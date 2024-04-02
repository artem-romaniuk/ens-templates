@if (isset($data['style']) && $data['style'] == 'ordered')
<ol class="ordered-list" style="padding: 0 30px;">
@else
<ul class="unordered-list" style="padding: 0 30px;">
@endif

@foreach($data['items'] ?? [] as $item)
    @php($i = (!empty($iteration) ? $iteration . '.' : '') . $loop->iteration)
    <li>{!! $item['content'] ?? '' !!}</li>

    @if (! empty($item['items']))
        @php($data['items'] = $item['items'])
        @php($iteration = $i)
        @includeif('themes.' . current_theme() . '.editor.blocks.list', ['data' => $data, 'iteration' => $iteration])
        @php($iteration = '')
    @endif
@endforeach

@if (isset($data['style']) && $data['style'] == 'ordered')
</ol>
@else
</ul>
@endif
