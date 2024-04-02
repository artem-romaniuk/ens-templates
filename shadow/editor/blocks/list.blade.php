@if (isset($data['style']) && $data['style'] == 'ordered')
<ol class="ordered-list">
@else
<ul class="unordered-list">
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
