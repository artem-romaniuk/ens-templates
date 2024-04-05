@if (! empty($items))
<style>
    .burger {
        display: none !important;
    }
    .navbar-mobile .burger {
        display: block !important;
        max-width: 600px;
        left: calc(100% - 600px);
    }
    @media(max-width: 615px) {
        .navbar-mobile .burger {
            left: 15px;
        }
    }
</style>
    <nav id="navbar" class="navbar" style="min-height: 40px;">
        <ul
            class="@if($align == 'burger') burger @endif"
            style="
                @if ($align == 'left') margin-right: auto;
                @elseif ($align == 'right') margin-left: auto;
                @elseif ($align == 'center') margin-inline: auto;
                @elseif ($align == 'burger') display: none;
                @endif">

            @include('themes.' . current_theme() . '.components.menu.main.items', ['items' => $items])

            <li>
                @auth()
        	    @if (has_any_access(['*']))
                        <a href="{{ main_admin_url() }}" style="line-height: 50px; height: 50px;" rel="nofollow">Admin</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" style="line-height: 50px; height: 50px;" target="_blank" rel="nofollow">Log In</a>
                @endauth
            </li>

            @auth()
                @if (! is_admin())
                    <li>
                        <a href="{{ main_profile_url() }}" style="line-height: 50px; height: 50px;" rel="nofollow">Profile</a>
                    </li>
                @endif
            @endauth

            @auth()
                <li>
                    <a href="{{ route('logout') }}" style="line-height: 50px; height: 50px;" rel="nofollow">Logout</a>
                </li>
            @endauth
        </ul>
        <i class="bi bi-list mobile-nav-toggle" style="font-size: 2rem; margin-left: auto; @if($align == 'burger') display: block !important; @endif"></i>
    </nav>
@endif
