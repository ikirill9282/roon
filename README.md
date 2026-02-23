# Лавка желаний и предсказаний

Laravel приложение для отправки писем в "небесную канцелярию" и открытия предсказаний (руны/свертки).

## Установка

1. Установите зависимости:
```bash
composer install
npm install  # если используете npm для фронтенда
```

2. Настройте `.env`:
```bash
cp .env.example .env
php artisan key:generate
```

3. Настройте базу данных в `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=roon
DB_USERNAME=root
DB_PASSWORD=
```

4. Запустите миграции:
```bash
php artisan migrate
```

5. Создайте админ-пользователя:
```bash
php artisan make:filament-user
```

6. Настройте YooKassa в `.env`:
```
YOOKASSA_SHOP_ID=your_shop_id
YOOKASSA_SECRET_KEY=your_secret_key
YOOKASSA_TEST_MODE=true
```

7. Настройте поддержку (опционально):
```
SUPPORT_TELEGRAM_LINK=https://t.me/your_support
SUPPORT_EMAIL=support@example.com
```

8. Запустите сервер:
```bash
php artisan serve
```

## Структура проекта

- **Модели**: `Letter`, `Prediction`, `Payment`, `FreeOpen`
- **Сервисы**: `LetterService`, `PredictionService`, `PaymentService`
- **Контроллеры**: `LetterController`, `PredictionController`, `PaymentController`, `WebhookController`
- **Админ-панель**: Filament (`/admin`)

## Основные функции

1. **Письмо в небесную канцелярию**:
   - Пользователь пишет сообщение (до 500 символов)
   - Оплата 50₽ через YooKassa
   - После оплаты письмо сохраняется в БД

2. **Открытие предсказаний**:
   - Первое открытие бесплатно (по категории: руна/сверток)
   - Последующие открытия платные (20₽ свертки, 30₽ руны)
   - Отслеживание через `device_uuid` cookie (серверная валидация)

3. **Админ-панель**:
   - Просмотр писем (фильтры по дате, статусу оплаты)
   - Управление предсказаниями (CRUD)
   - Статистика активных предсказаний

## API Endpoints

- `POST /api/letters` - Отправить письмо
- `POST /api/predictions/open` - Открыть предсказание (бесплатно/платно)
- `POST /api/predictions/open-paid` - Открыть предсказание после оплаты
- `POST /api/payments/create` - Создать платеж
- `POST /api/webhooks/yookassa` - Webhook от YooKassa
- `GET /payment/success` - Успешная оплата
- `GET /payment/failure` - Неудачная оплата

## Конфигурация цен

Цены настраиваются в `config/pricing.php` и могут быть переопределены через `.env`:
```
PRICING_LETTER=50.00
PRICING_PREDICTION_SCROLL=20.00
PRICING_PREDICTION_RUNE=30.00
```

## Безопасность

- CSRF защита на всех формах
- Rate limiting на API endpoints
- Серверная валидация free-open (нельзя обойти через localStorage)
- Идемпотентность платежей (защита от дубликатов)
- Верификация webhook payload от YooKassa

## Тестирование

Для тестирования используйте тестовые данные YooKassa:
- Shop ID и Secret Key из тестового кабинета YooKassa
- Тестовые карты для оплаты

## Развертывание

1. Настройте production `.env`
2. Запустите `php artisan config:cache`
3. Запустите `php artisan route:cache`
4. Настройте webhook URL в YooKassa: `https://yourdomain.com/api/webhooks/yookassa`
