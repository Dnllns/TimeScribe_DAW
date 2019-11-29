        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar  static-top shadow">

          <!-- TOGGLE NAVBAR PARA PANTALLAS PEQUEÑAS -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" data-toggle="collapse" data-target="#accordionSidebar">
            <i class="fa fa-bars"></i>
          </button>

          <!-- NOMBRE Y LOGO -->
          <a class="navbar-brand" href="{{ url('/') }}">
            {{-- {{ config('app.name', 'Laravel') }} --}}

            <img src="/svg/logo_ts.svg" alt="Logo TimeScribe" style="width:70px;">


          </a>

          <!-- BARRA DE BUSQUEDA (PANTALLAS NORMALES) -->
          {{-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form> --}}

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- BARRA DE BUSQUEDA (PANTALLAS PEQUEÑAS) -->
            {{-- <li class="nav-item dropdown no-arrow d-sm-none">

              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>

            </li> --}}

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>

                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            {{-- <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>

                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li> --}}

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name}}</span>
                {{-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> --}}
                <img class="img-profile rounded-circle" style="width:69;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSItMzkgMCA1MDQgNTA0LjIwMzA4IiB3aWR0aD0iNTEycHgiPjxwYXRoIGQ9Im00MDEuMTY3OTY5IDQ1My4wMDM5MDZoLTEyLjg4NjcxOWwtMTIzLjY0NDUzMS0yNzMuMDY2NDA2aC0xMDIuNDAyMzQ0bC0xMjMuNjQ4NDM3IDI3My4wNjY0MDZoLTEyLjg4MjgxM2MtMTQuMTQwNjI1IDAtMjUuNjAxNTYzIDExLjQ2MDkzOC0yNS42MDE1NjMgMjUuNTk3NjU2IDAgMTQuMTQwNjI2IDExLjQ2MDkzOCAyNS42MDE1NjMgMjUuNjAxNTYzIDI1LjYwMTU2M2g5My44NjMyODFjMTQuMTQwNjI1IDAgMjUuNjAxNTYzLTExLjQ2MDkzNyAyNS42MDE1NjMtMjUuNjAxNTYzIDAtMTQuMTM2NzE4LTExLjQ2MDkzOC0yNS41OTc2NTYtMjUuNjAxNTYzLTI1LjU5NzY1NmgtNi4yMjY1NjJsMjYuNzkyOTY4LTU5LjgyMDMxMmgxNDYuNjAxNTYzbDI2Ljc5Njg3NSA1OS44MjAzMTJoLTYuMjMwNDY5Yy0xNC4xMzY3MTkgMC0yNS41OTc2NTYgMTEuNDYwOTM4LTI1LjU5NzY1NiAyNS41OTc2NTYgMCAxNC4xNDA2MjYgMTEuNDYwOTM3IDI1LjYwMTU2MyAyNS41OTc2NTYgMjUuNjAxNTYzaDkzLjg2NzE4OGMxNC4xNDA2MjUgMCAyNS42MDE1NjItMTEuNDYwOTM3IDI1LjYwMTU2Mi0yNS42MDE1NjMgMC0xNC4xMzY3MTgtMTEuNDYwOTM3LTI1LjU5NzY1Ni0yNS42MDE1NjItMjUuNTk3NjU2em0tMjM0LjMzMjAzMS0xMTkuNTE5NTMxIDQ2LjU5NzY1Ni04NS4yODEyNSA0Ni42MDE1NjIgODUuMjgxMjV6bTAgMCIgZmlsbD0iI2NjNGI0YyIvPjxwYXRoIGQ9Im0yNTYuMTAxNTYyIDIyNS40MTc5NjljMjYuMTM2NzE5LTMuMjg1MTU3IDQ2LjgzOTg0NC0yNy4wMDc4MTMgNTguOTY0ODQ0LTQ4LjgwMDc4MSAxNC4xMDU0NjktMjUuMzQzNzUgMjIuMTg3NS02MC45MTc5NjkgOS4xOTE0MDYtODguMDgyMDMyLTEwLjk2MDkzNy0yMi4yOTY4NzUtMzMuNTA3ODEyLTM2LjU2MjUtNTguMzUxNTYyLTM2LjkyMTg3NS0yMy4zOTA2MjUtLjY2MDE1Ni00OS42MzY3MTkgNy44MzIwMzEtNTIuNDcyNjU2IDM0LjQ1NzAzMS0yLjgxNjQwNi0yNi42MjUtMjkuMDk3NjU2LTM1LjE1NjI1LTUyLjQ4MDQ2OS0zNC40NzY1NjItMjAuMjQyMTg3LjQxNDA2Mi0zOS4yMTQ4NDQgOS45NDUzMTItNTEuNjI1IDI1Ljk0MTQwNi0yLjY1MjM0NCAzLjQwNjI1LTQuOTE0MDYzIDcuMDk3NjU2LTYuNzQyMTg3IDExLjAwNzgxMy03LjYxMzI4MiAxOC4xNjAxNTYtOC42NzE4NzYgMzguNDA2MjUtMi45ODQzNzYgNTcuMjYxNzE5IDIuNjk1MzEzIDEwLjc1NzgxMiA2Ljc5Njg3NiAyMS4xMTcxODcgMTIuMjAzMTI2IDMwLjgwNDY4Ny41OTM3NSAxLjEwOTM3NSAxLjI3NzM0MyAyLjIxODc1IDEuOTYwOTM3IDMuMzI4MTI1IDEyLjI4OTA2MyAyMC45MDYyNSAzMi4yNTc4MTMgNDIuNDEwMTU2IDU3LjAwMzkwNiA0NS40ODA0Njl6bTAgMCIgZmlsbD0iI2Y5ZWFiMCIvPjxnIGZpbGw9IiM3ZjViNTMiPjxwYXRoIGQ9Im0yMTMuNDMzNTk0IDExMS42Njc5NjljLTQuNDQ5MjE5LjAxNTYyNS04LjE2NDA2My0zLjM5MDYyNS04LjUzMTI1LTcuODI0MjE5LS4yMDcwMzItMi41MDc4MTItNC43OTY4NzUtNjEuODQ3NjU2IDI0LjExMzI4MS04OS41OTc2NTYgMTIuMTEzMjgxLTExLjM1MTU2MyAyOC44NjcxODctMTYuMzI4MTI1IDQ1LjIxMDkzNy0xMy40NDE0MDYgNC41ODIwMzIuNjgzNTkzIDcuNzg1MTU3IDQuODk4NDM3IDcuMjA3MDMyIDkuNS0uNTc0MjE5IDQuNTk3NjU2LTQuNzEwOTM4IDcuODk0NTMxLTkuMzI0MjE5IDcuNDI5Njg3LTExLjIzMDQ2OS0yLjE5NTMxMy0yMi44MzIwMzEgMS4wODk4NDQtMzEuMjUgOC44Mzk4NDQtMTkuMTcxODc1IDE4LjM5ODQzNy0yMC4xNTIzNDQgNjAuOTk2MDkzLTE4Ljg5MDYyNSA3NS44NTU0NjkuMTk1MzEyIDIuMjYxNzE4LS41MTk1MzEgNC41MTE3MTgtMS45ODgyODEgNi4yNDYwOTMtMS40Njg3NSAxLjczODI4MS0zLjU3MDMxMyAyLjgxMjUtNS44MzU5MzggMi45OTIxODgtLjI0MjE4NyAwLS40ODA0NjkgMC0uNzEwOTM3IDB6bTAgMCIvPjxwYXRoIGQ9Im0xODcuODM1OTM4IDE1NC4zMzU5MzhjLTMuMjUuMDE5NTMxLTYuMjI2NTYzLTEuODEyNS03LjY3OTY4OC00LjcxODc1bC04LjUzNTE1Ni0xNy4wNjY0MDdjLTEuMzYzMjgyLTIuNzI2NTYyLTEuMTY3OTY5LTUuOTc2NTYyLjUxMTcxOC04LjUxOTUzMSAxLjY3OTY4OC0yLjU0Njg3NSA0LjU4NTkzOC00IDcuNjMyODEzLTMuODIwMzEyIDMuMDQyOTY5LjE4MzU5MyA1Ljc1NzgxMyAxLjk3NjU2MiA3LjEyMTA5NCA0LjcwMzEyNGw4LjUzNTE1NiAxNy4wNjY0MDdjMS4zMjAzMTMgMi42MzY3MTkgMS4xODc1IDUuNzczNDM3LS4zNTkzNzUgOC4yODkwNjItMS41NDI5NjkgMi41MTE3MTktNC4yNzczNDQgNC4wNTA3ODEtNy4yMjY1NjIgNC4wNjY0MDd6bTAgMCIvPjxwYXRoIGQ9Im0yMzkuMDM1MTU2IDE1NC4zMzU5MzhjLTIuOTU3MDMxIDAtNS43MDMxMjUtMS41MzEyNS03LjI1MzkwNi00LjA0Njg3Ni0xLjU1NDY4OC0yLjUxNTYyNC0xLjY5NTMxMi01LjY1NjI1LS4zNzUtOC4zMDA3ODFsOC41MzEyNS0xNy4wNjY0MDZjMS4zNjcxODgtMi43MjY1NjMgNC4wODIwMzEtNC41MTk1MzEgNy4xMjUtNC42OTkyMTkgMy4wNDI5NjktLjE4MzU5NCA1Ljk1MzEyNSAxLjI3MzQzOCA3LjYzMjgxMiAzLjgxNjQwNiAxLjY3OTY4OCAyLjU0Njg3NiAxLjg3NSA1Ljc5Mjk2OS41MTE3MTkgOC41MTk1MzJsLTguNTM1MTU2IDE3LjA2NjQwNmMtMS40NDkyMTkgMi44OTA2MjUtNC40MDYyNSA0LjcxNDg0NC03LjYzNjcxOSA0LjcxMDkzOHptMCAwIi8+PC9nPjwvc3ZnPgo=" />
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                {{-- <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a> --}}
                {{-- <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a> --}}
                <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{route('f-logout')}}" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
