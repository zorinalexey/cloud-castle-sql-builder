<?php

namespace CloudCastle\SqlBuilder\Schema\Table\Abstracts;

use CloudCastle\SqlBuilder\Common\Builder;
use CloudCastle\SqlBuilder\Common\Validator;
use CloudCastle\SqlBuilder\Enums\DriverEnum;
use CloudCastle\SqlBuilder\Exceptions\InvalidArgumentException;

abstract class AbstractTable extends Builder
{
    /**
     * @var Validator
     */
    protected readonly Validator $validator;
    
    /**
     * @var DriverEnum
     */
    protected readonly DriverEnum $driver;
    
    /**
     * @var string|null
     */
    protected string|null $name = null;
    
    /**
     * @param DriverEnum $driver
     */
    final public function __construct(DriverEnum $driver)
    {
        $this->validator = new Validator();
        $this->driver = $driver;
    }
    
    /**
     * Задать наименование таблицы для дальнейшей установки параметров запроса
     *
     * @param string $tableName Наименование таблицы
     * @return $this Текущий объект класса
     * @throws InvalidArgumentException
     */
    final public function name (string $tableName): self
    {
        $this->validator->validateTableName($tableName);
        $this->name = $tableName;
        
        return $this;
    }
}