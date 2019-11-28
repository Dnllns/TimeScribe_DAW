<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\WorkgroupInvitationMail;
use App\WorkGroupInvitation;



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
            'email' => $developerEmail,
            'hash' => md5($developerEmail . $workGroupId . Str::random(10)),
            'used' => false,
        ]);



        //Attach to workgroups_workgroupsinvitations table
        $invitation->workgroups()->attach(
            $invitation->id,
            [
                'workgroup_id' => $workGroupId,
                'invitation_id' => $invitation->id,
            ]
        );

        return $invitation;

    }


    public function acceptInvitation($invitationId, $hash){

        //Obtener  el registro de la invitacion
        $invitation = WorkGroupInvitation::find($invitationId);

        //Validar que el hash es el mismo
        if($invitation->hash == $hash){

            //Actualizar registro de la invitacion
            //Marcar como usada

            //Crear usuario manualmente

            //redireccionar a el formulario de editar usuario




        }





    }





}
