<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table\Index;

use CloudCastle\SqlBuilder\Enums\IndexTypeEnum;

interface CreateIndexInterface extends IndexTableInterface
{
    /**
     * Метод определяет установку типа индекса
     *
     * @param IndexTypeEnum $keyType
     * @return CreateIndexInterface
     */
    public function type(IndexTypeEnum $keyType): CreateIndexInterface;
}