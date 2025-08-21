<?php
namespace App\Traits;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
trait HasPermissionsTrait
{
    public function givePermissionsTo(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        dd($permissions);
        if ($permissions === null) {
            return $this;
        }
        $this->permissions()->sync($permissions);
        return $this;
    }
    public function giveRolesTo(...$roles)
    {
        $roles = collect($roles)->flatten() ->reduce(function ($array, $role) { return $array; }, []);
        $roles = $this->getAllRoles($roles);
        dd($roles);
        if ($roles === null) {
            return $this;
        }
        $this->roles()->sync($roles);
        return $this;
    }
    public function withdrawPermissionsTo(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }
    public function refreshPermissions(...$permissions)
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }
    public function refreshRoles(...$roles)
    {
        $this->roles()->detach();
        return $this->getAllRoles($roles);
    }
    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission->slug);
    }
    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }
    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id');
    }
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'users_permissions', 'user_id', 'permission_id');
    }
    public function hasPermission($permission)
    {
        return (bool) $this->permissions->where('slug', $permission)->count();
    }
    protected function getAllPermissions( $permissions)
    {
        return Permission::whereIn('id', $permissions)->get();
    }
    protected function getAllRoles( $roles)
    {
        return Role::whereIn('id', $roles)->get();
    }
}
