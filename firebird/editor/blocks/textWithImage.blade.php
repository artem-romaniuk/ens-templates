<section class="about_section">
    <div class="container row-block">
        <div class="row">
            @if ($data['align'] == 'it')
                <div class="col-md-6 ">
                    <div class="img-box">
                        @foreach($data['cols'] ?? [] as $col)
                            @foreach($col['blocks'] as $block)
                                @continue($block['type'] != 'image')
                                @php($align = $data['align'] ?? 'stretched')
                                @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                            @endforeach
                        @endforeach
                    </div>
                </div>

                <div class="col-md-6" style="padding-left: 32px;">
                    <div class="detail-box">
                        @foreach($data['cols'] ?? [] as $col)
                            @foreach($col['blocks'] as $block)
                                @continue($block['type'] == 'image')
                                @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                            @endforeach
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($data['align'] == 'ti')
                <div class="col-md-6" style="padding-right: 32px;">
                    <div class="detail-box">
                        @foreach($data['cols'] ?? [] as $col)
                            @foreach($col['blocks'] as $block)
                                @continue($block['type'] == 'image')
                                @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="img-box">
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
        </div>
    </div>
</section>
