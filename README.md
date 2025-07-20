# Dropship

## Installation

Clone Project
```bash
composer install
```
```bash
cp .env.example .env
```
```bash
php artisan key:generate
```
```bash
php artisan storage:link
```
```bash
php artisan migrate:fresh --seed
```
```bash
php artisan db:seed --class=ProductVIewSeeder
```
```bash
npm install && npm run dev
```

change the 'database name' & 'username' & 'password'
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=root
DB_PASSWORD=
```

wahtsapp
register to twillio and get sid and token
```bash
TWILIO_AUTH_SID=
TWILIO_AUTH_TOKEN=
TWILIO_WHATSAPP_FROM=
```
