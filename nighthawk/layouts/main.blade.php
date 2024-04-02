<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ config('app.name', '') }}</title>
    @if (! empty(settings('favicon.url')))
    	<!-- Favicon -->
        <link rel="icon" href="{{ settings('favicon.url') }}" type="image/x-icon">
    @endif

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ theme_asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ theme_asset('css/laraberg.css') }}?ver=16">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <link href="{{ theme_asset('css/main.css') }}" rel="stylesheet">

    <style>
        .event-short-description, .post-short-description {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .editor-blockquote {
            overflow: hidden;
            background-color: rgba(27, 47, 69, 0.06);
            padding: 60px;
            position: relative;
            text-align: center;
            margin: 20px 0;
        }
        .editor-blockquote:after {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background-color: var(--color-secondary);
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .editor-header {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 20px;
            position: relative;
        }
        .editor-header:after {
            content: "";
            position: absolute;
            display: block;
            width: 60px;
            height: 2px;
            background: var(--color-primary);
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
        }
        .row-block {
            padding: 30px;
        }
    </style>

    @include('themes.' . current_theme() . '.layouts.includes.styles')
    @stack('styles')
    
    @if (! empty(settings('scripts.before_close_head')))
        {!! settings('scripts.before_close_head') !!}
    @endif
</head>

<body class="@yield('body_class')">
@if (! empty(settings('scripts.after_open_body')))
    {!! settings('scripts.after_open_body') !!}
@endif

    @php($align = ! empty($template_settings['header']['menu_position']['apply']) ? ($template_settings['header']['menu_position']['value'] ?? 'center') : 'center')
    @if($align == 'burger') 
    <style>
        .mobile-nav-show {
            color: rgba(255, 255, 255, 0.9);
            font-size: 28px;
            cursor: pointer;
            line-height: 0;
            transition: 0.5s;
        }
        .mobile-nav-hide {
            color: rgba(255, 255, 255, 0.9);
            font-size: 32px;
            cursor: pointer;
            line-height: 0;
            transition: 0.5s;
            position: fixed;
            right: 15px;
            top: 15px;
            z-index: 9999;
        }
        .mobile-nav-show, .mobile-nav-hide {
            display: block;
        }
        .mobile-nav-active .navbar:before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(27, 47, 69, 0.7);
            z-index: 9996;
        }
        .navbar a, .navbar a:focus {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            font-family: var(--font-default);
            font-size: 15px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.7);
            white-space: nowrap;
            transition: 0.3s;
        }
        .navbar a:hover, .navbar .active, .navbar .active:focus, .navbar li:hover>a {
            color: #fff;
        }
        .navbar .dropdown>.dropdown-active, .navbar .dropdown .dropdown>.dropdown-active {
            display: block;
        }
        .navbar .dropdown ul, .navbar .dropdown .dropdown ul {
            position: static;
            display: none;
            padding: 10px 0;
            margin: 10px 20px;
            background-color: rgba(20, 35, 51, 0.6);
        }
        .navbar .dropdown ul {
            left: 0px; 
            top: 0px;
            z-index: 9998;
            opacity: 1;
            visibility: visible;
            background-color: rgba(20, 35, 51, 0.6);
            box-shadow: none;
            transition: 0.2s;
        }
        .navbar .dropdown ul a {
            color: rgba(255, 255, 255, 0.7);
        }
        .navbar .dropdown ul a:hover, .navbar .dropdown ul .active:hover, .navbar .dropdown ul li:hover>a {
            color: rgba(255, 255, 255, 0.7);
        }
    </style>
    @endif

@if (($template_settings['header']['logo_position']['value'] ?? '') == 'under_menu' && ! empty($template_settings['header']['logo_position']['apply']))
    <header id="header" class="header d-flex align-items-center fixed-top flex-column sticked" style="padding: 0;">
        <div style="width: 100%;">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        @if (($template_settings['header']['logo_position']['value'] ?? '') == 'under_menu' && ! empty($template_settings['header']['logo_position']['apply']))
                            @if (! empty(settings('company.logo.' . settings('logo_positions.header'))))
                                <a href="{{ route('home') }}" class="navbar-brand">
                                    <img 
                                        class="mt-2"
                                        src="{{ settings('company.logo.' . settings('logo_positions.header')) }}" 
                                        alt="{{ settings('company.name') }}"
                                        style="
                                            height: 75px; width: auto;
                                            @if(! empty(settings('logo_settings.header.height')) && settings('logo_settings.header.height') != 'auto') height: {{ settings('logo_settings.header.height') }}px !important; max-height: none; @endif
                                            @if(! empty(settings('logo_settings.header.width')) && settings('logo_settings.header.width') != 'auto') width: {{ settings('logo_settings.header.width') }}px !important; max-width: none; @endif
                                            @if(! empty(settings('logo_settings.header.opacity'))) opacity: {{ settings('logo_settings.header.opacity') }}%; @endif
                                        "
                                    >
                                </a>
                            @endif
                        @endif
                    </div>

                    <div class="col-auto">
                        @if (! empty(settings('social_links')))
                            <div class="social-links d-flex mt-3">
                                @foreach(settings('social_links', []) as $item)
                                    @continue((empty($item['icon']['dark']) && empty($item['icon']['light'])) || (isset($item['active']) && ! $item['active']))

                                    <a href="{{ $item['link'] ?? '#' }}" title="{{ $item['name'] ?? '' }}" target="_blank" style="display: flex; justify-content: center; align-items: center;">
                                        <img src="{{ $item['icon']['light'] ?? $item['icon']['dark'] }}" width="28" alt="{{ $item['name'] ?? '' }}" />
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div style="width: 100%;">
            <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
                <div style="width: 100%; display: flex;
                    @if ($align == 'left') justify-content: start;
                    @elseif ($align == 'right') justify-content: end;
                    @elseif($align == 'center') justify-content: center;
                    @endif">
                    <x-menu-component layout="main" :align="$align" />
                </div>
    
                <div style="display: flex; justify-content: end;">
                    <i style="font-size: 36px;" class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
                    <i style="font-size: 36px;" class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
                </div>
            </div>
        </div>
    </header>
@else
    <header id="header" class="header d-flex align-items-center fixed-top sticked">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            @if (! empty(settings('company.logo.' . settings('logo_positions.header'))))
                <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                    <img 
                        src="{{ settings('company.logo.' . settings('logo_positions.header')) }}" 
                        alt="{{ settings('company.name') }}" 
                        class="img-fluid"
                        style="
                            height: 75px; width: auto;
                            @if(! empty(settings('logo_settings.header.height')) && settings('logo_settings.header.height') != 'auto') height: {{ settings('logo_settings.header.height') }}px !important; max-height: none; @endif
                            @if(! empty(settings('logo_settings.header.width')) && settings('logo_settings.header.width') != 'auto') width: {{ settings('logo_settings.header.width') }}px !important; max-width: none; @endif
                            @if(! empty(settings('logo_settings.header.opacity'))) opacity: {{ settings('logo_settings.header.opacity') }}%; @endif
                        "
                    >
                </a>
            @endif

            <div style="width: 100%; display: flex;
                @if ($align == 'left') justify-content: start;
                @elseif ($align == 'right') justify-content: end;
                @elseif($align == 'center') justify-content: center;
                @endif">
                <x-menu-component layout="main" :align="$align" />
            </div>

            
            <div style="display: flex; justify-content: end;">
                <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
                <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            </div>
        </div>
    </header>
@endif

@yield('content')

<footer id="footer" class="footer">
    <div class="footer-content">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="{{ route('home') }}" class="logo d-flex align-items-center" style="line-height: 30px;">
                        <span>{{ settings('company.name') }}</span>
                    </a>
                    <p>{{ settings('company.description') }}</p>
                    @if (! empty(settings('social_links')))
                        <div class="social-links d-flex mt-3">
                            @foreach(settings('social_links', []) as $item)
                                @continue((empty($item['icon']['dark']) && empty($item['icon']['light'])) || (isset($item['active']) && ! $item['active']))

                                <a href="{{ $item['link'] ?? '#' }}" title="{{ $item['name'] ?? '' }}" target="_blank" style="display: flex; justify-content: center; align-items: center;">
                                    <img src="{{ $item['icon']['light'] ?? $item['icon']['dark'] }}" width="28" alt="{{ $item['name'] ?? '' }}" />
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                <x-menu-component layout="footer" />
            </div>
        </div>
    </div>

    <div class="footer-legal">
        <div class="container">
            <div class="copyright">
                Copyright {{ now()->year }} by <strong><span>{{ settings('company.name') }}</span></strong>. All Rights Reserved.
            </div>
            <div class="copyright">
                Powered by <a class="footer-link" href="https://easynetsites.com/">EasyNetSites</a> Webware
            </div>
        </div>
    </div>
</footer>

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader"></div>

<script src="{{ theme_asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ theme_asset('vendor/aos/aos.js') }}"></script>
<script src="{{ theme_asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ theme_asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ theme_asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ theme_asset('vendor/php-email-form/validate.js') }}"></script>

<script src="{{ theme_asset('js/main.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    Fancybox.bind("[data-fancybox]");
</script>

<script>
    window.addEventListener("load", (event) => {
        function updateMarginTop() {
            const header = document.querySelector("#header");
            const main = document.querySelector("#main");
            const hero = document.querySelector(".main-slider");

            if (hero) {
                hero.style['margin-top'] = `${header.offsetHeight}px`
            } else {
                main.style['margin-top'] = `${header.offsetHeight}px`
            }
        }

        updateMarginTop()

        addEventListener("resize", (event) => {
            updateMarginTop()
        });
    });
</script>

@stack('scripts')

@if (! empty(settings('scripts.before_close_body')))
    {!! settings('scripts.before_close_body') !!}
@endif
</body>
</html>
