<?php

namespace App\Provider;

use Corviz\CsrfToken\Token;
use Corviz\DI\Provider;
use Corviz\Mvc\View;
use Corviz\Mvc\View\DefaultTemplateEngine;
use Corviz\Mvc\View\TemplateEngine;

class AppProvider extends Provider
{
    /**
     * Initialize provider.
     */
    public function register()
    {
        //Register
        $this->container()->setSingleton(TemplateEngine::class, DefaultTemplateEngine::class);

        $token = new Token();
        $tokenString = $token->generate();

        View::setGlobals([
            'csrf_token' => $tokenString
        ]);
    }
}
