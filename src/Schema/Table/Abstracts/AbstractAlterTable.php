<?php

namespace CloudCastle\SqlBuilder\Schema\Table\Abstracts;

use CloudCastle\SqlBuilder\Exceptions\InvalidArgumentException;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Action\AlterTableInterface;

abstract class AbstractAlterTable extends AbstractCreateTable implements AlterTableInterface
{
    /**
     * @var string|null
     */
    protected string|null $rename = null;
    
    /**
     * Метод переименования таблицы
     *
     * @param string $newTableName Новое наименование таблицы
     * @return $this
     * @throws InvalidArgumentException
     */
    final public function rename (string $newTableName): self
    {
        $this->validator->validateTableName($newTableName);
        $this->rename = $newTableName;
        
        return $this;
    }
}