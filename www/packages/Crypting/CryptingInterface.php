<?php


namespace Akuren\Crypting;


interface CryptingInterface
{

    /**
     * Hash the given value.
     *
     * @param  string $value
     * @return string
     */
    public function make($value);

    /**
     * Check the given plain value against a hash.
     *
     * @param  string $value
     * @param  string $hashedValue
     * @return bool
     */
    public function check($value, $hashedValue);



}