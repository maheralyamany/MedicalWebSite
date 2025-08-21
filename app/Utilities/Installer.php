<?php
namespace App\Utilities;
use App\Jobs\CreateUser;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
/**
 * Class Installer
 *
 * Contains all of the Business logic to install the app. Either through the CLI or the `/install` web UI.
 *
 * @package App\Utilities
 */
class Installer
{
    /**
     * Create a default .env file.
     *
     * @return void
     */
	public static function createDefaultEnvFile()
	{
        // Rename file
        if (!is_file(base_path('.env')) && is_file(base_path('.env.example'))) {
            File::move(base_path('.env.example'), base_path('.env'));
        }
        // Update .env file
        static::updateEnv([
            'APP_KEY' => 'base64:'.base64_encode(random_bytes(32)),
        ]);
	}
    public static function createDbTables($host, $port, $database, $username, $password, $prefix = null)
    {
        if (!static::isDbValid($host, $port, $database, $username, $password)) {
            return false;
        }
        // Set database details
        static::saveDbVariables($host, $port, $database, $username, $password, $prefix);
        // Try to increase the maximum execution time
        set_time_limit(300); // 5 minutes
        // Create tables
        Artisan::call('migrate', ['--force' => true]);
        // Create Permissions
        Artisan::call('db:seed', ['--class' => 'Database\Seeders\DatabaseSeeder', '--force' => true]);
        return true;
    }
    /**
     * Check if the database exists and is accessible.
     *
     * @param $host
     * @param $port
     * @param $database
     * @param $host
     * @param $database
     * @param $username
     * @param $password
     *
     * @return bool
     */
    public static function isDbValid($host, $port, $database, $username, $password)
    {
        Config::set('database.connections.install_test', [
            'host'      => $host,
            'port'      => $port,
            'database'  => $database,
            'username'  => $username,
            'password'  => $password,
            'driver'    => $connection = config('database.default', 'mysql'),
            'charset'   => config("database.connections.$connection.charset", 'utf8mb4'),
        ]);
        try {
            DB::connection('install_test')->getPdo();
        } catch (\Exception $e) {
            return false;
        }
        // Purge test connection
        DB::purge('install_test');
        return true;
    }
    public static function saveDbVariables($host, $port, $database, $username, $password, $prefix = null)
    {
        $prefix = !is_null($prefix) ? $prefix : '';
        // Update .env file
        static::updateEnv([
            'DB_HOST'       =>  $host,
            'DB_PORT'       =>  $port,
            'DB_DATABASE'   =>  $database,
            'DB_USERNAME'   =>  $username,
            'DB_PASSWORD'   =>  '"' . $password . '"',
            'DB_PREFIX'     =>  $prefix,
        ]);
        $con = config('database.default', 'mysql');
        // Change current connection
        $db = Config::get('database.connections.' . $con);
        $db['host'] = $host;
        $db['database'] = $database;
        $db['username'] = $username;
        $db['password'] = $password;
        $db['prefix'] = $prefix;
        Config::set('database.connections.' . $con, $db);
        DB::purge($con);
        DB::reconnect($con);
    }
    public static function createUser($mobile,$email, $password)
    {


        $user = User::create([
            'name' => 'admin',
            'password' => $password,
            'mobile' => $mobile,
            'email' => $email,
            'longitude' =>  0,
            'latitude' =>  0,
            'status' => 1,
            'city_id' => 0,
            'address' => '',
            'insurance_company_id' => 0,
            'user_type_id' => '1',
        ]);
        $roles=Role::get();
        $permissions=Permission::get();
        $user->roles()->attach($roles);
        $user->permissions()->attach($permissions);


    }
    public static function finalTouches()
    {
        // Update .env file
        $env = [
            'APP_LOCALE'            =>  session('locale'),
            'APP_INSTALLED'         =>  'true',
            'APP_DEBUG'             =>  'true',
            'FIREWALL_ENABLED'      =>  'false',
            'MODEL_CACHE_ENABLED'   =>  'false',
        ];
        if (!app()->runningInConsole()) {
            $env['APP_URL'] = request()->getUriForPath('');
        }
        static::updateEnv($env);
        // Rename the robots.txt file
        try {
            File::move(base_path('robots.txt.dist'), base_path('robots.txt'));
        } catch (\Exception $e) {
            // nothing to do
        }
    }
    public static function updateEnv($data)
    {
        if (empty($data) || !is_array($data) || !is_file(base_path('.env'))) {
            return false;
        }
        $env = file_get_contents(base_path('.env'));
        $env = explode("\n", $env);
        foreach ($data as $data_key => $data_value) {
            $updated = false;
            foreach ($env as $env_key => $env_value) {
                $entry = explode('=', $env_value, 2);
                // Check if new or old key
                if ($entry[0] == $data_key) {
                    $env[$env_key] = $data_key . '=' . $data_value;
                    $updated = true;
                } else {
                    $env[$env_key] = $env_value;
                }
            }
            // Lets create if not available
            if (!$updated) {
                $env[] = $data_key . '=' . $data_value;
            }
        }
        $env = implode("\n", $env);
        file_put_contents(base_path('.env'), $env);
        return true;
    }
}
