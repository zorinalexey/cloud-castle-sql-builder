<?php

declare(strict_types=1);

namespace CloudCastle\SqlBuilder\Schema\Table\Abstracts;

use CloudCastle\SqlBuilder\Exceptions\InvalidArgumentException;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Action\CreateTableInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\ColumnInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\IndexInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\KeyInterface;

abstract class AbstractCreateTable extends AbstractTable implements CreateTableInterface
{
    /**
     * @var array
     */
    protected array $indexes = [];
    
    /**
     * @var array
     */
    protected array $columns = [];
    
    /**
     * @var array
     */
    protected array $keys = [];
    
    /**
     * Получить подготовленную строку запроса с заполнителями(биндами)
     *
     * @return string
     */
    abstract public function toSql (): string;
    
    /**
     * Метод модификации колонок таблицы
     *
     * @param string $columnName Наименование колонки
     * @return ColumnInterface Объект модификации колонки
     * @throws InvalidArgumentException
     */
    final public function column (string $columnName): ColumnInterface
    {
        $this->validator->validateColumnName($columnName);
        
        if(!isset($this->columns[$columnName])) {
            $columnClass = $this->getNameSpace().'\\Column';
            $this->columns[$columnName] = new $columnClass($columnName);
        }
        
        return $this->columns[$columnName];
    }
    
    /**
     * Метод предоставляет пространство имен класса, для создания объекта генерации запроса, в зависимости от драйвера.
     *
     * @return string Пространство имен генератора запроса
     */
    final protected function getNameSpace (): string
    {
        return '\CloudCastle\SqlBuilder\Schema\Table\Drivers\\' . $this->driver->name;
    }
    
    /**
     * Метод модификации индексов таблицы
     *
     * @param string $indexName Наименование индекса
     * @return IndexInterface Объект модификации индекса
     * @throws InvalidArgumentException
     */
    final public function index (string $indexName): IndexInterface
    {
        $this->validator->validateIndexName($indexName);
        
        if(!isset($this->indexes[$indexName])) {
            $indexClass = $this->getNameSpace().'\\Index';
            $this->indexes[$indexName] = new $indexClass($indexName);
        }
        
        return $this->indexes[$indexName];
    }
    
    /**
     * Метод модификации ключей таблицы
     *
     * @param string $keyName Наименование ключа
     * @return KeyInterface Объект модификации ключа
     * @throws InvalidArgumentException
     */
    final public function key (string $keyName): KeyInterface
    {
        $this->validator->validateKeyName($keyName);
        
        if(!isset($this->keys[$keyName])) {
            $keyClass = $this->getNameSpace().'\\Key';
            $this->keys[$keyName] = new $keyClass($keyName);
        }
        
        return $this->keys[$keyName];
    }
}