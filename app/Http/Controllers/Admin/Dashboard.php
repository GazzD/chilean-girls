<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\MedprozoneManagementController;

class Dashboard extends AppManagementController
{
	public function index(Request $request)
	{
		// Add breadcrumbs
		$this->addBreadcrumb('Dashboard', route('dashboard'));
		
		// Load view
		return $this->view('pages.admin.dashboard');
	}
}
