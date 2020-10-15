# Laravel meetup demo

Demo Laravel application for meetup in ITWare at 2020. 10. 09.

## Credits

Fodor Mánuel  
@mfodor  
https://doxasoft.hu

## Setup

```bash
git clone git@github.com:mfodor/laravel-meetup-demo.git
cd laravel-meetup-demo/
docker-compose up -d
cp .env.example .env
composer install
artisan key:generate
php artisan migrate --step
php artisan serve
```

The application is available at http://localhost:8000

### Horizon

The application is available at http://localhost:8000/horizon

[More about Horizon](https://laravel.com/docs/8.x/horizon)

### Telescope

The application is available at http://localhost:8000/telescope

[More about Telescope](https://laravel.com/docs/8.x/telescope)

### Other Laravel tools used

UI: [Laravel Jetstream](https://jetstream.laravel.com/1.x/introduction.html)  
UI: [Laravel LiveWire](https://laravel-livewire.com/)  
Auth: [Laravel Sanctum](https://laravel.com/docs/8.x/sanctum)  
Debugbar: [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar)
