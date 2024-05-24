@php $settings = settings('logo_settings.header'); @endphp

@php $height = $settings['height'] @endphp
@php $height = ($height === null || $height === 'auto') ? 200 : $height; @endphp

@php $width = $settings['width'] ?? 'auto' @endphp

@php
$paddingTop = $height;
switch ($height) {
    case 50:
        $paddingTop += 68;
        $paddingTop768 = $paddingTop + 8;
        $paddingTop992 = $paddingTop;
        $paddingTop1200 = $paddingTop992 - 42;
    break;
    case 100:
    case 150:
    case 200:
    case 250:
        $paddingTop += 68;
        $paddingTop768 = $paddingTop;
        $paddingTop992 = $paddingTop + 68 - 100;
        $paddingTop1200 = $paddingTop992 - 42 - 10;
    break;
}
@endphp

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
        padding-top: {{ $paddingTop }}px !important;
    }

    @media (min-width: 300px) {
        #content {
            padding-top: {{ $paddingTop }}px !important;
        }
    }
    @media (min-width: 575px) {
        #content {
            padding-top: {{ $paddingTop }}px !important;
        }
    }
    @media (min-width: 768px) {
        #content {
            padding-top: {{ $paddingTop768 }}px !important;
        }
    }
    @media (min-width: 992px) {
        #content {
            padding-top: {{ $paddingTop992 }}px !important;
        }
    }
    @media (min-width: 1200px) {
        #content {
            padding-top: {{ $paddingTop1200 }}px !important;
        }
    }
</style>
