<section class="about_section">
    <div class="container row-block">
        <div class="row">
            <div class="col-md-5">
                @includeif('themes.' . current_theme() . '.editor.blocks.index', ['blocks' => $data['cols'][0]['blocks'] ?? []])
            </div>

            <div class="col-md-3" style="padding: 0 32px;">
                @includeif('themes.' . current_theme() . '.editor.blocks.index', ['blocks' => $data['cols'][1]['blocks'] ?? []])
            </div>

            <div class="col-md-4">
                @includeif('themes.' . current_theme() . '.editor.blocks.index', ['blocks' => $data['cols'][2]['blocks'] ?? []])
            </div>
        </div>
    </div>
</section>
