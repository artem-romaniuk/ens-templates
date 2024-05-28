@php $settings = settings('logo_settings.header'); @endphp

@php $height = $settings['height'] ?? null @endphp
@php $height = ($height === null || $height === 'auto') ? 58 : $height; @endphp

@php $width = $settings['width'] ?? 'auto' @endphp

@php
$paddingTop = $height;
switch ($height) {
    case 50:
        $paddingTop += 68;
        $paddingTop992 = $paddingTop - 41;
        $paddingTop1200 = $paddingTop992 - 3;
    break;
    case 58:
        $paddingTop += 68;
        $paddingTop992 = $paddingTop - 49;
        $paddingTop1200 = $paddingTop992 - 3;
    break;
    case 100:
    case 150:
    case 250:
    case 200:
        $paddingTop += 68;
        $paddingTop992 = $paddingTop - 81;
        $paddingTop1200 = $paddingTop992 - 3;
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
            padding-top: {{ $paddingTop }}px !important;
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
