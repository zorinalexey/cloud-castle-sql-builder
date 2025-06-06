<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Common;

use CloudCastle\SqlBuilder\Interfaces\BuilderInterface;
use CloudCastle\SqlBuilder\Interfaces\Query\ConditionInterface;
use CloudCastle\SqlBuilder\Interfaces\Query\HavingInterface;
use CloudCastle\SqlBuilder\Traits\AsSubqueryTrait;
use CloudCastle\SqlBuilder\Traits\GetOperatorTrait;
use CloudCastle\SqlBuilder\Traits\GetPrefixTrait;
use Stringable;

/**
 * Абстрактный класс предоставляет методы для генерации условий запроса
 */
abstract class Conditions extends Builder implements ConditionInterface
{
    use GetOperatorTrait;
    use GetPrefixTrait;
    use AsSubqueryTrait;
    
    /**
     * @var array<string>
     */
    protected array $with = [];
    
    /**
     * @var array<string>
     */
    protected array $conditions = [];
    
    /**
     * @var array<Having|string>
     */
    protected array $having = [];
    
    /**
     * @var int|null
     */
    protected ?int $offset = null;
    
    /**
     * @var int|null
     */
    protected ?int $limit = null;
    
    /**
     * @var array<string>
     */
    protected array $orderBy = [];
    
    /**
     * @var array<string>
     */
    protected array $groupBy = [];
    
    /**
     * @var array<string>
     */
    protected array $union = [];
    
    /**
     * Задает условие with перед запросом для дальнейшего его использования в теле запроса
     *
     * @param string $name Наименование условной функции
     * @param string|BuilderInterface $query Тело функции
     * @return $this Текущий объект класса
     */
    final public function with (string $name, string|BuilderInterface $query): static
    {
        if ($query instanceof BuilderInterface) {
            $this->binds = [
                ...$this->binds,
                ...$query->getBinds(),
            ];
        }
        
        $this->with[] = "{$name} AS (\n\t{$query}\n)";
        
        return $this;
    }
    
    /**
     * Добавить в запрос сырую часть запроса
     *
     * @param string|BuilderInterface $query Тело запроса
     * @param array<string, string|int|float|null> $binds Массив биндов
     * @return $this Текущий объект класса
     */
    final public function raw (string|BuilderInterface $query, array $binds = []): static
    {
        if ($query instanceof BuilderInterface) {
            $binds = [...$binds, ...$query->getBinds(),];
            $query = "(\n\t{$query}\n\t)";
        }
        
        $this->binds = [...$this->binds, ...$binds,];
        $this->conditions[] = $query;
        
        return $this;
    }
    
    /**
     * Добавить условие where
     *
     * @param string|BuilderInterface $column Наименование  колонки
     * @param mixed|null $value значение
     * @param string $operator оператор
     *
     * @return $this Текущий объект класса
     */
    final public function where (string|BuilderInterface $column, mixed $value = null, string $operator = '='): static
    {
        $currentPrefix = $this->currentPrefix;
        $prefix = $this->getPrefix('AND');
        $value = $this->getValueStringParams($column, $value, $operator);
        
        if ($currentPrefix && $currentPrefix !== 'AND ') {
            array_unshift($this->conditions, '(');
            $this->conditions[] = ')';
        }
        
        $this->conditions[] = "{$prefix}{$column} {$value}";
        $this->currentPrefix = $prefix;
        
        return $this;
    }
    
    /**
     * Добавить условие or сгруппировав предыдущие
     *
     * @param string|BuilderInterface $column Наименование колонки
     * @param mixed|null $value значение
     * @param string $operator оператор
     *
     * @return $this Текущий объект класса
     */
    final public function orWhere (string|BuilderInterface $column, mixed $value = null, string $operator = '='): static
    {
        $currentPrefix = $this->currentPrefix;
        $prefix = $currentPrefix === 'OR ' ? 'AND ' : $this->getPrefix('OR');
        $value = $this->getValueStringParams($column, $value, $operator);
        
        if ($column instanceof BuilderInterface) {
            $this->binds = [
                ...$this->binds,
                ...$column->getBinds(),
            ];
        }
        
        if ($prefix !== 'AND ') {
            array_unshift($this->conditions, '(');
            $this->conditions[] = ')';
        }
        
        $this->conditions[] = "{$prefix}{$column} {$value}";
        
        return $this;
    }
    
    /**
     * Добавить условие AND без группировки
     *
     * @param string|BuilderInterface $column Наименование колонки
     * @param mixed|null $value значение
     * @param string $operator оператор
     *
     * @return $this Текущий объект класса
     */
    final public function and (string|BuilderInterface $column, mixed $value = null, string $operator = '='): static
    {
        $value = $this->getValueStringParams($column, $value, $operator);
        
        if ($column instanceof BuilderInterface) {
            $this->binds = [
                ...$this->binds,
                ...$column->getBinds(),
            ];
            $column = "(\n\t{$column}\n\t)";
        }
        
        $prefix = $this->getPrefix('AND');
        $this->conditions[] = "{$prefix}{$column} {$value}";
        
        return $this;
        
    }
    
    /**
     * Добавить условие OR без группировки
     *
     * @param string|BuilderInterface $column Наименование колонки
     * @param mixed|null $value значение
     * @param string $operator оператор
     *
     * @return $this Текущий объект класса
     */
    final public function or (string|BuilderInterface $column, mixed $value = null, string $operator = '='): static
    {
        $value = $this->getValueStringParams($column, $value, $operator);
        
        if ($column instanceof BuilderInterface) {
            $this->binds = [
                ...$this->binds,
                ...$column->getBinds(),
            ];
            $column = "(\n\t{$column}\n\t)";
        }
        
        $prefix = $this->getPrefix('OR');
        $this->conditions[] = "{$prefix}{$column} {$value}";
        
        return $this;
    }
    
    /**
     * Добавить условие IN
     *
     * @param string|BuilderInterface $column Колонка или подзапрос
     * @param array<mixed>|object $values значение для вхождения
     * @param bool $not отрицание вхождения
     * @param string $prefix Условный префих для составления запроса (AND|OR)
     *
     * @return $this Текущий объект класса
     */
    final public function in (string|BuilderInterface $column, object|array $values, bool $not = false, string $prefix = 'AND'): static
    {
        $prefix = $this->getPrefix($prefix);
        $values = (array) $values;
        $binds = $this->getBindColumnParam($values, $column);
        $suffix = $not === false ? ' ' : ' NOT ';
        
        if ($column instanceof BuilderInterface) {
            $this->binds = [
                ...$this->binds,
                ...$column->getBinds(),
            ];
            $column = "(\n\t{$column}\n\t)";
        }
        
        $this->conditions[] = "{$prefix}{$column}{$suffix}IN (\n\t" . implode(",\n\t", $binds) . "\n\t)";
        
        return $this;
    }
    
    /**
     * Добавить условие LIKE
     *
     * @param string $column Наименование колонки
     * @param string $value Значение поиска
     * @param bool $not Отрицание вхождения
     * @param string $prefix Условный префих для составления запроса (AND|OR)
     *
     * @return $this Текущий объект класса
     */
    final public function like (string $column, string $value, bool $not = false, string $prefix = 'AND'): static
    {
        $bind = $this->getBindName(mb_strtoupper($value), $column);
        
        if (is_array($bind)) {
            $bind = implode(", ", $bind);
        }
        
        $suffix = $not === false ? ' ' : ' NOT ';
        $prefix = $this->getPrefix($prefix);
        $this->conditions[] = "{$prefix} (UPPER({$column}){$suffix}LIKE {$bind})";
        
        return $this;
    }
    
    /**
     * Добавить условие BETWEEN (Диапазон значений)
     *
     * @param string|BuilderInterface $column Наименование колонки
     * @param mixed $start Старт вхождения
     * @param mixed $end Конец вхождений
     * @param bool $not Отрицание вхождения
     * @param string $prefix Условный префих для составления запроса (AND|OR)
     *
     * @return $this Текущий объект класса
     */
    final public function between (string|BuilderInterface $column, mixed $start, mixed $end, bool $not = false, string $prefix = 'AND'): static
    {
        $bindStart = $this->getBindName($start, "start_{$column}");
        
        if (is_array($bindStart)) {
            $bindStart = implode(", ", $bindStart);
        }
        
        $bindEnd = $this->getBindName($end, "end_{$column}");
        
        if (is_array($bindEnd)) {
            $bindEnd = implode(", ", $bindEnd);
        }
        
        $prefix = $this->getPrefix($prefix);
        $binds = [];
        
        if ($column instanceof BuilderInterface) {
            $binds = [
                ...$binds,
                ...$column->getBinds(),
            ];
            $column = "(\n\t{$column}\n\t)";
        }
        
        $this->binds = [
            ...$this->binds,
            ...$binds,
        ];
        $suffix = $not === false ? ' ' : ' NOT ';
        $this->conditions[] = "{$prefix} ({$column}{$suffix}BETWEEN {$bindStart} AND {$bindEnd})";
        
        return $this;
    }
    
    /**
     * @param string|BuilderInterface $column
     * @param Stringable|string|BuilderInterface $query
     * @param string $operator
     * @param string $prefix
     *
     * @return $this Текущий объект класса
     */
    final public function all (string|BuilderInterface $column, Stringable|string|BuilderInterface $query, string $operator = '=', string $prefix = 'AND'): static
    {
        $prefix = $this->getPrefix($prefix);
        [
            $column,
            $query,
            $operator,
        ] = $this->setGroupCondition($column, $query, $operator);
        $this->conditions[] = "{$prefix}{$column} {$operator} ALL (\n\t{$query}\n\t)";
        
        return $this;
        
    }
    
    /**
     * @param string|BuilderInterface $column
     * @param Stringable|string|BuilderInterface $query
     * @param string $operator
     *
     * @return array<int, string|Stringable>
     */
    private function setGroupCondition (string|BuilderInterface $column, Stringable|string|BuilderInterface $query, string $operator = '='): array
    {
        $binds = [];
        $operator = $this->getOperator($operator)->value;
        
        if ($column instanceof BuilderInterface) {
            $binds = [
                ...$binds,
                ...$column->getBinds(),
            ];
            $column = "(\n\t{$column}\n\t)";
        }
        
        if ($query instanceof BuilderInterface) {
            $binds = [
                ...$binds,
                ...$query->getBinds(),
            ];
        }
        
        $this->binds = [
            ...$this->binds,
            ...$binds,
        ];
        
        return [
            $column,
            $query,
            $operator,
        ];
    }
    
    /**
     * @param string|BuilderInterface $column
     * @param Stringable|string|BuilderInterface $query
     * @param string $operator
     * @param string $prefix
     *
     * @return $this Текущий объект класса
     */
    final public function any (string|BuilderInterface $column, Stringable|string|BuilderInterface $query, string $operator = '=', string $prefix = 'AND'): static
    {
        $prefix = $this->getPrefix($prefix);
        [
            $column,
            $query,
            $operator,
        ] = $this->setGroupCondition($column, $query, $operator);
        $this->conditions[] = "{$prefix}{$column} {$operator} ANY (\n\t{$query}\n\t)";
        
        return $this;
    }
    
    /**
     * @param string|BuilderInterface $query
     * @param bool $not
     *
     * @return $this Текущий объект класса
     */
    final public function exists (string|BuilderInterface $query, bool $not = false): static
    {
        if ($query instanceof BuilderInterface) {
            $this->binds = [
                ...$this->binds,
                ...$query->getBinds(),
            ];
        }
        
        $condition = "EXISTS (\n\t{$query}\n\t)";
        array_unshift($this->conditions, $condition);
        
        return $this;
    }
    
    /**
     * @param string|BuilderInterface $column
     * @param string|BuilderInterface $query
     * @param string $operator
     * @param string $prefix
     *
     * @return $this Текущий объект класса
     */
    final public function some (string|BuilderInterface $column, string|BuilderInterface $query, string $operator = '=', string $prefix = 'AND'): static
    {
        $prefix = $this->getPrefix($prefix);
        [
            $column,
            $query,
            $operator,
        ] = $this->setGroupCondition($column, $query, $operator);
        $this->conditions[] = "{$prefix}{$column} {$operator} SOME (\n\t{$query}\n\t)";
        
        return $this;
    }
    
    /**
     * @param string|BuilderInterface $query
     * @param bool $all
     *
     * @return $this Текущий объект класса
     */
    final public function union (string|BuilderInterface $query, bool $all = false): static
    {
        $prefix = $all === false ? ' ' : 'ALL ';
        
        if ($query instanceof BuilderInterface) {
            $this->binds = [
                ...$this->binds,
                ...$query->getBinds(),
            ];
            $query = "{$prefix}(\n\t{$query}\n\t)";
        }
        
        $this->union[md5($query)] = $query;
        
        return $this;
    }
    
    /**
     * Группировать по колонке
     *
     * @param string $column Колонка
     *
     * @return $this Текущий объект класса
     */
    final public function groupBy (string $column): static
    {
        $column = trim($column);
        $this->groupBy[$column] = $column;
        
        return $this;
    }
    
    /**
     * Сортировать по колонке
     *
     * @param string $column Колонка
     * @param string $direction Направление сортировки ASC - по возрастанию, DESC - по уменьшению
     *
     * @return $this Текущий объект класса
     */
    final public function orderBy (string $column, string $direction = 'ASC'): static
    {
        $column = trim($column);
        $direction = trim(mb_strtoupper($direction));
        
        if ($direction !== 'ASC') {
            $direction = 'DESC';
        }
        
        $this->orderBy[$column] = $direction;
        
        return $this;
    }
    
    /**
     * Задать лимит записей
     *
     * @param int $limit Лимит
     *
     * @return $this Текущий объект класса
     */
    final public function limit (int $limit): static
    {
        $this->limit = $limit;
        
        return $this;
    }
    
    /**
     * Пропустить записей
     *
     * @param int $offset Пропустить
     *
     * @return $this Текущий объект класса
     */
    final public function offset (int $offset): static
    {
        $this->offset = $offset;
        
        return $this;
    }
    
    /**
     * @param string $column
     * @return HavingInterface
     */
    final public function having (string $column): HavingInterface
    {
        $column = trim($column);
        $having = new Having();
        $having->column($column);
        $this->having[] = $having;
        
        return $having;
    }
    
    /**
     * Получить строку запроса
     */
    abstract public function toSql (): string;
    
    /**
     * @return array<string>
     */
    final protected function getConditions (): array
    {
        $conditions = [
            'with' => '',
            'where' => '',
        ];
        
        if ($this->with) {
            $conditions['with'] = $this->getWith();
        }
        
        if ($this->conditions) {
            $conditions['where'] = $this->getThisConditions();
        }
        
        return $conditions;
    }
    
    /**
     * @return string
     */
    private function getWith (): string
    {
        return 'WITH ' . implode(",\n", $this->with) . "\n";
        
    }
    
    /**
     * @return string
     */
    private function getThisConditions (): string
    {
        $where = "WHERE\n\t";
        $where .= implode("\n\t", $this->conditions) . "\n";
        
        if ($this->having) {
            $where .= 'HAVING ' . implode("\n\t", $this->having) . "\n";
        }
        
        if ($this->groupBy) {
            $where .= "GROUP BY\n\t";
            $where .= implode("\n\t", $this->groupBy) . "\n";
        }
        
        if ($this->union) {
            $where .= "UNION\n\t";
            $where .= implode("\n\t", $this->union) . "\n";
        }
        
        if ($this->orderBy) {
            $where .= "ORDER BY\n\t";
            $where .= implode("\n\t", $this->orderBy) . "\n";
        }
        
        if ($this->limit) {
            $where .= "LIMIT {$this->limit}\n";
        }
        
        if ($this->offset) {
            $where .= "OFFSET {$this->offset}\n";
        }
        
        return $where;
    }
    
    /**
     * @param string|BuilderInterface $column
     * @param mixed $value
     * @param string $operator
     *
     * @return string
     */
    private function getValueStringParams (string|BuilderInterface $column, mixed $value, string $operator): string
    {
        if($column instanceof BuilderInterface) {
            $bindName = md5($column->toSql());
        }else{
            $bindName = $column;
        }
        
        return $this->valueToString($value, $this->getOperator($operator), $bindName);
    }
    
    /**
     * @param array<mixed> $values
     * @param string|BuilderInterface $column
     *
     * @return array<string>
     */
    private function getBindColumnParam (array $values, string|BuilderInterface $column): array
    {
        if ($column instanceof BuilderInterface) {
            $bindName = md5($column->toSql());
        }else{
            $bindName = $column;
        }
        
        return (array)$this->getBindName($values, $bindName);
    }
}
