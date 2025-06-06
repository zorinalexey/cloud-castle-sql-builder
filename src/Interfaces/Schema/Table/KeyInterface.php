<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table;

use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Key\AlterKeyInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Key\CreateKeyInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Key\DropKeyInterface;

/**
 * Интерфейс определяет методы генерации запроса модификации ключей
 */
interface KeyInterface
{
    /**
     * Метод генерации запроса создания ключа
     *
     * @return CreateKeyInterface Объект установки параметров ключа
     */
    public function create(): CreateKeyInterface;
    
    /**
     * Метод генерации запроса удаления ключа
     *
     * @return DropKeyInterface Объект генерации запроса удаления ключа
     */
    public function drop(): DropKeyInterface;
    
    /**
     * Метод генерации запроса изменения ключа
     *
     * @return AlterKeyInterface Объект установки параметров ключа
     */
    public function alter(): AlterKeyInterface;
}