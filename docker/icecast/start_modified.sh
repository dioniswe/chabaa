#!/bin/sh

env

set -x

set_val() {
    if [ -n "$2" ]; then
        echo "set '$2' to '$1'"
        sed -i "s/<$2>[^<]*<\/$2>/<$2>$1<\/$2>/g" /etc/icecast2/icecast.xml
    else
        echo "ERROR: setting for '$1' is missing!" >&2
	exit
    fi
}

set_val $ICECAST_SOURCE_PASSWORD source-password
set_val $ICECAST_RELAY_PASSWORD  relay-password
set_val $ICECAST_ADMIN_PASSWORD  admin-password
set_val $ICECAST_PASSWORD        password
set_val $ICECAST_PORT            port

set -e

sed  -i '1 a <http-headers><header name="Access-Control-Allow-Origin" value="*" /><header name="Access-Control-Allow-Headers" value="Origin, Accept, X-Requested-With, Content-Type, If-Modified-Since" /><header name="Access-Control-Allow-Methods" value="GET, OPTIONS, HEAD" /></http-headers>' /etc/icecast2/icecast.xml
sudo -Eu icecast2 icecast2 -n -c /etc/icecast2/icecast.xml
