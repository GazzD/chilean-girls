<?php

use Illuminate\Database\Seeder;

class InitialDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin User Role
        $this->call(InitialAdminUserRoleSeeder::class);
        
        // Admin User 
        $this->call(InitialAdminUserSeeder::class);
        
    }
}
