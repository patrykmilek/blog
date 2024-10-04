# Dockerfile
FROM php:8.2-apache

# Zainstaluj sterowniki MySQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && apt-get install -y libzip-dev \
    && docker-php-ext-install zip \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*


# Upewnij się, że Composer jest zainstalowany
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Ustaw katalog roboczy na /var/www/html
WORKDIR /var/www/html

# Skopiuj cały projekt do kontenera
COPY . /var/www/html

# Instalacja zależności przez Composer
RUN composer install --no-dev --optimize-autoloader

# Zmiana uprawnień
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Kopiowanie pliku konfiguracyjnego Apache
COPY ./docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Włączenie modułów Apache
RUN a2enmod rewrite

# Uruchomienie serwera
CMD ["apache2-foreground"]

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && apt-get install -y libzip-dev \
    && docker-php-ext-install zip \
    && docker-php-ext-install mysqli pdo pdo_mysql

