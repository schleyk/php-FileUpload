FROM php:8.3-apache

RUN DEBIAN_FRONTEND="noninteractive" apt update ; apt install msmtp -y
RUN echo "sendmail_path = "/usr/bin/msmtp -t"" > "$PHP_INI_DIR/conf.d/docker-php-ext-sendmail.ini"
