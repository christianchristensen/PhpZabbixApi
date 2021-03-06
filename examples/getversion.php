<?php

// Autoload ZabbixApi
require __DIR__ . '/vendor/autoload.php';

try {
    // Get config info
    $c = parse_ini_file(".zabbix.config.ini");
    // connect to Zabbix API
    $api = new ZabbixApi($c['url'], $c['user'], $c['pass']);

    $api->printCommunication();
    var_dump($api->apiinfoVersion(array("output"=>"extend")));
    $api->userLogout();
}
catch(Exception $e) {
    // Exception in ZabbixApi catched
    echo $e->getMessage();
}
