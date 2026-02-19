#!/bin/bash
set -e
export DEBIAN_FRONTEND=noninteractive

echo "-----> Deployment started"

# 1. Install Composer dependencies
echo "-----> Installing Composer..."
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# 2. Build Assets
echo "-----> Building Assets..."
npm ci
npm run build

# 3. Optimize Laravel
echo "-----> Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Storage Link
echo "-----> Linking Storage..."
php artisan storage:link --force

# 5. Database Migration
# Note: Ensure MySQL SSL cert is set in .env on Azure
echo "-----> Running Migrations..."
php artisan migrate --force

echo "-----> Deployment finished successfully!"
