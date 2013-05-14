# [PhpZabbixApi](http://zabbixapi.confirm.ch)

A PHP library for the Zabbix™ JSON-RPC API.


## Builder

`make`

The PhpZabbixApi builder is a small PHP script, which depends on the Zabbix™ PHP front-end. It's loading some required API classes to identify and build all available API methods.

(Original: http://zabbixapi.confirm.ch/download.php?file=builder)

Note: `make` will regenerate the abstact and concrete class from templates based on the lookup of the Zabbix PHP frontend classes located in `../zabbix`. You can grab them from SVN using `make getzabbix`. Alternatively, you can just symlink `../zabbix -> <path to>/Zabbix/frontends/php` if you have an existing Zabbix installation/directory.


## TODO

*  Refactor `examples` into tests.
