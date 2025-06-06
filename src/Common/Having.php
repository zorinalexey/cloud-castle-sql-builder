<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Common;

use CloudCastle\SqlBuilder\Interfaces\Query\HavingInterface;
use CloudCastle\SqlBuilder\Traits\GetOperatorTrait;
use CloudCastle\SqlBuilder\Traits\GetPrefixTrait;

/**
 * Класс генерации условий having
 */
final class Having extends Builder implements HavingInterface
{
    use GetOperatorTrait;
    use GetPrefixTrait;
    
    /**
     * @var array<string>
     */
    private array $conditions = [];
    
    /**
     * @var string|null
     */
    private ?string $column = null;
    
    /**
     *
     * @param string $column
     *
     * @return $this Текущий объект класса
     */
    public function column (string $column): static
    {
        $this->column = $column;
        
        return $this;
    }
    
    /**
     * Выбрать по минимальному значению удовлетворяющее правилам выборки
     *
     * @param int $value
     * @param string $operator
     * @param string $prefix
     *
     * @return $this Текущий объект класса
     */
    public function min (int $value, string $operator = '=', string $prefix = 'AND'): static
    {
        $prefix = $this->getPrefix($prefix);
        $this->conditions[] = "{$prefix}MIN({$this->column}) {$this->getOperator($operator)->value} {$value}";
        
        return $this;
    }
    
    /**
     * Выбрать по максимальному значению удовлетворяющее правилам выборки
     *
     * @param int $value
     * @param string $operator
     * @param string $prefix
     *
     * @return $this Текущий объект класса
     */
    public function max (int $value, string $operator = '=', string $prefix = 'AND'): static
    {
        $prefix = $this->getPrefix($prefix);
        $this->conditions[] = "{$prefix}MAX({$this->column}) {$this->getOperator($operator)->value} {$value}";
        
        return $this;
    }
    
    /**
     * Выбрать по среднему значению удовлетворяющее правилам выборки
     *
     * @param int $value
     * @param string $operator
     * @param string $prefix
     *
     * @return $this Текущий объект класса
     */
    public function avg (int $value, string $operator = '=', string $prefix = 'AND'): static
    {
        $prefix = $this->getPrefix($prefix);
        $this->conditions[] = "{$prefix}AVG({$this->column}) {$this->getOperator($operator)->value} {$value}";
        
        return $this;
    }
    
    /**
     * Выбрать по сумме значений удовлетворяющее правилам выборки
     *
     * @param int $value
     * @param string $operator
     * @param string $prefix
     *
     * @return $this Текущий объект класса
     */
    public function sum (int $value, string $operator = '=', string $prefix = 'AND'): static
    {
        $prefix = $this->getPrefix($prefix);
        $this->conditions[] = "{$prefix}SUM({$this->column}) {$this->getOperator($operator)->value} {$value}";
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function toSql (): string
    {
        return implode("\n\t", $this->conditions) . "\n";
    }
}
