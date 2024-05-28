@php $settings = settings('logo_settings.header'); @endphp

@php $height = $settings['height'] ?? null @endphp
@php $height = ($height === null || $height === 'auto') ? 75 : $height; @endphp

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

    #content {
        padding-top: {{ $height - 18 }}px !important;
    }
</style>
