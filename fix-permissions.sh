#!/bin/bash

echo "🔧 Fixing Laravel permissions for TopGuide..."

# Set proper permissions for storage directories
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
chmod -R 775 public/upload/

# Create missing directories if they don't exist
mkdir -p storage/app/public
mkdir -p storage/framework/{cache,sessions,views}
mkdir -p storage/logs
mkdir -p public/upload/{excursion,voyage_cap,voyage_principale,voyage_couverture,voyage_galerie,hebergement}

# Set ownership (if running as root or with sudo)
if [ "$EUID" -eq 0 ]; then
    echo "Setting ownership to www-data..."
    chown -R www-data:www-data storage/
    chown -R www-data:www-data bootstrap/cache/
    chown -R www-data:www-data public/upload/
else
    echo "⚠️  Note: Run with sudo to set www-data ownership in production"
fi

# Create symbolic link if it doesn't exist
if [ ! -L "public/storage" ]; then
    php artisan storage:link
fi

echo "✅ Permissions fixed!"
echo "📁 Storage directories: 775"
echo "📁 Bootstrap cache: 775" 
echo "📁 Public upload: 775"