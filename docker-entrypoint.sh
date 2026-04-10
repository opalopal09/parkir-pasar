#!/bin/bash
set -e

echo "Starting Railway Deployment Script..."

# Use PORT from Railway or default to 80
PORT=${PORT:-80}
echo "Configuring Apache to listen on PORT: $PORT"

# Overwrite ports configuration
cat > /etc/apache2/ports.conf <<APACHE
Listen $PORT
APACHE

# Overwrite virtual host configuration
cat > /etc/apache2/sites-available/000-default.conf <<APACHE
<VirtualHost *:$PORT>
    DocumentRoot /var/www/html/public
    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
    </Directory>
    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
APACHE

echo "Caching configurations..."
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

echo "Running migrations..."
php artisan migrate --force 2>/dev/null || true

echo "Running seeders..."
php artisan db:seed --force 2>/dev/null || true

echo "Starting Apache..."
exec apache2-foreground
