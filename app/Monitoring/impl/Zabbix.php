<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dustin
 * Date: 08.04.2017
 * Time: 19:45
 */

namespace App\Monitoring\impl;


use App\Maintenance;
use App\Monitoring\Monitoring;
use App\Monitoring\MonitoringItem;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Zabbix implements Monitoring
{
    const API = "/api_jsonrpc.php";
    /**
     * @var Client
     */
    private $client;
    private $auth = null;

    function __construct()
    {
        $this->client = new Client();

        $this->auth = $this->zabbixMethod("user.login", ["user" => env("zabbix_user"), "password" => env("zabbix_password")]);
    }

    public function zabbixMethod($zabbixMethod, $param = null)
    {
        $data = [
            "verify" => false,
            "json" => [
                "jsonrpc" => "2.0",
                "method" => $zabbixMethod,
                "params" => $param,
                "id" => random_int(0, 10000),
                "auth" => $this->auth
            ]
        ];
        try {
            $response = $this->client->request("Post", env("zabbix_url") . "/api_jsonrpc.php", $data);
        } catch (\Exception $e) {
            Log::error("Error while reaching zabbix. " . $e->getMessage());
            return array();
        }
        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody(), true);
            Log::debug(["Zabbix", $result]);
            if (array_key_exists("result", $result)) return $result["result"];
        }
        return array();
    }

    /**
     * @return Collection
     */
    public function getList()
    {
        if (Cache::has("monitoring_list")) return Cache::get("monitoring_list");
        $rawdata = $this->zabbixMethod("host.get", ["output" => [env("monitoring_identifier_field"), env("monitoring_name_field")], "sortfield" => env("monitoring_name_field")]);
        $data = collect();
        foreach ($rawdata as $row) {
            $mh = new MonitoringItem($row);
            $data->push($mh);
        }
        Cache::put("monitoring_list", $data, Carbon::now()->addDay(1));
        return Cache::get("monitoring_list");
    }

    public function schedule(Maintenance $maintenance)
    {
        $ids = array_filter(array_column($maintenance->infected->toArray(), "monitoring_id"));
        if (empty($ids)) return;
        $response = $this->zabbixMethod("maintenance.create", [
            "name" => $maintenance->type . " " . $maintenance->id,
            "active_since" => $maintenance->maintenance_start->timestamp,
            "active_till" => $maintenance->maintenance_end->timestamp,
            "hostids" => $ids,
            "timeperiods" => [
                (object)[
                    "timeperiod_type" => 0,
                    "start_date" => $maintenance->maintenance_start->timestamp,
                    "period" => $maintenance->maintenance_end->timestamp - $maintenance->maintenance_start->timestamp
                ]
            ]
        ]);
        $maintenance->monitoring_id = $response["maintenanceids"][0];
        $maintenance->save();
    }

    public function getDataByID($identifier)
    {
        $data = $this->zabbixMethod("host.get", ["filter" => ["hostid" => $identifier], "output" => env("monitoring_name_field")]);
        return $data;
    }

    public function deleteSchedule(Maintenance $maintenance)
    {
        $this->zabbixMethod("maintenance.delete", [$maintenance->monitoring_id]);
    }
}