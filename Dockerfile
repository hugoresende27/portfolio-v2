FROM php:8.1.2-fpm-alpine

RUN apk --update --no-cache add \
   zlib-dev \
   libzip-dev \
   curl \
   git \
   mysql-client \
   icu-dev

RUN docker-php-ext-install pdo_mysql zip intl

WORKDIR /var/www/html

COPY . .

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

RUN apk add --update npm
RUN npm install
RUN npm run build

CMD php artisan serve --host 0.0.0.0 --port 8000
