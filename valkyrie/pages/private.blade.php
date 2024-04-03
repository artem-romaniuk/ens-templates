@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <section>
        <div class="container">
            <div style="display: flex; height: calc(100vh - 389px); justify-content: center; align-items: center;">
                <div>
                    <h3 style="text-align: center">Sorry, please log in as a member to view this page.</h3>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="btn btn-success">Log In</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
