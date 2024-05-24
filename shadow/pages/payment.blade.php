@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <header>
        @include('themes.' . current_theme() . '.layouts.includes.header')
    </header>

    <section>
        <div class="container">
            <div style="display: flex; justify-content: center; align-items: center; padding: 160px 0 60px 0;">
                @includeIf('includes.payment-result')
            </div>
        </div>
    </section>
@endsection
