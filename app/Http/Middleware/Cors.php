<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Cors
{
    /**
     * Метод, который обрабатывает все запросы, приходящие на сервер.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next)
    {
        $origin = $request->headers->get('Origin');

        if(!$origin) return new Response('Forbidden', 403);

        return $next($request)
            ->header('Access-Control-Allow-Origin', $origin)
            ->header('Access-Control-Allow-Methods', 'PUT, GET, POST, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Credentials', 'true');
    }
}
