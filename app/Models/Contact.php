<?php

namespace App\Models;


class Contact extends AppModel
{
	public $timestamps = true;
	public $table = 'contacts';
	protected $fillable = ['email', 'name', 'last_name', 'message', 'picture1', 'picture2', 'picture3', 'portfolio', 'model', 'language', 'country'];
	
}