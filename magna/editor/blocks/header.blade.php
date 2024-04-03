@php($level = $data['level'] ?? '3')

<div class="section-title py-0">
@if ($level == 1)
    <h1 class="my-2" @if (! empty($parameters['alignment'])) style="text-align: {{ $parameters['alignment'] }}" @endif>{!! $data['text'] ?? '' !!}</h1>
@elseif ($level == 2)
    <h2 class="my-2" @if (! empty($parameters['alignment'])) style="text-align: {{ $parameters['alignment'] }}" @endif>{!! $data['text'] ?? '' !!}</h2>
@elseif ($level == 3)
    <h3 class="my-2" @if (! empty($parameters['alignment'])) style="text-align: {{ $parameters['alignment'] }}" @endif>{!! $data['text'] ?? '' !!}</h3>
@elseif ($level == 4)
    <h4 class="my-2" @if (! empty($parameters['alignment'])) style="text-align: {{ $parameters['alignment'] }}" @endif>{!! $data['text'] ?? '' !!}</h4>
@elseif ($level == 5)
    <h5 class="my-2" @if (! empty($parameters['alignment'])) style="text-align: {{ $parameters['alignment'] }}" @endif>{!! $data['text'] ?? '' !!}</h5>
@else
    <p class="my-2" @if (! empty($parameters['alignment'])) style="text-align: {{ $parameters['alignment'] }}" @endif>{!! $data['text'] ?? '' !!}</p>
@endif
</div>
