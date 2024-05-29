<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name', '') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if (! empty(settings('favicon.url')))
    	<!-- Favicon -->
        <link rel="icon" href="{{ settings('favicon.url') }}" type="image/x-icon">
    @endif

    <link rel="stylesheet" href="{{ theme_asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ theme_asset('css/laraberg.css') }}?ver=16">
    <link rel="stylesheet" href="{{ theme_asset('css/templatemo.css') }}?v=1">
    <link rel="stylesheet" href="{{ theme_asset('css/custom.css') }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="{{ theme_asset('css/fontawesome.min.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <link rel="stylesheet" href="{{ asset('site/css/site.css?var' . time()) }}" />

    <style>
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
            background-color: #59ab6e;
            margin-top: 20px;
            margin-bottom: 20px;
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
            display: block;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .event-location {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
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
        .list-unstyled a {
            color: #000;
        }
        .undecoration-link {
            color: #000!important;
            text-decoration: none!important;
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
<body class="@yield('body_class')">
@if (! empty(settings('scripts.after_open_body')))
    {!! settings('scripts.after_open_body') !!}
@endif

    @php($align = ! empty($template_settings['header']['menu_position']['apply']) ? ($template_settings['header']['menu_position']['value'] ?? 'center') : 'center')
    @if (($template_settings['header']['logo_position']['value'] ?? '') == 'under_menu' && ! empty($template_settings['header']['logo_position']['apply']))
        <nav class="navbar @if($align != 'burger') navbar-expand-xl @endif bg-dark navbar-light" id="templatemo_nav_top">
            <div class="container text-light">
                <div class="w-100 d-flex justify-content-between flex-wrap">
                    <div class="d-flex align-items-center">
                        @if (! empty(settings('company.logo.' . settings('logo_positions.header'))))
                            <a href="{{ route('home') }}" class="navbar-brand text-success logo h1 align-self-center">
                                <img
                                    src="{{ settings('company.logo.' . settings('logo_positions.header')) }}"
                                    alt="{{ settings('company.name') }}"
                                    style="
                                        max-height: 50px; width: auto;
                                        @if(! empty(settings('logo_settings.header.height')) && settings('logo_settings.header.height') != 'auto') height: {{ settings('logo_settings.header.height') }}px !important; max-height: none; @endif
                                        @if(! empty(settings('logo_settings.header.width')) && settings('logo_settings.header.width') != 'auto') width: {{ settings('logo_settings.header.width') }}px !important; max-width: none; @endif
                                        @if(! empty(settings('logo_settings.header.opacity'))) opacity: {{ settings('logo_settings.header.opacity') }}%; @endif
                                    "
                                />
                            </a>
                        @endif
                    </div>
                    <div class="d-flex align-items-center px-2">
                        @if (! empty(settings('company.email')))
                            <i class="fa fa-envelope mx-2"></i>
                            <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:{{ settings('company.email') }}">{{ settings('company.email') }}</a>
                        @endif

                        @if (! empty(settings('company.phone')))
                            <i class="fa fa-phone mx-2"></i>
                            <a class="navbar-sm-brand text-light text-decoration-none" href="tel:{{ settings('company.phone') }}">{{ settings('company.phone') }}</a>
                        @endif
                    </div>

                        @if (! empty(settings('social_links')))
                            <ul class="list-inline text-left footer-icons m-0 d-flex align-items-center">
                                @foreach(settings('social_links', []) as $item)
                                    @continue((empty($item['icon']['dark']) && empty($item['icon']['light'])) || (isset($item['active']) && ! $item['active']))

                                    <li class="list-inline-item border border-light rounded-circle text-center">
                                        <a href="{{ $item['link'] ?? '#' }}" title="{{ $item['name'] ?? '' }}" class="text-light text-decoration-none" target="_blank" style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                            <img src="{{ $item['icon']['light'] ?? $item['icon']['dark'] }}" width="20" alt="{{ $item['name'] ?? '' }}" />
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                </div>
            </div>
        </nav>
        <nav class="navbar @if($align != 'burger') navbar-expand-xl @endif navbar-light shadow sticky-top" style="background-color: white;">
            <div class="container d-flex justify-content-end">
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="align-self-center collapse navbar-collapse flex-fill @if($align != 'burger') d-xl-flex @endif justify-content-xl-between" id="templatemo_main_nav">
                    <div class="flex-fill">
                        <x-menu-component layout="main" :align="$align" />
                    </div>
                </div>
            </div>
        </nav>
    @else
        <nav class="navbar @if($align != 'burger') navbar-expand-xl @endif bg-dark navbar-light d-none @if($align != 'burger') d-xl-block @endif" id="templatemo_nav_top">
            <div class="container text-light">
                <div class="w-100 d-flex justify-content-between">
                    <div>
                        @if (! empty(settings('company.email')))
                            <i class="fa fa-envelope mx-2"></i>
                            <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:{{ settings('company.email') }}">{{ settings('company.email') }}</a>
                        @endif

                        @if (! empty(settings('company.phone')))
                            <i class="fa fa-phone mx-2"></i>
                            <a class="navbar-sm-brand text-light text-decoration-none" href="tel:{{ settings('company.phone') }}">{{ settings('company.phone') }}</a>
                        @endif
                    </div>

                        @if (! empty(settings('social_links')))
                            <ul class="list-inline text-left footer-icons">
                                @foreach(settings('social_links', []) as $item)
                                    @continue((empty($item['icon']['dark']) && empty($item['icon']['light'])) || (isset($item['active']) && ! $item['active']))

                                    <li class="list-inline-item border border-light rounded-circle text-center">
                                        <a href="{{ $item['link'] ?? '#' }}" title="{{ $item['name'] ?? '' }}" class="text-light text-decoration-none" target="_blank" style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                            <img src="{{ $item['icon']['light'] ?? $item['icon']['dark'] }}" width="20" alt="{{ $item['name'] ?? '' }}" />
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                </div>
            </div>
        </nav>
        <nav class="navbar @if($align != 'burger') navbar-expand-xl @endif navbar-light shadow sticky-top" style="background-color: white;">
            <div class="container d-flex justify-content-between align-items-center">
                @if (! empty(settings('company.logo.' . settings('logo_positions.header'))))
                    <a href="{{ route('home') }}" class="navbar-brand text-success logo h1 align-self-center">
                        <img
                            src="{{ settings('company.logo.' . settings('logo_positions.header')) }}"
                            alt="{{ settings('company.name') }}"
                            style="
                                max-height: 50px; width: auto;
                                @if(! empty(settings('logo_settings.header.height')) && settings('logo_settings.header.height') != 'auto') height: {{ settings('logo_settings.header.height') }}px !important; max-height: none; @endif
                                @if(! empty(settings('logo_settings.header.width')) && settings('logo_settings.header.width') != 'auto') width: {{ settings('logo_settings.header.width') }}px !important; max-width: none; @endif
                                @if(! empty(settings('logo_settings.header.opacity'))) opacity: {{ settings('logo_settings.header.opacity') }}%; @endif
                            "
                        />
                    </a>
                @endif

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="align-self-center collapse navbar-collapse flex-fill @if($align != 'burger') d-xl-flex @endif justify-content-xl-between" id="templatemo_main_nav">
                    <div class="flex-fill">
                        @php($align = ! empty($template_settings['header']['menu_position']['apply']) ? ($template_settings['header']['menu_position']['value'] ?? 'center') : 'center')
                        <x-menu-component layout="main" :align="$align" />
                    </div>
                </div>
            </div>
        </nav>
    @endif

<div id="content">
@yield('content')
</div>

<footer class="@if (empty($template_colors['footer_background']['base'])) bg-dark @endif" id="tempaltemo_footer">
    <div class="container">
        <div class="row">

            <div class="col-md-4 pt-5">
                @if (! empty(settings('company.logo.' . settings('logo_positions.footer'))))
                    <div class="info_logo">
                        <a href="{{ route('home') }}" class="navbar-brand">
                            <img
                                src="{{ settings('company.logo.' . settings('logo_positions.footer')) }}"
                                alt="{{ settings('company.name') }}"
                                style="
                                    max-height: 50px; width: auto;
                                    @if(! empty(settings('logo_settings.footer.height')) && settings('logo_settings.footer.height') != 'auto') height: {{ settings('logo_settings.footer.height') }}px !important; max-height: none; @endif
                                    @if(! empty(settings('logo_settings.footer.width')) && settings('logo_settings.footer.width') != 'auto') width: {{ settings('logo_settings.footer.width') }}px !important; max-width: none; @endif
                                    @if(! empty(settings('logo_settings.footer.opacity'))) opacity: {{ settings('logo_settings.footer.opacity') }}%; @endif
                                "
                            />
                        </a>
                    </div>
                @endif

                <ul class="list-unstyled text-light footer-link-list">
                    <li>
                        <i class="fas fa-map-marker-alt fa-fw"></i>
                        {{ implode(', ', array_filter([settings('company.address_1'), settings('company.address_2'), settings('company.city'), settings('company.state'), settings('company.country')])) }}
                    </li>

                    @if (! empty(settings('company.phone')))
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none footer-link" href="tel:{{ settings('company.phone') }}">{{ settings('company.phone') }}</a>
                        </li>
                    @endif

                    @if (! empty(settings('company.email')))
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none footer-link" href="mailto:{{ settings('company.email') }}">{{ settings('company.email') }}</a>
                        </li>
                    @endif

                    <div class="mt-4">{{ settings('company.description') }}</div>
                </ul>
            </div>

            <x-menu-component layout="footer" />
        </div>

        <div class="row text-light mb-4">
            <div class="col-12 mb-3">
                <div class="w-100 my-3 border-top border-light"></div>
            </div>
            <div class="col-auto me-auto">
                @if (! empty(settings('social_links')))
                    <ul class="list-inline text-left footer-icons">
                        @foreach(settings('social_links', []) as $item)
                            @continue((empty($item['icon']['dark']) && empty($item['icon']['light'])) || (isset($item['active']) && ! $item['active']))

                            <li class="list-inline-item border border-light rounded-circle text-center">
                                <a href="{{ $item['link'] ?? '#' }}" title="{{ $item['name'] ?? '' }}" class="text-light text-decoration-none" target="_blank" style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                    <img src="{{ $item['icon']['light'] ?? $item['icon']['dark'] }}" width="28" alt="{{ $item['name'] ?? '' }}" />
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <div class="w-100 bg-black py-3 footer-bottom">
        <div class="container">
            <div class="row pt-2">
                <div class="col-12">
                    <p class="text-left text-light copyright">Copyright <span>{{ now()->year }} by {{ settings('company.name') }}</span>. All Rights Reserved.</p>
                    <p class="text-left text-light copyright">Powered by <a class="footer-link" href="https://easynetsites.com/">EasyNetSites</a> Webware</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('site/js/site.js?var' . time()) }}"></script>

<script src="{{ theme_asset('js/jquery-1.11.0.min.js') }}"></script>
<script src="{{ theme_asset('js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ theme_asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ theme_asset('js/templatemo.js') }}"></script>
<script src="{{ theme_asset('js/custom.js') }}"></script>
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
