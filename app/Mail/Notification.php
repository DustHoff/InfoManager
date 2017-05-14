<?php

namespace App\Mail;

use App\Maintainable;
use App\Maintenance;
use App\Option;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notification extends Mailable
{
    use SerializesModels;
    /**
     * @var Maintenance
     */
    private $maintenance;
    private $maintainable;

    /**
     * Notification constructor.
     * @param Maintenance $maintenance
     * @param Maintainable $maintainable
     */
    public function __construct(Maintenance $maintenance,Maintainable $maintainable)
    {
        $this->maintenance = $maintenance;
        $this->maintainable = $maintainable;
        $this->subject("[" . __("maintenance." . $maintenance->type) . "] " . __("maintenance." . $maintenance->state) . " " . __("menu.for") . " " . $maintainable->name);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $header = Option::query()->where("name", "=", "email_header");
        $footer = Option::query()->where("name", "=", "email_footer");
        return $this->markdown("email.notification", ["maintenance" => $this->maintenance, "maintainable" => $this->maintainable, "header" => $header, "footer" => $footer]);
    }
}
