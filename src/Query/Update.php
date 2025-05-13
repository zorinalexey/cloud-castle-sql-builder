<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Query;

use CloudCastle\SqlBuilder\Common\Conditions;
use CloudCastle\SqlBuilder\Interfaces\Query\UpdateInterface;

/**
 * Класс для генерации запроса на обновление данных из таблицы
 */
final class Update extends Conditions implements UpdateInterface
{
    /**
     * @var array<array<string>|string>
     */
    private array $values = [];
    
    public function toSql (): string
    {
        $conditions = $this->getConditions();
        $sql = '';
        
        if ($conditions['with']) {
            $sql .= $conditions['with'] . "\n";
        }
        
        $sql .= "UPDATE\n\t{$this->table}\nSET\n";
        
        $i = 1;
        
        foreach ($this->values as $column => $value) {
            if ($i > 1) {
                $sql .= ', ';
            }
            
            if(is_array($value)) {
                $value = json_encode($value);
            }
            
            $sql .= "\n\t{$column} = {$value}";
            $i++;
        }
        
        $sql .= ($conditions['where'] ?? '');
        
        return $sql;
    }
    
    /**
     * Ассоциативный массив или объект (Ключ|Свойство = Значение), где ключ наименование колонки
     *
     * @param object|array<mixed> $values Значения
     *
     * @return $this
     */
    public function set (object|array $values): static
    {
        $values = (array) $values;
        
        foreach ($values as $key => $value) {
            $this->values[$key] = $this->getBindName($value);
        }
        
        return $this;
    }
}
