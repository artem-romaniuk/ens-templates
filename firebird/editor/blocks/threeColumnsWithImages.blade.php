<section class="about_section">
    <div class="container row-block">
        <div class="row">
            @foreach($data['cols'] ?? [] as $col)
                @continue(empty($col['body']['blocks']))
                <div class="col-md-6 col-lg-{{ 12 / count(array_filter($data['cols'], fn ($item) => ! empty($item['body']['blocks']))) }} d-flex align-items-stretch" data-aos="fade-up" style="padding: 0 32px;">
                    <div class="icon-box icon-box-blue">
                        @foreach($col['body']['blocks'] as $block)
                            @if ($block['type'] == 'image')
                                @php($align = $block['data']['align'] ?? 'stretched')
                                <div class="icon">
                                    @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                                </div>
                            @else
                                @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
