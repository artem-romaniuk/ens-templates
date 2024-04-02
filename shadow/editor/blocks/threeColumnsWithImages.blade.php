<div class="page-section py-0">
    <div class="container">
        <div class="row">
            @foreach($data['cols'] ?? [] as $col)
                @continue(empty($col['body']['blocks']))
                <div class="col-lg-{{ 12 / count(array_filter($data['cols'], fn ($item) => ! empty($item['body']['blocks']))) }}">
                    <div class="card-service wow fadeInUp">
                        @foreach($col['body']['blocks'] as $block)
                            @if ($block['type'] == 'image')
                                @php($align = $block['data']['align'] ?? 'stretched')
                                <div class="header">
                                    @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                                </div>
                            @else
                                <div class="body">
                                    @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
