#!/bin/bash
source /etc/apache2/envvars
exec apache2 -D FOREGROUND
exec a2ensite /etc/apache2/sites-available/000-default.conf
