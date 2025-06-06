# Установка SQL Builder

## Требования
- PHP >= 8.3
- Composer

## Установка

1. Установите пакет через Composer:
```bash
composer require cloud-castle/sql-builder
```

2. Используйте автозагрузчик Composer:
```php
require 'vendor/autoload.php';
```

## Конфигурация

Библиотека не требует дополнительной конфигурации и готова к использованию сразу после установки.

## Пример использования

```php
use CloudCastle\SqlBuilder\QueryBuilder;

$queryBuilder = new QueryBuilder();
$select = $queryBuilder->select('users')
    ->columns(['id', 'name'])
    ->where('active', '=', true);

$sql = $select->getSql();
``` 