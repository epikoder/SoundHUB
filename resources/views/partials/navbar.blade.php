<nav>
    <div class="sm:hidden bg-gray-900 fixed z-40 h-20 top-0 w-full">
        <div class="vertical-center w-full">
            <div class="flex justify-between w-full h-12 px-2">
                <div class="w-1/12">
                    <button class="focus:outline-none h-12 px-4">
                        <img class="h-12"
                            src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjM4NHB0IiB2aWV3Qm94PSIwIC01MyAzODQgMzg0IiB3aWR0aD0iMzg0cHQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0ibTM2OCAxNTQuNjY3OTY5aC0zNTJjLTguODMyMDMxIDAtMTYtNy4xNjc5NjktMTYtMTZzNy4xNjc5NjktMTYgMTYtMTZoMzUyYzguODMyMDMxIDAgMTYgNy4xNjc5NjkgMTYgMTZzLTcuMTY3OTY5IDE2LTE2IDE2em0wIDAiLz48cGF0aCBkPSJtMzY4IDMyaC0zNTJjLTguODMyMDMxIDAtMTYtNy4xNjc5NjktMTYtMTZzNy4xNjc5NjktMTYgMTYtMTZoMzUyYzguODMyMDMxIDAgMTYgNy4xNjc5NjkgMTYgMTZzLTcuMTY3OTY5IDE2LTE2IDE2em0wIDAiLz48cGF0aCBkPSJtMzY4IDI3Ny4zMzIwMzFoLTM1MmMtOC44MzIwMzEgMC0xNi03LjE2Nzk2OS0xNi0xNnM3LjE2Nzk2OS0xNiAxNi0xNmgzNTJjOC44MzIwMzEgMCAxNiA3LjE2Nzk2OSAxNiAxNnMtNy4xNjc5NjkgMTYtMTYgMTZ6bTAgMCIvPjwvc3ZnPg==" />
                    </button>
                </div>
                <div class=" w-3/12 px-4">
                    <a href={{ route('home') }}>
                        <img src="" class="h-12 border border-white" alt={{ Config::get('app.name') }}>
                    </a>
                </div>
                <div class="w-6/12 px-4">
                    <input type="search" name="search"
                        class="w-full h-12 outline-none px-4 bg-gray-100 rounded-md search"
                        placeholder="Artists, Albums, Tracks">
                </div>
                <div class="w-1/12 px-4">
                    <button class="focus:outline-none h-12">
                        @if ($user ?? '')
                            @if ($user->artists ?? '')
                                <a href=" {{ route('dashboard/artists', ['name' => $user->artists->name]) }} "
                                    class="p-2 bg-blue-500 text-white rounded">
                                    upload
                                </a>
                            @else
                                <a href=" {{ route('pay/info') }} " class="p-2 bg-blue-500 text-white rounded">
                                    upload
                                </a>
                            @endif
                        @else
                            <a href=" {{ route('signup/reg') }} " class="p-2 bg-blue-500 text-white rounded">
                                upload
                            </a>
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full md:hidden lg:hidden xl:hidden z-40 h-20 fixed top-0 bg-gray-700 nav">
        <div class="flex w-full justify-between vertical-center">
            <div class="w-12 h-12 p-2 upload">
                @if ($user ?? '')
                    @if ($user->artists ?? '')
                        <a href=" {{ route('dashboard/artists', ['name' => $user->artists->name]) }} ">
                        @else
                            <a href=" {{ route('pay/info') }} ">
                    @endif
                @else
                    <a href=" {{ route('signup/reg') }} ">
                @endif
                <img class="bg-white"
                    src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyLjA1NiA1MTIuMDU2IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIuMDU2IDUxMi4wNTY7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxnPg0KCQk8Zz4NCgkJCTxwYXRoIGQ9Ik00MjYuNjM1LDE4OC4yMjRDNDAyLjk2OSw5My45NDYsMzA3LjM1OCwzNi43MDQsMjEzLjA4LDYwLjM3QzEzOS40MDQsNzguODY1LDg1LjkwNywxNDIuNTQyLDgwLjM5NSwyMTguMzAzDQoJCQkJQzI4LjA4MiwyMjYuOTMtNy4zMzMsMjc2LjMzMSwxLjI5NCwzMjguNjQ0YzcuNjY5LDQ2LjUwNyw0Ny45NjcsODAuNTY2LDk1LjEwMSw4MC4zNzloODB2LTMyaC04MGMtMzUuMzQ2LDAtNjQtMjguNjU0LTY0LTY0DQoJCQkJYzAtMzUuMzQ2LDI4LjY1NC02NCw2NC02NGM4LjgzNywwLDE2LTcuMTYzLDE2LTE2Yy0wLjA4LTc5LjUyOSw2NC4zMjctMTQ0LjA2NSwxNDMuODU2LTE0NC4xNDQNCgkJCQljNjguODQ0LTAuMDY5LDEyOC4xMDcsNDguNjAxLDE0MS40MjQsMTE2LjE0NGMxLjMxNSw2Ljc0NCw2Ljc4OCwxMS44OTYsMTMuNiwxMi44YzQzLjc0Miw2LjIyOSw3NC4xNTEsNDYuNzM4LDY3LjkyMyw5MC40NzkNCgkJCQljLTUuNTkzLDM5LjI3OC0zOS4xMjksNjguNTIzLTc4LjgwMyw2OC43MjFoLTY0djMyaDY0YzYxLjg1Ni0wLjE4NywxMTEuODQ4LTUwLjQ4MywxMTEuNjYtMTEyLjMzOQ0KCQkJCUM1MTEuODk5LDI0NS4xOTQsNDc2LjY1NSwyMDAuNDQzLDQyNi42MzUsMTg4LjIyNHoiLz4NCgkJCTxwYXRoIGQ9Ik0yNDUuMDM1LDI1My42NjRsLTY0LDY0bDIyLjU2LDIyLjU2bDM2LjgtMzYuNjR2MTUzLjQ0aDMydi0xNTMuNDRsMzYuNjQsMzYuNjRsMjIuNTYtMjIuNTZsLTY0LTY0DQoJCQkJQzI2MS4zNTQsMjQ3LjQ2LDI1MS4yNzYsMjQ3LjQ2LDI0NS4wMzUsMjUzLjY2NHoiLz4NCgkJPC9nPg0KCTwvZz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K" />
                </a>
            </div>
            <div class="w-3/6 h-12 px-1 logo">
                <a href={{ route('home') }}>
                    <img src="" alt="logo" class="border-2 border-silver">
                </a>
            </div>
            <div class="w-12 h-12 p-2 search">
                <button class="btn-search w-full">
                    <img
                        src="data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNTEyLjAwMiA1MTIuMDAyIiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDUxMi4wMDIgNTEyLjAwMiIgd2lkdGg9IjUxMiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Zz48cGF0aCBkPSJtNDk1LjU5NCA0MTYuNDA4LTEzNC4wODYtMTM0LjA5NWMxNC42ODUtMjcuNDkgMjIuNDkyLTU4LjMzMyAyMi40OTItOTAuMzEyIDAtNTAuNTE4LTE5LjQ2MS05OC4yMTctNTQuOC0xMzQuMzEtMzUuMjgzLTM2LjAzNi04Mi40NS01Ni41MDUtMTMyLjgwOC01Ny42MzYtMS40Ni0uMDMzLTIuOTItLjA1NC00LjM5Mi0uMDU0LTEwNS44NjkgMC0xOTIgODYuMTMxLTE5MiAxOTJzODYuMTMxIDE5MiAxOTIgMTkyYzEuNDU5IDAgMi45My0uMDIxIDQuMzc3LS4wNTQgMzAuNDU2LS42OCA1OS43MzktOC40NDQgODUuOTM2LTIyLjQzNmwxMzQuMDg1IDEzNC4wNzVjMTAuNTcgMTAuNTg0IDI0LjYzNCAxNi40MTQgMzkuNjAxIDE2LjQxNHMyOS4wMzEtNS44MyAzOS41ODktMTYuNDAzYzEwLjU4NC0xMC41NzcgMTYuNDEzLTI0LjYzOSAxNi40MTMtMzkuNTk3cy01LjgyNy0yOS4wMTktMTYuNDA3LTM5LjU5MnptLTI5OS45MzItNjQuNDUzYy0xLjIxMS4wMjctMi40NDEuMDQ2LTMuNjYyLjA0Ni04OC4yMjQgMC0xNjAtNzEuNzc2LTE2MC0xNjBzNzEuNzc2LTE2MCAxNjAtMTYwYzEuMjI5IDAgMi40NDkuMDE5IDMuNjcxLjA0NiA4Ni4yIDEuOTM1IDE1Ni4zMjkgNzMuNjkgMTU2LjMyOSAxNTkuOTU0IDAgODYuMjc0LTcwLjEzMyAxNTguMDI5LTE1Ni4zMzggMTU5Ljk1NHptMjc3LjI5NiAxMjEuMDJjLTQuNTI1IDQuNTMxLTEwLjU0NyA3LjAyNi0xNi45NTggNy4wMjZzLTEyLjQzNC0yLjQ5NS0xNi45NjYtNy4wMzRsLTEyOS4yOTQtMTI5LjI4NGM2LjgxMy01LjMwNyAxMy4zMTktMTEuMDk0IDE5LjQ1OC0xNy4zNjUgNS4xNzQtNS4yODUgOS45OTgtMTAuODI1IDE0LjQ4LTE2LjU4bDEyOS4yOTEgMTI5LjNjNC41MzUgNC41MzIgNy4wMzIgMTAuNTU2IDcuMDMyIDE2Ljk2MnMtMi40OTYgMTIuNDMxLTcuMDQzIDE2Ljk3NXoiLz48cGF0aCBkPSJtMTkyIDY0LjAwMWMtNzAuNTggMC0xMjggNTcuNDItMTI4IDEyOHM1Ny40MiAxMjggMTI4IDEyOCAxMjgtNTcuNDIgMTI4LTEyOC01Ny40Mi0xMjgtMTI4LTEyOHptMCAyMjRjLTUyLjkzNSAwLTk2LTQzLjA2NS05Ni05NnM0My4wNjUtOTYgOTYtOTYgOTYgNDMuMDY1IDk2IDk2LTQzLjA2NSA5Ni05NiA5NnoiLz48L2c+PC9zdmc+" />
                </button>
            </div>
        </div>
    </div>
    <div id="navlinks" class="fixed px-16 h-full bg-gray-800 sm:hidden hidden">
        <div>
            <ul>
                <li>
                    @if ($user ?? '')
                        <a href="">My Account</a>
                    @else
                        <a href="">Login</a>
                    @endif
                </li>
                <li>
                    <a href="">Artists</a>
                </li>
                <li>
                    <a href="">Albums</a>
                </li>
                <li>
                    <a href="">Tracks</a>
                </li>
            </ul>
        </div>
        <div>
            <ul>
                <li>
                    <a href="">About Us</a>
                </li>
                <li>
                    <a href="">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="search-bar hidden fixed h-20 w-full bg-gray-300 top-0 z-50">
        <div class="w-full vertical-center">
            <div class="flex justify-between px-2 h-12">
                <button class="w5 close-search">
                    <img class="w-12"
                        src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgMzQxLjMzMyAzNDEuMzMzIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAzNDEuMzMzIDM0MS4zMzM7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxnPg0KCQk8cG9seWdvbiBwb2ludHM9IjM0MS4zMzMsMTQ5LjMzMyA4MS43MDcsMTQ5LjMzMyAyMDAuODUzLDMwLjE4NyAxNzAuNjY3LDAgMCwxNzAuNjY3IDE3MC42NjcsMzQxLjMzMyAyMDAuODUzLDMxMS4xNDcgODEuNzA3LDE5MiANCgkJCTM0MS4zMzMsMTkyIAkJIi8+DQoJPC9nPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo=" />
                </button>
                <form action={{ route('browse') }} method="get" class="w-11/12 ">
                    @csrf
                    <input type="search" name="search"
                        class="w-full outline-none px-5 py-2 bg-gray-100 main-search rounded-full"
                        placeholder="Artists, Albums, Tracks">
                </form>
            </div>
        </div>
    </div>
</nav>
