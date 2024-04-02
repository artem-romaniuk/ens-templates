@php($align = $data['align'] ?? 'stretched')
<div style="width: 100%;height: 100%;">
    <img
        src="{{ safe_image_url($data['url'] ?? '') }}"
        style="display: block; @if ($align == 'stretched') width: 100%; @endif @if ($align == 'left') margin: 0 auto 0 0; @endif @if ($align == 'center') margin: 0 auto; @endif @if ($align == 'right') margin: 0 0 0 auto; @endif" alt="{{ $data['caption'] ?? '' }}"
    />
</div>
