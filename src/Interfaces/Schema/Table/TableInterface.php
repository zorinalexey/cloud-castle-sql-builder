<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table;

use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Action\AlterTableInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Action\CreateTableInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Action\DropTableInterface;

/**
 * Интерфейс определяет методы модификации таблицы БД и управление транзакциями
 */
interface TableInterface
{
    /**
     * Метод генерации запроса создания таблицы
     *
     * @return CreateTableInterface Объект генерации запроса создания таблицы
     */
    public function create (): CreateTableInterface;
    
    /**
     * Метод генерации запроса удаления таблицы
     *
     * @return DropTableInterface Объект генерации запроса удаления таблицы
     */
    public function drop (): mixed;
    
    /**
     * Метод генерации запроса изменения таблицы
     *
     * @return AlterTableInterface Объект генерации запроса изменения таблицы
     */
    public function alter (): AlterTableInterface;
    
    /**
     * Метод генерации запроса в управления транзакциями
     *
     * @return TransactionInterface Объект управления транзакциями
     */
    public function transaction (): TransactionInterface;
}