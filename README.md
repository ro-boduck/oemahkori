# OemahKori — Guesthouse Booking App

A curated guesthouse booking web app built with **Laravel 12** and a Modern Balinese Editorial UI. Features room listings, a booking system, user authentication, and an admin dashboard.

---

## 🚀 Deploy to Microsoft Azure (Step-by-Step)

### Prerequisites
- Azure account with an active subscription
- [Azure CLI](https://learn.microsoft.com/en-us/cli/azure/install-azure-cli) installed locally
- PHP 8.2+ and Composer installed locally
- Node.js 18+ and npm installed locally
- Git installed

---

### Step 1 — Create Azure Resources

Log in to the [Azure Portal](https://portal.azure.com) and create:

#### A. Resource Group
```bash
az group create --name oemahkori-rg --location southeastasia
```

#### B. Azure App Service Plan (Linux, PHP 8.2)
```bash
az appservice plan create \
  --name oemahkori-plan \
  --resource-group oemahkori-rg \
  --sku B1 \
  --is-linux
```

#### C. Azure Web App
```bash
az webapp create \
  --name oemahkori \
  --resource-group oemahkori-rg \
  --plan oemahkori-plan \
  --runtime "PHP|8.2"
```

#### D. Azure Database for MySQL Flexible Server
```bash
az mysql flexible-server create \
  --name oemahkori-db \
  --resource-group oemahkori-rg \
  --location southeastasia \
  --admin-user dbadmin \
  --admin-password "YourStrongPassword123!" \
  --sku-name Standard_B1ms \
  --tier Burstable \
  --storage-size 20 \
  --version 8.0
```

Create the database:
```bash
az mysql flexible-server db create \
  --resource-group oemahkori-rg \
  --server-name oemahkori-db \
  --database-name oemahkori
```

Allow Azure services to connect:
```bash
az mysql flexible-server firewall-rule create \
  --resource-group oemahkori-rg \
  --name oemahkori-db \
  --rule-name AllowAzureServices \
  --start-ip-address 0.0.0.0 \
  --end-ip-address 0.0.0.0
```

---

### Step 2 — Configure App Service Environment Variables

Set all environment variables via Azure CLI (or do it in the Portal → App Service → Configuration → Application Settings):

```bash
az webapp config appsettings set \
  --name oemahkori \
  --resource-group oemahkori-rg \
  --settings \
    APP_NAME="OemahKori" \
    APP_ENV="production" \
    APP_KEY="base64:GENERATE_WITH_php_artisan_key_generate" \
    APP_DEBUG="false" \
    APP_URL="https://oemahkori.azurewebsites.net" \
    DB_CONNECTION="mysql" \
    DB_HOST="oemahkori-db.mysql.database.azure.com" \
    DB_PORT="3306" \
    DB_DATABASE="oemahkori" \
    DB_USERNAME="dbadmin" \
    DB_PASSWORD="YourStrongPassword123!" \
    MYSQL_ATTR_SSL_CA="/home/site/wwwroot/ssl/DigiCertGlobalRootCA.crt.pem" \
    SESSION_DRIVER="database" \
    CACHE_STORE="database" \
    QUEUE_CONNECTION="database" \
    LOG_CHANNEL="stderr" \
    LOG_LEVEL="warning" \
    FILESYSTEM_DISK="local"
```

> ⚠️ **Generate your APP_KEY** first locally:
> ```bash
> php artisan key:generate --show
> ```
> Then paste the output into `APP_KEY` above.

---

### Step 3 — Set the Web Root to `/public`

Azure App Service (Linux) serves from `/home/site/wwwroot`. Tell it Laravel's public folder is the web root:

```bash
az webapp config set \
  --name oemahkori \
  --resource-group oemahkori-rg \
  --linux-fx-version "PHP|8.2" \
  --startup-file "cp /home/site/wwwroot/deploy.sh /tmp/deploy.sh && bash /tmp/deploy.sh"
```

Or set the virtual path in Portal:
- Go to **App Service → Configuration → Path mappings**
- Set Virtual Path `/` → Physical Path `site\wwwroot\public`

---

### Step 4 — Deploy via Git

#### Option A: GitHub Actions (Recommended)
1. In Azure Portal → App Service → **Deployment Center**
2. Select **GitHub** as source
3. Pick your repo and branch (`main`)
4. Azure will auto-generate a GitHub Actions workflow

#### Option B: Azure CLI Git Deploy
```bash
# Add Azure as a remote
az webapp deployment source config-local-git \
  --name oemahkori \
  --resource-group oemahkori-rg

# Azure will give you a Git URL. Add it as a remote:
git remote add azure https://<deployment-user>@oemahkori.scm.azurewebsites.net/oemahkori.git

# Push to deploy
git push azure main
```

The `deploy.sh` script will automatically run:
- `composer install --no-dev`
- `npm ci && npm run build`
- `php artisan config:cache`
- `php artisan migrate --force`
- `php artisan storage:link`

---

### Step 5 — Post-Deployment Checks

```bash
# Check app logs
az webapp log tail --name oemahkori --resource-group oemahkori-rg

# Run migrations manually if needed
az webapp ssh --name oemahkori --resource-group oemahkori-rg
# then inside the SSH session:
php artisan migrate --force
php artisan db:seed --force   # optional: if you have seeders
```

---

## 🛢️ Local Development (SQLite)

```bash
# Clone the repo
git clone https://github.com/YOUR-USERNAME/oemahkori.git
cd oemahkori

# Copy env and configure
cp .env.example .env
# Edit .env: change DB_CONNECTION=sqlite

# Install dependencies
composer install
npm install

# Generate key and migrate
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan db:seed  # optional

# Start dev server
npm run dev
php artisan serve
```

---

## 📁 Project Structure

```
oemahkori/
├── app/                  # Models, Controllers, Middleware
├── database/
│   ├── migrations/       # All DB migrations
│   └── seeders/
├── public/               # Web root — index.php + compiled assets
│   └── web.config        # IIS rewrite rules (Azure)
├── resources/
│   ├── css/app.css       # Main stylesheet
│   ├── js/app.js
│   └── views/            # Blade templates
├── ssl/
│   └── DigiCertGlobalRootCA.crt.pem  # Azure MySQL SSL cert
├── .deployment           # Tells Kudu to run deploy.sh
├── deploy.sh             # Post-deploy automation script
├── web.config            # Root-level IIS config (Azure)
└── .env.example          # Environment variable template
```

---

## 🔐 Security Notes

- Never commit `.env` to Git (it is already in `.gitignore`)
- Always set `APP_DEBUG=false` in production
- Use Azure Key Vault or App Service environment variables for secrets
- The `ssl/DigiCertGlobalRootCA.crt.pem` file is required for SSL connections to Azure MySQL

---

## Tech Stack

| Layer      | Technology |
|------------|-----------|
| Framework  | Laravel 12 |
| Frontend   | Vite + Vanilla CSS |
| Database   | MySQL 8.0 (Azure Flexible Server) |
| Hosting    | Azure App Service (PHP 8.2 Linux) |
| Auth       | Laravel Breeze / built-in |
| Storage    | Azure / Local disk |
