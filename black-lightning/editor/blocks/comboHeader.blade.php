<div class="section-title center mt-n3" style="margin-bottom: 0">
    @foreach($data['cols'] ?? [] as $col)
        @continue(empty($col['blocks']))
        <div class="col-lg-{{ 12 / count(array_filter($data['cols'], fn ($item) => ! empty($item['blocks']))) }}">
            @includeif('themes.' . current_theme() . '.editor.blocks.index', ['blocks' => $col['blocks'] ?? []])
        </div>
    @endforeach
    <span class="shape"><img src="{{ theme_asset('images/shape/section-title.png') }}" width="99" height="7" alt="Section Title Shape"></span>
</div>
