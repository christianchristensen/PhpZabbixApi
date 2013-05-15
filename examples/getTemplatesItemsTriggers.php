<?php

// Autoload ZabbixApi
require __DIR__ . '/vendor/autoload.php';

try {
    // Get config info
    $c = parse_ini_file(".zabbix.config.ini");
    // connect to Zabbix API
    $api = new ZabbixApi($c['url'], $c['user'], $c['pass']);

    // This shows all (limit=10) templates triggers and items as a tab separated dump.

    $templates = $api->templateGet(array("output"=>"extend", "selectTriggers"=>"refer", "selectItems"=>"refer", "limit"=>10));

    foreach($templates as $template) {
        print "Name\tItems\tTriggers\n";
        print "$template->name\t".count($template->items)."\t".count($template->triggers)."\n\n";

        array_walk($template->items, function(&$value, $key) { $value = $value->itemid; });
        // Items per template
        $items = $api->itemGet(array("itemids"=>array_values($template->items), "hostids"=>array($template->hostid), "output"=>"extend", "selectTriggers"=>"count", "selectApplications"=>"shorten"));
        print "Name\tTriggers\tKey\tInterval\tHist\tTrends\tType\tApps\tStatus\tError\n";
        foreach($items as $item) {
	    print "$item->name\t$item->triggers\t$item->key_\t$item->delay\t$item->history\t$item->trends\t$item->type\t".implode($item->applications, ', ')."\t$item->status\n";
        }
        print "\n";

        // Triggers per template
        array_walk($template->triggers, function(&$value, $key) { $value = $value->triggerid; });
        $triggers = $api->triggerGet(array("triggerids"=>array_values($template->triggers), "output"=>"extend", "expandExpression"=>1));
        print "Severity\tName\tExpression\tStatus\tError\n";
        foreach($triggers as $trigger) {
	    $errorstring = empty($trigger->error) ? '' : 'E';
	    print "$trigger->priority\t$trigger->description\t$trigger->expression\t$trigger->status\t$errorstring\n";
	}
	print "\n\n";
    }
}
catch(Exception $e) {
    // Exception in ZabbixApi catched
    echo $e->getMessage();
}
