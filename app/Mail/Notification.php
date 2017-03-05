<?php

namespace App\Mail;

use App\Maintainable;
use App\Maintenance;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Notification extends Mailable
{
    use SerializesModels;
    /**
     * @var Maintenance
     */
    private $maintenance;

    /**
     * Notification constructor.
     * @param Maintenance $maintenance
     * @param Maintainable $maintainable
     */
    public function __construct(Maintenance $maintenance,Maintainable $maintainable)
    {
        $this->maintenance = $maintenance;
        $this->subject($maintenance->type." ".$maintenance->state." for ".$maintainable->name);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown("email.notification",["maintenance"=>$this->maintenance]);
    }
}
