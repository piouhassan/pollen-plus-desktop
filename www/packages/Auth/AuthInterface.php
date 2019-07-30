<?php


namespace Akuren\Auth;

use App\Models\Users;

interface AuthInterface
{
    
    /**
     * @return Users | null
     */
    public function getUser(): ?Users;
    
    /**
     * @return Users|null
     */
    public function getLevel(): ?Users;
    
}