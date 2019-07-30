<?php


namespace Akuren\Crypting;


class Crypt
{

    private static function getPassManager()
    {
        return new PassManager();
    }


    public static function make($value)
    {
        return self::getPassManager()->make($value);
    }

    public static function check ($value , $hashedValue)
    {
        return self::getPassManager()->check($value, $hashedValue);
    }

}