<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table;

use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Index\AlterIndexInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Index\CreateIndexInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Index\DropIndexInterface;

/**
 * Интерфейс определяет методы генерации запроса модификации индексов
 */
interface IndexInterface
{
    /**
     * Метод генерации запроса создания индекса
     *
     * @return CreateIndexInterface Объект установки параметров индекса
     */
    public function create(): CreateIndexInterface;
    
    /**
     * Метод генерации запроса удаления индекса
     *
     * @return DropIndexInterface Объект генерации запроса удаления индекса
     */
    public function drop(): DropIndexInterface;
    
    /**
     * Метод генерации запроса изменения индекса
     *
     * @return AlterIndexInterface Объект установки параметров индекса
     */
    public function alter(): AlterIndexInterface;
}