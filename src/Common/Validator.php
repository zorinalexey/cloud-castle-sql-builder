<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Common;

use CloudCastle\SqlBuilder\Exceptions\InvalidArgumentException;

final class Validator
{
    /**
     * Валидация имени таблицы
     *
     * @param string $tableName
     * @throws InvalidArgumentException
     */
    public function validateTableName(string $tableName): void
    {
        if (empty($tableName)) {
            throw new InvalidArgumentException('Table name cannot be empty');
        }
        
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $tableName)) {
            throw new InvalidArgumentException('Invalid table name format');
        }
    }
    
    /**
     * Валидация имени процедуры
     *
     * @param string $tableName
     * @throws InvalidArgumentException
     */
    public function validateProcedureName(string $tableName): void
    {
        if (empty($tableName)) {
            throw new InvalidArgumentException('Procedure name cannot be empty');
        }
        
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $tableName)) {
            throw new InvalidArgumentException('Invalid procedure name format');
        }
    }

    /**
     * Валидация имени колонки
     *
     * @param string $columnName
     * @throws InvalidArgumentException
     */
    public function validateColumnName(string $columnName): void
    {
        if (empty($columnName)) {
            throw new InvalidArgumentException('Column name cannot be empty');
        }

        if (!preg_match('/^[a-zA-Z0-9_]+$/', $columnName)) {
            throw new InvalidArgumentException('Invalid column name format');
        }
    }

    /**
     * Экранирование значения для SQL
     *
     * @param mixed $value
     * @return string
     */
    public function escapeValue($value): string
    {
        if (is_null($value)) {
            return 'NULL';
        }

        if (is_bool($value)) {
            return $value ? 'TRUE' : 'FALSE';
        }

        return (string) $value;
    }
    
    public function validateIndexName (string $indexName)
    {
        if (empty($indexName)) {
            throw new InvalidArgumentException('Index name cannot be empty');
        }
        
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $indexName)) {
            throw new InvalidArgumentException('Invalid index name format');
        }
    }
    
    public function validateKeyName (string $keyName)
    {
        if (empty($keyName)) {
            throw new InvalidArgumentException('key name cannot be empty');
        }
        
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $keyName)) {
            throw new InvalidArgumentException('Invalid key name format');
        }
    }
} 