<?php

namespace App\Provider;

use Corviz\DI\Provider;

class SessionProvider extends Provider
{

    /**
     * @inheritDoc
     */
    public function register()
    {
        session_start();
    }
}