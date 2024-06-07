@if (($template_settings['header']['logo_position']['value'] ?? '') == 'under_menu' && ! empty($template_settings['header']['logo_position']['apply']))
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                @if (($template_settings['header']['logo_position']['value'] ?? '') == 'under_menu' && ! empty($template_settings['header']['logo_position']['apply']))
                    @if (! empty(settings('company.logo.' . settings('logo_positions.header'))))
                        <a href="{{ route('home') }}" class="navbar-brand">
                            <img
                                src="{{ settings('company.logo.' . settings('logo_positions.header')) }}"
                                alt="{{ settings('company.name') }}"
                                class="logo-main"
                            >
                        </a>
                    @endif
                @endif
            </div>

            <div class="col-auto">
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
        </div>
    </div>
    @php($align = ! empty($template_settings['header']['menu_position']['apply']) ? ($template_settings['header']['menu_position']['value'] ?? 'center') : 'center')
    <nav class="navbar @if($align != 'burger') navbar-expand-lg @endif navbar-light bg-white sticky" data-offset="500">
        <div class="container" style="display: flex; justify-content: end;">

            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <x-menu-component layout="main" :align="$align" />
        </div>
    </nav>
@else
    @php($align = ! empty($template_settings['header']['menu_position']['apply']) ? ($template_settings['header']['menu_position']['value'] ?? 'center') : 'center')
    <nav class="navbar @if($align != 'burger') navbar-expand-lg @endif navbar-light bg-white sticky" data-offset="500">
        <div class="container" style="display: flex; justify-content: space-between;">
            @if (! empty(settings('company.logo.' . settings('logo_positions.header'))))
                <a href="{{ route('home') }}" class="navbar-brand">
                    <img
                        src="{{ settings('company.logo.' . settings('logo_positions.header')) }}"
                        alt="{{ settings('company.name') }}"
                        class="logo-main"
                    >
                </a>
            @endif

            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <x-menu-component layout="main" :align="$align" />


        </div>
    </nav>
@endif
