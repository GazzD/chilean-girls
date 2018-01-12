<?php

namespace App;

use Illuminate\Support\Facades\Request;

class Route
{	
	
	public static function getSidebarClass($route) {
		return Route::isActive($route) ? 'active':'';
	}
	
	private static function isActive($route) {
		$currentRoute = Request::route()->getName();
		
		return starts_with($currentRoute, $route);
	}
	
}

