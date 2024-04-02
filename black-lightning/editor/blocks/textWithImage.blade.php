<div class="about-section section section-margin pt-0 pb-0 pt-xl-5 pb-xl-5" style="margin: 0;">
    @foreach($data['cols'] ?? [] as $col)
        @if ($data['align'] == 'ti')
            <div class="container">
                <div class="row mt-n1 pt-0 pt-lg-5 pt-xl-10 pb-6 pb-md-10 pb-lg-5 pb-xl-10 mb-5 mb-lg-0">
                    <div class="col-lg-5">
                        <div class="section-title-2 mb-0">
{{--                            <h6 class="sub-title">SAVE ANIMAL FOR EARTH</h6>--}}
                            @foreach($col['blocks'] as $block)
                                @continue($block['type'] == 'image')
                                @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            @foreach($col['blocks'] as $block)
                @continue($block['type'] != 'image')
                @php($align = $data['align'] ?? 'stretched')
                <div class="section-bg-img section-bg-img-style1" data-bg-img="{{ safe_image_url($block['data']['url'] ?? '') }}"></div>
{{--                <div class="section-pattern-img section-pattern-img-style2 pattern-img-move">--}}
{{--                    <img--}}
{{--                        src="{{ $block['data']['url'] ?? '' }}"--}}
{{--                        width="148"--}}
{{--                        height="190"--}}
{{--                        alt="{{ $block['data']['caption'] ?? '' }}"--}}
{{--                        style="display: block; @if ($align == 'stretched') width: 100%; @endif @if ($align == 'left') margin: 0 auto 0 0; @endif @if ($align == 'center') margin: 0 auto; @endif @if ($align == 'right') margin: 0 0 0 auto; @endif"--}}
{{--                    />--}}
{{--                </div>--}}
            @endforeach
        @endif

        @if ($data['align'] == 'it')
            @foreach($col['blocks'] as $block)
                @continue($block['type'] != 'image')
                @php($align = $data['align'] ?? 'stretched')
                <div class="section-bg-img section-bg-img-style1" style="right: initial;" data-bg-img="{{ safe_image_url($block['data']['url'] ?? '') }}"></div>
{{--                <div class="section-pattern-img section-pattern-img-style2 pattern-img-move">--}}
{{--                    <img--}}
{{--                        src="{{ $block['data']['url'] ?? '' }}"--}}
{{--                        width="148"--}}
{{--                        height="190"--}}
{{--                        alt="{{ $block['data']['caption'] ?? '' }}"--}}
{{--                        style="display: block; @if ($align == 'stretched') width: 100%; @endif @if ($align == 'left') margin: 0 auto 0 0; @endif @if ($align == 'center') margin: 0 auto; @endif @if ($align == 'right') margin: 0 0 0 auto; @endif"--}}
{{--                    />--}}
{{--                </div>--}}
            @endforeach

            <div class="container">
                <div class="row mt-n1 pt-0 pt-lg-5 pt-xl-10 pb-6 pb-md-10 pb-lg-5 pb-xl-10 mb-5 mb-lg-0" style="flex-direction: row-reverse;;">
                    <div class="col-lg-5">
                        <div class="section-title-2 mb-0">
                            {{--                            <h6 class="sub-title">SAVE ANIMAL FOR EARTH</h6>--}}
                            @foreach($col['blocks'] as $block)
                                @continue($block['type'] == 'image')
                                @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
