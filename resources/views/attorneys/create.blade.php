@extends('layout.master')
@section('content')
    <div class="col-span-12">
        <form action="{{ route('admin.attorneys.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body !py-0">
                    <ul class="flex flex-wrap w-full font-medium text-center nav-tabs">
                        <li class="group active">
                            <a
                                href="javascript:void(0);"
                                data-pc-toggle="tab"
                                data-pc-target="profile"
                                class="inline-flex items-center mr-6 py-4 transition-all duration-300 ease-linear border-t-2 border-b-2 border-transparent group-[.active]:text-primary-500 group-[.active]:border-b-primary-500 hover:text-primary-500 active:text-primary-500"
                            >
                                <i class="ti ti-user ltr:mr-2 rtl:ml-2 text-lg leading-none"></i>
                                Profile Information
                            </a>
                        </li>
                        <li class="group">
                            <a
                                href="javascript:void(0);"
                                data-pc-toggle="tab"
                                data-pc-target="notification"
                                class="inline-flex items-center mr-6 py-4 transition-all duration-300 ease-linear border-t-2 border-b-2 border-transparent group-[.active]:text-primary-500 group-[.active]:border-b-primary-500 hover:text-primary-500 active:text-primary-500"
                            >
                                <i class="ti ti-bell-ringing ltr:mr-2 rtl:ml-2 text-lg leading-none"></i>
                                Notification Settings
                            </a>
                        </li>
                        <li class="group">
                            <a
                                href="javascript:void(0);"
                                data-pc-toggle="tab"
                                data-pc-target="officeHoursTab"
                                class="inline-flex items-center mr-6 py-4 transition-all duration-300 ease-linear border-t-2 border-b-2 border-transparent group-[.active]:text-primary-500 group-[.active]:border-b-primary-500 hover:text-primary-500 active:text-primary-500"
                            >
                                <i class="ti ti-clock ltr:mr-2 rtl:ml-2 text-lg leading-none"></i>
                                Office Hours
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div class="block tab-pane" id="profile">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 lg:col-span-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Profile Information</h5>
                                    <span class="text-muted text-sm">
                                            {{ __("Update your account's profile information and email address.") }}
                                        </span>
                                </div>
                                <div class="card-body">
                                    <div class="grid grid-cols-12 gap-6">
                                        <div class="col-span-12 sm:col-span-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="name">Name</label>
                                                <input type="text"  name="name" id="name" class="form-control" value="{{ old('name') }}" required autofocus />
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback text-danger">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required />
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback text-danger">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="password">Password</label>
                                                <input type="password" name="password" id="password" class="form-control"/>
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback text-danger">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="phone">Phone</label>
                                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" />
                                                @if ($errors->has('phone'))
                                                    <span class="invalid-feedback text-danger">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="dateOfBirth">Date of birth</label>
                                                <div class="input-group date">
                                                    <input type="text" name="dob" class="form-control" placeholder="Select date"
                                                           id="dateOfBirth" value="{{ old('dob') }}"/>
                                                    <span class="input-group-text">
                                                          <i class="feather icon-calendar"></i>
                                                        </span>
                                                </div>
                                                @if ($errors->has('dob'))
                                                    <span class="invalid-feedback text-danger">
                                                            <strong>{{ $errors->first('dob') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="address">Address</label>
                                                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" />
                                                @if ($errors->has('address'))
                                                    <span class="invalid-feedback text-danger">
                                                            <strong>{{ $errors->first('address') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="city">City</label>
                                                <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}" />
                                                @if ($errors->has('city'))
                                                    <span class="invalid-feedback text-danger">
                                                            <strong>{{ $errors->first('city') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="state">State</label>
                                                <select class="form-control" name="state" data-trigger name="state" id="state">
                                                    <option value="AL" {{ old('state') == 'AL' ? 'selected' : '' }}>Alabama</option>
                                                    <option value="AK" {{ old('state') == 'AK' ? 'selected' : '' }}>Alaska</option>
                                                    <option value="AZ" {{ old('state') == 'AZ' ? 'selected' : '' }}>Arizona</option>
                                                    <option value="AR" {{ old('state') == 'AR' ? 'selected' : '' }}>Arkansas</option>
                                                    <option value="CA" {{ old('state') == 'CA' ? 'selected' : '' }}>California</option>
                                                    <option value="CO" {{ old('state') == 'CO' ? 'selected' : '' }}>Colorado</option>
                                                    <option value="CT" {{ old('state') == 'CT' ? 'selected' : '' }}>Connecticut</option>
                                                    <option value="DE" {{ old('state') == 'DE' ? 'selected' : '' }}>Delaware</option>
                                                    <option value="DC" {{ old('state') == 'DC' ? 'selected' : '' }}>District Of Columbia</option>
                                                    <option value="FL" {{ old('state') == 'FL' ? 'selected' : '' }}>Florida</option>
                                                    <option value="GA" {{ old('state') == 'GA' ? 'selected' : '' }}>Georgia</option>
                                                    <option value="HI" {{ old('state') == 'HI' ? 'selected' : '' }}>Hawaii</option>
                                                    <option value="ID" {{ old('state') == 'ID' ? 'selected' : '' }}>Idaho</option>
                                                    <option value="IL" {{ old('state') == 'IL' ? 'selected' : '' }}>Illinois</option>
                                                    <option value="IN" {{ old('state') == 'IN' ? 'selected' : '' }}>Indiana</option>
                                                    <option value="IA" {{ old('state') == 'IA' ? 'selected' : '' }}>Iowa</option>
                                                    <option value="KS" {{ old('state') == 'KS' ? 'selected' : '' }}>Kansas</option>
                                                    <option value="KY" {{ old('state') == 'KY' ? 'selected' : '' }}>Kentucky</option>
                                                    <option value="LA" {{ old('state') == 'LA' ? 'selected' : '' }}>Louisiana</option>
                                                    <option value="ME" {{ old('state') == 'ME' ? 'selected' : '' }}>Maine</option>
                                                    <option value="MD" {{ old('state') == 'MD' ? 'selected' : '' }}>Maryland</option>
                                                    <option value="MA" {{ old('state') == 'MA' ? 'selected' : '' }}>Massachusetts</option>
                                                    <option value="MI" {{ old('state') == 'MI' ? 'selected' : '' }}>Michigan</option>
                                                    <option value="MN" {{ old('state') == 'MN' ? 'selected' : '' }}>Minnesota</option>
                                                    <option value="MS" {{ old('state') == 'MS' ? 'selected' : '' }}>Mississippi</option>
                                                    <option value="MO" {{ old('state') == 'MO' ? 'selected' : '' }}>Missouri</option>
                                                    <option value="MT" {{ old('state') == 'MT' ? 'selected' : '' }}>Montana</option>
                                                    <option value="NE" {{ old('state') == 'NE' ? 'selected' : '' }}>Nebraska</option>
                                                    <option value="NV" {{ old('state') == 'NV' ? 'selected' : '' }}>Nevada</option>
                                                    <option value="NH" {{ old('state') == 'NH' ? 'selected' : '' }}>New Hampshire</option>
                                                    <option value="NJ" {{ old('state') == 'NJ' ? 'selected' : '' }}>New Jersey</option>
                                                    <option value="NM" {{ old('state') == 'NM' ? 'selected' : '' }}>New Mexico</option>
                                                    <option value="NY" {{ old('state') == 'NY' ? 'selected' : '' }}>New York</option>
                                                    <option value="NC" {{ old('state') == 'NC' ? 'selected' : '' }}>North Carolina</option>
                                                    <option value="ND" {{ old('state') == 'ND' ? 'selected' : '' }}>North Dakota</option>
                                                    <option value="OH" {{ old('state') == 'OH' ? 'selected' : '' }}>Ohio</option>
                                                    <option value="OK" {{ old('state') == 'OK' ? 'selected' : '' }}>Oklahoma</option>
                                                    <option value="OR" {{ old('state') == 'OR' ? 'selected' : '' }}>Oregon</option>
                                                    <option value="PA" {{ old('state') == 'PA' ? 'selected' : '' }}>Pennsylvania</option>
                                                    <option value="RI" {{ old('state') == 'RI' ? 'selected' : '' }}>Rhode Island</option>
                                                    <option value="SC" {{ old('state') == 'SC' ? 'selected' : '' }}>South Carolina</option>
                                                    <option value="SD" {{ old('state') == 'SD' ? 'selected' : '' }}>South Dakota</option>
                                                    <option value="TN" {{ old('state') == 'TN' ? 'selected' : '' }}>Tennessee</option>
                                                    <option value="TX" {{ old('state') == 'TX' ? 'selected' : '' }}>Texas</option>
                                                    <option value="UT" {{ old('state') == 'UT' ? 'selected' : '' }}>Utah</option>
                                                    <option value="VT" {{ old('state') == 'VT' ? 'selected' : '' }}>Vermont</option>
                                                    <option value="VA" {{ old('state') == 'VA' ? 'selected' : '' }}>Virginia</option>
                                                    <option value="WA" {{ old('state') == 'WA' ? 'selected' : '' }}>Washington</option>
                                                    <option value="WV" {{ old('state') == 'WV' ? 'selected' : '' }}>West Virginia</option>
                                                    <option value="WI" {{ old('state') == 'WI' ? 'selected' : '' }}>Wisconsin</option>
                                                    <option value="WY" {{ old('state') == 'WY' ? 'selected' : '' }}>Wyoming</option>
                                                </select>
                                                @if ($errors->has('state'))
                                                    <span class="invalid-feedback text-danger">
                                                            <strong>{{ $errors->first('state') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="zip">Zip code</label>
                                                <input type="text" name="zip" id="zip" class="form-control" value="{{ old('zip') }}"/>
                                                @if ($errors->has('zip'))
                                                    <span class="invalid-feedback text-danger">
                                                            <strong>{{ $errors->first('zip') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="timezone">Timezone</label>
                                                <select name="timezone" id="timezone" class="form-control">
                                                    <option value="">Select a Timezone</option>
                                                    <option value="UTC-12:00" {{ old('timezone') == 'UTC-12:00' ? 'selected' : '' }}>(UTC-12:00) International Date Line West</option>
                                                    <option value="UTC-11:00" {{ old('timezone') == 'UTC-11:00' ? 'selected' : '' }}>(UTC-11:00) Coordinated Universal Time-11</option>
                                                    <option value="UTC-10:00" {{ old('timezone') == 'UTC-10:00' ? 'selected' : '' }}>(UTC-10:00) Hawaii</option>
                                                    <option value="UTC-09:00" {{ old('timezone') == 'UTC-09:00' ? 'selected' : '' }}>(UTC-09:00) Alaska</option>
                                                    <option value="UTC-08:00" {{ old('timezone') == 'UTC-08:00' ? 'selected' : '' }}>(UTC-08:00) Pacific Time (US & Canada)</option>
                                                    <option value="UTC-07:00" {{ old('timezone') == 'UTC-07:00' ? 'selected' : '' }}>(UTC-07:00) Mountain Time (US & Canada)</option>
                                                    <option value="UTC-06:00" {{ old('timezone') == 'UTC-06:00' ? 'selected' : '' }}>(UTC-06:00) Central Time (US & Canada)</option>
                                                    <option value="UTC-05:00" {{ old('timezone') == 'UTC-05:00' ? 'selected' : '' }}>(UTC-05:00) Eastern Time (US & Canada)</option>
                                                    <option value="UTC-04:00" {{ old('timezone') == 'UTC-04:00' ? 'selected' : '' }}>(UTC-04:00) Atlantic Time (Canada)</option>
                                                    <option value="UTC-03:00" {{ old('timezone') == 'UTC-03:00' ? 'selected' : '' }}>(UTC-03:00) Greenland</option>
                                                    <option value="UTC-02:00" {{ old('timezone') == 'UTC-02:00' ? 'selected' : '' }}>(UTC-02:00) Mid-Atlantic</option>
                                                    <option value="UTC-01:00" {{ old('timezone') == 'UTC-01:00' ? 'selected' : '' }}>(UTC-01:00) Azores</option>
                                                    <option value="UTC+00:00" {{ old('timezone') == 'UTC+00:00' ? 'selected' : '' }}>(UTC+00:00) Coordinated Universal Time</option>
                                                    <option value="UTC+01:00" {{ old('timezone') == 'UTC+01:00' ? 'selected' : '' }}>(UTC+01:00) Amsterdam, Berlin, Rome</option>
                                                    <option value="UTC+02:00" {{ old('timezone') == 'UTC+02:00' ? 'selected' : '' }}>(UTC+02:00) Cairo, Jerusalem</option>
                                                    <option value="UTC+03:00" {{ old('timezone') == 'UTC+03:00' ? 'selected' : '' }}>(UTC+03:00) Moscow, Nairobi</option>
                                                    <option value="UTC+04:00" {{ old('timezone') == 'UTC+04:00' ? 'selected' : '' }}>(UTC+04:00) Dubai</option>
                                                    <option value="UTC+05:00" {{ old('timezone') == 'UTC+05:00' ? 'selected' : '' }}>(UTC+05:00) Islamabad, Karachi</option>
                                                    <option value="UTC+06:00" {{ old('timezone') == 'UTC+06:00' ? 'selected' : '' }}>(UTC+06:00) Dhaka</option>
                                                    <option value="UTC+07:00" {{ old('timezone') == 'UTC+07:00' ? 'selected' : '' }}>(UTC+07:00) Bangkok, Hanoi</option>
                                                    <option value="UTC+08:00" {{ old('timezone') == 'UTC+08:00' ? 'selected' : '' }}>(UTC+08:00) Beijing, Singapore</option>
                                                    <option value="UTC+09:00" {{ old('timezone') == 'UTC+09:00' ? 'selected' : '' }}>(UTC+09:00) Tokyo, Seoul</option>
                                                    <option value="UTC+10:00" {{ old('timezone') == 'UTC+10:00' ? 'selected' : '' }}>(UTC+10:00) Sydney, Vladivostok</option>
                                                    <option value="UTC+11:00" {{ old('timezone') == 'UTC+11:00' ? 'selected' : '' }}>(UTC+11:00) Solomon Islands</option>
                                                    <option value="UTC+12:00" {{ old('timezone') == 'UTC+12:00' ? 'selected' : '' }}>(UTC+12:00) Fiji, Auckland</option>
                                                </select>
                                                @if ($errors->has('timezone'))
                                                    <span class="invalid-feedback text-danger">
                                                        <strong>{{ $errors->first('timezone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden tab-pane" id="notification">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 lg:col-span-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Notification Settings</h5>
                                    <span class="text-muted text-sm">
                                        {{ __('Customize notification settings of what you want to get notified about.') }}
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="col-span-6 sm:col-span-6 border-b-2 mb-5 pb-5">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="mb-1">Email Notification</p>
                                                <p class="text-muted text-sm mb-0">Get notified by email.</p>
                                            </div>
                                            <div class="form-check form-switch p-0">
                                                <input class="form-check-input h4 position-relative m-0" type="checkbox"
                                                       name="notification_email" role="switch" {{ old('notification_email') ? 'checked' : '' }}/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6 border-b-2 mb-5 pb-5">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="mb-1">SMS Notification</p>
                                                <p class="text-muted text-sm mb-0">Get notified by SMS ( Need to have phone number set ).</p>
                                            </div>
                                            <div class="form-check form-switch p-0">
                                                <input class="form-check-input h4 position-relative m-0" type="checkbox"
                                                       name="notification_sms" role="switch" {{ old('notification_sms') ? 'checked' : '' }}/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6 border-b-2 mb-5 pb-5">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="mb-1">Push Notification</p>
                                                <p class="text-muted text-sm mb-0">Get notified by browser push notification.</p>
                                            </div>
                                            <div class="form-check form-switch p-0">
                                                <input class="form-check-input h4 position-relative m-0" type="checkbox"
                                                       name="notification_push" role="switch" {{ old('notification_push') ? 'checked' : '' }}/>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden tab-pane" id="officeHoursTab">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 lg:col-span-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Office Hours</h5>
                                    <span class="text-muted text-sm">
                                        {{ __("Attorney office hours he's available.") }}
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="grid grid-cols-12 gap-6 items-center">
                                        <div class="col-span-12 sm:col-span-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="officeHoursStart">Office Hours Start</label>
                                                <input type="text" name="office_hours_start" id="officeHoursStart" class="form-control" value="{{ old('office_hours_start') }}" />
                                                @if ($errors->has('office_hours_start'))
                                                    <span class="invalid-feedback text-danger">
                                                        <strong>{{ $errors->first('office_hours_start') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="officeHoursEnd">Office Hours End</label>
                                                <input type="text" name="office_hours_end" id="officeHoursEnd" class="form-control" value="{{ old('office_hours_end') }}" />
                                                @if ($errors->has('office_hours_end'))
                                                    <span class="invalid-feedback text-danger">
                                                        <strong>{{ $errors->first('office_hours_end') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 text-right">
                    <button type="reset" class="btn btn-outline-secondary mx-1">Cancel</button>
                    <button type="submit" class="btn btn-primary mx-1">Create Attorney</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('post-scripts')
    <script src="{{ asset('js/plugins/flatpickr.min.js') }}"></script>
    <script src="{{ asset('js/plugins/choices.min.js') }}"></script>
    <script>
        flatpickr(document.querySelector('#dateOfBirth'));
        // Initialize the start time picker
        const startTimePicker = flatpickr("#officeHoursStart", {
            noCalendar: true,
            enableTime: true,
            dateFormat: "H:i", // 24-hour format
            time_24hr: true, // Use 24-hour format
            onChange: function (selectedDates, dateStr, instance) {
                if (selectedDates.length > 0) {
                    // Set the min time for the end time picker based on the selected start time
                    endTimePicker.set("minTime", dateStr);
                }
            }
        });

        // Initialize the end time picker
        const endTimePicker = flatpickr("#officeHoursEnd", {
            noCalendar: true,
            enableTime: true,
            dateFormat: "H:i", // 24-hour format
            time_24hr: true, // Use 24-hour format
            onChange: function (selectedDates, dateStr, instance) {
                if (selectedDates.length > 0) {
                    // Set the max time for the start time picker based on the selected end time
                    startTimePicker.set("maxTime", dateStr);
                }
            }
        });
    </script>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v10.2.1/ol.css">
    <link rel="stylesheet" href="{{ asset('css/plugins/flatpickr.min.css') }}" />
@endsection
