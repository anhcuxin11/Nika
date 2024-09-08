# System Requirements
* PHP: 8
* Laravel: 8
* Docker

# Getting started

## Installation
Make db_mysql folder for docker mysql volume

    mkdir db_mysql

Modify hosts file
    
    127.0.0.1 service.loc

## Docker
    
    docker compose up -d
    docker compose exec app composer install
    docker compose exec app php artisan migrate
    docker compose exec app php artisan db:seed
    docker-compose exec app php artisan ziggy:generate
 **Run docker compose with worker service:**
 
    docker-compose --profile worker up -d
 **Connect to worker container:**
    
    docker exec -it gp_web_apps_worker_1 /bin/ash
    
# Frontend
- `npm install`
- `npm run build`
- `npm run watch`
