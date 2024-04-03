<blockquote class="editor-blockquote">
    @if (! empty($data['caption']))
        <h5>{!! $data['caption'] !!}</h5>
    @endif
    <p @if (! empty($data['alignment'])) style="text-align: {{ $data['alignment'] }}" @endif>
        {!! $data['text'] ?? '' !!}
    </p>
</blockquote>
