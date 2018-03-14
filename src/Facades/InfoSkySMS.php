<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 12/13/17
 * Time: 6:39 AM
 */

namespace CraftedSystems\InfoSky\Facades;

use Illuminate\Support\Facades\Facade;

class InfoSkySMS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'infosky-sms';
    }
}