@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <section>
        <div class="container">
            <div style="display: flex; height: calc(100vh - 489px); justify-content: center; align-items: center;">
                <div>
                    <h3 style="text-align: center">Sorry, please log in as a member to view this page.</h3>

                    @if (!auth()->check())
                        <div class="button">
                            <a href="{{ route('login') }}" style="display: block; margin: 0 auto; width: fit-content">Log In</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
