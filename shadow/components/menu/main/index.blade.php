@if($align == 'burger')
<style>
    .dropdown:hover .dropdown-menu {
        display: none;
    }
    .dropdown:hover .dropdown-menu .dropdown .dropdown-menu {
        display: none;
    }
    .dropdown .dropdown-menu .dropdown:hover .dropdown-menu {
        display: none;
        left: 100%;
        top: 0;
    }
    .expand-submenu {
        display: flex;
    }
    .dropdown-menu {
        margin-left: 20px;
        padding-left: 10px;
        margin-bottom: 10px;
    }

    @media (max-width: 1280px) {
        .navbar-nav .dropdown-menu {
            border: none!important;
        }
    }
</style>
@endif

@if (! empty($items))
    <div class="navbar-collapse collapse" id="navbarContent">
        <ul
            class="navbar-nav @if($align == 'left') mr-auto @elseif($align == 'right') ml-auto @elseif($align == 'center') m-auto @endif">
            @include('themes.' . current_theme() . '.components.menu.main.items', ['items' => $items])

            <li class="nav-item" style="margin-bottom: 2px;">
                @auth()
                    @if (has_any_access(['*']))
                        <a class="btn btn-primary ml-lg-2" style="width: 120px;" href="{{ main_admin_url() }}" rel="nofollow">Admin</a>
                    @endif
                @else
                    <a class="btn btn-primary ml-lg-2" style="width: 120px;" href="{{ route('login') }}" target="_blank" rel="nofollow">Log In</a>
                @endauth
            </li>

            @auth()
                @if (! is_admin())
                    <li class="nav-item" style="margin-bottom: 2px;">
                        <a class="btn btn-primary ml-lg-2" style="width: 120px;" href="{{ main_profile_url() }}" rel="nofollow">Profile</a>
                    </li>
                @endif
            @endauth

            @auth()
                <li class="nav-item" style="margin-bottom: 2px;">
                    <a class="btn btn-primary ml-lg-2" style="width: 120px;" href="{{ route('logout') }}" rel="nofollow">Logout</a>
                </li>
            @endauth
        </ul>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function normalizeMenuItems() {
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
        }

        normalizeMenuItems();

        window.addEventListener('resize', () => {
            Array.from(document.querySelectorAll('#navbarContent .dropdown-menu')).forEach((dropdown) => {
                if (window.innerWidth > 1278) {
                    if (dropdown.style.display = 'block') {
                        dropdown.style.display = '';
                    }
                }
            });

            if (window.innerWidth > 1278) {
                document.querySelectorAll(".expand-submenu").forEach(button => {
                    const icon = button.children[0]
                    icon.classList.remove("bi-dash");
                    icon.classList.add("bi-plus");
                });
            }
        });
    });
</script>
