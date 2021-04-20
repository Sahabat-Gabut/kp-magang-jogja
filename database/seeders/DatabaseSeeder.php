<?php

namespace Database\Seeders;

use Database\Seeders\{JssSeeder,RoleAdminSeeder,AdminSeeder, AgencySeeder};
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
        // \App\Models\User::factory(10)->create();
        $this->call(JssSeeder::class);  
        $this->call(AgencySeeder::class);  
        $this->call(RoleAdminSeeder::class);  
        $this->call(AdminSeeder::class);  
    }
}
