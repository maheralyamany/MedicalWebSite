<?php
namespace App\Traits;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

/**
 * Class Installer
 *
 * Contains all of the Business logic to install the app. Either through the CLI or the `/install` web UI.
 *
 * @package App\Utilities
 */
trait CheckPermissionsTrait
{
    public  function checkHasPermissions()
    {
        $rolesArr = static::getRolePermissions();
        foreach ($rolesArr as $role => $perissns) {
            foreach ($perissns as  $pe) {
                $permission = Permission::where('slug', $pe['slug'])->first();
                if (is_null($permission))
                    Permission::create($pe);
            }
            $dev_role = Role::where('slug', $role)->first();
            if (is_null($dev_role)) {
                $dev_role = new Role();
                $dev_role->slug = $role;
                $dev_role->name = $role;
                $dev_role->save();
            }
            $slugs = array_keys(array_column($perissns, "slug", "slug"));
            $permIds = Permission::whereIn('slug', $slugs)->pluck('id', 'id')->all();
            // $permIds = Permission::whereIn('slug', $slugs)->select('id')->get();
            $dev_role->permissions()->sync($permIds);
        }
    }

    public static function getRolePermissions()
    {
        $exeptNames = ['', 'Logout', 'lotteries.drawing', 'notification.center', 'admin.search', 'home',];
        $exeptRoles = ['admin_data'];
        $routes = Route::getRoutes();
        $arr = [];
        foreach ($routes as $route) {
            $name = $route->getName();
            if (!in_array($name, $exeptNames) && $route->getAction()['middleware']['0'] == 'web' && $route->getAction()['prefix'] != '') {
                $nameArr = explode(".", $name);
                $role = $nameArr[0];
                if (!in_array($role, $exeptRoles)) {
                    if (!key_exists($role, $arr))
                        $arr[$role] = [];
                    unset($nameArr[0]);
                    //$nameArr=array_reverse($nameArr);
                    $arr[$role][] = ['name' =>  implode('  ', $nameArr), 'slug' => strval($name)];
                }
            }
        }
        return $arr;
    }
}
