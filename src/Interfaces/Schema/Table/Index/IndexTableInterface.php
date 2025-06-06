<?php

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Table\Index;

interface IndexTableInterface
{
    /**
     * Задать наименование индекса для дальнейшей установки параметров запроса
     *
     * @param string $indexName Наименование индекса
     * @return $this Текущий объект класса
     */
    public function name (string $indexName): self;
}