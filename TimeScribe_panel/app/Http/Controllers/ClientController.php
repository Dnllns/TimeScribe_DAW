<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkGroup;
use App\User;


class ClientController extends Controller
{

    public static function view_showClientProjects($clientId)
    {

        //Obtener los proyectos que pertenecen al cliente
        $client = User::find($clientId);
        $userWorkGroupId = $client->workgroup_id;
        $clientProjects = WorkGroup::find($userWorkGroupId)->projects()->where('client_id', $clientId)->get();
    
        return view('client/dashboard', ['clientProjects' => $clientProjects]);
    }

}
