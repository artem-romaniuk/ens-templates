<div class="page-section py-0" id="about">
    <div class="container row-block">
        <div class="row align-items-center">
            @if ($data['align'] == 'ti')
                <div class="col-lg-6 wow fadeInUp">
                    @foreach($data['cols'] ?? [] as $col)
                        @foreach($col['blocks'] as $block)
                            @continue($block['type'] == 'image')
                            @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                        @endforeach
                    @endforeach
                </div>
                <div class="col-lg-6 py-3 wow fadeInRight">
                    <div class="img-fluid text-center">
                        @foreach($data['cols'] ?? [] as $col)
                            @foreach($col['blocks'] as $block)
                                @continue($block['type'] != 'image')
                                @php($align = $data['align'] ?? 'stretched')
                                @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                            @endforeach
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($data['align'] == 'it')
                <div class="col-lg-6 py-3 wow fadeInRight">
                    <div class="img-fluid text-center">
                        @foreach($data['cols'] ?? [] as $col)
                            @foreach($col['blocks'] as $block)
                                @continue($block['type'] != 'image')
                                @php($align = $data['align'] ?? 'stretched')
                                @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                            @endforeach
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp">
                    @foreach($data['cols'] ?? [] as $col)
                        @foreach($col['blocks'] as $block)
                            @continue($block['type'] == 'image')
                            @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                        @endforeach
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
