<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr" dir="ltr" data-pc-theme_contrast="" data-pc-theme="light">
<!-- [Head] start -->

<head>
    <title>{{ env('APP_NAME') }} | Able Pro Dashboard Template</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
        name="description"
        content="Able Pro is trending dashboard template made using Bootstrap 5 design framework. Able Pro is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies."
    />
    <meta
        name="keywords"
        content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard"
    />
    <meta name="author" content="Phoenixcoded" />

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('images/favicon.svg') }}" type="image/x-icon" />
    <!-- [Font] Family -->
    <link rel="stylesheet" href="{{ asset('fonts/inter/inter.css') }}" id="main-font-link" />
    <!-- [phosphor Icons] https://phosphoricons.com/ -->
    <link rel="stylesheet" href="{{ asset('fonts/phosphor/duotone/style.css') }}" />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('fonts/tabler-icons.min.css') }}" />
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('fonts/feather.css') }}" />
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome.css') }}" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('fonts/material.css') }}" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" id="main-style-link" />

    <!-- [Page specific CSS] start -->
    @yield('css')
    <!-- [Page specific CSS] end -->
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
<!-- [ Pre-loader ] start -->
<div class="loader-bg fixed inset-0 bg-white z-[1034]">
    <div class="loader-track h-[5px] w-full inline-block absolute overflow-hidden top-0">
        <div class="loader-fill w-[300px] h-[5px] bg-primary-500 absolute top-0 left-0 transition-[transform_0.2s_linear] origin-left animate-[2.1s_cubic-bezier(0.65,0.815,0.735,0.395)_0s_infinite_normal_none_running_loader-animate]"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->
@yield('body')
<!-- Required Js -->
@yield('pre-scripts')
<script src="{{ asset('js/plugins/simplebar.min.js') }}"></script>
<script src="{{ asset('js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('js/icon/custom-icon.js') }}"></script>
<script src="{{ asset('js/plugins/feather.min.js') }}"></script>
<script src="{{ asset('js/plugins/component.js') }}"></script>
<script src="{{ asset('js/plugins/theme.js') }}"></script>
<script src="{{ asset('js/plugins/script.js') }}"></script>
<script src="{{ asset('js/plugins/sweetalert2.all.min.js') }}"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });
    @if(session('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        });
    @endif
    @if(session('error'))
    Toast.fire({
        icon: 'error',
        title: '{{ session('error') }}'
    });
    @endif
</script>
@yield('post-scripts')


<script>
    layout_change('false');
</script>

<script>
    layout_theme_contrast_change('false');
</script>

<script>
    change_box_container('false');
</script>

<script>
    layout_caption_change('true');
</script>

<script>
    layout_rtl_change('false');
</script>

<script>
    preset_change('preset-1');
</script>

<script>
    main_layout_change('vertical');
</script>


@include('layout.partials .themeCustomizer')
</body>
<!-- [Body] end -->

</html>
