@if($align == 'burger')
<style>
    .expand-submenu {
        display: flex;
        justify-content: end;
        align-items: center;
        cursor: pointer;
        width: 15em;
    }
    .dropdown-menu {
        margin-left: 30px;
        padding-left: 15px;
    }
    .dropdown:hover .dropdown-menu {
      display: none;
    }
    .dropdown:hover .dropdown-menu .dropdown .dropdown-menu {
      display: none;
    }
    .dropdown .dropdown-menu .dropdown:hover .dropdown-menu {
      display: none;
    }
</style>
@endif

@if (! empty($items))
    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto" @if ($align == 'left') style="float: left;" @elseif ($align == 'right') style="float: right;" @endif>
        @include('themes.' . current_theme() . '.components.menu.main.items', ['items' => $items])

        <li class="nav-item">
            @auth()
                @if (has_any_access(['*']))
                    <a href="{{ main_admin_url() }}" class="nav-link" rel="nofollow">Admin</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="nav-link" target="_blank" rel="nofollow">Log In</a>
            @endauth
        </li>

        @auth()
            @if (! is_admin())
                <li class="nav-item">
                    <a href="{{ main_profile_url() }}" class="nav-link" rel="nofollow">Profile</a>
                </li>
            @endif
        @endauth

        @auth()
            <li>
                <a href="{{ route('logout') }}" class="nav-link" rel="nofollow">Logout</a>
            </li>
        @endauth
    </ul>
@endif

<script>
    const expandButtons = document.querySelectorAll(".expand-submenu");

    expandButtons.forEach(button => {
        button.addEventListener("click", () => {
            const submenu = button.parentElement.nextElementSibling
            if (submenu.style.display == '' || submenu.style.display == 'none') {
                submenu.style.display = 'block'
            } else {
                submenu.style.display = 'none'
            }

            const icon = button.children[0]
            icon.classList.toggle("bi-plus");
            icon.classList.toggle("bi-dash");
        });
    });
</script>
