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
        $this->sendInvitationEmail(
            $request[0]['guestEmail'],
            $request[0]['guestName'],
            $request[0]['adminName'],
            $request[0]['projectName'],
            $acceptInvitationLink
        );

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

        //Obtener  el registro de la invitacion
        $invitation = ClientInvitation::find($invitationId);

        //Validar que el hash es el mismo
        if($invitation->hash == $hash){

            //Actualizar registro de la invitacion
            //Marcar como usada
            $invitation->used = true;
            $invitation->save();

            //Crear usuario manualmente            
            $user = new User;
            $user->name = "";
            $user->email = $invitation->email;
            $user->password = "";

            $workgroupId = Project::find($invitation->project_id)->workgroup_id;
            $user->workgroup_id = $workgroupId;
            $user->is_admin = 0;
            $user->is_client = 1;

            $user->save();
            Auth::login($user);

            //redireccionar a el formulario de registro

            return ClientController::view_showClientProjects($user->id);


            // return view(
            //     'client/dashboard', 
            //     [ 
            //         'user' => $user, 
            //         'workgroupId' => $user->workgroup_id
            //     ]
            // );
            
        }else{
            
            return redirect('/home');

        }

    }



    public function registerClient( $workgroupId, Request $data){

        $user = Auth::user();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->is_client = 1;
        $user->save();

        return  ClientController::view_showClientProjects($clientId);

    }




}
