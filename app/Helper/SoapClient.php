<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dustin
 * Date: 18.11.2017
 * Time: 13:56
 */

namespace App\Helper;


use Illuminate\Support\Facades\Log;

class SoapClient extends \SoapClient
{

    private $debug;

    public function __construct($wsdl, $debug = false)
    {
        $this->debug = $debug;
        $opts = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false
            ),
            'http' => array(
                'user_agent' => 'Infomanager'
            )
        );

        $params = array(
            'cache_wsdl' => WSDL_CACHE_NONE,
            'encoding' => 'UTF-8',
            'verifypeer' => false,
            'verifyhost' => false,
            'exceptions' => 0,
            'trace' => 1,
            'location' => $wsdl,
            'connection_timeout' => 180,
            'stream_context' => stream_context_create($opts));
        try {
            parent::SoapClient($wsdl, $params);
        } catch (\Exception $exception) {
            if ($debug) {
                Log::info("Error: " . print_r(libxml_get_last_error(), true));
                Log::info("Request: " . print_r($this->__getLastRequest(), true));
                Log::info("Response: " . print_r($this->__getLastResponse(), true));
            }
        }
    }

    public function __doRequest($request, $location, $action, $version, $one_way = 0)
    {
        if ($this->debug) {
            Log::info("Location: " . $location);
            Log::info("Action: " . $action);
            Log::info("Request: " . print_r($request, true));
        }
        return parent::__doRequest($request, $location, $action, $version, $one_way);
    }

}