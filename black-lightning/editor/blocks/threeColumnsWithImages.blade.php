<div class="feature-section section section-padding section-margin-t" style="margin: 0">
    <div class="container">
        <div class="row row-gutter-45 mb-n6">
            @foreach($data['cols'] ?? [] as $col)
                <div class="col-md-6 col-lg-4 mb-6">
                    <div class="feature-item">
                        @foreach($col['body']['blocks'] as $block)
                            {{-- @if ($block['type'] == 'image')
                                @php($align = $block['data']['align'] ?? 'stretched')

                                <span class="icon">
                                <svg class="bg" data-name="bg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 135 135">
                                <path d="M67.5,0A67.5,67.5,0,1,1,0,67.5,67.5,67.5,0,0,1,67.5,0Z" fill="currentColor" fill-rule="evenodd"/>
                                </svg>
                                <img class="svg-inject" src="{{ safe_image_url($block['data']['url']) }}" width="63" height="56" alt="{{ $data['caption'] ?? '' }}">
                                </span>
                            @else --}}
                                @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                            {{-- @endif --}}
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="section-bg-color-shape section-bg-color-shape-style1 bg-grey"></div>

    <div class="section-pattern-img section-pattern-img-style1 pattern-img-zoom">
        <img src="{{ theme_asset('images/shape/1.png') }}" width="127" height="125" alt="Image">
    </div>
</div>
