<?php

/**
 * Class Hash
 * This class use for hashing passwords. It also creates salt for passwords.
 *
 * @author Andrew Yelmanov
 * Date: 04.04.2015
 */
class Hash{
    /**
     * Generate hash for new user or new passwords
     *
     * @param string $algo hash algorithm
     * @param string $data hash data
     * @param string $salt salt for password
     * @return string
     */
    public static function create($algo, $data, $salt)
    {
        $context = hash_init($algo, HASH_HMAC, $salt);
        hash_update($context, $data);
        
        return hash_final($context);
        
    }

    /**
     * This function generate salt for password hashing
     *
     * @return string
     */
    public static function salt(){
    	for($i = 0; $i<20; $i++)
    	{
            $salt = '';
            $salt .=chr(rand(48,122));
    	}
        /** @var string $salt */
        return $salt;
    }
}