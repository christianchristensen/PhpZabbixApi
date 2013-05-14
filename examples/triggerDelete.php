<?php

// Autoload ZabbixApi
require __DIR__ . '/vendor/autoload.php';

try {
    // Get config info
    $c = parse_ini_file(".zabbix.config.ini");
    // connect to Zabbix API
    $api = new ZabbixApi($c['url'], $c['user'], $c['pass']);

    $api->triggerUpdate(array('triggerid'=>'123450004150890', 'description'=>'Hello, World'));

}
catch(Exception $e) {
    // Exception in ZabbixApi catched
    echo $e->getMessage();
}
