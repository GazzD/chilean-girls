<?php

namespace App\Models;


class AdminUserRole extends AppModel
{
	public $timestamps = true;
	public $table = 'admin_user_roles';
	protected $fillable = ['name', 'enabled'];
	
	public function adminUsers()
	{
		return $this->belongsToMany('App\Models\AdminUser');
	}
	
}