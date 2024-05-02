<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', '') }}</title>

    @if (! empty(settings('favicon.url')))
    	<!-- Favicon -->
        <link rel="icon" href="{{ settings('favicon.url') }}" type="image/x-icon">
    @endif

    <link rel="stylesheet" href="{{ theme_asset('css/maicons.css') }}">
    <link rel="stylesheet" href="{{ theme_asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="{{ theme_asset('css/laraberg.css') }}?ver=16">
    <link rel="stylesheet" href="{{ theme_asset('vendor/animate/animate.css') }}">
    <link rel="stylesheet" href="{{ theme_asset('css/theme.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <link rel="stylesheet" href="{{ asset('site/css/site.css?var' . time()) }}" />

    <style>
        .quote {
            display: block;
            padding: 16px 20px;
            background-color: #6C55F9;
            color: #fff;
            font-size: 18px;
            border-radius: 8px;
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
        .categories li a.active {
            color: #6C55F9;
            text-decoration: none;
            font-weight: 500;
            text-shadow: 0 2px 4px rgba(107, 85, 249, 0.5);
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

<div class="back-to-top"></div>

<div id="content">
@yield('content')
</div>

<footer class="page-footer bg-image" style="background-image: url(../assets/img/world_pattern.svg);">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-3 py-3">
                <h3>{{ settings('company.name') }}</h3>
                <p>{{ settings('company.description') }}</p>

                @if (! empty(settings('social_links')))
                    <div class="social-media-button d-flex justify-content-between">
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

            <div class="col-lg-3 py-3">
                <p>{{ implode(', ', array_filter([settings('company.address_1'), settings('company.address_2'), settings('company.city'), settings('company.state'), settings('company.country')])) }}</p>

                @if (! empty(settings('company.phone')))
                    <a href="tel:{{ settings('company.phone') }}" class="footer-link">
                        {{ settings('company.phone') }}
                    </a>
                @endif

                @if (! empty(settings('company.email')))
                    <a href="mailto:{{ settings('company.email') }}" class="footer-link">
                        {{ settings('company.email') }}
                    </a>
                @endif
            </div>
        </div>

        <p class="text-center" id="copyright">Copyright <span>{{ now()->year }} by {{ settings('company.name') }}</span>. All Rights Reserved.</p>
        <p class="text-center" id="copyright">Powered by <a class="footer-link" href="https://easynetsites.com/">EasyNetSites</a> Webware</p>
    </div>
</footer>

<script src="{{ asset('site/js/site.js?var' . time()) }}"></script>

<script src="{{ theme_asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ theme_asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ theme_asset('vendor/wow/wow.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://huynhhuynh.github.io/owlcarousel2-filter/dist/owlcarousel2-filter.min.js"></script>
<script src="{{ theme_asset('js/theme.js') }}"></script>

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
