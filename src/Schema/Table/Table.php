<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Schema\Table;

use CloudCastle\SqlBuilder\Enums\DriverEnum;
use CloudCastle\SqlBuilder\Exceptions\InvalidArgumentException;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Action\AlterTableInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Action\CreateTableInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Action\DropTableInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Action\TransactionInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\TableInterface;
use CloudCastle\SqlBuilder\Schema\AbstractSchema;

/**
 * Класс предоставляет методы модификации таблицы БД
 */
final class Table extends AbstractSchema implements TableInterface
{
    /**
     * Наименование таблицы
     *
     * @var string|null
     */
    private string|null $name = null;
    
    /**
     * Драйвер класса генерации запроса
     *
     * @var DriverEnum|null
     */
    private DriverEnum|null $driver = null;
    
    /**
     * Драйвер класса управления транзакциями
     *
     * @var TransactionInterface|null
     */
    public TransactionInterface|null $transaction = null;
    
    /**
     * Метод генерации запроса создания таблицы
     *
     * @return CreateTableInterface Объект генерации запроса создания таблицы
     */
    public function create (): CreateTableInterface
    {
        $class = $this->getNameSpace() . '\CreateTable';
        /** @var CreateTableInterface $obj */
        $obj = new $class();
        $obj->name($this->name);
        
        return $obj;
    }
    
    /**
     * Метод предоставляет пространство имен класса, для создания объекта генерации запроса, в зависимости от драйвера.
     *
     * @return string Пространство имен генератора запроса
     */
    private function getNameSpace (): string
    {
        return '\CloudCastle\SqlBuilder\Schema\Table\Drivers\\' . $this->driver->name;
    }
    
    /**
     * Задать наименование таблицы для дальнейшей вызова метода генерации запроса
     *
     * @param string $tableName Наименование таблицы
     * @return $this Текущий объект класса
     * @throws InvalidArgumentException
     */
    public function name (string $tableName): self
    {
        $this->validator->validateTableName($tableName);
        $this->name = $tableName;
        
        return $this;
    }
    
    /**
     * Метод генерации запроса удаления таблицы
     *
     * @return DropTableInterface Объект генерации запроса удаления таблицы
     */
    public function drop (): DropTableInterface
    {
        $class = $this->getNameSpace() . '\DropTable';
        /** @var DropTableInterface $obj */
        $obj = new $class();
        $obj->name($this->name);
        
        return $obj;
    }
    
    /**
     * Метод генерации запроса изменения таблицы
     *
     * @return AlterTableInterface Объект генерации запроса изменения таблицы
     */
    public function alter (): AlterTableInterface
    {
        $class = $this->getNameSpace() . '\AlterTable';
        /** @var AlterTableInterface $obj */
        $obj = new $class();
        $obj->name($this->name);
        
        return $obj;
    }
    
    /**
     * Метод установки драйвера объекта запроса
     *
     * @param DriverEnum $driver Драйвер типа БД
     * @return $this Текущий объект класса
     */
    public function driver (DriverEnum $driver): self
    {
        $this->driver = $driver;
        
        return $this;
    }
    
    /**
     * Метод генерации запроса в управляемой транзакции
     *
     * @return TransactionInterface Объект управления транзакциями
     */
    public function transaction (): TransactionInterface
    {
        $class = $this->getNameSpace() . '\Transaction';
        /** @var TransactionInterface $obj */
        $obj = new $class();
        $this->transaction = $obj;
        
        return $obj;
    }
}