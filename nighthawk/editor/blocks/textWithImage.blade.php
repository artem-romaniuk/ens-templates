<section class="about py-0">
    <div class="container row-block" data-aos="fade-up">
        @if ($data['align'] == 'it')
            <div class="row gy-4" style="align-items: center" data-aos="fade-up">
                <div class="col-lg-4">
                    @foreach($data['cols'] ?? [] as $col)
                        @foreach($col['blocks'] as $block)
                            @continue($block['type'] != 'image')
                            @php($align = $data['align'] ?? 'stretched')
                            @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                        @endforeach
                    @endforeach
                </div>
                <div class="col-lg-8">
                    <div class="content ps-lg-5">
                        @foreach($data['cols'] ?? [] as $col)
                            @foreach($col['blocks'] as $block)
                                @continue($block['type'] == 'image')
                                @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($data['align'] == 'ti')
            <div class="row gy-4" style="align-items: center" data-aos="fade-up">
                <div class="col-lg-8">
                    <div class="content ps-lg-5">
                        @foreach($data['cols'] ?? [] as $col)
                            @foreach($col['blocks'] as $block)
                                @continue($block['type'] == 'image')
                                @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4">
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
</section>
