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
use GuzzleHttp\Client;

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
            //    Log::debug($result);
            return $result["result"];
        }
        return array();
    }

    public function listHosts()
    {
        $result = array();
        foreach ($this->zabbixMethod("host.get", ["output" => ["hostid", "host"]]) as $hostdata) {
            $host = new MonitoringHost();
            $host->setIdentifier($hostdata["hostid"]);
            $host->setDisplayName($hostdata["host"]);
            array_push($result, $host);
        }
        return $result;
    }

    public function schedule(MonitoringHost $host, Maintenance $maintenance)
    {
    }
}