<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    @include('layouts.head')
    @yield('head')

</head>
<body>
    <div id="wrapper">

        <div id="content-wrapper" >

            @include('layouts.navbar')

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container my-5 mx-auto">
                    @yield('content')
                </div>

            </div>
            <!-- End of Main Content -->

            @include('layouts.footer')

        </div>

    </div>
</body>
</html>
