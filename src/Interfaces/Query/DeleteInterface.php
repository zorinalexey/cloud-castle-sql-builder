<?php

namespace CloudCastle\SqlBuilder\Interfaces\Query;

use CloudCastle\SqlBuilder\Interfaces\BuilderInterface;

/**
 * Интерфейс определяет основные методы для генерации SQL-запроса удаления данных
 */
interface DeleteInterface extends BuilderInterface, ConditionInterface
{
}
