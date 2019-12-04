<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientInvitationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $guestName;
    public $guestEmail;
    public $adminName;
    public $projectName;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public function __construct($data)
    public function __construct($guestName, $adminName, $projectName, $link)

    {
        $this->guestName = $guestName;
        $this->adminName = $adminName;
        $this->projectName = $projectName;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $fromEmail = "timescribeteam@gmail.com";

        return $this->from($fromEmail)
        ->view(
            'emails.clientInvitationMail', 
            [
                'name' => $this->guestName,
                'adminName' => $this->adminName,
                'projectName' => $this->projectName,
                'link' => $this->link
            ]
        );
    }
}
