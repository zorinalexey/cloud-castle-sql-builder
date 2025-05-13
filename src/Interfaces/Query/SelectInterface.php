<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Query;

use CloudCastle\SqlBuilder\Interfaces\BuilderInterface;

/**
 * Интерфейс определяет основные методы для генерации SQL-запроса выборки данных
 */
interface SelectInterface extends BuilderInterface, ConditionInterface
{
    /**
     * Задать колонки для выборки данных
     *
     * @param string|array<string>|BuilderInterface $columns Колонки(колонка) или под запрос для получения в выборки
     *
     * @return $this
     */
    public function columns (array|string|BuilderInterface $columns = '*'): static;
    
    /**
     * Получить минимальное значение по колонке
     *
     * @param string $column Наименование колонки
     * @param string|null $alias Псевдоним колонки
     *
     * @return $this
     */
    public function min (string $column, ?string $alias = null): static;
    
    /**
     * Получить максимальное значение по колонке
     *
     * @param string $column Наименование колонки
     * @param string|null $alias Псевдоним колонки
     *
     * @return $this
     */
    public function max (string $column, ?string $alias = null): static;
    
    /**
     * Получить среднее значение по колонке
     *
     * @param string $column Наименование колонки
     * @param string|null $alias Псевдоним колонки
     *
     * @return $this
     */
    public function avg (string $column, ?string $alias = null): static;
    
    /**
     * Получить сумму всех значений по колонке
     *
     * @param string $column Наименование колонки
     * @param string|null $alias Псевдоним колонки
     *
     * @return $this
     */
    public function sum (string $column, ?string $alias = null): static;
    
    /**
     * Соединить с таблицей
     *
     * @param string $table таблица для соединения
     * @param string $joinType Тип соединения
     *
     * @return JoinInterface
     */
    public function join (string $table, string $joinType = 'left'): JoinInterface;
    
    /**
     * Создать перечисление
     *
     * @param string $alias Наименование
     *
     * @return CaseInterface
     */
    public function case (string $alias): CaseInterface;
    
    /**
     * Задать уникальность по колонке (колонкам)
     *
     * @param array<string>|string $columns Наименование колонки (колонок)
     *
     * @return $this
     */
    public function distinct (array|string $columns = 'id'): static;
}
