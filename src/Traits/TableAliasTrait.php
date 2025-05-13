<?php

namespace CloudCastle\SqlBuilder\Traits;

/**
 * Трейт предоставляет метод задания алиаса для таблицы
 */
trait TableAliasTrait
{
    /**
     * Псевдоним таблицы
     *
     * @var string|null
     */
    protected ?string $alias = null;
    
    /**
     * Задать псевдоним
     *
     * @param string $alias Псевдоним
     * @return $this
     */
    final public function alias (string $alias): static
    {
        $this->alias = trim($alias);
        
        return $this;
    }
}
