#!/bin/bash


chown -R www-data:www-data /usr/share/nginx/html/app;

php-fpm; 
nginx -g "daemon off;"