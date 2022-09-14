<?php

namespace App\Http\Middleware;

use App\Models\Test;
use Closure;
use Illuminate\Http\Request;

class TestSectionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $test_uuid = $request->test_uuid ?? null;

        if (!$test_uuid) {
            return response("Record does not exist", 410);
        }

        if (!$test = Test::where(["uuid" => $test_uuid])->first()) {
            return response("Record does not exist", 410);
        }

        $request->merge(["test" => $test]);

        return $next($request);
    }
}
