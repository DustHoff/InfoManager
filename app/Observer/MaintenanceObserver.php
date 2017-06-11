<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dustin
 * Date: 11.06.2017
 * Time: 10:28
 */

namespace App\Observer;


use App\Maintenance;
use garethp\ews\API;
use garethp\ews\API\Enumeration\BodyTypeType;
use garethp\ews\API\Enumeration\CalendarItemCreateOrDeleteOperationType;
use garethp\ews\API\Enumeration\ImportanceChoicesType;
use garethp\ews\API\Enumeration\ItemClassType;
use garethp\ews\API\Enumeration\SensitivityChoicesType;
use garethp\ews\API\Type;

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
        $request = [
            'Items' => [
                'CalendarItem' => [
                    'Start' => $maintenance->maintenance_start->format('c'),
                    'End' => $maintenance->maintenance_end->format('c'),
                    'Body' => [
                        'BodyType' => BodyTypeType::HTML,
                        '_value' => '<a href="' . route("maintenance", compact("maintenance")) . '">' . __("maintenance." . $maintenance->type) . "</a>"
                    ],
                    'Subject' => __("maintenance." . $maintenance->type),
                    'ItemClass' => ItemClassType::APPOINTMENT,
                    'Sensitivity' => SensitivityChoicesType::NORMAL,
                    'Categories' => $maintenance->getCategories(),
                    'Importance' => ImportanceChoicesType::NORMAL
                ]
            ],
            'SendMeetingInvitations' => CalendarItemCreateOrDeleteOperationType::SEND_TO_NONE
        ];
        $request = Type::buildFromArray($request);
        $response = $this->client->CreateItem($request);
        $maintenance->exchangeid = $response->get("id");

    }

    public function updated(Maintenance $maintenance)
    {
        if ($maintenance->type != Maintenance::TYPE[0]) return;
        if (isset($maintenance->exchangeid)) {
            $request = [
                "ItemChanges" => [
                    "ItemChange" => [
                        "ItemId" => ["Id" => $maintenance->exchangeid],
                        'Updates' => API\ItemUpdateBuilder::buildUpdateItemChanges('CalendarItem', 'calendar', [
                            "Start" => $maintenance->maintenance_start->format('c'),
                            "End" => $maintenance->maintenance_end->format('c')])
                    ]],
                'MessageDisposition' => 'SaveOnly',
                'ConflictResolution' => 'AlwaysOverwrite',
                'SendMeetingInvitationsOrCancellations' => CalendarItemCreateOrDeleteOperationType::SEND_TO_NONE
            ];

            $request = Type::buildFromArray($request);
            $response = $this->client->UpdateItem($request);
        }
    }
}