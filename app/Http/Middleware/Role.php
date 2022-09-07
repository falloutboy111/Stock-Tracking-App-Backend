<?php

namespace App\Http\Middleware;

use App\Helpers\ApiResponseHelper;
use App\Models\Manager;
use App\Models\Staff;
use App\Models\User;
use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $auth_token = str_replace("Bearer ", "", $request->header("Authorization"));
        $bearer_auth_token = $request->header("X-Bearer-Token");

        if (!$auth_token) {
            if (!$bearer_auth_token) {
                return ApiResponseHelper::error("Failed to validate", ["headers" => "X-Bearer-Token or Authorization missing"], 401);
            }

            $auth_token = $bearer_auth_token;
        }

		try {
			$decoded = JWT::decode($auth_token, new Key(config("jwt.key"),'HS256'));
		} catch (Exception $e) {
            return ApiResponseHelper::error("Failed to validate", ["token" => $e->getMessage()], 401);
		}

        if (!($user = User::where(["uuid" => $decoded->user->uuid])->first()) &&
            !($user = Manager::where(["uuid" => $decoded->user->uuid])->first()) &&
            !($user = Staff::where(["uuid" => $decoded->user->uuid])->first())
            ) {
            return ApiResponseHelper::error("Failed to validate", ["token" => "user does not exist"], 401);
        }

        $roles = is_array($role) ? $role : explode('|', $role);
        
        if (!$user->hasAnyRole($roles)) {
            throw UnauthorizedException::forRoles($roles);
        }

        $request->merge([
            "user" => $user,
        ]);

        return $next($request);
    }
}
