#!/bin/bash
# =============================================================================
# Azure App Service — Post-Deployment Script for Laravel + MySQL
# This script is run automatically by Azure Kudu after each Git push.
# =============================================================================

set -e  # Exit immediately if a command exits with a non-zero status

DEPLOYMENT_SOURCE="${DEPLOYMENT_SOURCE:-$PWD}"
DEPLOYMENT_TARGET="${DEPLOYMENT_TARGET:-/home/site/wwwroot}"

echo "-----> Starting OemahKori deployment..."
echo "       Source : $DEPLOYMENT_SOURCE"
echo "       Target : $DEPLOYMENT_TARGET"

# ── 1. Sync files to wwwroot (Kudu handles this, but just in case) ──────────
cd "$DEPLOYMENT_TARGET"

# ── 2. Install / update Composer dependencies (no dev) ──────────────────────
echo "-----> Installing Composer dependencies..."
composer install \
    --no-interaction \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader

# ── 3. Build frontend assets ─────────────────────────────────────────────────
echo "-----> Installing npm packages..."
npm ci --omit=dev

echo "-----> Building frontend assets (Vite)..."
npm run build

# ── 4. Laravel optimisations ─────────────────────────────────────────────────
echo "-----> Running Laravel optimisations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# ── 5. Storage symlink ───────────────────────────────────────────────────────
echo "-----> Creating storage symlink..."
php artisan storage:link --force

# ── 6. Run database migrations ───────────────────────────────────────────────
echo "-----> Running database migrations..."
php artisan migrate --force

# ── 7. Fix storage & bootstrap/cache permissions ────────────────────────────
echo "-----> Setting directory permissions..."
chmod -R 775 storage bootstrap/cache

echo "-----> Deployment complete! 🎉"
