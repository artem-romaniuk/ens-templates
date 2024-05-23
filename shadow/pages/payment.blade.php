@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <header>
        @include('themes.' . current_theme() . '.layouts.includes.header')
    </header>

    <section>
        <div style="
                @if( empty(settings('logo_settings.header.height')) || settings('logo_settings.header.height') == 'auto') padding-top: 0; @endif
                @if(  settings('logo_settings.header.height') == 50) padding-top: 3%; @endif
                @if(  settings('logo_settings.header.height') == 100) padding-top: 3.5%; @endif
                @if(  settings('logo_settings.header.height') == 150) padding-top: 6%; @endif
                @if(  settings('logo_settings.header.height') == 200) padding-top: 8%; @endif
                @if(  settings('logo_settings.header.height') == 250) padding-top: 11.5%; @endif
            ">
            <div class="container">
                <div style="display: flex; justify-content: center; align-items: center; padding: 160px 0 60px 0;">
                    @includeIf('includes.payment-result')
                </div>
            </div>
        </div>
    </section>
@endsection
