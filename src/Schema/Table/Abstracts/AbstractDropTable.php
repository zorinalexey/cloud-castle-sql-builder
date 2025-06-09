<?php

namespace CloudCastle\SqlBuilder\Schema\Table\Abstracts;

use CloudCastle\SqlBuilder\Common\Builder;
use CloudCastle\SqlBuilder\Interfaces\Schema\Table\Action\DropTableInterface;

abstract class AbstractDropTable extends AbstractTable implements DropTableInterface
{
    /**
     * @var bool
     */
    protected bool $cascade = false;
    
    /**
     * @var bool
     */
    protected bool $ifExists = false;
    
    /**
     * Получить подготовленную строку запроса с заполнителями(биндами)
     *
     * @return string
     */
    abstract public function toSql (): string;
    
    /**
     * Метод удаления без выброса ошибки отсутствия таблицы
     *
     * @return DropTableInterface
     */
    final public function ifExists (): DropTableInterface
    {
        $this->ifExists = true;
        
        return $this;
    }
    
    /**
     * Метод определяет каскадное удаление
     *
     * @param bool $cascade
     * @return DropTableInterface
     */
    final public function cascade (bool $cascade = false): DropTableInterface
    {
        $this->cascade = $cascade;
        
        return $this;
    }
}