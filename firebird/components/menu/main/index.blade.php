@if ($align == 'burger')
    <style>
        .custom_nav-container .navbar-nav {
            margin: 0;
            margin-left: auto;
            align-items: center;
        }
        .dropdown-menu {
            margin-left: -90px;
            width: 19em;
            padding-inline: 20px;
        }
        .expand-submenu {
            width: 80%;
            display: flex;
            justify-content: end;
            cursor: pointer;
            position: absolute;
            top: 25%;
            left: 90%;
        }
        .submenu .submenu .expand-submenu {
            width: 60%;
            display: flex;
            justify-content: end;
            cursor: pointer;
            position: absolute;
            top: 25%;
            left: 35%;
        }

        .dropdown:hover .dropdown-menu {
            visibility: hidden;
            opacity: 0;
        }

        .dropdown .dropdown-menu .dropdown .dropdown-menu {
            left: 35%;
            top: 100%;
        }

        .dropdown .dropdown-menu .dropdown:hover .dropdown-menu {
            visibility: hidden;
            opacity: 0;
            left: 110px;
            top: 100%;
        }
        .dropdown:hover .dropdown-menu .dropdown .dropdown-menu {
            left: 35%;
            top: 100%;
        }
        .dropdown .dropdown-menu .dropdown:hover .dropdown-menu {
            left: 35%;
            top: 100%;
        }
    </style>
@endif

@if (! empty($items))
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul
            class="navbar-nav"
            style="
                @if ($align == 'left') margin-right: auto !important;
                @elseif ($align == 'right') margin-left: auto !important;
                @elseif ($align == 'center') margin-inline: auto !important;
                @endif">
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
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" rel="nofollow">Logout</a>
                </li>
            @endauth
        </ul>
    </div>
@endif

<script>
    const expandButtons = document.querySelectorAll(".expand-submenu");

    expandButtons.forEach(button => {
        button.addEventListener("click", () => {
            const submenu = button.parentElement.nextElementSibling
            if (submenu.style.visibility && submenu.style.visibility == 'visible') {
                submenu.style.visibility = 'hidden'
                submenu.style.opacity = 0
            } else {
                submenu.style.visibility = 'visible'
                submenu.style.opacity = 1
            }

            const icon = button.children[0]
            icon.classList.toggle("bi-plus");
            icon.classList.toggle("bi-dash");
        });
    });

    window.addEventListener('click', function(e){
        const dropDownMenus = document.querySelectorAll('.dropdown-menu')
        let clickInsideDropdownMenu = false
        dropDownMenus.forEach(el => {
            if (el.contains(e.target)) {
                clickInsideDropdownMenu = true
            }
        })

        const expandMenuButtons = document.querySelectorAll('.expand-submenu')
        let clickInsideExpandMenuButton = false
        expandMenuButtons.forEach(el => {
            if (el.contains(e.target)) {
                expandMenuButtons = true
            }
        })

        if (! clickInsideDropdownMenu && ! clickInsideExpandMenuButton) {
            expandButtons.forEach(button => {
                const submenu = button.parentElement.nextElementSibling

                if (submenu.style.visibility && submenu.style.visibility == 'visible') {
                    submenu.style.visibility = 'hidden'
                    submenu.style.opacity = 0

                    const icon = button.children[0]
                    icon.classList.toggle("bi-plus");
                    icon.classList.toggle("bi-dash");
                }


            });
        }

        // if (!document.getElementById('l2').contains(e.target) && (!document.getElementById('logo-menu').contains(e.target))){
        //     alert("Clicked outside l2 and logo-menu");
        //     document.getElementById('l2').style.height="0px"; //the same code you've used to hide the menu
        // }
    })
</script>
