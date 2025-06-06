<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Query;

use CloudCastle\SqlBuilder\Interfaces\BuilderInterface;


/**
 * Интерфейс определяет основные методы для генерации SQL-запроса обновления данных
 */
interface UpdateInterface extends BuilderInterface, ConditionInterface
{
    /**
     * Ассоциативный массив или объект (Ключ|Свойство = Значение), где ключ наименование колонки
     *
     * @param object|array<mixed> $values Значения
     *
     * @return $this Текущий объект класса
     */
    public function set (array|object $values): static;
}
