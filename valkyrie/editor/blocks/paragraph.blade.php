<p @if (! empty($data['alignment'])) style="text-align: {{ $data['alignment'] }}" @endif>{!! $data['text'] ?? '' !!}</p>
