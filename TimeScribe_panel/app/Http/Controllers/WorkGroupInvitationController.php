<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkGroupInvitationController extends Controller
{
    //

    public function inviteUser( Request $data ){

        $request = json_decode($data->getContent(), true);

        //Crear registro en Bd
        $invitationHash = insertInvitation( 
            $request[0]['workgroupId'], 
            $request[0]['guestEmail']
        );

        //Enviar email
        sendInvitationEmail(
            $request[0]['guestEmail'],
            $request[0]['adminName'],
            $request[0]['workgroupName'],
            $invitationHash
        );

    }

    protected function sendInvitationEmail( $guestName, $adminName, $workGroupName, $link ){

        Mail::to($guestEmail)->send(
            new WorkgroupInvitationMail($guestName, $adminName, $workGroupName, $link)
        );
    }


    public function insertInvitation($workGroupId, $developerEmail)
    {

        //Insert in workgroupsinvitations table
        $invitation = WorkGroupInvitation::create([
            'email' => $developerEmail,
            'hash' => Hash::make($developerEmail . $workGroupId),
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

        return $invitation->hash;

    }





}
