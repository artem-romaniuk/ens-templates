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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ theme_asset('vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ theme_asset('css/laraberg.css') }}?ver=16">
    <link href="" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <!-- Template Main CSS File -->
    <link href="{{ theme_asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('site/css/site.css?var' . time()) }}" />

    <style>
        .button a {
            display: inline-block;
            background: #68A4C4;
            color: #fff;
            padding: 6px 20px;
            transition: 0.3s;
            font-size: 14px;
        }
        blockquote {
            overflow: hidden;
            background-color: #fafafa;
            padding: 60px;
            position: relative;
            text-align: center;
            margin: 20px 0;
        }
        blockquote::after {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background-color: #1e4356;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .event-short-description, .post-short-description {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .row-block {
            padding: 30px!important;
        }
    </style>

    @include('themes.' . current_theme() . '.layouts.includes.styles')
    @include('themes.' . current_theme() . '.layouts.includes.zoomStyles')
    @stack('styles')

    @if (! empty(settings('scripts.before_close_head')))
        {!! settings('scripts.before_close_head') !!}
    @endif

    <script>
        window.safeData = {
            csrfToken: '{{ csrf_token() }}',
            isAuth: '{{ auth()->check() }}',
            authToken: '{{ session('auth_token', '') }}',
            companyName: '{{ settings('company.name') }}'
        };
    </script>
</head>
<body>
@if (! empty(settings('scripts.after_open_body')))
    {!! settings('scripts.after_open_body') !!}
@endif

@if (($template_settings['header']['logo_position']['value'] ?? '') == 'under_menu' && ! empty($template_settings['header']['logo_position']['apply']))
    <header id="header" style="height: auto;" class="fixed-top">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    @if (($template_settings['header']['logo_position']['value'] ?? '') == 'under_menu' && ! empty($template_settings['header']['logo_position']['apply']))
                        @if (! empty(settings('company.logo.' . settings('logo_positions.header'))))
                            <a href="{{ route('home') }}" class="navbar-brand">
                                <img
                                    class="mt-2 pb-2"
                                    src="{{ settings('company.logo.' . settings('logo_positions.header')) }}"
                                    alt="{{ settings('company.name') }}"
                                    style="
                                        height: 50px;
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
                        <div class="social-links mt-3 d-flex justify-content-between">
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

        <div class="container">
            @php($align = ! empty($template_settings['header']['menu_position']['apply']) ? ($template_settings['header']['menu_position']['value'] ?? 'center') : 'center')
            <x-menu-component layout="main" :align="$align" />
        </div>
    </header>
@else
    <header id="header" class="fixed-top d-flex align-items-center ">
        <div class="container d-flex justify-content-between align-items-center">
            @if (! empty(settings('company.logo.' . settings('logo_positions.header'))))
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img
                            class="mt-2 pb-2"
                            src="{{ settings('company.logo.' . settings('logo_positions.header')) }}"
                            alt="{{ settings('company.name') }}" class="img-fluid"
                            style="
                                height: 50px;
                                @if(! empty(settings('logo_settings.header.height')) && settings('logo_settings.header.height') != 'auto') height: {{ settings('logo_settings.header.height') }}px !important; max-height: none; @endif
                                @if(! empty(settings('logo_settings.header.width')) && settings('logo_settings.header.width') != 'auto') width: {{ settings('logo_settings.header.width') }}px !important; max-width: none; @endif
                                @if(! empty(settings('logo_settings.header.opacity'))) opacity: {{ settings('logo_settings.header.opacity') }}%; @endif
                            "
                        >
                    </a>
                </div>
            @endif

            <div class="container-fluid">
                @php($align = ! empty($template_settings['header']['menu_position']['apply']) ? ($template_settings['header']['menu_position']['value'] ?? 'center') : 'center')
                <x-menu-component layout="main" :align="$align" />
            </div>
        </div>
    </header>
@endif

<div id="content">
    @yield('content')
</div>

<footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-info">
                    <h3>{{ settings('company.name') }}</h3>
                    <p>{{ settings('company.description') }}</p>

                    @if (! empty(settings('social_links')))
                        <div class="social-links mt-3 d-flex justify-content-between">
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

    <div class="container">
        <div class="copyright">
            Copyright {{ now()->year }} by <strong><span>{{ settings('company.name') }}</span></strong>. All Rights Reserved.
        </div>
        <div class="copyright">
            Powered by <a class="footer-link" href="https://easynetsites.com/">EasyNetSites</a> Webware
        </div>
    </div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script src="{{ asset('site/js/site.js?var' . time()) }}"></script>

<!-- Vendor JS Files -->
<script src="{{ theme_asset('vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ theme_asset('vendor/aos/aos.js') }}"></script>
<script src="{{ theme_asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ theme_asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ theme_asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ theme_asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ theme_asset('vendor/waypoints/noframework.waypoints.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ theme_asset('js/main.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    Fancybox.bind("[data-fancybox]");
</script>

<script>
    window.addEventListener("load", (event) => {
        const header = document.querySelector("#header");
        const main = document.querySelector("#main");
        const hero = document.querySelector("#hero");

        if (hero) {
            hero.style['margin-top'] = `${header.offsetHeight}px`
        } else {
            main.style['margin-top'] = `${header.offsetHeight}px`
        }
    });
</script>

@stack('scripts')

@if (! empty(settings('scripts.before_close_body')))
    {!! settings('scripts.before_close_body') !!}
@endif
</body>
</html>
