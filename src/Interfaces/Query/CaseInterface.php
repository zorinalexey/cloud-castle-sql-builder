<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Query;

/**
 * Интерфейс определяет методы генерации условий перечисления
 */
interface CaseInterface
{
    /**
     * @return $this
     */
    public function when (string $condition, string|int|bool|float $result): static;
    
    /**
     * @return $this
     */
    public function else (string|int|bool|float $result): static;
    
    /**
     * @return $this
     */
    public function alias (string $alias): static;
}
