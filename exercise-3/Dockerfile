# Sử dụng hình ảnh PHP chính thức với Apache
FROM php:8.2-apache

# Cập nhật và cài đặt các gói cần thiết
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    libzip-dev \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql zip

# Cài đặt phần mở rộng MongoDB
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Thiết lập thư mục làm việc
WORKDIR /var/www/html

# Sao chép file composer.json và composer.lock (nếu có)
#COPY composer.json composer.lock ./

# Cài đặt các phụ thuộc của PHP


# Sao chép mã nguồn ứng dụng
COPY . .

# Chạy Composer lần cuối để thiết lập autoloader và script
RUN #composer dump-autoload --optimize

# Thiết lập quyền cho thư mục storage và bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

RUN composer install

# Cấu hình Apache
RUN a2enmod rewrite
COPY ./docker/apache/laravel.conf /etc/apache2/sites-available/000-default.conf

# Expose port 80
EXPOSE 80

# Chạy Apache ở chế độ foreground
CMD ["apache2-foreground"]