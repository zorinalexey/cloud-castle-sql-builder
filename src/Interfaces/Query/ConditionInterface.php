<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Query;

use CloudCastle\SqlBuilder\Interfaces\BuilderInterface;
use Stringable;

/**
 * Интерфейс определяет методы для генерации условий запроса
 */
interface ConditionInterface
{
    /**
     * Задает условие with перед запросом для дальнейшего его использования в теле запроса
     *
     * @param string $name Наименование условной функции
     * @param string|BuilderInterface $query тело функции
     *
     * @return $this
     */
    public function with (string $name, string|BuilderInterface $query): static;
    
    /**
     * Добавить в запрос сырую часть запроса
     *
     * @param string|BuilderInterface $query Тело запроса
     * @param array<mixed> $binds Массив биндов
     *
     * @return $this
     */
    public function raw (string|BuilderInterface $query, array $binds = []): static;
    
    /**
     * Добавить условие where
     *
     * @param string|BuilderInterface $column Наименование колонки
     * @param mixed|null $value значение
     * @param string $operator оператор
     *
     * @return $this
     */
    public function where (string|BuilderInterface $column, mixed $value = null, string $operator = '='): static;
    
    /**
     * Добавить условие or сгруппировав предыдущие
     *
     * @param string|BuilderInterface $column Наименование колонки
     * @param mixed|null $value значение
     * @param string $operator оператор
     *
     * @return $this
     */
    public function orWhere (string|BuilderInterface $column, mixed $value = null, string $operator = '='): static;
    
    /**
     * Добавить условие AND без группировки
     *
     * @param string|BuilderInterface $column Наименование колонки
     * @param mixed|null $value значение
     * @param string $operator оператор
     *
     * @return $this
     */
    public function and (string|BuilderInterface $column, mixed $value = null, string $operator = '='): static;
    
    /**
     * Добавить условие OR без группировки
     *
     * @param string|BuilderInterface $column Наименование колонки
     * @param mixed|null $value значение
     * @param string $operator оператор
     *
     * @return $this
     */
    public function or (string|BuilderInterface $column, mixed $value = null, string $operator = '='): static;
    
    /**
     * Добавить условие IN
     *
     * @param string|BuilderInterface $column Колонка или подзапрос
     * @param array<mixed>|object $values значение для вхождения
     * @param bool $not отрицание вхождения
     * @param string $prefix Условный префих для составления запроса (AND|OR)
     *
     * @return $this
     */
    public function in (string|BuilderInterface $column, object|array $values, bool $not = false, string $prefix = 'AND'): static;
    
    /**
     * Добавить условие LIKE
     *
     * @param string $column Наименование колонки
     * @param string $value Значение поиска
     * @param bool $not Отрицание вхождения
     * @param string $prefix Условный префих для составления запроса (AND|OR)
     *
     * @return $this
     */
    public function like (string $column, string $value, bool $not = false, string $prefix = 'AND'): static;
    
    /**
     * Добавить условие BETWEEN (Диапазон значений)
     *
     * @param string|BuilderInterface $column Наименование колонки
     * @param mixed $start Старт вхождения
     * @param mixed $end Конец вхождений
     * @param bool $not Отрицание вхождения
     * @param string $prefix Условный префих для составления запроса (AND|OR)
     *
     * @return $this
     */
    public function between (string|BuilderInterface $column, mixed $start, mixed $end, bool $not = false, string $prefix = 'AND'): static;
    
    /**
     * @param string|BuilderInterface $column
     * @param string|Stringable|BuilderInterface $query
     * @param string $operator
     * @param string $prefix
     *
     * @return $this
     */
    public function all (string|BuilderInterface $column, string|Stringable|BuilderInterface $query, string $operator = '=', string $prefix = 'AND'): static;
    
    /**
     * @param string|BuilderInterface $column
     * @param string|Stringable|BuilderInterface $query
     * @param string $operator
     * @param string $prefix
     *
     * @return $this
     */
    public function any (string|BuilderInterface $column, string|Stringable|BuilderInterface $query, string $operator = '=', string $prefix = 'AND'): static;
    
    /**
     * @param string|BuilderInterface $query
     * @param bool $not
     *
     * @return $this
     */
    public function exists (string|BuilderInterface $query, bool $not = false): static;
    
    /**
     * @param string|BuilderInterface $column
     * @param string|BuilderInterface $query
     * @param string $operator
     * @param string $prefix
     *
     * @return $this
     */
    public function some (string|BuilderInterface $column, string|BuilderInterface $query, string $operator = '=', string $prefix = 'AND'): static;
    
    /**
     * Объединить с подзапросом
     *
     * @param string|BuilderInterface $query Подзапрос
     * @param bool $all Тип объединения ALL
     *
     * @return $this
     */
    public function union (string|BuilderInterface $query, bool $all = false): static;
    
    /**
     * Задать группировку по колонке
     *
     * @param string $column Наименование колонки
     *
     * @return $this
     */
    public function groupBy (string $column): static;
    
    /**
     * Задать сортировку по колонке
     *
     * @param string $column Наименование колонки
     * @param string $direction Направление сортировки
     *
     * @return $this
     */
    public function orderBy (string $column, string $direction = 'ASC'): static;
    
    /**
     * Задать лимит строк в выборке
     *
     * @return $this
     */
    public function limit (int $limit): static;
    
    /**
     * Пропустить заданное количество строк
     *
     * @return $this
     */
    public function offset (int $offset): static;
    
    /**
     * @param string $column Наименование колонки
     *
     * @return HavingInterface
     */
    public function having (string $column): HavingInterface;
    
    /**
     * Использовать как подзапрос
     *
     * @param string $name Наименование подзапроса
     *
     * @return $this
     */
    public function asSubquery (string $name): static;
}
