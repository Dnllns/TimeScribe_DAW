@extends('layouts.app')

@section('content')


<!-- CREATE PROJECT FORM -->

<div class="row">
    <div class="col-12 col-md-12 mx-auto">

        <!-- Titulo y eslogan -->
        <div class='row'>
            <div class="col-12 mx-auto">
                <h1 class="text-title">TimeScribe</h1>
                <h2 class="text-slogan text-secondary">Control yout time, control your work...</h2>
            </div>
        </div>


        <div class="row p-3">
            <div class="col-12 col-md-6">
                <img src="/svg/logo_ts.svg" alt="TimeCribe icon" style="height:250px;" >
            </div>

            <div class="col-12 my-auto col-lg-6">

                <div class="card" style="font-size:1.2em;">

                    <div class="card-header bg-success">
                        <h3 class="m-0">Hey!! Wellcome</h3>
                    </div>
                    <div class="card-body p-4">


                        <div class="row">
                            <div class="col-auto">
                                <p class="my-auto" for="login_f">Are you registered?</p>
                            </div>
                            <div class="col">
                                <a href="/login" class="btn btn-primary text-white float-right" name ="login_f">Login</a>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-auto">
                                <p class="my-auto" for="login_f">Are you new?</p>
                            </div>
                            <div class="col">
                            <a href="/register" class="btn btn-success text-white float-right" name ="reg_f">Register</a>
                            </div>
                        </div>

                    </div>
                </div>




            </div>
        </div>




    </div>
</div>







@endsection
