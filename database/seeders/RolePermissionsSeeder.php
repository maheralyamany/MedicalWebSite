<?php

namespace Database\Seeders;

use App\Utilities\CreateDefaults;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CreateDefaults::checkHasPermissions();
    }
}
