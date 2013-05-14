<?php

// Autoload ZabbixApi
require __DIR__ . '/vendor/autoload.php';

try {
    // Get config info
    $c = parse_ini_file(".zabbix.config.ini");
    // connect to Zabbix API
    $api = new ZabbixApi($c['url'], $c['user'], $c['pass']);

    $api->eventAcknowledge(array('eventids'=>array('123450328251741'),'message'=>'TEST API ACK'));

    // $api->userLogout();
}
catch(Exception $e) {
    // Exception in ZabbixApi catched
    echo $e->getMessage();
}
