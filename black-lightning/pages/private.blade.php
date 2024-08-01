@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <div style="display: flex; height: 100%; justify-content: center; align-items: center; padding: 60px 0">
        <div>
            <h3 style="text-align: center">Sorry, please log in as a member to view this page.</h3>

            @if (!auth()->check())
                <a href="{{ route('login') }}" class="btn btn-primary" style="display: block; margin: 0 auto; width: fit-content">Log In</a>
            @endif
        </div>
    </div>
@endsection
