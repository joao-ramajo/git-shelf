FROM php:8.3-cli 

WORKDIR /var/www/backend

RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# RUN composer install 

CMD php -S 0.0.0.0:8080 -t public 