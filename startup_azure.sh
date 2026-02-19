#!/bin/bash

# 1. Point Apache to the Laravel 'public' folder
sed -i "s|/home/site/wwwroot|/home/site/wwwroot/public|g" /etc/apache2/sites-available/000-default.conf
sed -i "s|/home/site/wwwroot|/home/site/wwwroot/public|g" /etc/apache2/apache2.conf

# 2. Start Apache
echo "Starting Apache..."
/usr/sbin/apache2ctl -D FOREGROUND
