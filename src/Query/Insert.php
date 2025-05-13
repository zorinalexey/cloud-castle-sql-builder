<?php

namespace CloudCastle\SqlBuilder\Query;

use CloudCastle\SqlBuilder\Common\Builder;
use CloudCastle\SqlBuilder\Interfaces\Query\InsertInterface;

/**
 * Класс для генерации запроса на добавление данных в таблицу
 */
final class Insert extends Builder implements InsertInterface
{
    /**
     * @var array<array<mixed>>
     */
    private array $values = [];
    
    /**
     * @return string
     */
    public function toSql (): string
    {
        $columns = [];
        $items = [];
        $values = [];
        
        foreach ($this->values as $i => $value) {
            foreach ($value as $key => $val) {
                $columns[$key] = $key;
                $items[$i][] = $val;
            }
        }
        
        foreach ($items as $item) {
            $values[] = '(' . implode(', ', $item) . ')';
        }
        
        $sql = /** @lang TEXT */
            "INSERT INTO {$this->table} (" . implode(', ', $columns) . ") VALUES\n\t";
        $sql .= implode(",\n\t", $values);
        
        return $sql;
    }
    
    /**
     * @param object|array<string> $values
     *
     * @return $this
     */
    public function values (object|array $values): static
    {
        $values = (array) $values;
        $i = count($this->values);
        
        foreach ($values as $key => $value) {
            $name = "{$key}_{$i}";
            $this->values[$i][$key] = $this->getBindName($value, $name);
        }
        
        return $this;
    }
}
