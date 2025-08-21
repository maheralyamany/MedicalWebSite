<?php
namespace App\Http\Middleware;
use App\Exceptions\PermissionException;
use Closure;
use Illuminate\Http\Request;
class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    /*  public function handle(Request $request, Closure $next, $permission)
    {
        if($request->user()->user_type_id!=1&&!$request->user()->can($permission))
            abort(404);
        return $next($request);
    } */
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null, $guard = null)
    {
        $authGuard = app('auth')->guard($guard);
        try {
            if ($authGuard->guest()) {
                throw PermissionException::notLoggedIn();
            }
          
            if ($authGuard->user()->isAdmin())
            return $next($request);
            if (!is_null($permission)) {
                $permissions = is_array($permission)
                    ? $permission
                    : explode('|', $permission);
            }
            if (is_null($permission)) {
                $permission = $request->route()->getName();
                $permissions = array($permission);
            }
            foreach ($permissions as $permission) {
                if ($authGuard->user()->hasPermission($permission)) {
                    return $next($request);
                }
            }
            
            throw PermissionException::forPermissions($permissions);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
