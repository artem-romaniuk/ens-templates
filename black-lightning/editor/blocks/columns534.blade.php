<div class="event-section section section-padding" style="padding: 0">
    <div class="container">
        <div class="row mb-n6">
            <div class="col-12 mb-6">
                <div class="event-item alt ">
                    <div class="image">
                        @includeif('themes.' . current_theme() . '.editor.blocks.index', ['blocks' => $data['cols'][2]['blocks'] ?? []])
                    </div>

                    <div class="content">
                        <div class="details">
                            @includeif('themes.' . current_theme() . '.editor.blocks.index', ['blocks' => $data['cols'][0]['blocks'] ?? []])
                        </div>
                        <div class="button">
                            @includeif('themes.' . current_theme() . '.editor.blocks.index', ['blocks' => $data['cols'][1]['blocks'] ?? []])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
