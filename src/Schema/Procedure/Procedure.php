<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Schema\Procedure;

use CloudCastle\SqlBuilder\Enums\DriverEnum;
use CloudCastle\SqlBuilder\Exceptions\InvalidArgumentException;
use CloudCastle\SqlBuilder\Interfaces\Schema\Procedure\Action\AlterProcedureInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Procedure\Action\CreateProcedureInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Procedure\Action\DropProcedureInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Procedure\ProcedureInterface;
use CloudCastle\SqlBuilder\Schema\AbstractSchema;

final class Procedure extends AbstractSchema implements ProcedureInterface
{
    /**
     * Наименование хранимой процедуры
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
     * Метод установки драйвера объекта запроса
     *
     * @param DriverEnum $driver
     * @return $this Текущий объект класса
     */
    public function driver (DriverEnum $driver): self
    {
        $this->driver = $driver;
        
        return $this;
    }
    
    /**
     * Метод генерации запроса создания хранимой процедуры
     *
     * @return CreateProcedureInterface
     */
    public function create (): CreateProcedureInterface
    {
        $class = $this->getNameSpace() . '\CreateProcedure';
        /** @var CreateProcedureInterface $obj */
        $obj = new $class();
        $obj->name($this->name);
        
        return $obj;
    }
    
    /**
     * Метод предоставляет пространство имен класса, для создания объекта генерации запроса, в зависимости от драйвера.
     *
     * @return string
     */
    private function getNameSpace (): string
    {
        return '\CloudCastle\SqlBuilder\Schema\Procedure\Drivers\\' . $this->driver->name;
    }
    
    /**
     * Задать наименование процедуры для дальнейшей вызова метода генерации запроса
     *
     * @param string $procedureName Наименование хранимой процедуры
     * @return $this Текущий объект класса
     * @throws InvalidArgumentException
     */
    public function name (string $procedureName): self
    {
        $this->validator->validateProcedureName($procedureName);
        $this->name = $procedureName;
        
        return $this;
    }
    
    /**
     * Метод генерации запроса изменения хранимой процедуры
     *
     * @return AlterProcedureInterface
     */
    public function alter (): AlterProcedureInterface
    {
        $class = $this->getNameSpace() . '\AlterProcedure';
        /** @var AlterProcedureInterface $obj */
        $obj = new $class();
        $obj->name($this->name);
        
        return $obj;
    }
    
    /**
     * Метод генерации запроса удаления хранимой процедуры
     *
     * @return DropProcedureInterface
     */
    public function drop (): DropProcedureInterface
    {
        $class = $this->getNameSpace() . '\DropProcedure';
        /** @var DropProcedureInterface $obj */
        $obj = new $class();
        $obj->name($this->name);
        
        return $obj;
    }
}