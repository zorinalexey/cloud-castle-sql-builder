# CloudCastle SQL Builder

A powerful and flexible SQL query builder library for PHP that provides a fluent interface for building complex database queries.

## Features

- Fluent interface for building SQL queries
- Support for all major SQL operations:
  - SELECT queries with advanced features
  - INSERT operations
  - UPDATE operations
  - DELETE operations
- Advanced query building capabilities:
  - JOIN operations (LEFT, RIGHT, INNER, etc.)
  - WHERE conditions
  - Aggregate functions (MIN, MAX, AVG, SUM)
  - DISTINCT queries
  - CASE statements
  - Subqueries
  - Table aliases
- Type-safe implementation with strict typing
- Clean and maintainable code structure

## Installation

```bash
composer require cloud-castle/sql-builder
```

## Usage

### Basic Query Building

```php
use CloudCastle\SqlBuilder\QueryBuilder;

$queryBuilder = new QueryBuilder();

// SELECT query
$selectQuery = $queryBuilder->select('users')
    ->columns(['id', 'name', 'email'])
    ->where('active', '=', true)
    ->toSql();

// INSERT query
$insertQuery = $queryBuilder->insert('users')
    ->values([
        'name' => 'John Doe',
        'email' => 'john@example.com'
    ])
    ->toSql();

// UPDATE query
$updateQuery = $queryBuilder->update('users')
    ->set(['active' => false])
    ->where('id', '=', 1)
    ->toSql();

// DELETE query
$deleteQuery = $queryBuilder->delete('users')
    ->where('id', '=', 1)
    ->toSql();
```

### Advanced Features

#### JOIN Operations
```php
$select = $queryBuilder->select('users');
$join = $select->join('orders', 'left')
    ->on('users.id', '=', 'orders.user_id')
    ->columns(['users.*', 'orders.total']);
```

#### Aggregate Functions
```php
$query = $queryBuilder->select('orders')
    ->min('total', 'min_total')
    ->max('total', 'max_total')
    ->avg('total', 'avg_total')
    ->sum('total', 'total_sum');
```

#### DISTINCT Queries
```php
$query = $queryBuilder->select('users')
    ->distinct(['email', 'name']);
```

#### CASE Statements
```php
$select = $queryBuilder->select('orders');
$case = $select->case('status_label')
    ->when('status', '=', 'pending', 'Pending')
    ->when('status', '=', 'completed', 'Completed')
    ->else('Unknown');
```

## Project Structure

```
src/
├── Common/         # Common components and utilities
├── Enums/          # Enumeration classes
├── Interfaces/     # Interface definitions
├── Query/          # Query implementation classes
├── Schema/         # Database schema related classes
└── Traits/         # Reusable traits
```

## Requirements

- PHP 8.3 or higher

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is licensed under the MIT License - see the LICENSE file for details. 