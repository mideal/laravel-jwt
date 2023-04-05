<?php

namespace Mideal\Jwt\Facades;

use Illuminate\Support\Facades\Facade;

class JwtServiceFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'jwt';
    }
}
