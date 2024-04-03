@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <div class="hero_area">
        @includeIf('themes.' . current_theme() . '.layouts.includes.header')

        <section>
            <div class="container">
                <div style="display: flex; height: calc(100vh - 489px); justify-content: center; align-items: center;">
                    <div>
                        <h3 style="text-align: center">Sorry, please log in as a member to view this page.</h3>

                        <div class="button">
                            <a href="{{ route('login') }}" style="display: block; margin: 0 auto; width: fit-content">Log In</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
