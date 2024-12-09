<header class="pc-header">
    <div class="header-wrapper flex max-sm:px-[15px] px-[25px] grow"><!-- [Mobile Media Block] start -->
        <div class="me-auto pc-mob-drp">
            <ul class="inline-flex *:min-h-header-height *:inline-flex *:items-center">
                <!-- ======= Menu collapse Icon ===== -->
                <li class="pc-h-item pc-sidebar-collapse max-lg:hidden lg:inline-flex">
                    <a href="#" class="pc-head-link ltr:!ml-0 rtl:!mr-0" id="sidebar-hide">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="pc-h-item pc-sidebar-popup lg:hidden">
                    <a href="#" class="pc-head-link ltr:!ml-0 rtl:!mr-0" id="mobile-collapse">
                        <i class="ti ti-menu-2 text-2xl leading-none"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- [Mobile Media Block end] -->
        <div class="ms-auto">
            <ul class="inline-flex *:min-h-header-height *:inline-flex *:items-center">
{{--                <li class="dropdown pc-h-item">--}}
{{--                    <a--}}
{{--                        class="pc-head-link dropdown-toggle me-0"--}}
{{--                        data-pc-toggle="dropdown"--}}
{{--                        href="#"--}}
{{--                        role="button"--}}
{{--                        aria-haspopup="false"--}}
{{--                        aria-expanded="false"--}}
{{--                    >--}}
{{--                        <svg class="pc-icon">--}}
{{--                            <use xlink:href="#custom-layer"></use>--}}
{{--                        </svg>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">--}}
{{--                        <div class="text-[16px] m-2">--}}
{{--                            Select Companies--}}
{{--                        </div>--}}
{{--                        <div class="p-2 text-[14px]">--}}
{{--                            <div class="form-check mb-2 pb-2">--}}
{{--                                <input class="form-check-input mr-2" type="checkbox" value="" id="flexCheckChecked">--}}
{{--                                <label class="form-check-label" for="flexCheckChecked">Company 1</label>--}}
{{--                            </div>--}}
{{--                            <div class="form-check mb-2 pb-2">--}}
{{--                                <input class="form-check-input mr-2" type="checkbox" value="" id="flexCheckChecked">--}}
{{--                                <label class="form-check-label" for="flexCheckChecked">Company 2</label>--}}
{{--                            </div>--}}
{{--                            <div class="form-check mb-2 pb-2">--}}
{{--                                <input class="form-check-input mr-2" type="checkbox" value="" id="flexCheckChecked">--}}
{{--                                <label class="form-check-label" for="flexCheckChecked">Company 3</label>--}}
{{--                            </div>--}}
{{--                            <div class="float-end border-t-2 w-full pt-3">--}}
{{--                                <button type="submit" class="btn btn-primary mb-1 float-end btn-sm">Apply</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </li>--}}
                <li class="dropdown pc-h-item">
                    <a
                        class="pc-head-link dropdown-toggle me-0"
                        data-pc-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false"
                    >
                        <svg class="pc-icon">
                            <use xlink:href="#custom-sun-1"></use>
                        </svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                        <a href="#!" class="dropdown-item" onclick="layout_change('dark')">
                            <svg class="pc-icon w-[18px] h-[18px]">
                                <use xlink:href="#custom-moon"></use>
                            </svg>
                            <span>Dark</span>
                        </a>
                        <a href="#!" class="dropdown-item" onclick="layout_change('light')">
                            <svg class="pc-icon w-[18px] h-[18px]">
                                <use xlink:href="#custom-sun-1"></use>
                            </svg>
                            <span>Light</span>
                        </a>
                        <a href="#!" class="dropdown-item" onclick="layout_change_default()">
                            <svg class="pc-icon w-[18px] h-[18px]">
                                <use xlink:href="#custom-setting-2"></use>
                            </svg>
                            <span>Default</span>
                        </a>
                    </div>
                </li>
                <li class="dropdown pc-h-item">
                    <a
                        class="pc-head-link dropdown-toggle me-0"
                        data-pc-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false"
                    >
                        <svg class="pc-icon">
                            <use xlink:href="#custom-notification"></use>
                        </svg>
                        <span class="badge bg-success-500 text-white rounded-full z-10 absolute right-0 top-0" id="notificationCount">{{ count(auth()->user()->unreadNotifications) }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown p-2">
                        <div class="dropdown-header flex items-center justify-between py-4 px-5">
                            <h5 class="m-0">Notifications</h5>
                            @if(count(auth()->user()->unreadNotifications))
                            <a id="markAllRead" href="#!" class="btn btn-link btn-sm">Mark all read</a>
                            @endif
                        </div>
                        <div id="notificationContainer" class="dropdown-body header-notification-scroll relative py-4 px-5" style="max-height: calc(100vh - 215px)">
                            @forelse(auth()->user()->unreadNotifications as $notification)
                            <div class="card mb-2">
                                <div class="card-body notificationItem" data-url="{{ $notification->data['url'] }}" data-notification-id="{{ $notification->id }}">
                                    <div class="flex gap-4">
                                        <div class="shrink-0">
                                            <svg class="pc-icon text-primary w-[22px] h-[22px]">
                                                <use xlink:href="#custom-notification-status"></use>
                                            </svg>
                                        </div>
                                        <div class="grow">
                                            <span class="float-end text-sm text-muted">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                                            <h5 class="text-body mb-2">{{ $notification->data['title'] }}</h5>
                                            <p class="mb-0">
                                                {{ $notification->data['content'] ?? '' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div class="flex justify-center flex-col align-middle items-center">
                                    <span class="text-[50px] text-secondary icon-bold fa fa-bell-slash grow mb-6"></span>
                                    <span class="text-muted">
                                        You're all caught up! No new notifications at the moment.
                                    </span>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </li>
                <li class="dropdown pc-h-item header-user-profile">
                    <a
                        class="pc-head-link dropdown-toggle arrow-none me-0"
                        data-pc-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        data-pc-auto-close="outside"
                        aria-expanded="false"
                    >
                        <img src="{{ asset('images/user/avatar-2.jpg') }}" alt="user-image" class="user-avtar w-10 h-10 rounded-full" />
                    </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown p-2">
                        <div class="dropdown-header flex items-center justify-between py-4 px-5">
                            <h5 class="m-0">Profile</h5>
                        </div>
                        <div class="dropdown-body py-4 px-5">
                            <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
                                <div class="flex mb-1 items-center">
                                    <div class="shrink-0">
                                        <img src="{{ asset('images/user/avatar-2.jpg') }}" alt="user-image" class="w-10 rounded-full" />
                                    </div>
                                    <div class="grow ms-3">
                                        <h6 class="mb-1"> {{ Auth::user()->name }}🖖</h6>
                                        <span>{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                                <hr class="border-secondary-500/10 my-4" />
                                <div class="grid mb-3">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary flex items-center justify-center">
                                            <svg class="pc-icon me-2 w-[22px] h-[22px]">
                                                <use xlink:href="#custom-logout-1-outline"></use>
                                            </svg>
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
