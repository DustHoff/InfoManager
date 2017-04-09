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
use App\Monitoring\MonitoringHost;
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

        $response = $this->client->request("Post", env("zabbix_url") . "/api_jsonrpc.php", $data);
        //Log::debug($data);
        //Log::debug($response->getBody()->getContents());
        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody(), true);
            //Log::debug($result);
            return $result["result"];
        }
        return array();
    }

    /**
     * @return Collection
     */
    public function getList()
    {
        if(Cache::has("monitoring_list")) return Cache::get("monitoring_list");
        $rawdata = $this->zabbixMethod("host.get", ["output" => [env("monitoring_identifier_field"), env("monitoring_name_field")]]);
        $data = array();
        foreach ($rawdata as $row){
            $mh = new MonitoringHost;
            $mh->identifier = $row[env("monitoring_identifier_field")];
            $mh->external = $row;
            array_push($data,$mh);
        }
        Cache::put("monitoring_list",collect($data),Carbon::now()->addDay(1));
        return collect($data);
    }

    public function schedule(MonitoringHost $host, Maintenance $maintenance)
    {
    }

    public function getDataByID($identifier)
    {
        $data = $this->zabbixMethod("host.get",["filter" => ["hostid"=>$identifier],"output"=>env("monitoring_name_field")]);
        Log::debug($data);
        return $data;
    }
}