<?php
namespace App\Console\Commands;
use App\Utilities\Installer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Session;
class Install extends Command
{

    const CMD_SUCCESS = 0;
    const CMD_ERROR = 1;
    const OPT_DB_HOST = 'db-host';
    const OPT_DB_PORT = 'db-port';
    const OPT_DB_NAME = 'db-name';
    const OPT_DB_USERNAME = 'db-username';
    const OPT_DB_PASSWORD = 'db-password';
    const OPT_ADMIN_MOBILE = 'admin-mobile';
    const OPT_ADMIN_EMAIL = 'admin-email';
    const OPT_ADMIN_PASSWORD = 'admin-password';
    const OPT_LOCALE = 'locale';
    const OPT_NO_INTERACTION = 'no-interaction';
 /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install
                            {--db-host=localhost : Database host}
                            {--db-port=3306 : Port of the database host}
                            {--db-name=new_medical : Name of the database}
                            {--db-username=root : Username to use to access the database}
                            {--db-password="" : Password to use to access the database}
                            {--admin-mobile= : Admin user mobile}
                            {--admin-email= : Admin user email}
                            {--admin-password=111111 : Admin user password}
                            {--locale=ar_AE : Language used in the app}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Allows to install App directly through CLI';
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (($missing_options = $this->getMissingOptions()) && $this->option(self::OPT_NO_INTERACTION)) {
            $this->line('❌ Some options are missing and --no-interaction is present. Please run the following command for more information :');
            $this->line('❌ php artisan help install');
            $this->line('❌ Missing options are : ' . implode(', ', $missing_options));
            return self::CMD_ERROR;
        }
        $this->line('Setting locale ' . $this->locale);
        Session::put(self::OPT_LOCALE, $this->locale);
        app()->setLocale($this->locale);
        $this->prompt();
        // Create the .env file
        
        Installer::createDefaultEnvFile();
        $this->line('Creating database tables');
        if (!$this->createDatabaseTables()) {
            return self::CMD_ERROR;
        }
        $this->line('Creating admin');
        Installer::createUser($this->admin_mobile,$this->admin_email, $this->admin_password);
        $this->line('Applying the final touches');
        Installer::finalTouches();
        return self::CMD_SUCCESS;
    }
    /**
     * Check that all options are presents. otherwise returns an array of the missing options
     */
    private function getMissingOptions()
    {
        $missing_options = [];
        $constants = [
            'OPT_LOCALE',
            'OPT_DB_PORT',
            'OPT_DB_HOST',
            'OPT_DB_NAME',
            'OPT_DB_USERNAME',
            'OPT_DB_PASSWORD',
            'OPT_ADMIN_MOBILE',
            'OPT_ADMIN_EMAIL',
            'OPT_ADMIN_PASSWORD'
        ];
        $allowed_empty = ['db_password'];
        foreach ($constants as $const) {
            $option = constant("self::$const");
            $property = str_replace('-', '_', $option);
            $this->$property = $this->option($option);
            if (!empty($this->$property)) {
                continue;
            }
            if (in_array($property, $allowed_empty)) {
                continue;
            }
            $missing_options[] = $option;
        }
        return $missing_options;
    }
    /**
     * Ask the user for data if some options are missing.
     */
    private function prompt()
    {
        if (empty($this->db_host)) {
            $this->db_host = $this->ask('What is the database host?', 'localhost');
        }
        if (empty($this->db_port)) {
            $this->db_port = $this->ask('What is the database port?', '3306');
        }
        if (empty($this->db_name)) {
            $this->db_name = $this->ask('What is the database name?');
        }
        if (empty($this->db_username)) {
            $this->db_username = $this->ask('What is the database username?', 'root');
        }
        if (!isset($this->db_password)) {
            $this->db_password = $this->secret('What is the database password?', false);
        }
        if (empty($this->admin_mobile)) {
            $this->admin_mobile = $this->ask('What is the admin mobile?', $this->admin_mobile);
        }
        if (empty($this->admin_email)) {
            $this->admin_email = $this->ask('What is the admin email?', $this->admin_email);
        }
        if (empty($this->admin_password)) {
            $this->admin_password = $this->secret('What is the admin password?');
        }
    }
    private function createDatabaseTables()
    {
        $this->db_host     = $this->option(self::OPT_DB_HOST);
        $this->db_port     = $this->option(self::OPT_DB_PORT);
        $this->db_name     = $this->option(self::OPT_DB_NAME);
        $this->db_username = $this->option(self::OPT_DB_USERNAME);
        $this->db_password = $this->option(self::OPT_DB_PASSWORD);
        $this->line('Connecting to database ' . $this->db_name . '@' . $this->db_host . ':' . $this->db_port);
        if (!Installer::createDbTables($this->db_host, $this->db_port, $this->db_name, $this->db_username, $this->db_password)) {
            $this->error('Error: Could not connect to the database! Please, make sure the details are correct.');
            return false;
        }
        return true;
    }
}
