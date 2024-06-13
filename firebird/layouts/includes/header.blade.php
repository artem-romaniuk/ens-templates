<header class="header_section">
    <div class="header_top">
        <div class="container-fluid header_top_container">
            @if (($template_settings['header']['logo_position']['value'] ?? '') == 'under_menu' && ! empty($template_settings['header']['logo_position']['apply']))
                @if (! empty(settings('company.logo.' . settings('logo_positions.header'))))
                    <a href="{{ route('home') }}" class="navbar-brand">
                        <img
                            src="{{ settings('company.logo.' . settings('logo_positions.header')) }}"
                            alt="{{ settings('company.name') }}"
                            style="
                                @if(! empty(settings('logo_settings.header.height')) && settings('logo_settings.header.height') != 'auto') height: {{ settings('logo_settings.header.height') }}px !important; max-height: none; @endif
                                @if(! empty(settings('logo_settings.header.width')) && settings('logo_settings.header.width') != 'auto') width: {{ settings('logo_settings.header.width') }}px !important; max-width: none; @endif
                                @if(! empty(settings('logo_settings.header.opacity'))) opacity: {{ settings('logo_settings.header.opacity') }}%; @endif
                            "
                        />
                    </a>
                @endif
            @endif

            <div class="contact_nav">
                @if (! empty(settings('company.phone')))
                    <a href="tel:{{ settings('company.phone') }}">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <span>
                            Call : {{ settings('company.phone') }}
                        </span>
                    </a>
                @endif

                @if (! empty(settings('company.email')))
                    <a href="mailto:{{ settings('company.email') }}">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <span>
                            Email : {{ settings('company.email') }}
                        </span>
                    </a>
                @endif
{{--                <a href="">--}}
{{--                    <i class="fa fa-map-marker" aria-hidden="true"></i>--}}
{{--                    <span>--}}
{{--                        Location--}}
{{--                    </span>--}}
{{--                </a>--}}
            </div>

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

    <div class="header_bottom">
        <div class="container-fluid">
            @php($align = ! empty($template_settings['header']['menu_position']['apply']) ? ($template_settings['header']['menu_position']['value'] ?? 'center') : 'center')
            <nav class="navbar @if($align != 'burger') navbar-expand-lg @endif custom_nav-container " style="display: flex; justify-content: end;">
                @if (($template_settings['header']['logo_position']['value'] ?? '') == 'inline_menu' || empty($template_settings['header']['logo_position']['apply']))
                    @if (! empty(settings('company.logo.' . settings('logo_positions.header'))))
                        <a href="{{ route('home') }}" class="navbar-brand">
                            <img
                                src="{{ settings('company.logo.' . settings('logo_positions.header')) }}"
                                alt="{{ settings('company.name') }}"
                                style="
                                    @if(! empty(settings('logo_settings.header.height')) && settings('logo_settings.header.height') != 'auto') height: {{ settings('logo_settings.header.height') }}px !important; max-height: none; @endif
                                    @if(! empty(settings('logo_settings.header.width')) && settings('logo_settings.header.width') != 'auto') width: {{ settings('logo_settings.header.width') }}px !important; max-width: none; @endif
                                    @if(! empty(settings('logo_settings.header.opacity'))) opacity: {{ settings('logo_settings.header.opacity') }}%; @endif
                                "
                            />
                        </a>
                    @endif
                @endif

                <button class="navbar-toggler" style="@if($align == 'burger') display: block !important; @endif" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>

                <x-menu-component layout="main" :align="$align" />
            </nav>
        </div>
    </div>
</header>
