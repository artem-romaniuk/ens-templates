<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>{{ config('app.name', '') }}</title>

    @if (! empty(settings('favicon.url')))
    	<!-- Favicon -->
        <link rel="icon" href="{{ settings('favicon.url') }}" type="image/x-icon">
    @endif

    <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/bootstrap.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link href="{{ theme_asset('css/font-awesome.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ theme_asset('css/laraberg.css') }}?ver=16">
    <link href="{{ theme_asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ theme_asset('css/responsive.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <link rel="stylesheet" href="{{ asset('site/css/site.css?var' . time()) }}" />

    <style>
        .cta-btn {
            padding: 10px 45px;
            background-color: #f07b26;
            color: #ffffff;
            border-radius: 0px;
            -webkit-transition: all .3s;
            transition: all .3s;
            border: none;
            margin-top: 15px;
        }
        .cta-btn:hover, .cta-btn:focus {
            background-color: #bc570d;
            color: #ffffff;
        }
        .contact_section .form_container select, .contact_section .form_container textarea {
            width: 100%;
            border: none;
            height: 50px;
            margin-bottom: 25px;
            padding-left: 15px;
            outline: none;
            color: #101010;
            -webkit-box-shadow: 0 0 25px 0 rgba(0, 0, 0, 0.15);
            box-shadow: 0 0 25px 0 rgba(0, 0, 0, 0.15);
        }
        .contact_section .form_container textarea {
            padding: 15px;
            height: initial!important;
        }
        .error-message {
            color: #df1529;
            text-align: left;
            padding: 15px;
            font-weight: 600;
        }
        .sent-message {
            color: #059652;
            text-align: center;
            padding: 15px;
            font-weight: 600;
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

<div id="content">
    @yield('content')
</div>

<section class="info_section footer">
    <div class="container">
        <div class="contact_nav">
            @if (! empty(settings('company.phone')))
                <a class="footer-link" href="tel:{{ settings('company.phone') }}">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <span>
                        Call : {{ settings('company.phone') }}
                    </span>
                </a>
            @endif

            @if (! empty(settings('company.email')))
                <a class="footer-link" href="mailto:{{ settings('company.email') }}">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <span>
                        Email : {{ settings('company.email') }}
                    </span>
                </a>
            @endif

{{--            <a href="">--}}
{{--                <i class="fa fa-map-marker" aria-hidden="true"></i>--}}
{{--                <span>--}}
{{--                    Location--}}
{{--                </span>--}}
{{--            </a>--}}
        </div>

        <div class="info_top ">
            <div class="row info_main_row">
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <h5>
                        <span>{{ settings('company.name') }}</span>
                    </h5>
                    <p>{{ settings('company.description') }}</p>
                </div>

                <x-menu-component layout="footer" />
            </div>
        </div>
        <div class="info_bottom">
            <div class="row">
                <div class="col-md-2">
                    @if (! empty(settings('company.logo.' . settings('logo_positions.footer'))))
                        <div class="info_logo">
                            <a href="{{ route('home') }}" class="navbar-brand">
                                <img
                                    src="{{ settings('company.logo.' . settings('logo_positions.footer')) }}"
                                    alt="{{ settings('company.name') }}"
                                    style="
                                        max-height: 50px; width: auto;
                                        @if(! empty(settings('logo_settings.footer.height'))) height: {{ settings('logo_settings.footer.height') }}px; max-height: none; @endif
                                        @if(! empty(settings('logo_settings.footer.width'))) width: {{ settings('logo_settings.footer.width') }}px; max-width: none; @endif
                                        @if(! empty(settings('logo_settings.footer.opacity'))) opacity: {{ settings('logo_settings.footer.opacity') }}%; @endif
                                    "
                                />
                            </a>
                        </div>
                    @endif
                </div>
                <div class="col-md-4 ml-auto">
                    @if (! empty(settings('social_links')))
                        <div class="social_box">
                            @foreach(settings('social_links', []) as $item)
                                @continue((empty($item['icon']['dark']) && empty($item['icon']['light'])) || (isset($item['active']) && ! $item['active']))

                                <a href="{{ $item['link'] ?? '#' }}" title="{{ $item['name'] ?? '' }}" target="_blank">
                                    <img src="{{ $item['icon']['light'] ?? $item['icon']['dark'] }}" width="28" alt="{{ $item['name'] ?? '' }}" />
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer_section">
    <div class="container">
        <p>Copyright <span> {{ now()->year }} by {{ settings('company.name') }}</span>. All Rights Reserved.</p>
        <p>Powered by <a class="footer-link" href="https://easynetsites.com/">EasyNetSites</a> Webware</p>
    </div>
</footer>

<script src="{{ asset('site/js/site.js?var' . time()) }}"></script>

<script src="{{ theme_asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="{{ theme_asset('js/bootstrap.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
</script>
<script src="https://huynhhuynh.github.io/owlcarousel2-filter/dist/owlcarousel2-filter.min.js"></script>
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
