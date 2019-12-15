<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\ClientInvitationMail;
use App\ClientInvitation;
use App\User;
use App\Project;





class ClientInvitationController extends Controller
{
    //

    public function inviteClient( Request $data ){

        $request = json_decode($data->getContent(), true);

        //Crear registro en Bd
        $invitation = $this->insertInvitation(
            $request[0]['projectId'],
            $request[0]['guestEmail']
        );

        $acceptInvitationLink = route(
            'f-cl-acceptinvitation',
            [
                'invitationId'=> $invitation->id,
                'hash' => $invitation->hash
            ]
        );

        //Enviar email
        try {

            $this->sendInvitationEmail(
                $request[0]['guestEmail'],
                $request[0]['guestName'],
                $request[0]['adminName'],
                $request[0]['projectName'],
                $acceptInvitationLink
            );

            return $invitation->id;

        } catch (\Throwable $th) {

            return "false";

        }


    }

    protected function sendInvitationEmail( $guestEmail, $guestName, $adminName, $projectName, $link ){

        Mail::to($guestEmail)->send(
            new ClientInvitationMail($guestName, $adminName, $projectName, $link)
        );
    }


    public function insertInvitation($projectId, $clientEmail)
    {

        //Insert in clientinvitations table
        $invitation = ClientInvitation::create([
            'project_id' => $projectId,
            'email' => $clientEmail,
            'hash' => md5($clientEmail . $projectId . Str::random(10)),
            'used' => false,
        ]);

        return $invitation;
    }


    public function acceptInvitation($invitationId, $hash){

        $todoCorrecto = true;

        //Obtener  el registro de la invitacion
        $invitation = ClientInvitation::find($invitationId);
        $invitedProject = Project::find($invitation->project_id);


        //Commprobar usuario existente
        $existeUsuario = (User::where('email', $invitation->email)->get()->count() > 0);
        if($existeUsuario){
            $todoCorrecto = false;
        }

        //Validar que el hash es el mismo
        if($invitation->hash != $hash){
            $todoCorrecto = false;
        }

        //Comprobar que no hay errores
        if($todoCorrecto){

            //redireccionar a el formulario de registro
            return view(
                'user/mod',
                [
                    "workgroupId" => $invitedProject->workgroup_id,
                    'email' => $invitation->email,
                    'invitationId' => $invitation->id,
                    'formRoute' => route(
                        'f-pj-register-client',
                        [
                            'workGroupId' => $invitation->project_id,
                            'invitationId' => $invitationId
                        ]
                    )
                ]
            );

        }else {
            return redirect('/');
        }


    }



    public function deleteInvitation($invitationId){

        $invitation = ClientInvitation::find($invitationId);
        $invitation->delete();
    }


    public function registerClient($projectId, $invitationId,  Request $data){

        $user = new User;
        Auth::login($user);


        $workgroupId = Project::find($projectId)->workgroup_id;

        //Actualizar registro de la invitacion
        //Marcar como usada
        $invitation = ClientInvitation::find($invitationId);
        $invitation->used = true;
        $invitation->save();

        //Crear usuario manualmente

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->workgroup_id = $workgroupId;
        $user->is_admin = 0;
        $user->is_client = 1;
        $user->save();

        //Asignar usuario al proyecto
        $project = Project::find($projectId);
        $project->users()->attach(
            $user->id,
            [
                'project_id' => $projectId,
                'user_id' => $user->id,
                'permissions' => 2, //CLIENT PERMS
            ]
        );



        return  ClientController::view_showClientProjects($user->id);

    }

}
