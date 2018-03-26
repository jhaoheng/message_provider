FROM        ubuntu:16.04

RUN         apt-get update; \
            apt-get install vim -y; \
            apt-get install wget -y; \
            apt-get install curl -y; \
            apt-get install git -y;
            

RUN         apt-get install nginx -y; 

RUN         apt-get install php7.0-dev -y; \
            apt-get install php-pgsql -y; \
            apt-get install php-mysql -y; \
            apt-get install php-curl -y; \
            apt-get install php-gd -y; \
            apt-get install php-dom -y; \
            apt-get install php-mbstring -y; \
            apt-get install php-mcrypt -y; \
            apt-get install php-soap -y; \
            apt-get install php-sqlite3 -y; \
            apt-get install php-xml -y; \
            apt-get install php-xmlrpc -y; \
            apt-get install php-zip -y; 

RUN         apt-get install php-pear;

# php-fpm
RUN         apt-get install php7.0-fpm -y ; \
            mkdir /run/php; \
            echo "" > /run/php/php7.0-fpm.sock; \
            ln -s /usr/sbin/php-fpm7.0 /usr/bin/php-fpm

# install memcached
RUN         apt-get install memcached -y && \
            apt-get install php-memcached -y

# install phalcon
RUN         apt-get install libpcre3-dev -y; \
            curl -s https://packagecloud.io/install/repositories/phalcon/stable/script.deb.sh | bash; \
            apt-get install php7.0-phalcon;

# install yaml
RUN         apt-get install libyaml-dev -y && \
            printf "\n" | pecl install yaml-2.0.0 && \
            echo extension=yaml.so > /etc/php/7.0/mods-available/yaml.ini && \
            # make sure php-fpm already installed
            phpenmod yaml 

# install mosquitto
RUN         apt-get install libmosquitto-dev -y && \
            printf "\n" | pecl install Mosquitto-alpha && \
            echo "extension=mosquitto.so" > /etc/php/7.0/mods-available/mosquitto.ini && \
            # make sure php-fpm already installed
            phpenmod mosquitto

# index.php
COPY        ./default /etc/nginx/sites-available/default
RUN         chmod 755 /etc/nginx/sites-available/default
RUN         echo "<?php phpinfo();?>" > /var/www/html/index.php


CMD         php-fpm; nginx -g "daemon off;"

