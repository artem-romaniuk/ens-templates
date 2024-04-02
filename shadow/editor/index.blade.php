@foreach($blocks ?? [] as $block)
    @if (in_array($block['type'], ['columns453', 'columns534', 'comboHeader', 'textWithImage', 'threeColumnsWithImages']))
        @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
    @else
        <section class="page-section py-0">
            <div class="container">
                @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
            </div>
        </section>
    @endif
@endforeach
