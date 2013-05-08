.PHONY: build commitbuild getzabbix
.DEFAULT_GOAL := build
DATE=$(shell date +%I:%M%p)
SHA=$(shell git rev-parse HEAD)

build:
	mkdir -p build
	php build.php

# Travis CI: Build script; build
commitbuild:
	@echo "Host github.com\n\tStrictHostKeyChecking no\n" >> ~/.ssh/config
	@echo "-----BEGIN RSA PRIVATE KEY-----" >> ~/.ssh/id_rsa
	@for i in $(shell seq 0 24); do eval echo "\$$IDRSA_PRIV_ENV$$i" >> ~/.ssh/id_rsa; done
	@echo "-----END RSA PRIVATE KEY-----" >> ~/.ssh/id_rsa
	@chmod 0600 ~/.ssh/id_rsa
	git remote add cc git@github.com:christianchristensen/PhpZabbixApi.git; \
	git add .; \
	git commit -m "Automated build ${DATE}: ${SHA}"; git --no-pager log -n3; \
	git push cc master;

# export i=0
# cat id_rsa | grep -v "\-\-\-\-" | while read line
#   do
#     echo "IDRSA_PRIV_ENV$i"
#     travis encrypt AllPlayers/allplayers-theme IDRSA_PRIV_ENV$i=$line | grep "secure:"
#     i=$((i+1))
#   done
