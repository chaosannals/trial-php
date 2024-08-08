<?php

namespace app\basic;

use Closure;
use think\facade\Request;
use think\Response;

class PermitMiddleware
{
    public function handle($request, Closure $next)
    {
        $url = explode('/', $request->baseUrl());
        

        if ($request->param('name') == 'think') {
            return redirect('index/think');
        }

        return $next($request);
    }

    public function end(Response $response)
    {
    }
}
