## Autoput

https://github.com/holix/autoput

### Neophodan softver
- Web server (nginx, Apache)
- PHP 5.6+
- MySQL
- Composer

### Instalacija

```
cp .env.example .env
```
Potrebno je podesiti podešavanja u .env fajlu
```
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
```

### Testiranje
```
composer global require "phpunit/phpunit"
phpunit
```

### Demo verzija

http://autoput.nemanjavidovic.com

#### Demo korisnici:
- admin@admin.com / admin
- radnik1@radnik.com / radnik1
- radnik2@radnik.com / radnik2
- radnik3@radnik.com / radnik3
- radnik4@radnik.com / radnik4
- radnik5@radnik.com / radnik5