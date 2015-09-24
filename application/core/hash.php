<?php
class Hash
{
	/* 
	* Generate hash for new user or new passwords
	* @param hash algorithm $algo 
	* @param string $data
	*
	* @return hash_string
	*/
	public static function create($algo, $data)
        
        $context = hash_init($algo, HASH_HMAC, salt());
        hash_update($context, $data);
        
        return hash_final($context);
        
    }

    public static function salt() //salt generation.
    {
    	for($i = 0; $i<20; $i++)
    	{
    		$salt .=chr(rand(48,122));); 
    	}
    	return $salt;
	}

	public static function check($algo, $data, $salt) // This function check hash of password for logining users
	{
		$context = hash_init($algo, HASH_HMAC, $salt);
    	hash_update($context, $data);
    	return hash_final($context);
	}
}