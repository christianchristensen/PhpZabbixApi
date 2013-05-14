.PHONY: all build clean getzabbix
.DEFAULT: all

all: clean build

build:
	mkdir -p build
	php build.php

clean:
	rm -rf build

# Dependency: SVN
getzabbix:
	(cd ..; svn co svn://svn.zabbix.com/branches/2.0/frontends/php zabbix)
