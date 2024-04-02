<section class="about py-0">
    <div class="container row-block" data-aos="fade-up">
        <div class="row gy-4" style="align-items: center" data-aos="fade-up">
            <div class="col-lg-5">
                @includeif('themes.' . current_theme() . '.editor.blocks.index', ['blocks' => $data['cols'][0]['blocks'] ?? []])
            </div>
            <div class="col-lg-3">
                @includeif('themes.' . current_theme() . '.editor.blocks.index', ['blocks' => $data['cols'][1]['blocks'] ?? []])
            </div>
            <div class="col-lg-4">
                @includeif('themes.' . current_theme() . '.editor.blocks.index', ['blocks' => $data['cols'][2]['blocks'] ?? []])
            </div>
        </div>
    </div>
</section>
