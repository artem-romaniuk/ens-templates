<blockquote class="client_section">
    <div class="box">
        <div class="detail-box">
            <div class="client_info">
                <div class="client_name">
                    @if (! empty($data['caption']))
                        <h5>{!! $data['caption'] !!}</h5>
                    @endif
                </div>
                <i class="fa fa-quote-left" aria-hidden="true"></i>
            </div>
            <p @if (! empty($data['alignment'])) style="text-align: {{ $data['alignment'] }}" @endif>
                {!! $data['text'] ?? '' !!}
            </p>
        </div>
    </div>
</blockquote>
