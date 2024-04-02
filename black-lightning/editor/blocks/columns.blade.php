<div class="container" style="padding: 0">
    <div class="row">
        @foreach($data['cols'] ?? [] as $col)
            @continue(empty($col['blocks']))
            <div class="col-lg-{{ 12 / count(array_filter($data['cols'], fn ($item) => ! empty($item['blocks']))) }}">
                @foreach($col['blocks'] as $block)
                    @if ($block['type'] == 'image')
                        @php($align = $block['data']['align'] ?? 'stretched')
                        <div class="my-3">
                            @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                        </div>
                    @else
                        @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
</div>
