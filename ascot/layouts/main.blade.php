<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>{{ config('app.name', '') }}</title>
    @if (! empty(settings('favicon.url')))
        <link rel="icon" href="{{ settings('favicon.url') }}" type="image/x-icon">
    @endif

    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/bootstrap.min.css') }}">
    <link href="{{ theme_asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ theme_asset('css/tooplate.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <link rel="stylesheet" href="{{ theme_asset('css/laraberg.css') }}?ver=16">

    <link rel="stylesheet" href="{{ asset('site/css/site.css?var' . time()) }}" />

    <style>
        .ordered-list, .unordered-list {
            margin-left: 30px;
        }
        .ordered-list li {
            list-style: decimal;
        }
        .unordered-list li {
            list-style: initial;
        }
        .editor-blockquote {
            overflow: hidden;
            background-color: rgba(27, 47, 69, 0.06);
            padding: 40px;
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
            background-color: #000b16;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            font-size: 14px;
            padding: 12px 18px;
            background-color: #343a3e;
            color: #fff;
            text-align: center;
            font-weight: 500;
            text-transform: capitalize;
            transition: all .3s;
        }
        .button:hover {
            opacity: 0.9;
            color: #fff;
        }
        .rent-venue-application .contact-form select {
            color: #7a7a7a;
            font-size: 13px;
            border: 1px solid #ddd;
            background-color: #fff;
            width: 100%;
            height: 40px;
            outline: none;
            line-height: 40px;
            padding: 0px 10px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin-bottom: 30px;
        }
        .error-message {
            color: #df1529;
            text-align: left;
            padding: 15px 15px 0 15px;
            font-weight: 600;
        }
        .error-message p {
            color: #df1529!important;
            font-weight: 600!important;
        }
        .sent-message {
            color: #059652;
            text-align: center;
            padding: 15px 15px 0 15px;
            font-weight: 600;
        }
        .sent-message p {
            color: #059652!important;
            font-weight: 600!important;
        }
        .post-thumb {
            position: relative;
            display: block;
            width: 100%;
            height: 250px;
            overflow: hidden;
        }
        .event-short-description, .post-short-description {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            height: 80px;
        }
        .entry-title {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .entry-title a:hover {
            opacity: 0.9;
        }
        .event-location {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .sidebar input {
            color: #7a7a7a;
            font-size: 13px;
            border: 1px solid #ddd;
            background-color: #fff;
            width: 100%;
            height: 40px;
            outline: none;
            line-height: 40px;
            padding: 0px 10px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin-bottom: 30px;
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

<div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>

@if (($template_settings['header']['logo_position']['value'] ?? '') == 'under_menu' && ! empty($template_settings['header']['logo_position']['apply']))
    <header id="header" style="height: auto; padding-bottom: 10px;" class="fixed-top bg-white">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    @if (($template_settings['header']['logo_position']['value'] ?? '') == 'under_menu' && ! empty($template_settings['header']['logo_position']['apply']))
                        @if (! empty(settings('company.logo.' . settings('logo_positions.header'))))
                            <a href="{{ route('home') }}" class="navbar-brand">
                                <img
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
                        <div class="social-links">
                            <ul>
                                @foreach(settings('social_links', []) as $item)
                                    @continue((empty($item['icon']['dark']) && empty($item['icon']['light'])) || (isset($item['active']) && ! $item['active']))
                                    <li>
                                        <a href="{{ $item['link'] ?? '#' }}" title="{{ $item['name'] ?? '' }}" target="_blank" style="display: flex; justify-content: center; align-items: center;">
                                            <img src="{{ $item['icon']['light'] ?? $item['icon']['dark'] }}" height="17" alt="{{ $item['name'] ?? '' }}" />
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
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
    <header id="header" class="fixed-top bg-white" style="padding-bottom: 10px;">
        <div class="container">
            <div class="d-flex justify-content-end align-items-center">
                <div class="col-auto pt-2">
                    @if (! empty(settings('social_links')))
                        <div class="social-links">
                            <ul>
                                @foreach(settings('social_links', []) as $item)
                                    @continue((empty($item['icon']['dark']) && empty($item['icon']['light'])) || (isset($item['active']) && ! $item['active']))
                                    <li>
                                        <a href="{{ $item['link'] ?? '#' }}" title="{{ $item['name'] ?? '' }}" target="_blank" style="display: flex; justify-content: center; align-items: center;">
                                            <img src="{{ $item['icon']['light'] ?? $item['icon']['dark'] }}" height="17" alt="{{ $item['name'] ?? '' }}" />
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="container d-flex justify-content-between align-items-center">
            @if (! empty(settings('company.logo.' . settings('logo_positions.header'))))
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img
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

<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="address">
                    <h4>{{ settings('company.name') }}</h4>
                    <span>{{ settings('company.description') }}</span>
                </div>
            </div>

            <x-menu-component layout="footer" />

            <div class="col-lg-12">
                <div class="under-footer">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <p>{{ implode(', ', array_filter([settings('company.address_1'), settings('company.address_2'), settings('company.city'), settings('company.state'), settings('company.country')])) }}</p>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <p class="copyright">Copyright <span id="displayYear"> {{ now()->year }} by {{ settings('company.name') }}</span>.</p>
                            <p class="copyright">All Rights Reserved.</p>
                            <p class="copyright">Powered by <a class="footer-link" href="https://easynetsites.com/">EasyNetSites</a> Webware</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sub-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            @if (! empty(settings('company.logo.' . settings('logo_positions.footer'))))
                                <img
                                    class="logo-main"
                                    src="{{ settings('company.logo.' . settings('logo_positions.footer')) }}"
                                    alt="{{ settings('company.name') }}"
                                    style="
                                        @if(! empty(settings('logo_settings.footer.height')) && settings('logo_settings.footer.height') != 'auto') height: {{ settings('logo_settings.footer.height') }}px !important; max-height: none; @endif
                                        @if(! empty(settings('logo_settings.footer.width')) && settings('logo_settings.footer.width') != 'auto') width: {{ settings('logo_settings.footer.width') }}px !important; max-width: none; @endif
                                        @if(! empty(settings('logo_settings.footer.opacity'))) opacity: {{ settings('logo_settings.footer.opacity') }}%; @endif
                                    "
                                />
                            @endif
                        </div>
                        <div class="col-lg-6">
                            @if (! empty(settings('social_links')))
                                <div class="social-links">
                                    <ul>
                                        @foreach(settings('social_links', []) as $item)
                                            @continue((empty($item['icon']['dark']) && empty($item['icon']['light'])) || (isset($item['active']) && ! $item['active']))
                                            <li>
                                                <a href="{{ $item['link'] ?? '#' }}" title="{{ $item['name'] ?? '' }}" target="_blank" style="display: flex; justify-content: center; align-items: center;">
                                                    <img src="{{ $item['icon']['light'] ?? $item['icon']['dark'] }}" height="17" alt="{{ $item['name'] ?? '' }}" />
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('site/js/site.js?var' . time()) }}"></script>

<script src="{{ theme_asset('js/jquery-2.1.0.min.js') }}"></script>

<script src="{{ theme_asset('js/popper.js') }}"></script>
<script src="{{ theme_asset('js/bootstrap.min.js') }}"></script>

<script src="{{ theme_asset('js/scrollreveal.min.js') }}"></script>
<script src="{{ theme_asset('js/waypoints.min.js') }}"></script>
<script src="{{ theme_asset('js/jquery.counterup.min.js') }}"></script>
<script src="{{ theme_asset('js/imgfix.min.js') }}"></script>
<script src="{{ theme_asset('js/mixitup.js') }}"></script>
<script src="{{ theme_asset('js/accordions.js') }}"></script>
<script src="{{ theme_asset('js/owl-carousel.js') }}"></script>

<script src="{{ theme_asset('js/custom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    Fancybox.bind("[data-fancybox]");
</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const header = document.getElementById("header");
        const content = document.getElementById("content");
        content.style['margin-top'] = `${header.offsetHeight}px`
    });
</script>

@stack('scripts')

@if (! empty(settings('scripts.before_close_body')))
    {!! settings('scripts.before_close_body') !!}
@endif
</body>
</html>
