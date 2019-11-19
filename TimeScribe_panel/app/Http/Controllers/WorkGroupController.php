<?php

namespace App\Http\Controllers;

use App\WorkGroup;
use Illuminate\Http\Request;

class WorkGroupController extends Controller
{
    //

    #region vistas

    public function view_newWorkGroup()
    {
        return view('workgroup/create');
    }

    public function view_modWorkGroup($workGroupId)
    {

        $workGroup = WorkGroup::find($workGroupId);
        $workGroupDevelopers = $workGroup->users()->get();
        $workGroupInvitations = $workGroup->workGroupInvitations()->get();

        return view(
            'workgroup/edit',
            [
                'workGroup' => $workGroup,
                'isNew' => false,
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
    public function view_show($workGroupId)
    {

        $workGroup = WorkGroup::find($workGroupId);

        //Si el usuario logeado es admin puede ver todos los proyectos
        //Sinó solo podra ver los proyectos en los que tenga permisos

        $currentUser =  auth()->user();
        $projects = null;

        if( $currentUser->is_admin == 1){
            $projects = $workGroup->projects()->get();
        }
        else{
            $projects = $currentUser->projects()->where('visible', 1)->get();
        }

        return view(
            'workgroup/show', 
            ['workGroup' =>$workGroup , 'userProjects' => $projects]
        );
    }

    public function createInvitation($workGroupId, $developerEmail)
    {

        //Insert in workgroupsinvitations table
        $invitation = WorkGroupInvitation::create([
            'email' => $developerEmail,
        ]);

        //Attach to workgroups_workgroupsinvitations table
        $invitation->workgroups()->attach(
            $invitation->id,
            [
                'workgroup_id' => $workGroupId,
                'invitation_id' => $invitation->id,
            ]
        );

        //timescribeteam@gmail.com
        //admin.timescribe2019

        //Send invitation email

        $to_name = "RECEIVER_NAME";
        $data = array("name" => "Ogbonna", "body" => "A test mail");
        Mail::send("emails.mail", $data, function ($message) use ($to_name, $developerEmail) {
            $message->to($developerEmail, $to_name)->subject("Laravel Test Mail");
            $message->from("timescribeteam@gmail.com", "Test Mail");
        });

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


        //Return to the project editor view
        return view(
            'workgroup/edit',
            ['workGroup' => $workGroup, 'isNew' => true]
        );

    }

    /**
     * Actualiza el registro con el id pasado por parametro
     */
    protected function edit(Request $data, $workGroupId)
    {

        $workGroup = WorkGroup::find($workGroupId);
        $workGroup->name = $data['name'];
        $workGroup->save();

    }

    protected function webSelectProject($workGroupId)
    {

        $userId = auth()->user()->id;
        $workGroup = WorkGroup::find($workGroupId);
        $projects = $workGroup->projects()->where('user_id', $userId)->get();

    }

    /**
     * Obtiene los proyectos pertenecientes a un workgroup
     */
    public function getProjects($workGroupId)
    {

        return $projects;

    }

}
