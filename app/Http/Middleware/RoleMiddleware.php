<?php
namespace App\Http\Middleware;
use App\Exceptions\PermissionException;
use Closure;
use Illuminate\Http\Request;
class RoleMiddleware
{
    public function handle($request, Closure $next, $role, $guard = null)
    {
        $authGuard = app('auth')->guard($guard);
        if ($authGuard->guest()) {
            throw PermissionException::notLoggedIn();
        }
        if (!$authGuard->user()->isAdmin()) {
            $roles = is_array($role) ? $role : explode('|', $role);
            if (!$authGuard->user()->hasRole($roles))
                throw PermissionException::forRoles($roles);
        }
        return $next($request);
    }
}
