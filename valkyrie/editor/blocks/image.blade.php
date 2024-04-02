@php($align = $data['align'] ?? 'stretched')
<div class="img-box" style="width: 100%;height: 100%;">
    <img
        src="{{ $data['url'] ?? '' }}"
        style="display: block; @if ($align == 'stretched') width: 100%; @endif @if ($align == 'left') margin: 0 auto 0 0; @endif @if ($align == 'center') margin: 0 auto; @endif @if ($align == 'right') margin: 0 0 0 auto; @endif" alt="{{ $data['caption'] ?? '' }}"
    />
</div>
