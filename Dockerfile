FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    wget \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    librabbitmq-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl

RUN pecl install amqp && \
    docker-php-ext-enable amqp

# Install the Elastic APM agent
RUN wget -O /usr/src/apm-agent-php.deb https://github.com/elastic/apm-agent-php/releases/download/v1.14.1/apm-agent-php_1.14.1_amd64.deb  \
    && dpkg -i /usr/src/apm-agent-php.deb \
    && rm /usr/src/apm-agent-php.deb

# Copy Composer from the composer container
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy the application code
COPY . .

# Install dependencies via Composer
RUN composer install --no-interaction

# Ensure proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
