<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Query;

use CloudCastle\SqlBuilder\Common\CaseQuery;
use CloudCastle\SqlBuilder\Common\Conditions;
use CloudCastle\SqlBuilder\Common\Join;
use CloudCastle\SqlBuilder\Interfaces\BuilderInterface;
use CloudCastle\SqlBuilder\Interfaces\Query\CaseInterface;
use CloudCastle\SqlBuilder\Interfaces\Query\JoinInterface;
use CloudCastle\SqlBuilder\Interfaces\Query\SelectInterface;

/**
 * Класс генерации SQL запроса для выборки данных
 */
final class Select extends Conditions implements SelectInterface
{
    /**
     * @var array|string[]
     */
    private array $columns = [];
    
    /**
     * @var array|string[]
     */
    private array $distinct = [];
    
    /**
     * @var Join[]|array
     */
    private array $joins = [];
    
    /**
     * Задать колонки для выборки данных
     *
     * @param string|array<string>|BuilderInterface $columns Колонки(колонка) или под запрос для получения в выборки
     *
     * @return $this
     */
    public function columns (array|string|BuilderInterface $columns = '*'): static
    {
        if ($columns instanceof BuilderInterface) {
            $this->binds = [
                ...$this->binds,
                $columns->getBinds(),
            ];
            $columns = $columns->toSql();
        }
        
        if (!is_array($columns)) {
            $columns = [$columns];
        }
        
        $this->columns = array_unique([...$columns, ...$this->columns]);
        
        return $this;
    }
    
    /**
     * Получить строку запроса
     *
     * @return string
     */
    public function toSql (): string
    {
        $sql = '';
        $conditions = $this->getConditions();
        
        if ($conditions['with']) {
            $sql .= $conditions['with'];
        }
        
        if($this->subQuery){
            $sql .= "(";
        }
        
        $sql .= "SELECT\n\t";
        
        if ($this->distinct) {
            $sql .= "DISTINCT (\n\t\t" . implode(",\n\t\t", $this->distinct) . "\n\t\t),\n\t";
        }
        
        if ($this->columns) {
            $sql .= implode(",\n\t", $this->columns) . "\n";
        } else {
            $sql .= "*\n";
        }
        
        $sql .= "FROM\n\t" . $this->table;
        
        if ($this->alias) {
            $sql .= ' AS ' . $this->alias;
        }
        
        $sql .= "\n";
        
        foreach ($this->joins as $join) {
            $this->binds = [
                ...$this->binds,
                ...$join->getBinds(),
            ];
            $sql .= "$join\n";
        }
        
        $sql .= ($conditions['where'] ?? '');
        
        if($this->subQuery){
            $sql .= ") AS {$this->subQuery}";
        }
        
        return $sql;
    }
    
    /**
     * Получить минимальное значение по колонке
     *
     * @param string $column Наименование колонки
     * @param string|null $alias Псевдоним колонки
     *
     * @return $this
     */
    public function min (string $column, ?string $alias = null): static
    {
        $sql = "MIN($column)";
        
        if (!$alias) {
            $alias = "min_{$column}";
        }
        
        $sql .= " AS $alias";
        $this->columns[] = $sql;
        
        return $this;
    }
    
    /**
     * Получить максимальное значение по колонке
     *
     * @param string $column Наименование колонки
     * @param string|null $alias Псевдоним колонки
     *
     * @return $this
     */
    public function max (string $column, ?string $alias = null): static
    {
        $sql = "MAX($column)";
        
        if (!$alias) {
            $alias = "max_{$column}";
        }
        
        $sql .= " AS $alias";
        $this->columns[] = $sql;
        
        return $this;
    }
    
    /**
     * Получить среднее значение по колонке
     *
     * @param string $column Наименование колонки
     * @param string|null $alias Псевдоним колонки
     *
     * @return $this
     */
    public function avg (string $column, ?string $alias = null): static
    {
        $sql = "AVG($column)";
        
        if (!$alias) {
            $alias = "avg_{$column}";
        }
        
        $sql .= " AS $alias";
        $this->columns[] = $sql;
        
        return $this;
    }
    
    /**
     * Получить сумму всех значений по колонке
     *
     * @param string $column Наименование колонки
     * @param string|null $alias Псевдоним колонки
     *
     * @return $this
     */
    public function sum (string $column, ?string $alias = null): static
    {
        $sql = "SUM($column)";
        
        if (!$alias) {
            $alias = "sum_{$column}";
        }
        
        $sql .= " AS $alias";
        $this->columns[] = $sql;
        
        return $this;
    }
    
    /**
     * Соединить с другой таблицей
     *
     * @param string $table наименование таблицы
     * @param string $joinType Тип соединения
     *
     * @return JoinInterface
     */
    public function join (string $table, string $joinType = 'left'): JoinInterface
    {
        $join = (new Join())->table($table)->type($joinType);
        $this->joins[] = $join;
        
        return $join;
    }
    
    /**
     * Задать перечисление в результате выборки
     *
     * @param string $alias Псевдоним перечисления
     *
     * @return CaseInterface
     */
    public function case (string $alias): CaseInterface
    {
        $case = new CaseQuery();
        $case->alias($alias);
        
        return $case;
    }
    
    /**
     * Задать уникальность по колонке (колонкам)
     *
     * @param array<string>|string $columns Наименование колонки (колонок)
     *
     * @return $this
     */
    public function distinct (array|string $columns = 'id'): static
    {
        if (!is_array($columns)) {
            $columns = [$columns];
        }
        
        $this->distinct = array_unique([...$this->distinct, ...$columns]);
        
        return $this;
    }
}
