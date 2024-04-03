@php($level = $data['level'] ?? '3')

<div class="heading_container py-0">
@if ($level == 1)
    <h1 class="h1" @if (! empty($parameters['alignment'])) style="text-align: {{ $parameters['alignment'] }}; width: 100%;" @endif>{!! $data['text'] ?? '' !!}</h1>
@elseif ($level == 2)
    <h2 class="h2" @if (! empty($parameters['alignment'])) style="text-align: {{ $parameters['alignment'] }}; width: 100%;" @endif>{!! $data['text'] ?? '' !!}</h2>
@elseif ($level == 3)
    <h3 class="h3" @if (! empty($parameters['alignment'])) style="text-align: {{ $parameters['alignment'] }}; width: 100%;" @endif>{!! $data['text'] ?? '' !!}</h3>
@elseif ($level == 4)
    <h4 class="h4" @if (! empty($parameters['alignment'])) style="text-align: {{ $parameters['alignment'] }}; width: 100%;" @endif>{!! $data['text'] ?? '' !!}</h4>
@elseif ($level == 5)
    <h5 class="h5" @if (! empty($parameters['alignment'])) style="text-align: {{ $parameters['alignment'] }}; width: 100%;" @endif>{!! $data['text'] ?? '' !!}</h5>
@else
    <p @if (! empty($parameters['alignment'])) style="text-align: {{ $parameters['alignment'] }}; width: 100%;" @endif>{!! $data['text'] ?? '' !!}</p>
@endif
</div>
