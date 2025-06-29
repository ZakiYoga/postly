FROM php:8.2-apache

# Install sistem dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy aplikasi
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Create startup script
RUN echo '#!/bin/bash\n\
echo "Starting Laravel application..."\n\
\n\
# Generate APP_KEY if not set\n\
if [ -z "$APP_KEY" ]; then\n\
    echo "Generating APP_KEY..."\n\
    php artisan key:generate --force\n\
fi\n\
\n\
# Wait a bit for database\n\
echo "Waiting for database..."\n\
sleep 5\n\
\n\
# Try to run migrations\n\
echo "Running migrations..."\n\
php artisan migrate --force || echo "Migration failed, continuing..."\n\
\n\
# Clear and cache config\n\
php artisan config:clear\n\
php artisan config:cache\n\
\n\
# Start server\n\
echo "Starting server on port ${PORT:-8000}"\n\
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}\n\
' > /var/www/html/start.sh && chmod +x /var/www/html/start.sh

EXPOSE 8000

CMD ["/var/www/html/start.sh"]