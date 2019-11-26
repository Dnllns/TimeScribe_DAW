<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\User;


class UserController extends Controller
{
    //



    // /**
    // * Mostrar el workgroup al que pertenece el usuario en el sidebar
    // */

    // public function prepareSidebar(){

    //     $user = auth()->user();
    //     $workGroup = WorkGroup::find($user->workgroup_id);


    // }




    // public function view_clientDashboard()
    // {
    //     $clientProjects = $this->getClientProjects();
    //     return view('Client/Cl_Dashboard', ['clientProjects' => $clientProjects]);
    // }


    // public function getClientProjects()
    // {
    //     $client_id = auth()->user()->id;

    //     //ELoquent query
    //     $clientProjects = Project::where('client_id', $client_id)->get();

    //     return $clientProjects;
    // }


    public function deleteUser($userId){

        $user = User::find($userId);
        $user->delete();

    }


}
