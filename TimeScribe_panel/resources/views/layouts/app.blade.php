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
    <div id="app" class="">
        
        @include('layouts.navbar')
        
        

        <main class="d-flex">

            @include('layouts.sidebar')
            <div class="content col-sm-10">
                @yield('content')
            </div>
            
        </main>
    </div>


    

</body>
</html>
