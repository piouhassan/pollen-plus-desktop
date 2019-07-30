<?php


namespace App\Http\Controllers\Auth;


use Akuren\Auth\AuthInterface;
use Akuren\Crypting\Crypt;
use Akuren\Session\Session;
use App\Models\Users;

class Auth implements AuthInterface
{
    
    private $user;
    
    public static function login(string $username, string $password): ?Users
    {
        if (empty($username) || empty($password)) {
            return null;
        }
        $user = Users::where(['username' => $username])->first();
        if ($user && Crypt::check($password, $user->password)) {
            (new Session())->set('auth.id', $user->id);
            return $user;
        }
        return null;
    }
    
    /**
     * @return Users|null
     */
    public function getUser(): ?Users
    {
        if ($this->user) {
            return $this->user;
        }
        $authId = (new Session())->get('auth.id');
        if ($authId) {
            $this->user = Users::find($authId);
            return $this->user;
        }
        return null;
    }
    
    /**
     * @return Users|null
     */
    public function getLevel(): ?Users
    {
        if (!is_null($this->user)) {
            return $this->user->type;
        }
        return null;
        
    }
}