@extends('layout.master')
@section('content')
    <div class="col-span-12 lg:col-span-3 md:col-span-6">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center">
                    <div class="shrink-0">
                        <div class="w-12 h-12 rounded-lg inline-flex items-center justify-center bg-primary-500/10 text-primary-500">
                            <i class="ti ti-file text-2xl leading-none"></i>
                        </div>
                    </div>
                    <div class="grow ltr:ml-3 rtl:mr-3">
                        <p class="mb-1">Open Tickets</p>
                        <div class="flex items-center justify-between">
                            <h4 class="mb-0">400</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-12 lg:col-span-3 md:col-span-6">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center">
                    <div class="shrink-0">
                        <div class="w-12 h-12 rounded-lg inline-flex items-center justify-center bg-warning-500/10 text-warning-500">
                            <i class="ti ti-user text-2xl leading-none"></i>
                        </div>
                    </div>
                    <div class="grow ltr:ml-3 rtl:mr-3">
                        <p class="mb-1">Total Drivers</p>
                        <div class="flex items-center justify-between">
                            <h4 class="mb-0">520</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-12 lg:col-span-3 md:col-span-6">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center">
                    <div class="shrink-0">
                        <div class="w-12 h-12 rounded-lg inline-flex items-center justify-center bg-success-500/10 text-success-500">
                            <i class="ti ti-briefcase text-2xl leading-none"></i>
                        </div>
                    </div>
                    <div class="grow ltr:ml-3 rtl:mr-3">
                        <p class="mb-1">Total Attorneys</p>
                        <div class="flex items-center justify-between">
                            <h4 class="mb-0">800</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-12 lg:col-span-3 md:col-span-6">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center">
                    <div class="shrink-0">
                        <div class="w-12 h-12 rounded-lg inline-flex items-center justify-center bg-danger-500/10 text-danger-500">
                            <i class="ti ti-building text-2xl leading-none"></i>
                        </div>
                    </div>
                    <div class="grow ltr:ml-3 rtl:mr-3">
                        <p class="mb-1">Total Companies</p>
                        <div class="flex items-center justify-between">
                            <h4 class="mb-0">1,065</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="col-span-12 lg:col-span-4">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-4">Upcoming court dates</h5>
                <div class="card overflow-hidden mb-2">
                    <div class="card-body !px-3 !py-2 border-l-4 border-danger-500">
                        <h6 class="mb-1">Airi Satou</h6>
                        <p class="mb-1"><i class="ti ti-calendar"></i> Oct 10, Mon</p>
                        <p class="mb-0"> <span class="ti ti-calendar-time"></span> 16:00</p>
                    </div>
                </div>
                <div class="card overflow-hidden mb-2">
                    <div class="card-body !px-3 !py-2 border-l-4 border-danger-500">
                        <h6 class="mb-1">Ashton Cox</h6>
                        <p class="mb-1"><i class="ti ti-calendar"></i> Oct 10, Mon</p>
                        <p class="mb-0"> <span class="ti ti-calendar-time"></span> 16:00</p>
                    </div>
                </div>
                <div class="card overflow-hidden mb-2">
                    <div class="card-body !px-3 !py-2 border-l-4 border-danger-500">
                        <h6 class="mb-1">Bradley Greer</h6>
                        <p class="mb-1"><i class="ti ti-calendar"></i> Oct 10, Mon</p>
                        <p class="mb-0"> <span class="ti ti-calendar-time"></span> 16:00</p>
                    </div>
                </div>
                <div class="card overflow-hidden mb-2">
                    <div class="card-body !px-3 !py-2 border-l-4 border-danger-500">
                        <h6 class="mb-1">Brielle Williamson</h6>
                        <p class="mb-1"><i class="ti ti-calendar"></i> Oct 10, Mon</p>
                        <p class="mb-0"> <span class="ti ti-calendar-time"></span> 16:00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-span-12 lg:col-span-4">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between mb-3">
                    <h5 class="mb-0">Tickets</h5>
                </div>
                <div id="invites-goal-chart"></div>
                <div class="text-center">
                    <p class="text-muted my-2">Ratio of open tickets of all tickets</p>
                    <div class="grid grid-cols-12 gap-3">
                        <div class="col-span-4">
                            <div class="text-center d-inline-block px-md-3">
                                <p class="mb-1 text-muted">Tickets</p>
                                <h5 class="inline-flex items-center gap-1 mb-0">
                                    34999
                                </h5>
                            </div>
                        </div>
                        <div class="col-span-4">
                            <div class="text-center d-inline-block px-md-3">
                                <p class="mb-1 text-muted">Open Tickets</p>
                                <h5 class="inline-flex items-center gap-1 mb-0">
                                    10434
                                </h5>
                            </div>
                        </div>
                        <div class="col-span-4">
                            <div class="text-center d-inline-block px-md-3">
                                <p class="mb-1 text-muted">Other</p>
                                <h5 class="inline-flex items-center gap-1 mb-0">
                                    24565
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-span-12 lg:col-span-4">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between mb-3">
                    <h5 class="mb-0">Tickets requires action</h5>
                </div>
                <ul class="rounded-lg *:py-4 divide-y divide-inherit border-theme-border dark:border-themedark-border">
                    <li class="list-group-item">
                        <div class="flex items-center">
                            <div class="grow mx-1">
                                Ticket 1
                                <span class="badge text-white bg-warning-500">Pending</span>

                            </div>
                            <div class="grow mx-1">
                            </div>
                            <div class="shrink-0">
                                <a href="#" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-light-secondary">
                                    <i class="ti ti-eye text-xl leading-none"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="flex items-center">
                            <div class="grow mx-1">
                                Ticket 2
                                <span class="badge text-white bg-warning-500">Pending</span>

                            </div>
                            <div class="grow mx-1">
                            </div>
                            <div class="shrink-0">
                                <a href="#" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-light-secondary">
                                    <i class="ti ti-eye text-xl leading-none"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="flex items-center">
                            <div class="grow mx-1">
                                Ticket 3
                                <span class="badge text-white bg-warning-500">Pending</span>

                            </div>
                            <div class="grow mx-1">
                            </div>
                            <div class="shrink-0">
                                <a href="#" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-light-secondary">
                                    <i class="ti ti-eye text-xl leading-none"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="flex items-center">
                            <div class="grow mx-1">
                                Ticket 4
                                <span class="badge text-white bg-warning-500">Pending</span>

                            </div>
                            <div class="grow mx-1">
                            </div>
                            <div class="shrink-0">
                                <a href="#" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-light-secondary">
                                    <i class="ti ti-eye text-xl leading-none"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="flex items-center">
                            <div class="grow mx-1">
                                Ticket 5
                                <span class="badge text-white bg-warning-500">Pending</span>

                            </div>
                            <div class="grow mx-1">
                            </div>
                            <div class="shrink-0">
                                <a href="#" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-light-secondary">
                                    <i class="ti ti-eye text-xl leading-none"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="flex items-center">
                            <div class="grow mx-1">
                                Ticket 6
                                <span class="badge text-white bg-warning-500">Pending</span>

                            </div>
                            <div class="grow mx-1">
                            </div>
                            <div class="shrink-0">
                                <a href="#" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-light-secondary">
                                    <i class="ti ti-eye text-xl leading-none"></i>
                                </a>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <div class="col-span-12 lg:col-span-12">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between mb-3">
                    <h5 class="mb-0">Logs</h5>
                    <div class="dropdown">
                        <a
                            class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary dropdown-toggle arrow-none"
                            href="#"
                            data-pc-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <i class="ti ti-dots-vertical text-lg leading-none"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Today</a>
                            <a class="dropdown-item" href="#">Weekly</a>
                            <a class="dropdown-item" href="#">Monthly</a>
                        </div>
                    </div>
                </div>
                <ul class="rounded-lg *:py-3 divide-y divide-inherit border-theme-border dark:border-themedark-border">
                    <li class="list-group-item">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <img src="{{ asset('images/user/avatar-1.jpg') }}" alt="img" class="w-10 rounded-full" />
                            </div>
                            <div class="grow mx-3">
                                <h6 class="mb-0">Brieley join casual membership..</h6>
                            </div>
                            <div class="shrink-0">
                                <p class="mb-0 text-muted">Today | 9:00 AM</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <img src="{{ asset('images/user/avatar-2.jpg') }}" alt="img" class="w-10 rounded-full" />
                            </div>
                            <div class="grow mx-3">
                                <h6 class="mb-0">Ashton end membership planing</h6>
                            </div>
                            <div class="shrink-0">
                                <p class="mb-0 text-muted">Yesterday | 6:30 PM</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <img src="{{ asset('images/user/avatar-3.jpg') }}" alt="img" class="w-10 rounded-full" />
                            </div>
                            <div class="grow mx-3">
                                <h6 class="mb-1">Airi canceled in 2 months membership</h6>
                            </div>
                            <div class="shrink-0">
                                <p class="mb-0 text-muted">05 Feb | 3:45 PM</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <img src="{{ asset('images/user/avatar-4.jpg') }}" alt="img" class="w-10 rounded-full" />
                            </div>
                            <div class="grow mx-3">
                                <h6 class="mb-1">Colleen join Addicted membership</h6>
                            </div>
                            <div class="shrink-0">
                                <p class="mb-0 text-muted">05 Feb | 4:00 PM</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <img src="{{ asset('images/user/avatar-5.jpg') }}" alt="img" class="w-10 rounded-full" />
                            </div>
                            <div class="grow mx-3">
                                <h6 class="mb-1">Airi canceled in 2 months membership</h6>
                            </div>
                            <div class="shrink-0">
                                <p class="mb-0 text-muted">05 Feb | 3:45 PM</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <img src="{{ asset('images/user/avatar-6.jpg') }}" alt="img" class="w-10 rounded-full" />
                            </div>
                            <div class="grow mx-3">
                                <h6 class="mb-1">Colleen join Addicted membership</h6>
                            </div>
                            <div class="shrink-0">
                                <p class="mb-0 text-muted">05 Feb | 4:00 PM</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>


@endsection

@section('pre-scripts')
    <script src="{{ asset('js/plugins/apexcharts.min.js') }}"></script>
@endsection

@section('post-scripts')
    <script src="{{ asset('js/widgets/invites-goal-chart.js') }}"></script>
@endsection
