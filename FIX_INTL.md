# ✅ Исправление ошибки intl расширения

## Проблема

Ошибка: `The "intl" PHP extension is required to use the [format] method.`

## Решение

Добавлено расширение `intl` в Dockerfile:

1. Добавлена библиотека `libicu-dev` в зависимости
2. Добавлено расширение `intl` в список устанавливаемых PHP расширений
3. Включено расширение через `docker-php-ext-enable intl`

## Изменения в Dockerfile

```dockerfile
# Добавлено libicu-dev
libicu-dev \

# Добавлено intl в список расширений
&& docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl \

# Включено расширение
&& docker-php-ext-enable pdo_mysql intl
```

## Проверка

Расширение установлено и работает:
```bash
docker-compose exec app php -m | grep intl
# Вывод: intl
```

## Статус

✅ **Исправлено!** Расширение intl установлено и активно.

Теперь админ-панель должна работать без ошибок.
