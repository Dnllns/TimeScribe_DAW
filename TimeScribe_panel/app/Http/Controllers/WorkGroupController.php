<?php

namespace App\Http\Controllers;

use App\WorkGroup;
use App\Project;
use Illuminate\Http\Request;


class WorkGroupController extends Controller
{
    //

    #region vistas

    public function view_newWorkGroup()
    {
        return view('workgroup/new');
    }

    public static function view_modWorkGroup($workGroupId, $isNew=false)
    {

        $workGroup = WorkGroup::find($workGroupId);
        $workGroupDevelopers = $workGroup->users()->get();
        $workGroupInvitations = $workGroup->workGroupInvitations()->get();

        if($workGroupInvitations->count() == 0){
            $workGroupInvitations = null;
        }

        return view(
            'workgroup/mod',
            [
                'workGroup' => $workGroup,
                'isNew' => $isNew,
                'workGroupDevelopers' => $workGroupDevelopers,
                'workGroupInvitations' => $workGroupInvitations,
            ]
        );
    }

    /**
     * VISUALIZAR WORKGROUP
     * ----------------------
     *
     * @return View
     */
    public static function view_show($workGroupId)
    {

        $workGroup = WorkGroup::find($workGroupId);

        //Si el usuario logeado es admin puede ver todos los proyectos
        //Sinó solo podra ver los proyectos en los que tenga permisos

        $currentUser =  auth()->user();
        $projects = null;
        $isAdmin = false;


        if( $currentUser->is_admin == 1){

            // USUARIO ADMIN
            $isAdmin = true;
            // Obtiene todos los proyectos del Workgroup
            $projects = $workGroup->projects()->get();
        }
        else{
            // Obtiene los proyectos del workgroup que le han sido asignados
            $projects = $currentUser->projects()
            ->where('permissions', Project::PERM_ALL)
            ->orWhere('permissions', Project::PERM_WORK )->get();
        }



        //Vista Mostrar Workgroup
        return view(
            'workgroup/show',
            [
                'workGroup' =>$workGroup ,
                'userProjects' => $projects,
                'isAdmin' => $isAdmin
            ]
        );

    }

    #endregion

    /**
     * Inserta en bd un nuevo workgroup y lo relaciona con el usuario mediante la tabla workgroups_users
     */
    protected function insertWorkgroup(Request $data)
    {

        //Insert in workgroups table
        $workGroup = WorkGroup::create([
            'name' => $data['name'],
        ]);


        // Añadir el workgroup al usuario que lo ha creado
        $currentUser = auth()->user();
        $currentUser->workgroup_id = $workGroup->id;
        $currentUser->is_admin = 1;
        $currentUser->save();

        return $this->view_show($workGroup->id);



    }

    /**
     * Actualiza el registro con el id pasado por parametro
     */
    protected function edit(Request $data, $workGroupId)
    {

        $workGroup = WorkGroup::find($workGroupId);
        $workGroup->name = $data['name'];
        $workGroup->save();
        return $this->view_show($workGroupId);

    }



    // protected function registerDeveloper( Request $data){


    //     $user = Auth::user();
    //     $user->name = $data['name'];
    //     $user->email = $data['email'];
    //     $user->password = $data['password'];


    //     $user->save();


    // }





}
