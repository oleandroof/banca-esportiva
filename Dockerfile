FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    default-mysql-server \
    libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_mysql mysqli zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

RUN echo '<Directory /var/www/html>\n    AllowOverride All\n    Require all granted\n</Directory>' \
    >> /etc/apache2/apache2.conf

COPY . /var/www/html/

COPY docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 /var/www/html/_temp \
    && chmod -R 777 /var/www/html/imagens

EXPOSE 80
CMD ["/docker-entrypoint.sh"]
