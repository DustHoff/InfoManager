<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dustin
 * Date: 19.11.2017
 * Time: 16:11
 */

namespace App\Helper;


use App\Email;
use App\User;
use Illuminate\Support\Facades\Hash;

class LDAPAttribteSync
{
    public function handle(\Adldap\Models\User $ldapUser, User $user)
    {
        $user->name = $ldapUser->getFirstAttribute("cn");
        $user->username = $ldapUser->getFirstAttribute(env("ADLDAP_USERATTRIBUTE", ""));
        $user->password = Hash::make(str_random(16));
        $email = Email::firstOrCreate(["email" => $ldapUser->getFirstAttribute("mail")]);
        $user->email()->associate($email);
        $user->save();
    }
}