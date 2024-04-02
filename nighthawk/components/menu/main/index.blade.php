@if (! empty($items))
    <style>
        .burger-nav {
            position: fixed;
            top: 0;
            right: -100%;
            width: 100%;
            max-width: 400px;
            bottom: 0;
            transition: 0.3s;
            z-index: 9997;
        }
        .mobile-nav-active .burger-nav {
            right: 0;
        }
        
        .burger-nav ul {
            position: absolute;
            inset: 0;
            padding: 50px 0 10px 0;
            margin: 0;
            background: rgba(27, 47, 69, 0.9);
            overflow-y: auto;
            transition: 0.3s;
            z-index: 9998;
            display: block;
        }
    </style>
    <nav 
        id="navbar" 
        class="navbar @if($align == 'burger') burger-nav @endif"
        >
        <ul
            style="
                @if($align == 'left') float: left;
                @elseif($align == 'rigth') float: right;
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
                <li>
                    <a href="{{ route('logout') }}" style="line-height: 50px; height: 50px;" rel="nofollow">Logout</a>
                </li>
            @endauth
        </ul>
    </nav>
@endif
