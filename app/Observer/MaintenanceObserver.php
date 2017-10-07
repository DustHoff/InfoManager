<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dustin
 * Date: 11.06.2017
 * Time: 10:28
 */

namespace App\Observer;


use App\Maintenance;
use App\Option;
use garethp\ews\API;
use garethp\ews\API\Enumeration\BodyTypeType;
use garethp\ews\API\Enumeration\CalendarItemCreateOrDeleteOperationType;
use garethp\ews\API\Enumeration\ImportanceChoicesType;
use garethp\ews\API\Enumeration\ItemClassType;
use garethp\ews\API\Enumeration\SensitivityChoicesType;
use garethp\ews\API\Type;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Log;

class MaintenanceObserver
{
    private $client;

    /**
     * MaintenanceObserver constructor.
     */
    public function __construct()
    {
        $this->client = API::withUsernameAndPassword(env("MAIL_HOST"), env("MAIL_USERNAME"), env("MAIL_PASSWORD"))->getClient();
    }

    public function creating(Maintenance $maintenance)
    {
        if ($maintenance->type != Maintenance::TYPE[0]) return;
        $this->createCalendarItem($maintenance);
    }

    public function updating(Maintenance $maintenance)
    {
        if (isset($maintenance->exchangeid)) $this->updateCalendarItem($maintenance);
        else $this->createCalendarItem($maintenance);
    }

    public function createCalendarItem(Maintenance $maintenance)
    {
        $header = view(["template" => Option::query()->where("name", "=", "email_header")->first()->value],
            ["maintenance" => $maintenance,
                "maintainable" => ($maintenance->causedBy != null ? $maintenance->causedBy() : $maintenance->infected->first())]);
        $footer = view([
            "template" => Option::query()->where("name", "=", "email_footer")->first()->value],
            ["maintenance" => $maintenance,
                "maintainable" => ($maintenance->causedBy != null ? $maintenance->causedBy() : $maintenance->infected->first())]);

        $request = [
            'Items' => [
                'CalendarItem' => [
                    'Start' => $maintenance->maintenance_start->format('c'),
                    'End' => $maintenance->maintenance_end->format('c'),
                    'Body' => [
                        'BodyType' => BodyTypeType::HTML,
                        '_value' => view("email.notification", [
                            "maintenance" => $maintenance,
                            "maintainable" => ($maintenance->causedBy != null ? $maintenance->causedBy() : $maintenance->infected->first()),
                            "header" => $header,
                            "footer" => $footer])->render()
                    ],
                    'Subject' => $maintenance->getTitleAttribute(),
                    'ItemClass' => ItemClassType::APPOINTMENT,
                    'Sensitivity' => SensitivityChoicesType::NORMAL,
                    'Categories' => $maintenance->getCategories(),
                    'Importance' => ImportanceChoicesType::NORMAL
                ]
            ],
            'SendMeetingInvitations' => CalendarItemCreateOrDeleteOperationType::SEND_TO_NONE
        ];
        try {
            $request = Type::buildFromArray($request);
            $response = $this->client->CreateItem($request);
            $maintenance->exchangeid = $response->get("id");
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    public function updateCalendarItem(Maintenance $maintenance)
    {
        $request = [
            "ItemChanges" => [
                "ItemChange" => [
                    "ItemId" => ["Id" => $maintenance->exchangeid],
                    'Updates' => API\ItemUpdateBuilder::buildUpdateItemChanges('CalendarItem', 'calendar', [
                        "Start" => $maintenance->maintenance_start->format('c'),
                        "End" => $maintenance->maintenance_end->format('c'),
                        'Body' => [
                            'BodyType' => BodyTypeType::HTML,
                            '_value' => $this->buildBody($maintenance)
                        ]]),
                ]],
            'MessageDisposition' => 'SaveOnly',
            'ConflictResolution' => 'AlwaysOverwrite',
            'SendMeetingInvitationsOrCancellations' => CalendarItemCreateOrDeleteOperationType::SEND_TO_NONE
        ];
        try {
            $request = Type::buildFromArray($request);
            $response = $this->client->UpdateItem($request);
        } catch (\Exception $exception) {
            Log::error("Exchange Error: " . $exception->getMessage());
        }
    }

    private function buildBody(Maintenance $maintenance)
    {
        $header = view([
            "secondsTemplateCacheExpires" => 0,
            "template" => Option::query()->where("name", "=", "email_header")->first()->value],
            ["maintenance" => $maintenance,
                "maintainable" => ($maintenance->causedBy != null ? $maintenance->causedBy() : $maintenance->infected->first())]);
        $footer = view([
            "secondsTemplateCacheExpires" => 0,
            "template" => Option::query()->where("name", "=", "email_footer")->first()->value],
            ["maintenance" => $maintenance,
                "maintainable" => ($maintenance->causedBy != null ? $maintenance->causedBy() : $maintenance->infected->first())]);

        $markdown = new Markdown(view(), config('mail.markdown'));
        return $markdown->render("email.notification", [
            "maintenance" => $maintenance,
            "maintainable" => ($maintenance->causedBy != null ? $maintenance->causedBy() : $maintenance->infected->first()),
            "header" => $header,
            "footer" => $footer])->toHtml();
    }
}