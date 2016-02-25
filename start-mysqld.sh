#!/bin/bash
#exec mysqld_safe
/usr/bin/mysqld_safe &
sleep 5
mysql -u root -e "CREATE DATABASE simpleblog"
mysql -u root simpleblog < /var/www/html/reference/simpleblog.sql