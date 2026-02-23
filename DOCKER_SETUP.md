# Docker Setup Guide

## Доступы к админ-панели

**Email:** `admin@roon.local`  
**Password:** `admin123`

URL админ-панели: http://localhost:8000/admin

## Запуск через Docker

### 1. Подготовка

Скопируйте `.env.docker` в `.env`:
```bash
cp .env.docker .env
```

### 2. Запуск контейнеров

```bash
docker-compose up -d --build
```

### 3. Установка зависимостей

```bash
docker-compose exec app composer install
```

### 4. Запуск миграций

```bash
docker-compose exec app php artisan migrate
```

### 5. Создание символической ссылки для storage

```bash
docker-compose exec app php artisan storage:link
```

### 6. Очистка кэша

```bash
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
```

## Доступ к приложению

- **Сайт:** http://localhost:8080
- **Админ-панель:** http://localhost:8080/admin
- **MySQL:** localhost:3307
  - Database: `roon`
  - Username: `roon`
  - Password: `root`

## Полезные команды

### Остановка контейнеров
```bash
docker-compose down
```

### Просмотр логов
```bash
docker-compose logs -f app
docker-compose logs -f webserver
docker-compose logs -f db
```

### Выполнение команд в контейнере
```bash
docker-compose exec app php artisan [command]
docker-compose exec app composer [command]
```

### Пересоздание контейнеров
```bash
docker-compose down -v
docker-compose up -d --build
```

### Доступ к MySQL
```bash
docker-compose exec db mysql -u roon -proot roon
# Или с хоста:
mysql -h 127.0.0.1 -P 3307 -u roon -proot roon
```

## Структура Docker

- **app** - PHP-FPM контейнер с Laravel
- **webserver** - Nginx веб-сервер
- **db** - MySQL база данных

## Troubleshooting

### Если порт 8080 занят
Измените порт в `docker-compose.yml`:
```yaml
ports:
  - "8090:80"  # Используйте другой порт
```

### Если возникают проблемы с правами доступа
```bash
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
docker-compose exec app chmod -R 775 storage bootstrap/cache
```

### Пересоздание базы данных
```bash
docker-compose down -v
docker-compose up -d
docker-compose exec app php artisan migrate
```
