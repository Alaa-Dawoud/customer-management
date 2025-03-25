<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title', config('app.name'))</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/favicon/icon-png.png')}}" />
    <!-- CSS files -->
    @vite(['resources/css/admin.css'])
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
    @stack('styles')
</head>

<body>
    @stack('modals')
    <div class="page">
        <!-- Navbar -->
        <div class="sticky-top">
            @include('admin.partials.header')
            @include('admin.partials.navbar')
        </div>
        <div class="page-wrapper">
            @yield('content')
            @include('admin.partials.footer')
        </div>
    </div>
    <!-- Tabler Core -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @vite(['resources/js/admin.js'])

    @stack('scripts')
    <script type="text/javascript">
        window.addEventListener('alert', event => {
            //
        });
    </script>
</body>

</html>
