@php($level = $data['level'] ?? '3')

@if ($level == 1)
    <h1 class="title" @if (! empty($parameters['alignment'])) style="text-align: {{ $parameters['alignment'] }}" @endif>{!! $data['text'] ?? '' !!}</h1>
@elseif ($level == 2)
    <h2 class="title" @if (! empty($parameters['alignment'])) style="text-align: {{ $parameters['alignment'] }}" @endif>{!! $data['text'] ?? '' !!}</h2>
@elseif ($level == 3)
    <h3 class="title" @if (! empty($parameters['alignment'])) style="text-align: {{ $parameters['alignment'] }}" @endif>{!! $data['text'] ?? '' !!}</h3>
@elseif ($level == 4)
    <h4 class="title" @if (! empty($parameters['alignment'])) style="text-align: {{ $parameters['alignment'] }}" @endif>{!! $data['text'] ?? '' !!}</h4>
@elseif ($level == 5)
    <h5 class="title" @if (! empty($parameters['alignment'])) style="text-align: {{ $parameters['alignment'] }}" @endif>{!! $data['text'] ?? '' !!}</h5>
@else
    <p class="title" @if (! empty($parameters['alignment'])) style="text-align: {{ $parameters['alignment'] }}" @endif>{!! $data['text'] ?? '' !!}</p>
@endif
