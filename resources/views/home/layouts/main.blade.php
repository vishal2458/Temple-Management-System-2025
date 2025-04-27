<!DOCTYPE html>
<html lang="en">
<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Home')</title>
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">
    <!-- Css Start **************** -->
    @include('home.layouts.css')
    <!-- Css End **************** -->

</head>
<body>
     <!-- ================> preloader start here <================ -->
     <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ================> preloader ending here <================ -->
    @include('home.layouts.header')
    @yield('main-content')
    {{-- {{ dd($temples) }} --}}
    @include('home.layouts.footer')

    <!-- Js Start **************** -->
    <a href="#" class="scrollToTop"><i class="fas fa-arrow-up"></i><span class="pluse_1"></span><span class="pluse_2"></span></a>
    @include('home.layouts.js')

    <!-- Js End **************** -->
</body>
