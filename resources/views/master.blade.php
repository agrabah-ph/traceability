<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

<<<<<<< HEAD
    <title>{{ config('app.name', 'Agrabah') }} | @yield('title')</title>
=======
    <title>Trace | @yield('title')</title>
>>>>>>> 522a3f927c46fa7ec5740b76d00b1c500d8459ff
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/favicon_io/site.webmanifest">

{{--    <link href="css/bootstrap.min.css" rel="stylesheet">--}}
    <link href="/css/app.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/css/template/animate.css" rel="stylesheet">
    <link href="/css/template/style.css" rel="stylesheet">
    @yield('styles')

</head>

<body class="pace-done skin-3">

<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">

                <li class="nav-header">
                    <div class="dropdown profile-element">
{{--                        <img alt="image" class="rounded-circle" src="/img/profile_small.jpg"/>--}}
                        <img alt="image" class="rounded-circle profile-pic" src="{{ authProfilePic(Auth::user()->id) }}"/>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold">{!! Auth::user()->name !!}</span>
{{--                            <span class="text-muted text-xs block">{{ getRoleName('display_name') }} <b class="caret"></b></span>--}}
                            <span class="text-muted text-xs block"> Farmer <b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Contacts</a></li>
                            <li><a class="dropdown-item" href="#">Mailbox</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item btn-logout" href="#" id="">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        Trace
                    </div>
                </li>

                @include('menu')

            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">

        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

                    {{-- slot for search bar --}}

                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message"><strong class="text-mams-blue">Welcome</strong> <strong class="text-mams-gray">to</strong> <strong class="text-mams-red">{!! config('app.name') !!}</strong>.</span>
                    </li>

                    {{-- slot for mail notification --}}

                    {{-- slot for general notification --}}

                    <li>
                        <a href="#" class="btn-logout"> <i class="fa fa-sign-out"></i> Log out </a>
                    </li>
                </ul>

            </nav>
        </div>

        @include('flash::message')

        <div id="app">
            @yield('content')
        </div>

        <div class="footer">
            <div class="float-right">
                <strong></strong>
            </div>
            <div>
<<<<<<< HEAD
                <strong>Copyright</strong> {{ config('app.name', 'Agrabah') }}
=======
                <strong></strong>
>>>>>>> 522a3f927c46fa7ec5740b76d00b1c500d8459ff
            </div>
        </div>

    </div>
    {{ Form::open(array('route' => 'logout', 'class' => 'sr-only', 'id' => 'form-logout')) }}
    @csrf
    {{ Form::close() }}
</div>

<!-- Mainly scripts -->
<script src="/js/app.js"></script>
{{--<script src="js/jquery-3.1.1.min.js"></script>--}}
<script src="/js/template/popper.min.js"></script>
{{--<script src="js/bootstrap.js"></script>--}}
<script src="/js/template/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/js/template/plugins/slimscroll/jquery.slimscroll.min.js"></script>

@yield('scripts')

<!-- Custom and plugin javascript -->
<script src="/js/template/inspinia.js"></script>
<script src="/js/template/plugins/pace/pace.min.js"></script>


</body>
</html>
