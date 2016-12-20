<?php

namespace ThibaudDT\LaravelTrinityCoreAuth\Hashing;

use Illuminate\Contracts\Hashing\Hasher as IlluminateHasher;

/**
 * Class TrinityCoreHasher
 *
 * @category Hasher
 * @package  ThibaudDT\LaravelTrinityCoreAuth\Hashing
 * @author   Thibaud DELOBELLE TOUSSAINT <thibaud@d-t.fr>
 * @license  GNU
 * @link     https://github.com/Thibaud-DT/laravel-trinitycore
 */
class TrinityCoreHasher implements IlluminateHasher
{
    /**
     * Hash the given value.
     *
     * @param  mixed  $user
     * @return array   $options
     * @return string
     */
    public function make($user, array $options = array()) {
        if(is_string($user)) // Laravel Passport Support. Only use password, encrypt with bcrypt
            return md5($user);
        
        if(is_array($user))
        {
            // cast $user Array to Object, no need to instantiate a Collection here.
            $user = (object)$user;
        }

        return SHA1(strtoupper($user->username.':'.$user->password));
    }

    /**
     * Check the given plain value against a hash.
     *
     * @param  string  $value
     * @param  string  $hashedValue
     * @param  array   $options
     * @return bool
     */
    public function check($value, $hashedValue, array $options = array()) {
        return $this->make($value) === $hashedValue;
    }

    /**
     * Check if the given hash has been hashed using the given options.
     *
     * @param  string  $hashedValue
     * @param  array   $options
     * @return bool
     */
    public function needsRehash($hashedValue, array $options = array()) {
        return false;
    }
}