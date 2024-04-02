@php($align = $data['align'] ?? 'left')
<div style="width:100%; margin-top: 45px;">
    <a
        href="{{ $data['url'] ?? '#' }}"
        class="btn btn-primary"
        @if(! empty($data['openInNewTab']) && $data['openInNewTab']) target="_blank" @endif
        style="display: block; @if ($align == 'stretched') width: 100%; @endif @if ($align == 'left') margin: 0 auto 0 0; width: fit-content; @endif @if ($align == 'center') margin: 0 auto; width: fit-content; @endif @if ($align == 'right') margin: 0 0 0 auto; width: fit-content; @endif"
    >{{ $data['text'] ?? '' }}</a>
</div>
