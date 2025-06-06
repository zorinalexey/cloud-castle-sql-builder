<?php

declare(strict_types = 1);

namespace CloudCastle\SqlBuilder\Interfaces\Schema\Procedure;

use CloudCastle\SqlBuilder\Interfaces\Schema\Procedure\Action\AlterProcedureInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Procedure\Action\CreateProcedureInterface;
use CloudCastle\SqlBuilder\Interfaces\Schema\Procedure\Action\DropProcedureInterface;

interface ProcedureInterface
{
    /**
     * Метод генерации запроса создания хранимой процедуры
     *
     * @return CreateProcedureInterface
     */
    public function create (): CreateProcedureInterface;
    
    /**
     * Метод генерации запроса изменения хранимой процедуры
     *
     * @return AlterProcedureInterface
     */
    public function alter (): AlterProcedureInterface;
    
    /**
     * Метод генерации запроса удаления хранимой процедуры
     *
     * @return DropProcedureInterface
     */
    public function drop (): DropProcedureInterface;
}