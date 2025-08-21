<?php
namespace App\Providers;
use App\Models\Permission;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Spatie\Permission\Contracts\Permission as PermissionContract;
use Spatie\Permission\Contracts\Role as RoleContract;
class PermissionsServiceProvider extends ServiceProvider
{
     /* public function boot()
    {
        try {
            Permission::get()->map(function ($permission) {
                Gate::define($permission->slug, function ($user) use ($permission) {
                    return $user->hasPermissionTo($permission);
                });
            });
        } catch (\Exception $e) {
            report($e);
            return false;
        }
        //Blade directives
        Blade::directive('role', function ($role) {
             return "if(auth()->check() && auth()->user()->hasRole({$role})) :"; //return this if statement inside php tag
        });
        Blade::directive('endrole', function ($role) {
             return "endif;"; //return this endif statement inside php tag
        });
    } */
    public function register()
    {
        $this->callAfterResolving('blade.compiler', function (BladeCompiler $bladeCompiler) {
            $this->registerBladeExtensions($bladeCompiler);
        });
    }
    public function boot(PermissionRegistrar $permissionLoader)
    {
        if ($this->app->config['permission.register_permission_check_method']) {
            $permissionLoader->clearClassPermissions();
            $permissionLoader->registerPermissions();
        }
        $this->app->singleton(PermissionRegistrar::class, function ($app) use ($permissionLoader) {
            return $permissionLoader;
        });
    }
    protected function registerBladeExtensions($bladeCompiler)
    {
        $bladeCompiler->directive('role', function ($arguments) {
            list($role, $guard) = explode(',', $arguments.',');
            return "<?php if(auth({$guard})->check() && auth({$guard})->user()->hasRole({$role})): ?>";
        });
        $bladeCompiler->directive('elserole', function ($arguments) {
            list($role, $guard) = explode(',', $arguments.',');
            return "<?php elseif(auth({$guard})->check() && auth({$guard})->user()->hasRole({$role})): ?>";
        });
        $bladeCompiler->directive('endrole', function () {
            return '<?php endif; ?>';
        });
        $bladeCompiler->directive('hasrole', function ($arguments) {
            list($role, $guard) = explode(',', $arguments.',');
            return "<?php if(auth({$guard})->check() && auth({$guard})->user()->hasRole({$role})): ?>";
        });
        $bladeCompiler->directive('endhasrole', function () {
            return '<?php endif; ?>';
        });
        $bladeCompiler->directive('hasanyrole', function ($arguments) {
            list($roles, $guard) = explode(',', $arguments.',');
            return "<?php if(auth({$guard})->check() && auth({$guard})->user()->hasAnyRole({$roles})): ?>";
        });
        $bladeCompiler->directive('endhasanyrole', function () {
            return '<?php endif; ?>';
        });
        $bladeCompiler->directive('hasallroles', function ($arguments) {
            list($roles, $guard) = explode(',', $arguments.',');
            return "<?php if(auth({$guard})->check() && auth({$guard})->user()->hasAllRoles({$roles})): ?>";
        });
        $bladeCompiler->directive('endhasallroles', function () {
            return '<?php endif; ?>';
        });
        $bladeCompiler->directive('unlessrole', function ($arguments) {
            list($role, $guard) = explode(',', $arguments.',');
            return "<?php if(!auth({$guard})->check() || ! auth({$guard})->user()->hasRole({$role})): ?>";
        });
        $bladeCompiler->directive('endunlessrole', function () {
            return '<?php endif; ?>';
        });
        $bladeCompiler->directive('hasexactroles', function ($arguments) {
            list($roles, $guard) = explode(',', $arguments.',');
            return "<?php if(auth({$guard})->check() && auth({$guard})->user()->hasExactRoles({$roles})): ?>";
        });
        $bladeCompiler->directive('endhasexactroles', function () {
            return '<?php endif; ?>';
        });
    }
}
