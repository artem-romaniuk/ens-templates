@php($align = $data['align'] ?? 'left')
<div class="button my-0" style="width:100%">
    <a
        class="btn btn-primary"
        href="{{ $data['url'] ?? '#' }}"
        @if(! empty($data['openInNewTab']) && $data['openInNewTab']) target="_blank" @endif
        style="text-align: center; display: block; @if ($align == 'stretched') width: 100%; @endif @if ($align == 'left') margin: 0 auto 0 0; width: fit-content; @endif @if ($align == 'center') margin: 0 auto; width: fit-content; @endif @if ($align == 'right') margin: 0 0 0 auto; width: fit-content; @endif"
    >{{ $data['text'] ?? '' }}</a>
</div>
