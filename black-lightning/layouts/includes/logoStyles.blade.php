@php $settings = settings('logo_settings.header'); @endphp
@php /** @var array $template_settings */@endphp

@php $height = $settings['height'] ?? 'auto' @endphp
@php $width = $settings['width'] ?? 'auto' @endphp

@php
$paddingTop = 0;

$socialLinksEmpty = true;

foreach (settings('social_links') as $link) {
    if ($link['active']) {
        $socialLinksEmpty = false;
        break;
    }
}

$socialLinksHeight = $socialLinksEmpty ? 32 : 0;

switch ($height) {
    case 50:
        $paddingTop += 68;
        $paddingTop768 = $paddingTop + 8;
        $paddingTop992 = $paddingTop;
        $paddingTop1200 = $paddingTop992 - 42 + $socialLinksHeight;
    break;
    case 100:
    case 150:
    case 200:
    case 250:
        $paddingTop += 68;
        $paddingTop768 = $paddingTop;
        $paddingTop992 = $paddingTop + 68 - 100;
        $paddingTop1200 = $paddingTop992 - 52 + $socialLinksHeight;
    break;
    case 'auto':
        $paddingTop = 68;
        $paddingTop768 = $paddingTop;
        $paddingTop992 = $paddingTop + 68 - 100;
        $paddingTop1200 = $paddingTop992 - 52 + $socialLinksHeight;
}
@endphp

@php
$needPadding = '#content';
$logoUnderMenu = ($template_settings['header']['logo_position']['value'] ?? '') == 'under_menu'
    && !empty($template_settings['header']['logo_position']['apply']);
if ($logoUnderMenu) {
    $needPadding = '.header-top';
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

    {{ $needPadding }} {
        padding-top: {{ $paddingTop }}px !important;
    }

    @media (min-width: 300px) {
        {{ $needPadding }} {
            padding-top: {{ $paddingTop }}px !important;
        }
    }
    @media (min-width: 575px) {
        {{ $needPadding }} {
            padding-top: {{ $paddingTop }}px !important;
        }
    }
    @media (min-width: 768px) {
        {{ $needPadding }} {
            padding-top: {{ $paddingTop768 }}px !important;
        }
    }
    @media (min-width: 992px) {
        {{ $needPadding }} {
            padding-top: {{ $paddingTop992 }}px !important;
        }
    }
    @media (min-width: 1200px) {
        {{ $needPadding }} {
            padding-top: {{ $paddingTop1200 }}px !important;
        }
    }
</style>
