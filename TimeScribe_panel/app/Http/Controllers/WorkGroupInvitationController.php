<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\WorkgroupInvitationMail;
use App\WorkGroupInvitation;
use App\User;




class WorkGroupInvitationController extends Controller
{
    //

    public function inviteUser( Request $data ){

        $request = json_decode($data->getContent(), true);

        //Crear registro en Bd
        $invitation = $this->insertInvitation(
            $request[0]['workgroupId'],
            $request[0]['guestEmail']
        );

        $acceptInvitationLink = route(
            'f-wg-acceptinvitation',
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
            $request[0]['workgroupName'],
            $acceptInvitationLink
        );

        return $invitation->id;

    }

    protected function sendInvitationEmail( $guestEmail, $guestName, $adminName, $workGroupName, $link ){

        Mail::to($guestEmail)->send(
            new WorkgroupInvitationMail($guestName, $adminName, $workGroupName, $link)
        );
    }


    public function insertInvitation($workGroupId, $developerEmail)
    {

        //Insert in workgroupsinvitations table
        $invitation = WorkGroupInvitation::create([
            'workgroup_id' => $workGroupId,
            'email' => $developerEmail,
            'hash' => md5($developerEmail . $workGroupId . Str::random(10)),
            'used' => false,
        ]);

        return $invitation;
    }


    public function acceptInvitation($invitationId, $hash){

        $todoCorrecto = true;

        //Obtener  el registro de la invitacion
        $invitation = WorkGroupInvitation::find($invitationId);

        //Commprobar usuario existente
        $existeUsuario = (User::where('email', $invitation->email)->get()->count() > 0);
        if($existeUsuario){
            $todoCorrecto = false;
        }

        //Validar que el hash es el mismo
        if($invitation->hash != $hash){
            $todoCorrecto = false;
        }


        if($todoCorrecto){

            //redireccionar a el formulario de registro
            return view(
                'user/mod',
                [
                    "workGroupId" => $invitation->workgroup_id,
                    'email' => $invitation->email,
                    'invitationId' => $invitation->id,
                    'formRoute' => route(
                        'f-wg-register-developer',
                        [
                            'workGroupId' => $invitation->workgroup_id,
                            'invitationId' => $invitationId
                        ]
                    )
                ]
            );
        }
        else{
            return redirect('/');
        }

    }



    public function registerUser( $workgroupId, $invitationId,  Request $data){

        //Crear usuario manualmente

        $user = new User;
        Auth::login($user);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->workgroup_id = $workgroupId;
        $user->is_admin = 0;
        $user->is_client = 0;
        $user->save();

        //Actualizar registro de la invitacion
        //Marcar como usada
        $invitation = WorkGroupInvitation::find($invitationId);
        $invitation->used = true;
        $invitation->save();

        return  WorkGroupController::view_show($workgroupId);

    }


    public function removeInvitation($invitationId){

        $invitation = WorkGroupInvitation::find($invitationId);
        $invitation->delete();
        return "true";
        // $invitation->save();

    }

}
