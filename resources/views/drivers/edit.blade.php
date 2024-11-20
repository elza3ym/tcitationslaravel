@extends('layout.master')
@section('content')
    <div class="col-span-12">
        <form action="{{ route('admin.drivers.update', $driver->id) }}" method="POST">
            @csrf
            @method('PUT')
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
                                                <input type="text"  name="name" id="name" class="form-control" value="{{ old('name', $driver->user->name) }}" required autofocus />
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback text-danger">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <div class="mb-3">
                                                <label class="form-label">Company</label>
                                                <select
                                                    class="form-control"
                                                    name="company_id"
                                                    id="companies"
                                                ></select>
                                                @if ($errors->has('company_id'))
                                                    <span class="invalid-feedback text-danger">
                                                            <strong>{{ $errors->first('company_id') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-span-12 sm:col-span-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $driver->user->email) }}" required/>
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
                                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $driver->user->phone) }}" />
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
                                                           id="dateOfBirth" value="{{ old('dob', $driver->user->dob) }}"/>
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
                                                <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $driver->user->address) }}" />
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
                                                <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $driver->user->city) }}" />
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
                                                    <option value="AL" {{ old('state', $driver->user->state) == 'AL' ? 'selected' : '' }}>Alabama</option>
                                                    <option value="AK" {{ old('state', $driver->user->state) == 'AK' ? 'selected' : '' }}>Alaska</option>
                                                    <option value="AZ" {{ old('state', $driver->user->state) == 'AZ' ? 'selected' : '' }}>Arizona</option>
                                                    <option value="AR" {{ old('state', $driver->user->state) == 'AR' ? 'selected' : '' }}>Arkansas</option>
                                                    <option value="CA" {{ old('state', $driver->user->state) == 'CA' ? 'selected' : '' }}>California</option>
                                                    <option value="CO" {{ old('state', $driver->user->state) == 'CO' ? 'selected' : '' }}>Colorado</option>
                                                    <option value="CT" {{ old('state', $driver->user->state) == 'CT' ? 'selected' : '' }}>Connecticut</option>
                                                    <option value="DE" {{ old('state', $driver->user->state) == 'DE' ? 'selected' : '' }}>Delaware</option>
                                                    <option value="DC" {{ old('state', $driver->user->state) == 'DC' ? 'selected' : '' }}>District Of Columbia</option>
                                                    <option value="FL" {{ old('state', $driver->user->state) == 'FL' ? 'selected' : '' }}>Florida</option>
                                                    <option value="GA" {{ old('state', $driver->user->state) == 'GA' ? 'selected' : '' }}>Georgia</option>
                                                    <option value="HI" {{ old('state', $driver->user->state) == 'HI' ? 'selected' : '' }}>Hawaii</option>
                                                    <option value="ID" {{ old('state', $driver->user->state) == 'ID' ? 'selected' : '' }}>Idaho</option>
                                                    <option value="IL" {{ old('state', $driver->user->state) == 'IL' ? 'selected' : '' }}>Illinois</option>
                                                    <option value="IN" {{ old('state', $driver->user->state) == 'IN' ? 'selected' : '' }}>Indiana</option>
                                                    <option value="IA" {{ old('state', $driver->user->state) == 'IA' ? 'selected' : '' }}>Iowa</option>
                                                    <option value="KS" {{ old('state', $driver->user->state) == 'KS' ? 'selected' : '' }}>Kansas</option>
                                                    <option value="KY" {{ old('state', $driver->user->state) == 'KY' ? 'selected' : '' }}>Kentucky</option>
                                                    <option value="LA" {{ old('state', $driver->user->state) == 'LA' ? 'selected' : '' }}>Louisiana</option>
                                                    <option value="ME" {{ old('state', $driver->user->state) == 'ME' ? 'selected' : '' }}>Maine</option>
                                                    <option value="MD" {{ old('state', $driver->user->state) == 'MD' ? 'selected' : '' }}>Maryland</option>
                                                    <option value="MA" {{ old('state', $driver->user->state) == 'MA' ? 'selected' : '' }}>Massachusetts</option>
                                                    <option value="MI" {{ old('state', $driver->user->state) == 'MI' ? 'selected' : '' }}>Michigan</option>
                                                    <option value="MN" {{ old('state', $driver->user->state) == 'MN' ? 'selected' : '' }}>Minnesota</option>
                                                    <option value="MS" {{ old('state', $driver->user->state) == 'MS' ? 'selected' : '' }}>Mississippi</option>
                                                    <option value="MO" {{ old('state', $driver->user->state) == 'MO' ? 'selected' : '' }}>Missouri</option>
                                                    <option value="MT" {{ old('state', $driver->user->state) == 'MT' ? 'selected' : '' }}>Montana</option>
                                                    <option value="NE" {{ old('state', $driver->user->state) == 'NE' ? 'selected' : '' }}>Nebraska</option>
                                                    <option value="NV" {{ old('state', $driver->user->state) == 'NV' ? 'selected' : '' }}>Nevada</option>
                                                    <option value="NH" {{ old('state', $driver->user->state) == 'NH' ? 'selected' : '' }}>New Hampshire</option>
                                                    <option value="NJ" {{ old('state', $driver->user->state) == 'NJ' ? 'selected' : '' }}>New Jersey</option>
                                                    <option value="NM" {{ old('state', $driver->user->state) == 'NM' ? 'selected' : '' }}>New Mexico</option>
                                                    <option value="NY" {{ old('state', $driver->user->state) == 'NY' ? 'selected' : '' }}>New York</option>
                                                    <option value="NC" {{ old('state', $driver->user->state) == 'NC' ? 'selected' : '' }}>North Carolina</option>
                                                    <option value="ND" {{ old('state', $driver->user->state) == 'ND' ? 'selected' : '' }}>North Dakota</option>
                                                    <option value="OH" {{ old('state', $driver->user->state) == 'OH' ? 'selected' : '' }}>Ohio</option>
                                                    <option value="OK" {{ old('state', $driver->user->state) == 'OK' ? 'selected' : '' }}>Oklahoma</option>
                                                    <option value="OR" {{ old('state', $driver->user->state) == 'OR' ? 'selected' : '' }}>Oregon</option>
                                                    <option value="PA" {{ old('state', $driver->user->state) == 'PA' ? 'selected' : '' }}>Pennsylvania</option>
                                                    <option value="RI" {{ old('state', $driver->user->state) == 'RI' ? 'selected' : '' }}>Rhode Island</option>
                                                    <option value="SC" {{ old('state', $driver->user->state) == 'SC' ? 'selected' : '' }}>South Carolina</option>
                                                    <option value="SD" {{ old('state', $driver->user->state) == 'SD' ? 'selected' : '' }}>South Dakota</option>
                                                    <option value="TN" {{ old('state', $driver->user->state) == 'TN' ? 'selected' : '' }}>Tennessee</option>
                                                    <option value="TX" {{ old('state', $driver->user->state) == 'TX' ? 'selected' : '' }}>Texas</option>
                                                    <option value="UT" {{ old('state', $driver->user->state) == 'UT' ? 'selected' : '' }}>Utah</option>
                                                    <option value="VT" {{ old('state', $driver->user->state) == 'VT' ? 'selected' : '' }}>Vermont</option>
                                                    <option value="VA" {{ old('state', $driver->user->state) == 'VA' ? 'selected' : '' }}>Virginia</option>
                                                    <option value="WA" {{ old('state', $driver->user->state) == 'WA' ? 'selected' : '' }}>Washington</option>
                                                    <option value="WV" {{ old('state', $driver->user->state) == 'WV' ? 'selected' : '' }}>West Virginia</option>
                                                    <option value="WI" {{ old('state', $driver->user->state) == 'WI' ? 'selected' : '' }}>Wisconsin</option>
                                                    <option value="WY" {{ old('state', $driver->user->state) == 'WY' ? 'selected' : '' }}>Wyoming</option>
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
                                                <input type="text" name="zip" id="zip" class="form-control" value="{{ old('zip', $driver->user->zip) }}"/>
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
                                                    <option value="UTC-12:00" {{ old('timezone', $driver->user->timezone) == 'UTC-12:00' ? 'selected' : '' }}>(UTC-12:00) International Date Line West</option>
                                                    <option value="UTC-11:00" {{ old('timezone', $driver->user->timezone) == 'UTC-11:00' ? 'selected' : '' }}>(UTC-11:00) Coordinated Universal Time-11</option>
                                                    <option value="UTC-10:00" {{ old('timezone', $driver->user->timezone) == 'UTC-10:00' ? 'selected' : '' }}>(UTC-10:00) Hawaii</option>
                                                    <option value="UTC-09:00" {{ old('timezone', $driver->user->timezone) == 'UTC-09:00' ? 'selected' : '' }}>(UTC-09:00) Alaska</option>
                                                    <option value="UTC-08:00" {{ old('timezone', $driver->user->timezone) == 'UTC-08:00' ? 'selected' : '' }}>(UTC-08:00) Pacific Time (US & Canada)</option>
                                                    <option value="UTC-07:00" {{ old('timezone', $driver->user->timezone) == 'UTC-07:00' ? 'selected' : '' }}>(UTC-07:00) Mountain Time (US & Canada)</option>
                                                    <option value="UTC-06:00" {{ old('timezone', $driver->user->timezone) == 'UTC-06:00' ? 'selected' : '' }}>(UTC-06:00) Central Time (US & Canada)</option>
                                                    <option value="UTC-05:00" {{ old('timezone', $driver->user->timezone) == 'UTC-05:00' ? 'selected' : '' }}>(UTC-05:00) Eastern Time (US & Canada)</option>
                                                    <option value="UTC-04:00" {{ old('timezone', $driver->user->timezone) == 'UTC-04:00' ? 'selected' : '' }}>(UTC-04:00) Atlantic Time (Canada)</option>
                                                    <option value="UTC-03:00" {{ old('timezone', $driver->user->timezone) == 'UTC-03:00' ? 'selected' : '' }}>(UTC-03:00) Greenland</option>
                                                    <option value="UTC-02:00" {{ old('timezone', $driver->user->timezone) == 'UTC-02:00' ? 'selected' : '' }}>(UTC-02:00) Mid-Atlantic</option>
                                                    <option value="UTC-01:00" {{ old('timezone', $driver->user->timezone) == 'UTC-01:00' ? 'selected' : '' }}>(UTC-01:00) Azores</option>
                                                    <option value="UTC+00:00" {{ old('timezone', $driver->user->timezone) == 'UTC+00:00' ? 'selected' : '' }}>(UTC+00:00) Coordinated Universal Time</option>
                                                    <option value="UTC+01:00" {{ old('timezone', $driver->user->timezone) == 'UTC+01:00' ? 'selected' : '' }}>(UTC+01:00) Amsterdam, Berlin, Rome</option>
                                                    <option value="UTC+02:00" {{ old('timezone', $driver->user->timezone) == 'UTC+02:00' ? 'selected' : '' }}>(UTC+02:00) Cairo, Jerusalem</option>
                                                    <option value="UTC+03:00" {{ old('timezone', $driver->user->timezone) == 'UTC+03:00' ? 'selected' : '' }}>(UTC+03:00) Moscow, Nairobi</option>
                                                    <option value="UTC+04:00" {{ old('timezone', $driver->user->timezone) == 'UTC+04:00' ? 'selected' : '' }}>(UTC+04:00) Dubai</option>
                                                    <option value="UTC+05:00" {{ old('timezone', $driver->user->timezone) == 'UTC+05:00' ? 'selected' : '' }}>(UTC+05:00) Islamabad, Karachi</option>
                                                    <option value="UTC+06:00" {{ old('timezone', $driver->user->timezone) == 'UTC+06:00' ? 'selected' : '' }}>(UTC+06:00) Dhaka</option>
                                                    <option value="UTC+07:00" {{ old('timezone', $driver->user->timezone) == 'UTC+07:00' ? 'selected' : '' }}>(UTC+07:00) Bangkok, Hanoi</option>
                                                    <option value="UTC+08:00" {{ old('timezone', $driver->user->timezone) == 'UTC+08:00' ? 'selected' : '' }}>(UTC+08:00) Beijing, Singapore</option>
                                                    <option value="UTC+09:00" {{ old('timezone', $driver->user->timezone) == 'UTC+09:00' ? 'selected' : '' }}>(UTC+09:00) Tokyo, Seoul</option>
                                                    <option value="UTC+10:00" {{ old('timezone', $driver->user->timezone) == 'UTC+10:00' ? 'selected' : '' }}>(UTC+10:00) Sydney, Vladivostok</option>
                                                    <option value="UTC+11:00" {{ old('timezone', $driver->user->timezone) == 'UTC+11:00' ? 'selected' : '' }}>(UTC+11:00) Solomon Islands</option>
                                                    <option value="UTC+12:00" {{ old('timezone', $driver->user->timezone) == 'UTC+12:00' ? 'selected' : '' }}>(UTC+12:00) Fiji, Auckland</option>
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
                                                       name="notification_email" role="switch" {{ old('notification_email', $driver->user->notification_email) ? 'checked' : '' }}/>
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
                                                       name="notification_sms" role="switch" {{ old('notification_sms', $driver->user->notification_sms) ? 'checked' : '' }}/>
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
                                                       name="notification_push" role="switch" {{ old('notification_push', $driver->user->notification_push) ? 'checked' : '' }}/>
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
                    <button type="submit" class="btn btn-primary mx-1">Update Driver</button>
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
        var companiesChoices = new Choices('#companies', {
            placeholder: true,
            placeholderValue: 'Company Name',
            maxItemCount: 5,
            shouldSort: false, // Optional: keeps the order of items as provided
        }).setChoices(function () {
            return fetch('{{ route('api.company.index') }}')
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    return [{
                        value: '',
                        label: 'Select an option',
                        disabled: true,
                        selected: {{ !old('company_id', $driver->company_id) ? 'true' : 'false' }} },
                        ...data.map(function (company) {
                        return {
                            value: company.id,
                            label: company.name,
                            selected: Number('{{ old('company_id', $driver->company_id) }}') === Number(company.id)
                        };
                    })];
                });
        });
    </script>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v10.2.1/ol.css">
    <link rel="stylesheet" href="{{ asset('css/plugins/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins/choices.min.css') }}" />
@endsection
