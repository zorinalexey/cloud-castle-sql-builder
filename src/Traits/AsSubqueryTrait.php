<?php

namespace CloudCastle\SqlBuilder\Traits;

/**
 * Трейт предоставляет метод для задания алиаса запросу для использования его как подзапрос
 */
trait AsSubqueryTrait
{
    /**
     * Алиас подзапроса
     *
     * @var string|null
     */
    protected string|null $subQuery = null;
    
    /**
     * Использовать как подзапрос
     *
     * @param string $name Наименование подзапроса
     *
     * @return $this Текущий объект класса
     */
    final public function asSubquery (string $name): static
    {
        $this->subQuery = $name;
        
        return $this;
    }
}