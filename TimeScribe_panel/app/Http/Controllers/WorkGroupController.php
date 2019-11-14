<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkGroup;

class WorkGroupController extends Controller
{
    //


    #region vistas

    public function view_createWorkGroup(){
        return view('workgroup/create');
    }

    public function view_editWorkGroup($workgroupId){
        return view('workgroup/edit', ['workGroupId' => $workgroupId]);
    }

    #endregion





    /**
     * Inserta en bd un nuevo workgroup y lo relaciona con el usuario mediante la tabla workgroups_users
     */
    protected function create(Request $data)
    {

        //Insert in workgroups table
        $workGroup = WorkGroup::create([
            'name' => $data['name']
        ]);

        //insert in workgroups_users table
        $workGroup->users()->attach(
            $workGroup->id,
            [
                'workgroup_id' => $workGroup->id,
                'user_id' => auth()->user()->id,
                'admin' => 1,
            ]
        );


        //Return to the project editor view
        return view(
            'workgroup/edit',
            [ 'workGroup' => $workGroup, 'isNew' => true ]
        );

    }




    /**
     * Actualiza el registro con el id pasado por parametro
     */
    protected function edit(Request $data, $workGroupId){

        $workGroup = WorkGroup::find($workGroupId);
        $workGroup->name = $data['name'];
        $workGroup->save();

    }

    protected function webSelectProject( $workGroupId ){

        $userId = auth()->user()->id;
        $workGroup = WorkGroup::find($workGroupId);
        $projects = $workGroup->projects()->where('user_id', $userId )->get();







    }


    /**
     * Obtiene los proyectos pertenecientes a un workgroup
     */
    public function getProjects($workGroupId){


        return $projects;

    }

}
