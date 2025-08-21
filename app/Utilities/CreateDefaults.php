<?php

namespace App\Utilities;

use App\Models\Branch;
use App\Models\Nationality;
use App\Models\Navbar;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UsersGroup;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/**
 * Class CreateDefaults
 *
 * Contains all of the Business logic to install the app. Either through the CLI or the `/install` web UI.
 *
 * @package App\Utilities
 */
class CreateDefaults
{
    public static function initDefaults()
    {
        //DB::beginTransaction();
        try {
            static::initNavbar();
            DB::table('card_types')->insert([
                ['name_ar' => 'شخصية', 'name_en' => 'ID Card'],
                ['name_ar' => 'جواز سفر', 'name_en' => 'Passport'],
            ]);
            DB::table('appointment_status')->insert([
                ['name_ar' => 'قيد الانتظار', 'name_en' => 'Pending'],
                ['name_ar' => 'نشط', 'name_en' => 'Active'],
                ['name_ar' => 'ملغي', 'name_en' => 'Canceled'],
                ['name_ar' => 'زيارة أخرى', 'name_en' => 'Another visit'],
                ['name_ar' => 'اكتمل', 'name_en' => 'Completed'],
            ]);
            DB::table('drug_types')->insert([
                ['name_ar' => 'أقراص دوائية ', 'name_en' => 'tablets'],
                ['name_ar' => 'كبسولة ', 'name_en' => 'Capsule'],
                ['name_ar' => 'شراب ', 'name_en' => 'Syrup'],
                ['name_ar' => 'قطرات ', 'name_en' => 'Drops'],
                ['name_ar' => 'رذاذ للأنف ', 'name_en' => 'nasal spray'],
                ['name_ar' => 'استنشاق ', 'name_en' => 'inhalation'],
                ['name_ar' => 'أجهزة الاستنشاق ', 'name_en' => 'Inhalers'],
                ['name_ar' => 'حقنة ', 'name_en' => 'Injection'],
                ['name_ar' => 'أمبولة ', 'name_en' => 'ampoule'],
                ['name_ar' => 'كريم ', 'name_en' => 'cream'],
                ['name_ar' => 'مرهم ', 'name_en' => 'ointment'],
                ['name_ar' => 'تحاميل ', 'name_en' => 'Suppositories'],
                ['name_ar' => 'جل ', 'name_en' => 'Gel'],
            ]);
            Nationality::create([
                'name_en' => 'Yemeni',
                'name_ar' => 'يمني',
            ]);

            DB::table('cities')->insert([[
                'name_en' => 'Thamar',
                'name_ar' => 'ذمار',
            ], [
                'name_en' => 'Sana`a',
                'name_ar' => 'صنعاء',
            ]]);
            static::checkHasPermissions();
            Branch::create([
                'name_ar' => 'MaxSoft',
                'mobile' => '737191721',
                'email' => '',
                'status' => '1',
                'address' => '',
            ]);
            $grops = ['admin', 'user', 'doctor', 'customer'];
            foreach ($grops as $v) {
                if (count(UsersGroup::where('name', $v)->get()) == 0) {
                    UsersGroup::create(['name' => $v]);
                }

            }
            $user = User::create([
                'name_ar' => 'admin',
                'password' => '111111',
                'mobile' => '737191721',
                'email' => '',
                'gender' => 'male',
                'status' => '1',
                'address' => '',
                'group_id' => '1',
            ]);
            $roles = Role::get();
            $permissions = Permission::get();
            $user->roles()->attach($roles);
            $user->permissions()->attach($permissions);

            //  DB::commit();
        } catch (Exception $e) {
            //  DB::rollback();
            throw $e;
        }
    }

    public static function initNavbar()
    {
        $links = sidebar_list();
        $ordering = 0;
        foreach ($links as $key => $navbar) {
            $navbar['ordering'] = $ordering++;
            if (count(Navbar::where('route', $navbar['route'])->get()) == 0) {
                Navbar::create($navbar);
            }

        }
    }
    public static function checkHasPermissions()
    {
        $allPermission = Permission::get();
        $rolesArr = static::getRolePermissions();
        $roles = $rolesArr['roles'];
        $permissions = $rolesArr['permissions'];
        if (isset($allPermission) && count($allPermission) > 0) {
            foreach ($allPermission as $p) {
                if (!in_array($p->slug, $permissions)) {
                    $p->delete();
                }
            }
        }
        foreach ($roles as $role => $perissns) {
            foreach ($perissns as $pe) {

                if (Permission::where('slug', $pe['slug'])->count() == 0) {
                    Permission::create($pe);
                }

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
        $exeptNames = ['', 'logout', 'logout.perform', 'home.index', 'admin.search', 'home'];
        $exeptRoles = ['admin_data'];
        $routes = Route::getRoutes();
        $arr = [];
        $permissions = [];
        foreach ($routes as $route) {
            $name = $route->getName();
            if (!in_array($name, $exeptNames) && $route->getAction()['middleware']['0'] == 'web' && $route->getAction()['prefix'] != '') {
                $nameArr = explode(".", $name);
                $role = $nameArr[0];
                $slug = strval($name);
                if (!in_array($role, $exeptRoles)) {
                    if (!key_exists($role, $arr)) {
                        $arr[$role] = [];
                    }

                    unset($nameArr[0]);
                    //$nameArr=array_reverse($nameArr);
                    $arr[$role][] = ['name' => implode('  ', $nameArr), 'slug' => $slug];
                }

                if (!in_array($slug, $permissions)) {
                    $permissions[] = $slug;
                }

            }
        }
        return ['roles' => $arr, 'permissions' => $permissions];
    }
}
