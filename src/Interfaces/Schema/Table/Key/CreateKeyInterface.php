<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table\Key;

use CloudCastle\SqlBuilder\Enums\KeyTypeEnum;

interface CreateKeyInterface extends KeyTableInterface
{
    /**
     * Метод определяет установку типа ключа
     *
     * @param KeyTypeEnum $keyType
     * @return CreateKeyInterface
     */
    public function type(KeyTypeEnum $keyType): CreateKeyInterface;
}