<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header flex items-center py-4 px-6 h-header-height">
            <a href="../dashboard/index.html" class="b-brand flex items-center gap-3 mx-auto">
                <!-- ========   Change your logo from here   ============ -->
                <img src="{{ asset('images/logo-dark.png') }}" class="img-fluid logo-lg h-header-height" alt="logo"/>
            </a>
        </div>
        <div class="navbar-content h-[calc(100vh_-_74px)] py-2.5">
            <div class="card pc-user-card mx-[15px] mb-[15px] bg-theme-sidebaruserbg">
                <div class="card-body !p-5">
                    <div class="flex items-center">
                        <img class="shrink-0 w-[45px] h-[45px] rounded-full"
                             src="{{ asset('images/user/avatar-1.jpg') }}" alt="user-image"/>
                        <div class="ml-4 mr-2 grow">
                            <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                            <small>{{ Auth::user()->roles->first()->name }}</small>
                        </div>
                        <a class="shrink-0 btn btn-icon inline-flex btn-link-secondary" data-pc-toggle="collapse"
                           href="#pc_sidebar_userlink">
                            <svg class="pc-icon w-[22px] h-[22px]">
                                <use xlink:href="#custom-sort-outline"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="hidden pc-user-links" id="pc_sidebar_userlink">
                        <div class="pt-3 *:flex *:items-center *:py-2 *:gap-2.5 hover:*:text-primary-500">
                            <a href="{{ route('profile.edit') }}">
                                <i class="text-lg leading-none ti ti-user"></i>
                                <span>My Account</span>
                            </a>
                            <a href="#">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <i class="text-lg leading-none ti ti-power"></i>
                                    <button type="submit">
                                        <span class="ml-[5px]">{{ __('Logout') }}</span>
                                    </button>
                                </form>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Dashboard</label>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('dashboard') }}" class="pc-link">
                        <span class="pc-micon">
                          <svg class="pc-icon">
                            <use xlink:href="#custom-home"></use>
                          </svg>
                        </span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="/administrators" class="pc-link">
                        <span class="pc-micon">
                          <svg class="pc-icon">
                            <use xlink:href="#custom-message-2"></use>
                          </svg>
                        </span>
                        <span class="pc-mtext">Messaging</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>Tickets</label>
                    <svg class="pc-icon">
                        <use xlink:href="#custom-layer"></use>
                    </svg>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="{{ route(auth()->user()->roles->first()->name.'.tickets.index') }}" class="pc-link">
                        <span class="pc-micon">
                          <svg class="pc-icon">
                            <use xlink:href="#custom-document"></use>
                          </svg>
                        </span>
                        <span class="pc-mtext">Tickets</span>
                    </a>
                </li>
                @role('admin|manager')
                <li class="pc-item pc-caption">
                    <label>Users</label>
                    <svg class="pc-icon">
                        <use xlink:href="#custom-layer"></use>
                    </svg>
                </li>
                @endrole
                @role('admin')
                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('admin.admins.index') }}" class="pc-link">
                        <span class="pc-micon">
                          <svg class="pc-icon">
                            <use xlink:href="#custom-user"></use>
                          </svg>
                        </span>
                        <span class="pc-mtext">Administrators</span>
                    </a>
                </li>
                @endrole
                @hasanyrole('admin|manager')
                <li class="pc-item pc-hasmenu">
                    <a href="{{ route(auth()->user()->roles->first()->name.'.companies.index') }}" class="pc-link">
                        <span class="pc-micon">
                          <svg class="pc-icon">
                            <use xlink:href="#custom-building"></use>
                          </svg>
                        </span>
                        <span class="pc-mtext">Companies</span>
                    </a>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="{{ route(auth()->user()->roles->first()->name.'.managers.index') }}" class="pc-link">
                        <span class="pc-micon">
                          <svg class="pc-icon">
                            <use xlink:href="#custom-user-square"></use>
                          </svg>
                        </span>
                        <span class="pc-mtext">Managers</span>
                    </a>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                          <svg class="pc-icon">
                            <use xlink:href="#custom-car-icon"></use>
                          </svg>
                        </span>
                        <span class="pc-mtext">Drivers</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route(auth()->user()->roles->first()->name.'.drivers.index') }}">Registered Drivers</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route(auth()->user()->roles->first()->name.'.drivers.index', ['status' => 0]) }}">Ticket Drivers</a>
                        </li>
                    </ul>
                </li>
                @endhasanyrole
                @role('admin')
                <li class="pc-item pc-hasmenu">
                    <a href="{{ route('admin.attorneys.index') }}" class="pc-link">
                        <span class="pc-micon">
                          <svg class="pc-icon">
                            <use xlink:href="#custom-bill"></use>
                          </svg>
                        </span>
                        <span class="pc-mtext">Attorneys</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Citations</label>
                    <svg class="pc-icon">
                        <use xlink:href="#custom-box-1"></use>
                    </svg>
                </li>
                <li class="pc-item">
                    <a href="../elements/bc_alert.html" class="pc-link" target="_blank">
                        <span class="pc-micon">
                          <svg class="pc-icon">
                            <use xlink:href="#custom-notification-status"></use>
                          </svg>
                        </span>
                        <span class="pc-mtext">Citations</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>Administration</label>
                    <svg class="pc-icon">
                        <use xlink:href="#custom-element-plus"></use>
                    </svg>
                </li>
                <li class="pc-item">
                    <a href="../forms/form2_wizard.html" class="pc-link">
            <span class="pc-micon">
              <svg class="pc-icon">
                <use xlink:href="#custom-setting-2"></use>
              </svg>
            </span>
                        <span class="pc-mtext">Site Settings</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="../forms/form2_wizard.html" class="pc-link">
            <span class="pc-micon">
              <svg class="pc-icon">
                <use xlink:href="#custom-text-align-justify-center"></use>
              </svg>
            </span>
                        <span class="pc-mtext">Logs</span>
                    </a>
                </li>
                @endrole

                <li class="pc-item pc-caption">
                    <label>Support</label>
                    <svg class="pc-icon">
                        <use xlink:href="#custom-text-align-justify-center"></use>
                    </svg>
                </li>
                <li class="pc-item">
                    <a href="../forms/form2_wizard.html" class="pc-link">
            <span class="pc-micon">
              <svg class="pc-icon">
                <use xlink:href="#custom-24-support"></use>
              </svg>
            </span>
                        <span class="pc-mtext">Support</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
