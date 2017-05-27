<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TransactionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        DB::beginTransaction();
        try {
            $response = $next($request);
        } catch (\Exception $exception) {
            DB::rollback();
            throw $exception;
        }

        if ($response instanceof Response && $response->getStatusCode() > 399) {
            DB::rollback();
        } else {
            DB::commit();
        }
        return $response;
    }
}
