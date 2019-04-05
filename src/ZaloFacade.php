<?php

namespace Visualweber\Zalo;

use Illuminate\Support\Facades\Facade;

class ZaloFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'zalo';
    }

}