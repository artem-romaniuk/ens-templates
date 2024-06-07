@php $settings = settings('logo_settings.header'); @endphp
@php /** @var array $template_settings */@endphp

@php $height = $settings['height'] ?? 'auto' @endphp
@php $width = $settings['width'] ?? 'auto' @endphp
<style>
    header .logo-main {
        @if($height === 'auto')
            height: auto !important;;
        @else
            height: {{ $height }}px !important; max-height: none;
        @endif

        @if($width === 'auto')
            width: auto !important;
        @else
            width: {{ $width }}px !important; max-width: none;
        @endif

        @if(!empty($settings['opacity']))
            opacity: {{ $settings['opacity'] }}% !important;
        @endif
    }

    .navbar.sticky.fixed {
        animation: none!important;
    }
</style>
