<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;


class AdminUser extends AppModel
{
    public $timestamps = true;
    public $table = 'admin_users';
    protected $fillable = ['email', 'enabled', 'first_name', 'last_name', 'password', 'phone'];
    
    public function adminUserPasswordRecoveries()
    {
        return $this->hasMany('App\Models\AdminUserPasswordRecovery');
    }
    
    public function adminUserRole()
    {
        return $this->belongsTo('App\Models\AdminUserRole'); 
    }
    
    public static function authenticate($email,$password)
    {
        // Authenticates an admin user
        $adminUser = AdminUser::where('enabled', true)
            ->where('email', $email)
            ->first()
        ;
        // Exist admin user
        if ($adminUser) {
            // Validate password
            if (!Hash::check($password, $adminUser->password)) {
                $adminUser = null;
            }
        }
        return $adminUser;
    }
    
    public function fullName()
    {
        return $this->firstName.' '.$this->lastName;
    }
}