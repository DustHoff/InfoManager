<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dustin
 * Date: 21.10.2017
 * Time: 13:07
 */

namespace App\Jobs\impl;


use App\Helper\SoapClient;
use App\Host;
use App\Jobs\HostImportJob;
use SoapVar;

class EsxiHostImportJob extends HostImportJob
{
    protected $username;
    protected $password;

    public function __construct(Host $host, $username, $password, $repeat)
    {
        parent::__construct($host, $repeat);
        $this->username = $username;
        $this->password = encrypt($password);

    }

    public function pullHosts()
    {
        $client = new SoapClient("https://" . $this->esxi->address . "/sdk/vimService.wsdl", env("APP_DEBUG"));
        $client->__setlocation("https://" . $this->esxi->address . "/sdk/vimService");

        $request = new \stdClass();
        $request->_this = ["_" => "ServiceInstance", "type" => "ServiceInstance"];

        $serviceContent = $client->__soapCall("RetrieveServiceContent", [(array)$request])->returnval;

        $request = new \stdClass();
        $request->_this = $serviceContent->sessionManager;
        $request->userName = $this->username;
        $request->password = decrypt($this->password);

        $client->__soapCall("Login", [(array)$request]);

        $ss1 = new soapvar(array('name' => 'FolderTraversalSpec'), SOAP_ENC_OBJECT, null, null, 'selectSet', null);
        $ss2 = new soapvar(array('name' => 'DataCenterVMTraversalSpec'), SOAP_ENC_OBJECT, null, null, 'selectSet', null);
        $a = array('name' => 'FolderTraversalSpec', 'type' => 'Folder', 'path' => 'childEntity', 'skip' => false, $ss1, $ss2);
        $ss = new soapvar(array('name' => 'FolderTraversalSpec'), SOAP_ENC_OBJECT, null, null, 'selectSet', null);
        $b = array('name' => 'DataCenterVMTraversalSpec', 'type' => 'Datacenter', 'path' => 'vmFolder', 'skip' => false, $ss);

        $request = new \stdClass();
        $request->_this = $serviceContent->propertyCollector;
        $request->specSet = array(
            'propSet' => array(
                array('type' => 'VirtualMachine', 'all' => 0, 'pathSet' => array('name', 'config.uuid')),
            ),
            'objectSet' => array(
                'obj' => $serviceContent->rootFolder,
                'skip' => false,
                'selectSet' => array(
                    new soapvar($a, SOAP_ENC_OBJECT, 'TraversalSpec'),
                    new soapvar($b, SOAP_ENC_OBJECT, 'TraversalSpec'),
                ),
            )
        );

        $result = $client->__soapCall("RetrieveProperties", [(array)$request])->returnval;
        $data = array();
        foreach ($result as $item) {
            $vm = array();
            foreach ($item->propSet as $prop) {
                if ($prop->name == "name") $vm["name"] = $prop->val;
                if ($prop->name == "config.uuid") $vm["uuid"] = $prop->val;
            }
            array_push($data, $vm);
        }
        return $data;
    }
}