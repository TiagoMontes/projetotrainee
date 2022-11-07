FROM php:8.1-fpm-alpine
WORKDIR /var/www/html
RUN apk --update --no-cache add git
RUN docker-php-ext-install pdo_mysql
RUN apk add bash
RUN apk add tzdata
ENV TZ="America/Sao_Paulo"
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN chown -R www-data .
EXPOSE 9000