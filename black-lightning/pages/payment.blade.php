@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <main class="main-content">
        <section class="container py-0 page-content">
            <div style="display: flex; justify-content: center; align-items: center; padding: 220px 0 60px 0">
                @includeIf('includes.payment-result')
            </div>
        </section>
    </main>
@endsection
