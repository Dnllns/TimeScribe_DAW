<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    
    <script src="/js/jquery-3.4.1.min.js" language="JavaScript" type="text/javascript" ></script>
    <script src="/js/enableTooltips.js" language="JavaScript" type="text/javascript"></script>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/myStyle.css') }}" rel="stylesheet">

    @yield('head')



</head>
<body>



    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- End of Sidebar -->
    
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
    
            <!-- Main Content -->
            <div id="content">
    
                <!-- TOP BAR NAVBAR -->
                @include('layouts.navbar') 

    
                <!-- Begin Page Content -->
                <div class="container-fluid pt-5">
                        @yield('content')                      
                </div>
                <!-- /.container-fluid -->
    
            </div>
            <!-- End of Main Content -->
    
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                    <span>Copyright © TimeScribe@dnllns 2019</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
    
        </div>
        <!-- End of Content Wrapper -->
    
    </div>


</body>
</html>
