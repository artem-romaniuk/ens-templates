@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <section>
        <div class="container">
            <div style="display: flex; justify-content: center; align-items: center;">
                @includeIf('includes.payment-result')
            </div>
        </div>
    </section>
@endsection
