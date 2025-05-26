FROM php:8.0-apache

# PHP-MySQL-Erweiterung installieren
RUN docker-php-ext-install mysqli

# Dateien ins Webverzeichnis kopieren
COPY . /var/www/html

EXPOSE 80
