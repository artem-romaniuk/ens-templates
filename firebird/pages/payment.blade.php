@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <div class="hero_area sticky-top">
        @includeIf('themes.' . current_theme() . '.layouts.includes.header')

        <section>
            <div class="container">
                <div style="display: flex; justify-content: center; align-items: center; padding: 30px 0 30px 0;">
                    @includeIf('includes.payment-result')
                </div>
            </div>
        </section>
    </div>
@endsection
