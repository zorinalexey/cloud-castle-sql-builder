<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Query;

/**
 * Интерфейс определяет методы генерации условий having
 */
interface HavingInterface
{
    /**
     * @return $this Текущий объект класса
     */
    public function column (string $column): static;
    
    /**
     * @return $this Текущий объект класса
     */
    public function min (int $value, string $operator = '=', string $prefix = 'AND'): static;
    
    /**
     * @return $this Текущий объект класса
     */
    public function max (int $value, string $operator = '=', string $prefix = 'AND'): static;
    
    /**
     * @return $this Текущий объект класса
     */
    public function avg (int $value, string $operator = '=', string $prefix = 'AND'): static;
    
    /**
     * @return $this Текущий объект класса
     */
    public function sum (int $value, string $operator = '=', string $prefix = 'AND'): static;
}
