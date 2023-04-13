# Build an image from php-fpm:8.2.4 and composer images
FROM composer/composer:lts AS composer

FROM bitnami/php-fpm:8.2.4 AS php-fpm
COPY --from=composer /usr/bin/composer /usr/bin/composers