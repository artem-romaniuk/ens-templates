@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <header>
        @include('themes.' . current_theme() . '.layouts.includes.header')
    </header>

    <section>
        <div class="container">
            <div style="display: flex; height: calc(100vh - 489px); justify-content: center; align-items: center;">
                <div>
                    <h3 style="text-align: center">Sorry, please log in as a member to view this page.</h3>

                    @if (!auth()->check())
                        <div class="button text-center">
                            <a href="{{ route('login') }}" class="btn btn-primary ml-lg-2">Log In</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
