<?php

// Autoload ZabbixApi
require __DIR__ . '/vendor/autoload.php';

try {
    // Get config info
    $c = parse_ini_file(".zabbix.config.ini");
    // connect to Zabbix API
    $api = new ZabbixApi($c['url'], $c['user'], $c['pass']);

    $templates = $api->templateGet(array("output"=>"extend", "selectTriggers"=>"count", "selectItems"=>"count"));

    //var_dump($templates);
    foreach($templates as $template) {
        print "$template->name\t$template->items\t$template->triggers\n";
    }

    $api->userLogout();
}
catch(Exception $e) {
    // Exception in ZabbixApi catched
    echo $e->getMessage();
}
