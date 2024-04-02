<section class="features py-0">
    <div class="container row-block">
        <div class="row" data-aos="fade-up">
            @if ($data['align'] == 'it')
                <div class="col-md-5">
                    @foreach($data['cols'] ?? [] as $col)
                        @foreach($col['blocks'] as $block)
                            @continue($block['type'] != 'image')
                            @php($align = $data['align'] ?? 'stretched')
                            @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                        @endforeach
                    @endforeach
                </div>
                <div class="col-md-7 pt-5">
                    @foreach($data['cols'] ?? [] as $col)
                        @foreach($col['blocks'] as $block)
                            @continue($block['type'] == 'image')
                            @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                        @endforeach
                    @endforeach
                </div>
            @endif

            @if ($data['align'] == 'ti')
                <div class="col-md-7 pt-5">
                    @foreach($data['cols'] ?? [] as $col)
                        @foreach($col['blocks'] as $block)
                            @continue($block['type'] == 'image')
                            @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                        @endforeach
                    @endforeach
                </div>
                <div class="col-md-5">
                    @foreach($data['cols'] ?? [] as $col)
                        @foreach($col['blocks'] as $block)
                            @continue($block['type'] != 'image')
                            @php($align = $data['align'] ?? 'stretched')
                            @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                        @endforeach
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
