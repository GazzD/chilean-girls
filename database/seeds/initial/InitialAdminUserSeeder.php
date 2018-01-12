<?php

use Illuminate\Database\Seeder;
use App\Models\AdminUser;

class InitialAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = new AdminUser();
        $adminUser->id = 1;
        $adminUser->enabled = true;
        $adminUser->email = "bigtor.cardozo@gmail.com";
        $adminUser->firstName = "Admin User $adminUser->id";
        $adminUser->lastName = "Admin User $adminUser->id";
        $adminUser->password = bcrypt("123456");
        $adminUser->phone = "5555555";
        $adminUser->save();
        
    }
}
