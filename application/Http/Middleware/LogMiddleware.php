<?php

namespace App\Http\Middleware;

use Closure;
use Corviz\Application;
use Corviz\Http\Request;
use Corviz\Http\Response;

class LogMiddleware extends \Corviz\Http\Middleware
{

    /**
     * @inheritDoc
     */
    public function handle(Closure $next): Response
    {
        $request = Request::current();
        $log = Application::current()->getDirectory().'/log.txt';
        file_put_contents(
            $log,
            "\r\n". $request->getRouteStr(). " - ".$request->getClientIp(),
            FILE_APPEND
        );

        return $next();
    }
}