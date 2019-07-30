<?php

namespace Akuren\Token;


class TokenGeneretor
{
    
    
    public static function token()
    {
        return base_convert(hash('sha256', time() . mt_rand()), 16, 36);
    }
}