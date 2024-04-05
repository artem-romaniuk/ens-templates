@if (! empty($items))
    @if ($side)
        <div class="mobile-menu-items">
            <ul class="nav-menu" @if ($align == 'left') style="float: left;" @elseif ($align == 'right') style="float: right;" @endif>
                @include('themes.' . current_theme() . '.components.menu.main.items', ['items' => $items, 'side' => $side])

                <li>
                @auth()
                    <a href="{{ route('admin.pages.index') }}" rel="nofollow">Admin</a>
                @else
                    <a href="{{ route('login') }}" target="_blank" rel="nofollow">Log In</a>
                @endauth
                </li>
            </ul>
        </div>
    @else
        <div class="header-navigation" @if ($align == 'left') style="float: left;" @elseif ($align == 'right') style="float: right;" @endif>
            <ul class="main-nav justify-content-center">
                @include('themes.' . current_theme() . '.components.menu.main.items', ['items' => $items, 'side' => $side])

                <li>
                    @auth()
                        @if (has_any_access(['*']))
                            <a href="{{ main_admin_url() }}" rel="nofollow">Admin</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" target="_blank" rel="nofollow">Log In</a>
                    @endauth
                </li>

                @auth()
                    @if (! is_admin())
                        <li>
                            <a href="{{ main_profile_url() }}" rel="nofollow">Profile</a>
                        </li>
                    @endif
                @endauth

                @auth()
                    <li>
                        <a href="{{ route('logout') }}" rel="nofollow">Logout</a>
                    </li>
                @endauth
            </ul>
        </div>
    @endif
@endif
