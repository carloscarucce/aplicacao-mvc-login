<?php

namespace App\Http\Middleware;

use Closure;
use Corviz\CsrfToken\Token;
use Corviz\Http\Middleware;
use Corviz\Http\Request;
use Corviz\Http\Response;

class CsrfTokenMiddleware extends Middleware
{

    /**
     * @inheritDoc
     */
    public function handle(Closure $next): Response
    {
        $token = new Token();
        $request = Request::current();
        $isPost = $request->getMethod() == Request::METHOD_POST;

        if (
            !$isPost
            || (
                $isPost
                && !$request->isAjax()
                && $token->verify($request->getData()['csrf_token'] ?? '')
            )
        ) {
            return $next();
        } else {
            die('Invalid csrf token');
        }
    }
}