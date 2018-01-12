<?php

use Illuminate\Database\Seeder;
use App\Models\AdminUserRole;

class InitialAdminUserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $adminUserRole = new AdminUserRole();
        $adminUserRole->id = 1;
        $adminUserRole->name = "Super admin";
        $adminUserRole->enabled = true;
        $adminUserRole->save();
        
    }
}
