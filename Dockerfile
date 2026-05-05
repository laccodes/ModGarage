FROM php:8.2-apache
RUN a2enmod rewrite
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html
RUN echo '<Directory /var/www/html>\nAllowOverride All\nRequire all granted\n</Directory>' \
    > /etc/apache2/conf-available/app.conf && a2enconf app
RUN mkdir -p /var/lib/php/sessions && chmod 777 /var/lib/php/sessions
EXPOSE 80
CMD ["apache2-foreground"]
