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

        //Obtener  el registro de la invitacion
        $invitation = WorkGroupInvitation::find($invitationId);

        //Validar que el hash es el mismo
        if($invitation->hash == $hash){

            //Actualizar registro de la invitacion
            //Marcar como usada
            $invitation->used = true;
            $invitation->save();

            //Crear usuario manualmente
            $password = Str::random(10);
            $user = new User;
            $user->name = "";
            $user->email = $invitation->email;
            $user->password = $password;
            $user->workgroup_id = $invitation->workgroup_id;
            $user->is_admin = 0;
            $user->is_client = 0;
            $user->save();
            Auth::login($user);

            //redireccionar a el formulario de registro
            return view(
                'user/mod',
                [
                    'user' => $user,
                ]
            );

        }else{

            return redirect('/home');

        }

    }



    public function registerUser( $workgroupId, Request $data){

        $user = Auth::user();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        return  WorkGroupController::view_show($workgroupId);

    }


}
