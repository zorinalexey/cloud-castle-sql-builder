<?php

namespace CloudCastle\SqlBuilder\Traits;

trait GetPrefixTrait
{
    /**
     * @var string|null
     */
    protected ?string $currentPrefix = null;
    
    /**
     * Получить текущий префикс
     *
     * @param string $prefix Префикс
     */
    final protected function getPrefix (string $prefix): string
    {
        $prefix = trim(mb_strtoupper($prefix));
        
        if (count($this->conditions) === 0) {
            $prefix = null;
        }
        
        $this->currentPrefix = match ($prefix) {
            'OR' => 'OR ',
            null => '',
            default => 'AND ',
        };
        
        return $this->currentPrefix;
    }
}
