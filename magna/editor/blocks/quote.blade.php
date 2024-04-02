<blockquote>
    @if (! empty($data['caption']))
        <h5 class="mb-30">{!! $data['caption'] !!}</h5>
    @endif
    <p @if (! empty($data['alignment'])) style="text-align: {{ $data['alignment'] }}" @endif>
        {!! $data['text'] ?? '' !!}
    </p>
</blockquote>
