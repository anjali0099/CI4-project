<?php

namespace App\Libraries;

class Hash
{
    /**
     * Encrypt Password
     *
     * @param string $password Password
     * @return string Hashed Password
     */
    public static function encrypt($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Check Password
     *
     * @param string $userpassword, $dbuserpass
     * @return bool
     */
    public static function check($userpassword, $dbuserpass){
        if(password_verify($userpassword, $dbuserpass)){
            return true;
        }

        return false;
    }
}
