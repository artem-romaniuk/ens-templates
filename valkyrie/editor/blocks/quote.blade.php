<blockquote class="editor-blockquote" @if (! empty($data['alignment'])) style="text-align: {{ $data['alignment'] }}" @endif>
    {!! $data['text'] ?? '' !!}

    @if (! empty($data['caption']))
        <br />
        <br />
        <span class="author">― {!! $data['caption'] !!}</span>
    @endif
</blockquote>
