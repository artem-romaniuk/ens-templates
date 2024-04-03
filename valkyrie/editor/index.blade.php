@foreach($blocks ?? [] as $block)
    @if (in_array($block['type'], ['columns453', 'columns534', 'textWithImage', 'threeColumnsWithImages']))
        @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
    @else
        <section class="container py-0">
            @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
        </section>
    @endif
@endforeach
