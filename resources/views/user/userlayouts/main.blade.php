<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Ram')</title>
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">
    <!-- Css Start **************** -->
    @include('user.userlayouts.css')
    <!-- Css End **************** -->

</head>
<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <!-- Navbar Start **************** -->

                @include('user.userlayouts.header')

            <!-- Navbar End ****************** -->

            <!-- Sidebar Start *************** -->

                @include('user.userlayouts.sidebar')

            <!-- Sidebar End ***************** -->

            <!-- Main Content Start ***********-->
            <div class="main-content">

                @yield('main-content')

            </div>

            <!-- Main Content End *************-->

            <!-- Footer Start **************** -->

                @include('user.userlayouts.footer')

            <!-- Footer End ****************** -->
        </div>
    </div>
    <!-- Js Start **************** -->

    @include('user.userlayouts.js')

    <!-- Js End **************** -->
</body>
