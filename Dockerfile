FROM php:8.3-fpm

# Встановлення необхідних залежностей
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    nano

# Встановлення Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Встановлення PHP розширень
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Створення групи та користувача
RUN groupadd -g 1000 www && \
    useradd -u 1000 -ms /bin/bash -g www www

RUN mkdir -p /home/www/.composer && \
    chown -R www:www /home/www

# Встановлення робочого каталогу
WORKDIR /var/www

# Створення директорії vendor
USER root
RUN mkdir -p /var/www/vendor && chown -R www:www /var/www

# Копіювання composer файлів
COPY --chown=www:www composer.json composer.lock /var/www/

# Перехід на користувача www
USER www

# Копіювання додатку
COPY --chown=www:www . /var/www
# Встановлення залежностей через Composer
RUN composer install --no-dev --optimize-autoloader

# Відкриття порту 9000
EXPOSE 9000

CMD ["php-fpm"]
