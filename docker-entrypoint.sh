#!/bin/bash
set -e

# Use PORT from Railway or default to 80
if [ -n "$PORT" ]; then
    sed -i "s/Listen 80/Listen $PORT/" /etc/apache2/ports.conf
    sed -i "s/:80/:$PORT/" /etc/apache2/sites-available/000-default.conf
fi

# Run migrations
php artisan migrate --force 2>/dev/null || true

# Cache config and routes for performance
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

# Start Apache
apache2-foreground
