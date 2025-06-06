<?php

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table\Key;

interface KeyTableInterface
{
    /**
     * Задать наименование ключа для дальнейшей установки параметров запроса
     *
     * @param string $keyName Наименование ключа
     * @return $this Текущий объект класса
     */
    public function name (string $keyName): self;
}