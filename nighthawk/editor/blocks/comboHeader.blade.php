<div>
    @foreach($data['cols'] ?? [] as $col)
        @continue(empty($col['blocks']))
        @includeif('themes.' . current_theme() . '.editor.blocks.index', ['blocks' => $col['blocks'] ?? []])
    @endforeach
</div>
