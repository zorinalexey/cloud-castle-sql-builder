<?php

namespace CloudCastle\SqlBuilder\Traits;

use CloudCastle\SqlBuilder\Enums\OperatorValueEnum;

/**
 * Трейт предоставляет метод для получения условного оператора из строки
 */
trait GetOperatorTrait
{
    /**
     * Получить объект перечисления из строки
     *
     * @param string $operator оператор
     */
    final protected function getOperator (string $operator): OperatorValueEnum
    {
        if ($case = OperatorValueEnum::tryFrom(mb_strtoupper($operator))) {
            return $case;
        }
        
        return OperatorValueEnum::EQUALS;
    }
}
