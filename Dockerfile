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

# Встановлення робочого каталогу
WORKDIR /var/www

# Копіювання composer файлів і встановлення залежностей
COPY composer.json composer.lock /var/www/
RUN composer install --no-dev --optimize-autoloader

# Копіювання додатку
COPY --chown=www:www . /var/www

# Перехід на користувача www
USER www

# Відкриття порту 9000
EXPOSE 9000

CMD ["php-fpm"]
