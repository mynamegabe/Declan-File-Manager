FROM php:7.2-apache
COPY src/ /var/www/html/
COPY flag.txt /flag.txt
RUN chmod 755 /var/www/html/*
RUN chmod 777 /var/www/html/files
RUN chmod 777 /var/www/html/files*