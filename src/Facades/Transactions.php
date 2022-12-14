<?php

namespace Backpack\Transactions\Facades;

use Illuminate\Support\Facades\Facade;

class Transactions extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Transactions';
    }
}
