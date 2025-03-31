#!/usr/bin/with-contenv bashio

CONFIG_PATH=/data/options.json
WES_SERVER_ADDRESS="$(bashio::config 'wes_server_address')"

bashio --help

symfony server:start --dir=app --allow-http --no-tls
