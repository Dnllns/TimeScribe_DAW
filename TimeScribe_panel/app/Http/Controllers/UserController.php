<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class UserController extends Controller
{
    //



    public function view_clientDashboard()
    {
        $clientProjects = $this->getClientProjects();
        return view('Client/Cl_Dashboard', ['clientProjects' => $clientProjects]);
    }


    public function getClientProjects()
    {
        $client_id = auth()->user()->id;

        //ELoquent query
        $clientProjects = Project::where('client_id', $client_id)->get();

        return $clientProjects;
    }


}
