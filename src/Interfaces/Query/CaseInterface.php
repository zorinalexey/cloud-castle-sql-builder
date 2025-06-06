<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Query;

/**
 * Интерфейс определяет методы генерации условий перечисления
 */
interface CaseInterface
{
    /**
     * @return $this Текущий объект класса
     */
    public function when (string $condition, string|int|bool|float $result): static;
    
    /**
     * @return $this Текущий объект класса
     */
    public function else (string|int|bool|float $result): static;
    
    /**
     * @return $this Текущий объект класса
     */
    public function alias (string $alias): static;
}
