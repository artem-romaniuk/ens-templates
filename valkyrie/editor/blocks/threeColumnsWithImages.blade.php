<section class="bg-light py-0">
    <div class="container row-block pt-5 pb-3">
        <div class="row">
            @foreach($data['cols'] ?? [] as $col)
                @continue(empty($col['body']['blocks']))

                <div class="col-12 col-md-{{ 12 / count(array_filter($data['cols'], fn ($item) => ! empty($item['body']['blocks']))) }} mb-{{ 12 / count(array_filter($data['cols'], fn ($item) => ! empty($item['body']['blocks']))) }}">
                    <div class="card h-100">
                        @foreach($col['body']['blocks'] as $block)
                            @continue($block['type'] != 'image')
                            @php($align = $block['data']['align'] ?? 'stretched')
                            <div class="header">
                                @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                            </div>
                        @endforeach

                        <div class="card-body">
                            @foreach($col['body']['blocks'] as $block)
                                @continue($block['type'] == 'image')
                                    @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
