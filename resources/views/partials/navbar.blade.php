<div class="bg-gray-900 flex sm:h-20 md:h-20 lg:h-16 xl:h-16 w-full justify-between fixed top-0 text-center">
    <div class="p-2 sm:w-16 md:w-16 lg:w-16 xl:w-16 lg:ml-4 xl:ml-4">
        <button class="w-full p-2 h-full focus:outline-none">
            <img id="menu" onclick="menu()" class="menu" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjM4NHB0IiB2aWV3Qm94PSIwIC01MyAzODQgMzg0IiB3aWR0aD0iMzg0cHQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0ibTM2OCAxNTQuNjY3OTY5aC0zNTJjLTguODMyMDMxIDAtMTYtNy4xNjc5NjktMTYtMTZzNy4xNjc5NjktMTYgMTYtMTZoMzUyYzguODMyMDMxIDAgMTYgNy4xNjc5NjkgMTYgMTZzLTcuMTY3OTY5IDE2LTE2IDE2em0wIDAiLz48cGF0aCBkPSJtMzY4IDMyaC0zNTJjLTguODMyMDMxIDAtMTYtNy4xNjc5NjktMTYtMTZzNy4xNjc5NjktMTYgMTYtMTZoMzUyYzguODMyMDMxIDAgMTYgNy4xNjc5NjkgMTYgMTZzLTcuMTY3OTY5IDE2LTE2IDE2em0wIDAiLz48cGF0aCBkPSJtMzY4IDI3Ny4zMzIwMzFoLTM1MmMtOC44MzIwMzEgMC0xNi03LjE2Nzk2OS0xNi0xNnM3LjE2Nzk2OS0xNiAxNi0xNmgzNTJjOC44MzIwMzEgMCAxNiA3LjE2Nzk2OSAxNiAxNnMtNy4xNjc5NjkgMTYtMTYgMTZ6bTAgMCIvPjwvc3ZnPg==" />
        </button>
    </div>
    <div class="ml-1/7 sm:hidden md:w-56 lg:w-56 xl:w-56 p-2" id="wide-logo">
        <a href=" {{route('home')}} ">
            <img src="" alt="{{env('APP_NAME')}}">
        </a>
    </div>
    <div class="m-auto md:hidden lg:hidden xl:hidden w-32 p-2" id="small-logo">
        <a href=" {{route('home')}} ">
            <img src="" alt="{{env('APP_NAME')}}">
        </a>
    </div>
    <div class="sm:hidden w-2/5 px-2 py-3">
        <input type="search" name="search" class="sm:hidden w-full h-10 outline-none px-5 bg-gray-100 rounded-md" placeholder="search">
    </div>
    <div class="sm:hidden flex">
        <button class="sm:hidden focus:outline-none w-16 m-auto">
            @if ($user?? '')
            <a href=" {{route('dashboard/artists', ['name' => $user->artists->name])}} " class="p-2 bg-blue-500 text-white rounded">
                upload
            </a>
            @else
            <a href=" {{route('signup/reg')}} " class="p-2 bg-blue-500 text-white rounded">
                upload
            </a>
            @endif
        </button>
    </div>
    <div class="left-auto right-0 md:hidden lg:hidden xl:hidden flex align-right" id="small-buttons">
        <button class="m-auto w-10 focus:outline-none md:hidden lg:hidden xl:hidden">
            <img class="bg-white rounded-full p-2" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPGc+DQoJCTxwYXRoIGQ9Ik0zMTAsMTkwYy01LjUyLDAtMTAsNC40OC0xMCwxMHM0LjQ4LDEwLDEwLDEwYzUuNTIsMCwxMC00LjQ4LDEwLTEwUzMxNS41MiwxOTAsMzEwLDE5MHoiLz4NCgk8L2c+DQo8L2c+DQo8Zz4NCgk8Zz4NCgkJPHBhdGggZD0iTTUwMC4yODEsNDQzLjcxOWwtMTMzLjQ4LTEzMy40OEMzODguNTQ2LDI3Ny40ODUsNDAwLDIzOS41NTUsNDAwLDIwMEM0MDAsODkuNzIsMzEwLjI4LDAsMjAwLDBTMCw4OS43MiwwLDIwMA0KCQkJczg5LjcyLDIwMCwyMDAsMjAwYzM5LjU1NiwwLDc3LjQ4Ni0xMS40NTUsMTEwLjIzOS0zMy4xOThsMzYuODk1LDM2Ljg5NWMwLjAwNSwwLjAwNSwwLjAxLDAuMDEsMC4wMTYsMC4wMTZsOTYuNTY4LDk2LjU2OA0KCQkJQzQ1MS4yNzYsNTA3LjgzOCw0NjEuMzE5LDUxMiw0NzIsNTEyYzEwLjY4MSwwLDIwLjcyNC00LjE2MiwyOC4yNzgtMTEuNzE2QzUwNy44MzcsNDkyLjczMSw1MTIsNDgyLjY4Nyw1MTIsNDcyDQoJCQlTNTA3LjgzNyw0NTEuMjY5LDUwMC4yODEsNDQzLjcxOXogTTMwNS41MzYsMzQ1LjcyN2MwLDAuMDAxLTAuMDAxLDAuMDAxLTAuMDAyLDAuMDAyQzI3NC42NjcsMzY4LjE0OSwyMzguMTc1LDM4MCwyMDAsMzgwDQoJCQljLTk5LjI1MiwwLTE4MC04MC43NDgtMTgwLTE4MFMxMDAuNzQ4LDIwLDIwMCwyMHMxODAsODAuNzQ4LDE4MCwxODBjMCwzOC4xNzUtMTEuODUxLDc0LjY2Ny0zNC4yNzIsMTA1LjUzNQ0KCQkJQzMzNC41MTEsMzIwLjk4OCwzMjAuOTg5LDMzNC41MTEsMzA1LjUzNiwzNDUuNzI3eiBNMzI2LjUxNiwzNTQuNzkzYzEwLjM1LTguNDY3LDE5LjgxMS0xNy45MjgsMjguMjc3LTI4LjI3N2wyOC4zNzEsMjguMzcxDQoJCQljLTguNjI4LDEwLjE4My0xOC4wOTQsMTkuNjUtMjguMjc3LDI4LjI3N0wzMjYuNTE2LDM1NC43OTN6IE00ODYuMTM5LDQ4Ni4xMzljLTMuNzgsMy43OC04LjgwMSw1Ljg2MS0xNC4xMzksNS44NjENCgkJCXMtMTAuMzU5LTIuMDgxLTE0LjEzOS01Ljg2MWwtODguNzk1LTg4Ljc5NWMxMC4xMjctOC42OTEsMTkuNTg3LTE4LjE1LDI4LjI3Ny0yOC4yNzdsODguNzk4LDg4Ljc5OA0KCQkJQzQ4OS45MTksNDYxLjYzOSw0OTIsNDY2LjY1OCw0OTIsNDcyQzQ5Miw0NzcuMzQyLDQ4OS45MTksNDgyLjM2MSw0ODYuMTM5LDQ4Ni4xMzl6Ii8+DQoJPC9nPg0KPC9nPg0KPGc+DQoJPGc+DQoJCTxwYXRoIGQ9Ik0yMDAsNDBjLTg4LjIyNSwwLTE2MCw3MS43NzUtMTYwLDE2MHM3MS43NzUsMTYwLDE2MCwxNjBzMTYwLTcxLjc3NSwxNjAtMTYwUzI4OC4yMjUsNDAsMjAwLDQweiBNMjAwLDM0MA0KCQkJYy03Ny4xOTYsMC0xNDAtNjIuODA0LTE0MC0xNDBTMTIyLjgwNCw2MCwyMDAsNjBzMTQwLDYyLjgwNCwxNDAsMTQwUzI3Ny4xOTYsMzQwLDIwMCwzNDB6Ii8+DQoJPC9nPg0KPC9nPg0KPGc+DQoJPGc+DQoJCTxwYXRoIGQ9Ik0zMTIuMDY1LDE1Ny4wNzNjLTguNjExLTIyLjQxMi0yMy42MDQtNDEuNTc0LTQzLjM2LTU1LjQxM0MyNDguNDc5LDg3LjQ5LDIyNC43MjEsODAsMjAwLDgwYy01LjUyMiwwLTEwLDQuNDc4LTEwLDEwDQoJCQljMCw1LjUyMiw0LjQ3OCwxMCwxMCwxMGM0MS4wOTksMCw3OC42MzEsMjUuODE4LDkzLjM5Niw2NC4yNDdjMS41MjgsMy45NzYsNS4zMTcsNi40MTYsOS4zMzcsNi40MTYNCgkJCWMxLjE5MiwwLDIuNDA1LTAuMjE1LDMuNTg0LTAuNjY4QzMxMS40NzIsMTY4LjAxNCwzMTQuMDQ2LDE2Mi4yMjksMzEyLjA2NSwxNTcuMDczeiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K" />
        </button>
        <div class="ml-2 w-12 focus:outline-none md:hidden lg:hidden xl:hidden">
            @if ($user?? '')
            <a href=" {{route('dashboard/artists', ['name' => $user->artists->name])}} ">
                <img src="" class="rounded-full py-2" alt="upload"/>
            </a>
            @else
            <a href=" {{route('signup/reg')}} ">
                <img src="" alt="upload" class="py-2">
            </a>
            @endif
        </div>
    </div>

    <div id="navlinks" class="hidden fixed px-16 h-full bg-gray-800 sm:mt-20 md:mt-20 lg:mt-16 xl:mt-16">
        <div>
            <ul>
                <li>
                    @if($user?? '')
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
    <script>
        var x = 0;
        function menu() {
            if (x==0) {
                x = 1;
                $('#navlinks').removeClass('hidden');
                return $('#menu').attr('src', 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyLjAwMSA1MTIuMDAxIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIuMDAxIDUxMi4wMDE7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxnPg0KCQk8cGF0aCBkPSJNMjg0LjI4NiwyNTYuMDAyTDUwNi4xNDMsMzQuMTQ0YzcuODExLTcuODExLDcuODExLTIwLjQ3NSwwLTI4LjI4NWMtNy44MTEtNy44MS0yMC40NzUtNy44MTEtMjguMjg1LDBMMjU2LDIyNy43MTcNCgkJCUwzNC4xNDMsNS44NTljLTcuODExLTcuODExLTIwLjQ3NS03LjgxMS0yOC4yODUsMGMtNy44MSw3LjgxMS03LjgxMSwyMC40NzUsMCwyOC4yODVsMjIxLjg1NywyMjEuODU3TDUuODU4LDQ3Ny44NTkNCgkJCWMtNy44MTEsNy44MTEtNy44MTEsMjAuNDc1LDAsMjguMjg1YzMuOTA1LDMuOTA1LDkuMDI0LDUuODU3LDE0LjE0Myw1Ljg1N2M1LjExOSwwLDEwLjIzNy0xLjk1MiwxNC4xNDMtNS44NTdMMjU2LDI4NC4yODcNCgkJCWwyMjEuODU3LDIyMS44NTdjMy45MDUsMy45MDUsOS4wMjQsNS44NTcsMTQuMTQzLDUuODU3czEwLjIzNy0xLjk1MiwxNC4xNDMtNS44NTdjNy44MTEtNy44MTEsNy44MTEtMjAuNDc1LDAtMjguMjg1DQoJCQlMMjg0LjI4NiwyNTYuMDAyeiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K');
            }
            if (x == 1) {
                x = 0;
                $('#navlinks').addClass('hidden');
                return $('#menu').attr('src', 'data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjM4NHB0IiB2aWV3Qm94PSIwIC01MyAzODQgMzg0IiB3aWR0aD0iMzg0cHQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0ibTM2OCAxNTQuNjY3OTY5aC0zNTJjLTguODMyMDMxIDAtMTYtNy4xNjc5NjktMTYtMTZzNy4xNjc5NjktMTYgMTYtMTZoMzUyYzguODMyMDMxIDAgMTYgNy4xNjc5NjkgMTYgMTZzLTcuMTY3OTY5IDE2LTE2IDE2em0wIDAiLz48cGF0aCBkPSJtMzY4IDMyaC0zNTJjLTguODMyMDMxIDAtMTYtNy4xNjc5NjktMTYtMTZzNy4xNjc5NjktMTYgMTYtMTZoMzUyYzguODMyMDMxIDAgMTYgNy4xNjc5NjkgMTYgMTZzLTcuMTY3OTY5IDE2LTE2IDE2em0wIDAiLz48cGF0aCBkPSJtMzY4IDI3Ny4zMzIwMzFoLTM1MmMtOC44MzIwMzEgMC0xNi03LjE2Nzk2OS0xNi0xNnM3LjE2Nzk2OS0xNiAxNi0xNmgzNTJjOC44MzIwMzEgMCAxNiA3LjE2Nzk2OSAxNiAxNnMtNy4xNjc5NjkgMTYtMTYgMTZ6bTAgMCIvPjwvc3ZnPg==')
            }
        }
    </script>
</div>
