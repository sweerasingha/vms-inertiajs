<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name') }}</title>

    <meta name="keywords"
        content="IMake is a comprehensive ERP solution that streamlines your business operations, improves productivity, and boosts your bottom line. With modules for finance, manufacturing, supply chain, and more, IMake helps you manage your entire organization from one centralized platform. Get real-time insights, automate tasks, and optimize your workflows with IMake">
    <meta name="description"
        content="IMake is a comprehensive ERP solution that streamlines your business operations, improves productivity, and boosts your bottom line. With modules for finance, manufacturing, supply chain, and more, IMake helps you manage your entire organization from one centralized platform. Get real-time insights, automate tasks, and optimize your workflows with IMake" />

    <meta name="og:image" property="og:image" content="{{ asset('img/logo/logoN.png') }}" />
    <meta name="og:image:secure_url" property="og:image:secure_url"
        content="{{ asset('img/logo/logoN.png') }}" />
    <meta name="og:image:width" property="og:image:width" content="500" />
    <meta name="og:image:height" property="og:image:height" content="200" />
    <meta name="og:image:alt" property="og:image:alt" content="IMake | ERP solution" />
    <meta name="og:site_name" property="og:site_name" content="IMake" />
    <meta name="og:type" property="og:type" content="website" />
    <meta name="og:title" property="og:title"
        content="IMake | ERP solution" />
    <meta name="og:url" property="og:url" content="{{Request::url()}}" />
    <meta name="og:description" property="og:description"
        content="IMake is a comprehensive ERP solution that streamlines your business operations" />

    <meta name="twitter:image:src" content="{{ asset('img/logo/logoN.png') }}" />
    <meta name="twitter:site" content="@IMake" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="IMake | ERP solution" />
    <meta name="twitter:description"
        content="IMake is a comprehensive ERP solution that streamlines your business operations" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/logo/logoN.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/logo/logoN.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css"
        integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead


    <script type="text/javascript">
        window.Laravel = {
    csrfToken: "{{ csrf_token() }}",
    jsPermissions: {!! json_encode(auth()->check() ? auth()->user()->jsPermissions() : null) !!}
};

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"
        integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if (Session::has('alert-' . $msg))
                    var msg = '@php echo Session("alert-".$msg); @endphp';
                    @if ($msg == 'success')
                        setTimeout(() => {
                            alert(msg);
                            alertSuccess(msg);
                        }, 500);
                    @endif
                    @if ($msg == 'danger')
                        setTimeout(() => {
                            alert(msg);
                            alertDanger(msg);
                        }, 500);
                    @endif
                    @if ($msg == 'info')
                        setTimeout(() => {
                            alert(msg);
                            alertInfo(msg);
                        }, 500);
                    @endif
                    @if ($msg == 'warning')
                        setTimeout(() => {
                            alert(msg);
                            alertWarning(msg);
                        }, 500);
                    @endif
                @endif
            @endforeach
        });

        function alertDanger(msg) {
            $.toast({
                heading: 'Oops',
                text: msg,
                icon: 'error',
                loader: true,
                loaderBg: '#fff',
                showHideTransition: 'slide',
                hideAfter: 6000,
                position: 'top-right',
            })
        }

        function alertSuccess(msg) {
            $.toast({
                heading: 'Success',
                text: msg,
                icon: 'success',
                loader: true,
                loaderBg: '#fff',
                showHideTransition: 'slide',
                hideAfter: 6000,
                allowToastClose: false,
                position: 'bottom-center',
            })
        }

        function alertWarning(msg) {
            $.toast({
                heading: 'Warning',
                text: msg,
                icon: 'warning',
                loader: true,
                loaderBg: '#fff',
                showHideTransition: 'slide',
                hideAfter: 6000,
                allowToastClose: false,
                position: 'bottom-right',
            })
        }

        function alertInfo(msg) {
            $.toast({
                heading: 'Attention',
                text: msg,
                icon: 'info',
                loader: true,
                loaderBg: '#fff',
                showHideTransition: 'slide',
                hideAfter: 6000,
                allowToastClose: false,
                position: 'bottom-right',
            })
        }
    </script>
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
