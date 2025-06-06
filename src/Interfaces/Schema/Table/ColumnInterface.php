<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table;

use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Column\AlterColumnInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Column\CreateColumnInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Column\DropColumnInterface;

/**
 * Интерфейс определяет методы генерации запроса модификации колонок таблицы
 */
interface ColumnInterface
{
    
    /**
     * Метод генерации запроса создания колонки
     *
     * @return CreateColumnInterface Объект генерации запроса создания колонки
     */
    public function create(): CreateColumnInterface;
    
    /**
     * Метод генерации запроса удаления колонки
     *
     * @return DropColumnInterface Объект генерации запроса удаления колонки
     */
    public function drop(): DropColumnInterface;
    
    /**
     * Метод генерации запроса изменения колонки
     *
     * @return AlterColumnInterface Объект генерации запроса изменения колонки
     */
    public function alter(): AlterColumnInterface;
}