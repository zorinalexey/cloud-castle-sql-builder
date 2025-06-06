<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table\Key;

use CloudCastle\SqlBuilder\Enums\KeyTypeEnum;

interface AlterKeyInterface extends KeyTableInterface
{
    /**
     * Метод определяет установку типа ключа
     *
     * @param KeyTypeEnum $keyType
     * @return AlterKeyInterface
     */
    public function type(KeyTypeEnum $keyType): AlterKeyInterface;
}