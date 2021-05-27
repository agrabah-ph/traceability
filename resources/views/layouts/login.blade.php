<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Trace | @yield('title')</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/favicon_io/site.webmanifest">

    <link href="/css/app.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/css/template/animate.css" rel="stylesheet">
    <link href="/css/template/style.css" rel="stylesheet">
    @yield('styles')
</head>

<body class="gray-bg">

<div id="app">

    @yield('content')

</div>


<!-- Mainly scripts -->
<script src="/js/app.js"></script>
{{--<script src="js/jquery-3.1.1.min.js"></script>--}}
<script src="/js/template/popper.min.js"></script>
{{--<script src="js/bootstrap.js"></script>--}}
<script src="/js/template/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/js/template/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="/js/template/inspinia.js"></script>
<script src="/js/template/plugins/pace/pace.min.js"></script>
@yield('scripts')
</body>

</html>
