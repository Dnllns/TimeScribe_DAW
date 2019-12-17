<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(Auth::user()->is_client == 1){
            return route('client_dashboard', ['clientId' => Auth::user()->id]);
        }
        else{
            $workgroupId = Auth::user()->workgroups()->first()->id;
            return route('v-wg-show', ['workgroupId' => $workgroupId]);

        }
    }
}
