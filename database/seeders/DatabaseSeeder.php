<?php

namespace Database\Seeders;

use App\Utilities\CreateDefaults;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      
       
        CreateDefaults::initDefaults();
       

    }
}
