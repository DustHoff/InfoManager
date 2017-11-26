<?php

namespace App\Mail;

use App\Option;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangePassword extends Mailable
{
    use Queueable, SerializesModels;
    private $user;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject(__("mail.changePassword"));
        $template = Option::query()->where("name", "=", "message_changePassword")->first()->value;
        return $this->view(["secondsTemplateCacheExpires" => 0, "template" => $template], ["user" => $this->user]);
    }
}
