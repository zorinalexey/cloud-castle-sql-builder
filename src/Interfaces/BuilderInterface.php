<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces;

/**
 * Интерфейс определяет основные методы для преобразования объектов в SQL-запрос
 */
interface BuilderInterface
{
    /**
     * Получить строку запроса
     *
     * @return string
     */
    public function __toString (): string;
    
    /**
     * Получить строку запроса
     *
     * @return string
     */
    public function toSql (): string;
    
    /**
     * Получить строку в виде сырого запроса
     *
     * @return string
     */
    public function toRawSql (): string;
    
    /**
     * Получить бинды запроса
     *
     * @return array<string>
     */
    public function getBinds (): array;
    
    /**
     * Задать таблицу
     *
     * @param string $tableName наименование таблицы
     *
     * @return $this
     */
    public function table (string $tableName): static;
}
