<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>{{ config('app.name', '') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    @if (! empty(settings('favicon.url')))
    	<!-- Favicon -->
        <link rel="icon" href="{{ settings('favicon.url') }}" type="image/x-icon">
    @endif

    <!-- Font CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <!-- Vendor CSS (Bootstrap & Icon Font) -->
    <link rel="stylesheet" href="{{ theme_asset('css/vendor/bootstrap.min.css') }}">
    <!-- Plugins CSS (All Plugins Files) -->
    <link rel="stylesheet" href="{{ theme_asset('css/plugins/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ theme_asset('css/plugins/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ theme_asset('css/plugins/fancybox.min.css') }}">

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ theme_asset('css/style.min.css?ver=' . time()) }}">
    <link rel="stylesheet" href="{{ theme_asset('css/laraberg.css') }}?ver=16">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <link rel="stylesheet" href="{{ asset('site/css/site.css?var' . time()) }}" />

@include('themes.' . current_theme() . '.layouts.includes.styles')
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

<div class="wrapper">
<header class="header-wrapper">
<div class="header-top d-none d-xl-flex">
    <div class="container-fluid header-container-fluid">
        <div class="row justify-content-between align-items-center">
            @if (($template_settings['header']['menu_position']['value'] ?? '') == 'burger' && ! empty($template_settings['header']['menu_position']['apply']))
                <div class="col-auto">
                    @if (($template_settings['header']['logo_position']['value'] ?? '') == 'under_menu' && ! empty($template_settings['header']['logo_position']['apply']))
                        @if (! empty(settings('company.logo.' . settings('logo_positions.header'))))
                            <div class="header-logo">
                                <a href="{{ route('home') }}">
                                    <img
                                        class="logo-main"
                                        src="{{ settings('company.logo.' . settings('logo_positions.header')) }}"
                                        alt="{{ settings('company.name') }}"
                                        style="
                                            @if(! empty(settings('.header.height')) && settings('logo_settings.header.height') != 'auto') height: {{ settings('logo_settings.header.height') }}px !important; max-height: none; @endif
                                            @if(! empty(settings('logo_settings.header.width')) && settings('logo_settings.header.width') != 'auto') width: {{ settings('logo_settings.header.width') }}px !important; max-width: none; @endif
                                            @if(! empty(settings('logo_settings.header.opacity'))) opacity: {{ settings('logo_settings.header.opacity') }}%; @endif
                                        "
                                    />
                                </a>
                            </div>
                        @endif
                    @endif
                </div>
                <div class="col-auto">
                    <button class="btn-menu d-flex ml-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasMenu" aria-controls="AsideOffcanvasMenu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            @else
                <div class="col-auto">
                    @if (($template_settings['header']['logo_position']['value'] ?? '') == 'under_menu' && ! empty($template_settings['header']['logo_position']['apply']))
                        @if (! empty(settings('company.logo.' . settings('logo_positions.header'))))
                            <div class="header-logo">
                                <a href="{{ route('home') }}">
                                    <img
                                        class="logo-main"
                                        src="{{ settings('company.logo.' . settings('logo_positions.header')) }}"
                                        alt="{{ settings('company.name') }}"
                                        style="
                                            @if(! empty(settings('logo_settings.header.height')) && settings('logo_settings.header.height') != 'auto') height: {{ settings('logo_settings.header.height') }}px !important; max-height: none; @endif
                                            @if(! empty(settings('logo_settings.header.width')) && settings('logo_settings.header.width') != 'auto') width: {{ settings('logo_settings.header.width') }}px !important; max-width: none; @endif
                                            @if(! empty(settings('logo_settings.header.opacity'))) opacity: {{ settings('logo_settings.header.opacity') }}%; @endif
                                        "
                                    />
                                </a>
                            </div>
                        @endif
                    @endif
                </div>
                <div class="col-auto">
                    @if (! empty(settings('social_links')))
                        <ul class="header-top-info-list">
                            @foreach(settings('social_links', []) as $item)
                                @continue((empty($item['icon']['dark']) && empty($item['icon']['light'])) || isset($item['active']) && ! $item['active'])
                                <li class="mx-1">
                                    <a href="{{ $item['link'] ?? '#' }}" title="{{ $item['name'] ?? '' }}" target="_blank">
                                        <img src="{{ $item['icon']['dark'] ?? $item['icon']['light'] }}" width="28" alt="{{ $item['name'] ?? '' }}" />
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<div class="header-bottom sticky-header sticky sticky-show">
    <div class="container-fluid header-container-fluid py-2">
        <div class="row justify-content-between align-items-center">
            @if (
                ($template_settings['header']['logo_position']['value'] ?? '') == 'inline_menu' || empty($template_settings['header']['logo_position']['apply'])
                && (($template_settings['header']['menu_position']['value'] ?? '') != 'burger' || empty($template_settings['header']['logo_position']['apply']))
            )
                <div class="col-auto">
                    @if (! empty(settings('company.logo.' . settings('logo_positions.header'))))
                        <div class="header-logo">
                            <a href="{{ route('home') }}">
                                <img
                                    class="logo-main"
                                    src="{{ settings('company.logo.' . settings('logo_positions.header')) }}"
                                    alt="{{ settings('company.name') }}"
                                    style="
                                        @if(! empty(settings('logo_settings.header.height')) && settings('logo_settings.header.height') != 'auto') height: {{ settings('logo_settings.header.height') }}px !important; max-height: none; @endif
                                        @if(! empty(settings('logo_settings.header.width')) && settings('logo_settings.header.width') != 'auto') width: {{ settings('logo_settings.header.width') }}px !important; max-width: none; @endif
                                        @if(! empty(settings('logo_settings.header.opacity'))) opacity: {{ settings('logo_settings.header.opacity') }}%; @endif
                                    "
                                />
                            </a>
                        </div>
                    @endif
                </div>

            @elseif (($template_settings['header']['logo_position']['value'] ?? '') != 'inline_menu' || ($template_settings['header']['menu_position']['value'] ?? '') == 'burger')
                <div class="col-auto d-block d-xl-none">
                    @if (! empty(settings('company.logo.' . settings('logo_positions.header'))))
                        <div class="header-logo">
                            <a href="{{ route('home') }}">
                                <img
                                    class="logo-main"
                                    src="{{ settings('company.logo.' . settings('logo_positions.header')) }}"
                                    alt="{{ settings('company.name') }}"
                                    style="
                                        @if(! empty(settings('logo_settings.header.height')) && settings('logo_settings.header.height') != 'auto') height: {{ settings('logo_settings.header.height') }}px !important; max-height: none; @endif
                                        @if(! empty(settings('logo_settings.header.width')) && settings('logo_settings.header.width') != 'auto') width: {{ settings('logo_settings.header.width') }}px !important; max-width: none; @endif
                                        @if(! empty(settings('logo_settings.header.opacity'))) opacity: {{ settings('logo_settings.header.opacity') }}%; @endif
                                    "
                                />
                            </a>
                        </div>
                    @endif
                </div>
            @endif

            <div class="col-auto d-none d-md-block flex-grow-1">
                @php($align = ! empty($template_settings['header']['menu_position']['apply']) ? ($template_settings['header']['menu_position']['value'] ?? 'center') : 'center')
                @if (($template_settings['header']['menu_position']['value'] ?? '') != 'burger' || empty($template_settings['header']['menu_position']['apply']))
                <x-menu-component layout="main" :align="$align" />
                @endif
            </div>
            <div class="col-auto d-flex align-items-center gap-6 gap-xl-0">
                <button class="btn-menu d-flex ml-4 d-md-none d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasMenu" aria-controls="AsideOffcanvasMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </div>
</div>
</header>

<div id="content">
    <div style="
    @if( empty(settings('logo_settings.header.height')) || settings('logo_settings.header.height') == 'auto') padding-top: '0%'; @endif
    @if(  settings('logo_settings.header.height') == 50) padding-top: '0%'; @endif
    @if(  settings('logo_settings.header.height') == 100) padding-top: '3.5%'; @endif
    @if(  settings('logo_settings.header.height') == 150) padding-top: '6%'; @endif
    @if(  settings('logo_settings.header.height') == 200) padding-top: '8%'; @endif
    @if(  settings('logo_settings.header.height') == 250) padding-top: '10%'; @endif
    ">
        @yield('content')
    </div>
</div>

<footer class="footer-section section" style="margin-top: 80px">
<div class="footer-main section-padding bg-img" style="padding: 30px 0 10px 0;">
    <div class="container mb-n3">
        <div class="row align-items-start">
            <div class="col-md-8 col-lg-4 mb-8 mb-md-0">
                <div class="footer-widget text-center text-md-start">
                    @if (! empty(settings('company.logo.' . settings('logo_positions.footer'))))
                        <a href="{{ route('home') }}" class="footer-widget-logo me-auto me-md-0 ms-auto ms-md-0">
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
                        </a>
                    @endif

                    <p class="footer-widget-desc me-auto me-md-0 ms-auto ms-md-0">{{ settings('company.description') }}</p>
                </div>
            </div>

            <div class="col-md-4 col-lg-5">
                <div class="footer-widget">
                    <x-menu-component layout="footer" />
                </div>
            </div>

            <div class="col-lg-3 ps-3 ps-xl-10 mt-8 mt-lg-0">
                @if (! empty(settings('social_links')))
                    <div class="footer-widget">
                        <h4 class="footer-widget-title mb-3 mb-xl-2 pb-1">Social links</h4>
                        <h4 class="collapsed-title collapsed" data-bs-toggle="collapse" data-bs-target="#dividerId-3" aria-expanded="false">Social links</h4>
                        <div id="dividerId-3" class="widget-collapse-body collapse px-3  px-xl-0">
                            <ul class="d-flex">
                                @foreach(settings('social_links', []) as $item)
                                    @continue((empty($item['icon']['dark']) && empty($item['icon']['light'])) || (isset($item['active']) && ! $item['active']))
                                    <li class="mx-1">
                                        <a href="{{ $item['link'] ?? '#' }}" title="{{ $item['name'] ?? '' }}" target="_blank">
                                            <img src="{{ $item['icon']['light'] ?? $item['icon']['dark'] }}" width="28" alt="{{ $item['name'] ?? '' }}" />
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="footer-bottom">
    <div class="container">
        <div class="row flex-row-reverse flex-md-row">
            <div class="col-md-6 text-center text-md-start">
                <p class="footer-copyright">Copyright {{ now()->year }} by {{ settings('company.name') }}. All rights reserved.</p>
                <p class="footer-copyright">Powered by <a class="footer-link" href="https://easynetsites.com/">EasyNetSites</a> Webware</p>
            </div>
{{--                    <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">--}}
{{--                        <p class="footer-payment-info">Payment System: <a href="my-account.html"><img src="assets/images/photos/payment-card.png" width="147" height="31" alt="Image"></a></p>--}}
{{--                    </div>--}}
        </div>
    </div>
</div>
</footer>

<div id="scroll-to-top" class="scroll-to-top"><span class="icofont-rounded-up"></span></div>

<aside class="off-canvas-wrapper offcanvas offcanvas-start" tabindex="-1" id="AsideOffcanvasMenu" aria-labelledby="offcanvasExampleLabel">
<div class="offcanvas-header">
    <h6 class="d-none" id="offcanvasExampleLabel">Aside Menu</h6>
    <button class="btn-menu-close" data-bs-dismiss="offcanvas" aria-label="Close">menu <i class="icofont-rounded-left"></i></button>
</div>

<div class="offcanvas-body">
    <div class="mobile-menu-action">
        <x-menu-component layout="main" side="true" />

        @if (! empty(settings('social_links')))
            <ul class="mobile-menu-info-list d-flex mx-3">
                @foreach(settings('social_links', []) as $item)
                    @continue((empty($item['icon']['dark']) && empty($item['icon']['light'])) || isset($item['active']) && ! $item['active'])
                    <li class="mx-1 px-0">
                        <a href="{{ $item['link'] ?? '#' }}" title="{{ $item['name'] ?? '' }}" target="_blank">
                            <img src="{{ $item['icon']['light'] ?? $item['icon']['dark'] }}" width="28" alt="{{ $item['name'] ?? '' }}" />
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
</aside>
</div>

<script src="{{ asset('site/js/site.js?var' . time()) }}"></script>

<script src="{{ theme_asset('js/vendor/modernizr-3.11.7.min.js') }}"></script>
<script src="{{ theme_asset('js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{ theme_asset('js/vendor/jquery-migrate-3.3.2.min.js') }}"></script>
<script src="{{ theme_asset('js/vendor/bootstrap.bundle.min.js') }}"></script>

<script src="{{ theme_asset('js/plugins/swiper-bundle.min.js') }}"></script>
<script src="{{ theme_asset('js/plugins/svg-inject.min.js') }}"></script>
<script src="{{ theme_asset('js/plugins/fancybox.min.js') }}"></script>

<script src="{{ theme_asset('js/main.js?ver=' . time()) }}"></script>

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    Fancybox.bind("[data-fancybox]");
</script>

@stack('scripts')

@if (! empty(settings('scripts.before_close_body')))
    {!! settings('scripts.before_close_body') !!}
@endif
</body>
</html>
