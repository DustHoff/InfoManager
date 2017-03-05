<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dustin
 * Date: 28.02.2017
 * Time: 18:58
 */

namespace App\Providers;

use Adldap\Adldap;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class DBLdapUserProvider implements UserProvider
{
    /**
     * @var Adldap
     */
    private $ldap;
    public function __construct()
    {
        $this->ldap = new Adldap(Config::get(""));
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        $user = User::query()->where("name","=",$identifier)->first();

        if($user==null){
            $user= $this->ldap->getDefaultProvider()->search()->users()->users($identifier);
        }
        return $user;
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed $identifier
     * @param  string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        return User::query()->where("name","=",$identifier)->where("token","=",$token)->first();
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  string $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        $user->token = $token;
        $user->save();
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        return $this->retrieveByCredentials($credentials["name"]);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return $user->getAuthPassword() == Hash::make($credentials["password"]) && $user->getAuthIdentifier() == $credentials["name"];
    }
}