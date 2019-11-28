<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WorkgroupInvitationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $guestName;
    public $guestEmail;
    public $adminName;
    public $workGroupName;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public function __construct($data)
    public function __construct($guestName, $adminName, $workGroupName, $link)

    {
        $this->guestName = $guestName;
        $this->adminName = $adminName;
        $this->workGroupName = $workGroupName;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $fromEmail = "suport@timescribe.com";
        // $fromEmail = env('SEND_EMAIL_ACCOUNT', false);

        return $this->from($fromEmail)
        ->view(
            'emails.invitationMail', 
            [
                'name' => $this->guestName,
                'adminName' => $this->adminName,
                'workGroupName' => $this->workGroupName,
                'link' => $this->link
            ]
        );
    }
}
