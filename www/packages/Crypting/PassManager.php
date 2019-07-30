<?php


namespace Akuren\Crypting;


class PassManager implements CryptingInterface
{
    
    /**
     * Hash the given value.
     *
     * @param  string $value
     * @return string
     */
    public function make($value)
    {
        return sha1($value);
        
    }
    
    /**
     * Check the given plain value against a hash.
     *
     * @param  string $value
     * @param  string $hashedValue
     * @return bool
     */
    public function check($value, $hashedValue)
    {
        if ($this->make($value) === $hashedValue) {
            return true;
        } else {
            return false;
        }
    }
}