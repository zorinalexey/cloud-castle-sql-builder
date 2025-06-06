<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Procedure\Action;

interface ActionProcedureInterface
{
    /**
     * Метод установки наименования хранимой процедуры для дальнейшей работы с ней
     *
     * @param string $name Наименование хранимой процедуры
     * @return self
     */
    public function name (string $name): self;
}