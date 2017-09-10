<!DOCTYPE html>
<html lang="en-en">
<head>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Layout head -->
    <link media="all" type="text/css" rel="stylesheet" href="/js/AppBase/Extensions/Bootstrap/css/bootstrap.min.css?rev={{ \Config::get('revision.rev') }}">
    <link media="all" type="text/css" rel="stylesheet" href="/js/AppBase/Extensions/BootstrapDatepicker/css/bootstrap-datepicker3.standalone.min.css?rev={{ \Config::get('revision.rev') }}">

    <link media="all" type="text/css" rel="stylesheet" href="/css/App/main.css?rev={{ \Config::get('revision.rev') }}">
    <link media="all" type="text/css" rel="stylesheet" href="/css/App/main-menu.css?rev={{ \Config::get('revision.rev') }}">
    <link media="all" type="text/css" rel="stylesheet" href="/css/App/buttons.css?rev={{ \Config::get('revision.rev') }}">
    <link media="all" type="text/css" rel="stylesheet" href="/css/App/columns.css?rev={{ \Config::get('revision.rev') }}">
    <!-- CSS :: CustomPage -->
    @yield('style')
</head>
<body>


    <!-- MAIN  -->

        @include('menu')
        <!-- Page Layout & Content -->
        @yield('content')

    <!-- END MAIN -->

    <!-- JavaScripts :: AppBase -->
    <script src="/js/AppBase/jQuery/jquery-2.2.1.min.js?rev={{ \Config::get('revision.rev') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js?rev={{ \Config::get('revision.rev') }}"></script>

    <script src="/js/AppBase/Extensions/Bootstrap/bootstrap.min.js?rev={{ \Config::get('revision.rev') }}"></script>
    <!-- JavaScripts :: AppCore -->
    <script src="/js/AppCore/Libraries/apiClient.js?rev={{ \Config::get('revision.rev') }}"></script>
    <script src="/js/AppCore/Libraries/tabView.js?rev={{ \Config::get('revision.rev') }}"></script>
    <script src="/js/AppCore/Libraries/mainMenuVC.js?rev={{ \Config::get('revision.rev') }}"></script>

    <!-- JavaScripts :: CustomPage -->
    @yield('scripts')

    <!-- Include SVG sprite -->
    @include('_svgSprite')
</body>
</html>
