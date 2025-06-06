<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Common;

use CloudCastle\SqlBuilder\Enums\JoinEnum;
use CloudCastle\SqlBuilder\Interfaces\Query\JoinInterface;
use CloudCastle\SqlBuilder\Traits\GetOperatorTrait;

/**
 * Класс для генерации SQL строк для объединения таблиц с помощью оператора JOIN
 */
final class Join extends Builder implements JoinInterface
{
    use GetOperatorTrait;
    
    /**
     * @var JoinEnum
     */
    private JoinEnum $type = JoinEnum::LEFT;
    
    /**
     * @var array<string>
     */
    private array $conditions = [];
    
    /**
     * @return string
     */
    public function toSql (): string
    {
        $sql = "{$this->type->value} JOIN {$this->table} ";
        
        if ($this->alias) {
            $sql .= "AS {$this->alias} ";
        }
        
        $sql .= implode(' ', $this->conditions);
        
        return $sql;
    }
    
    /**
     * @param string $type
     *
     * @return $this Текущий объект класса
     */
    public function type (string $type = 'left'): static
    {
        $this->type = $this->getType($type);
        
        return $this;
    }
    
    /**
     * @param string $type
     *
     * @return JoinEnum
     */
    private function getType (string $type): JoinEnum
    {
        $type = mb_strtoupper($type);
        
        if ($case = JoinEnum::tryFrom($type)) {
            return $case;
        }
        
        return JoinEnum::LEFT;
    }
    
    /**
     * @param string $field
     * @param mixed $value
     * @param string $operator
     *
     * @return $this Текущий объект класса
     */
    public function on (string $field, mixed $value, string $operator = '='): static
    {
        $value = $this->valueToString($value, $this->getOperator($operator), $field);
        array_unshift($this->conditions, "ON {$field} {$value}");
        
        return $this;
    }
    
    /**
     * @param string $column
     * @param mixed|null $value
     * @param string $operator
     *
     * @return $this Текущий объект класса
     */
    public function and (string $column, mixed $value = null, string $operator = '='): static
    {
        $value = $this->valueToString($value, $this->getOperator($operator), $column);
        $this->conditions[] = "AND {$column} {$value}";
        
        return $this;
    }
    
    /**
     * @param string $column
     * @param mixed|null $value
     * @param string $operator
     *
     * @return $this Текущий объект класса
     */
    public function or (string $column, mixed $value = null, string $operator = '='): static
    {
        $value = $this->valueToString($value, $this->getOperator($operator), $column);
        $this->conditions[] = "OR {$column} {$value}";
        
        return $this;
    }
}
