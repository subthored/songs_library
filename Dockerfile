# Используем базовый образ PHP с Apache
FROM php:8.1-apache

# Устанавливаем необходимые зависимости
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    curl \
    git \
    && docker-php-ext-install pdo pdo_pgsql

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Копируем приложение в контейнер
COPY . .

# Устанавливаем права для директорий storage и bootstrap/cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Устанавливаем зависимости Laravel
RUN composer install --optimize-autoloader --no-dev

# Устанавливаем переменную среды для Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Настройка Apache
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Включаем модули Apache
RUN a2enmod rewrite

# Открываем порт 80
EXPOSE 80

# Запуск Apache
CMD ["apache2-foreground"]
