FROM php:8.2-fpm

WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create npm cache directory
RUN mkdir -p /var/www/.npm && \
    chown -R www-data:www-data /var/www/.npm

# Copy package files first
COPY package*.json ./
COPY composer*.json ./
COPY vite.config.js ./
COPY postcss.config.js ./
COPY tailwind.config.js ./

# Set permissions
RUN chown -R www-data:www-data . \
    && chmod -R 755 .

# Switch to www-data user
USER www-data

# Install dependencies
RUN npm install
RUN composer install --no-scripts

# Copy the rest of the application
COPY --chown=www-data:www-data . .

# Create necessary directories
RUN mkdir -p public/build

# Build assets
RUN npm run build

# Create .env file with proper configuration
RUN cp .env.example .env && \
    sed -i 's/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/' .env && \
    sed -i 's/DB_HOST=127.0.0.1/DB_HOST=db/' .env && \
    sed -i 's/DB_DATABASE=laravel/DB_DATABASE=acl/' .env && \
    sed -i 's/DB_USERNAME=root/DB_USERNAME=root/' .env && \
    sed -i 's/DB_PASSWORD=/DB_PASSWORD=/' .env && \
    php artisan key:generate --force && \
    composer dump-autoload -o

EXPOSE 9000 