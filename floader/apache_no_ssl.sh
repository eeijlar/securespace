#!/bin/bash
# Start wireless

rcapache2 stop
rcapache2 start
sleep 2
/etc/init.d/mysql start
exit 0

