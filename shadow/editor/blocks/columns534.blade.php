<div class="page-section py-0" id="about">
    <div class="container row-block">
        <div class="row align-items-center">
            <div class="col-lg-5 wow fadeInUp">
                @includeif('themes.' . current_theme() . '.editor.blocks.index', ['blocks' => $data['cols'][0]['blocks'] ?? []])
            </div>
            <div class="col-lg-3 wow fadeInRight">
                @includeif('themes.' . current_theme() . '.editor.blocks.index', ['blocks' => $data['cols'][1]['blocks'] ?? []])
            </div>
            <div class="col-lg-4 wow fadeInRight">
                @includeif('themes.' . current_theme() . '.editor.blocks.index', ['blocks' => $data['cols'][2]['blocks'] ?? []])
            </div>
        </div>
    </div>
</div>
