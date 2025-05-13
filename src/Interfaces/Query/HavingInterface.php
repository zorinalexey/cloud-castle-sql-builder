<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Query;

/**
 * Интерфейс определяет методы генерации условий having
 */
interface HavingInterface
{
    /**
     * @return $this
     */
    public function column (string $column): static;
    
    /**
     * @return $this
     */
    public function min (int $value, string $operator = '=', string $prefix = 'AND'): static;
    
    /**
     * @return $this
     */
    public function max (int $value, string $operator = '=', string $prefix = 'AND'): static;
    
    /**
     * @return $this
     */
    public function avg (int $value, string $operator = '=', string $prefix = 'AND'): static;
    
    /**
     * @return $this
     */
    public function sum (int $value, string $operator = '=', string $prefix = 'AND'): static;
}
