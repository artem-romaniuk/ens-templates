@php $settings = settings('logo_settings.header'); @endphp

@php $height = $settings['height'] ?? 'auto' @endphp
@php $width = $settings['width'] ?? 'auto' @endphp

<style>
    header .logo-main {
        height: {{ $height }}px !important; max-height: none;

        @if($width === 'auto')
            width: auto !important;
        @else
            width: {{ $width }}px !important; max-width: none;
        @endif

        @if(!empty($settings['opacity']))
            opacity: {{ $settings['opacity'] }}% !important;
        @endif
    }
</style>
