<?php

namespace App\Auth;

use App\Model\UserModel;
use Corviz\Behaviour\Singleton;

class Auth implements Singleton
{
    /**
     * @var static
     */
    private static $instance;

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * @return UserModel|null
     */
    public function getUser()
    {
        if ($this->authenticated()) {
            return $_SESSION['login'];
        }

        return null;
    }

    /**
     * Returns true if user is authenticated,
     * otherwise returns false.
     *
     * @return bool
     */
    public function authenticated() : bool
    {
        return !empty($_SESSION['login']);
    }

    /**
     * Attempt to authenticate user.
     *
     * @param string $email
     * @param string $password
     *
     * @return bool
     */
    public function login(string $email, string $password) : bool
    {
        $users = UserModel::find(function($query) use ($email, $password) {
            $query->where(function($where){
                $where->and('email', '=', '?');
                $where->and('password', '=', '?');
            });
            $query->limit(1);

            $query->bind($email);
            $query->bind($password);
        });

        if (empty($users)) {
            return false;
        }

        $user = $users[0];
        $_SESSION['login'] = $user;
        return true;
    }

    /**
     * Sign out current user.
     */
    public function logout() : bool
    {
        if (isset($_SESSION['login'])) {
            unset($_SESSION['login']);
        }

        return true;
    }

    /**
     * Auth constructor.
     */
    private function __construct()
    {
        //Deny new instances
    }
}
