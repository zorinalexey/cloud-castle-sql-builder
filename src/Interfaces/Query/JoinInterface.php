<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Query;

use CloudCastle\SqlBuilder\Interfaces\BuilderInterface;

/**
 * Интерфейс определяет методы для генерации SQL строк для объединения таблиц с помощью оператора JOIN
 */
interface JoinInterface extends BuilderInterface
{
    /**
     * @return $this
     */
    public function on (string $field, mixed $value, string $operator = '='): static;
    
    /**
     * @return $this
     */
    public function and (string $column, mixed $value = null, string $operator = '='): static;
    
    /**
     * @return $this
     */
    public function or (string $column, mixed $value = null, string $operator = '='): static;
    
    /**
     * @return $this
     */
    public function type (string $type = 'left'): static;
}
