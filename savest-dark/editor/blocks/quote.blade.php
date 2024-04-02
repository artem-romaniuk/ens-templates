<div class="section-top-border">
    @if (! empty($data['caption']))
        <h3 class="mb-30">{!! $data['caption'] !!}</h3>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <blockquote class="generic-blockquote" @if (! empty($data['alignment'])) style="text-align: {{ $data['alignment'] }}" @endif>{!! $data['text'] ?? '' !!}</blockquote>
        </div>
    </div>
</div>
