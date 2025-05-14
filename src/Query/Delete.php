<?php

namespace CloudCastle\SqlBuilder\Query;

use CloudCastle\SqlBuilder\Common\Conditions;
use CloudCastle\SqlBuilder\Interfaces\Query\DeleteInterface;

/**
 * Класс для генерации запроса на удаление данных из таблицы
 */
final class Delete extends Conditions implements DeleteInterface
{
    /**
     * Получить строку запроса
     */
    public function toSql (): string
    {
        $conditions = $this->getConditions();
        $sql = '';
        
        if ($conditions['with']) {
            $sql .= $conditions['with'] . "\n";
        }
        
        if($this->subQuery){
            $sql .= '(';
        }
        
        $sql .= /** @lang text */
            "DELETE FROM {$this->table}\n" . ($conditions['where'] ?? '');
        
        if($this->subQuery){
            $sql .= ") AS {$this->subQuery}";
        }
        
        return $sql;
    }
}
