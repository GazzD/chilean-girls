<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Admin\AppManagementController;
use App\Models\ConfigItem as ConfigItemModel;
use JsValidator;
use Illuminate\Http\Request;

class ConfigItems extends AppManagementController
{
	/**
	 * Define your validation messages in a property in
	 * the controller to reuse the messages.
	 */
	protected $validationMessages = [
			'required'	=> 'The field is required.',
	];
	
	protected $editValidationRules = array();
	
	public function __construct() {
		parent::__construct();
	
		$this->editValidationRules['value'] = 'required';
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return admin.config-items.index
     */
    
    public function index()
    {
    	// Load default size value
    	$pageDefault = $this->configItems['medprozone.admin.paginatorDefault.value'];
    	// Load page size values
    	$pageSizes = explode(",", $this->configItems['medprozone.admin.paginatorSizes']);

    	// Add breadcrumbs
    	$this->addBreadcrumb('Config items', route('management/config-items'));
    	
    	// Set Title and subtitle
    	$this->title = 'Config items';
    	$this->subtitle = '';
    	
    	// Find all config items
        $configItems = ConfigItemModel::get();
		
        // Display view
		return $this->view('pages.admin.management.config-items.index')
			->with('configItems', $configItems)
			->with('pageDefault', $pageDefault)
			->with('pageSizes', $pageSizes)
		;
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return admin.config-items.detail
     */
    public function detail($id)
    {
    	// Add breadcrumbs
    	$this->addBreadcrumb('Config items', route('management/config-items'));
    	$this->addBreadcrumb('Detail', route('management/config-items/detail', $id));
    	 
    	// Set Title and subtitle
    	$this->title = 'Config items';
    	$this->subtitle = 'entry #'.$id;
    	 
    	// Find config item by id
    	$configItem = ConfigItemModel::find($id);
    	
    	if($configItem){
	    	// Display view
	    	return $this->view('pages.admin.management.config-items.detail')
	    		->with('configItem', $configItem)
	    	;
    	} else {
    		return response()->view('errors.admin.404');
    	}
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return admin.config-items.edit
     */
    public function edit($id)
    {
    	// Add breadcrumbs
    	$this->addBreadcrumb('Config items', route('management/config-items'));
    	$this->addBreadcrumb('Edit', route('management/config-items/edit', $id));
    	
    	// Set Title and subtitle
    	$this->title = 'Config items';
    	$this->subtitle = 'edit entry #'.$id;
    	 
    	// Prepare view data
    	$validator = JsValidator::make($this->editValidationRules, $this->validationMessages, [], "#editConfigItemForm");

    	// Load config item
    	$configItem = ConfigItemModel::find($id);
    	
    	if($configItem){
	    	// Display view
	    	return $this->view('pages.admin.management.config-items.edit')
		    	->with('configItem', $configItem)
		    	->with('validator', $validator)
	    	;
    	} else {
    		return response()->view('errors.admin.404');
    	}
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return admin.config-items.edit
     */
    public function update(Request $request, $id)
    {
    	// Get values
    	$values = $request->all();
    
    	// Validate
    	$this->validate($request, $this->editValidationRules, $this->validationMessages);
    
    	// Load config item
    	$configItem = ConfigItemModel::find($id);
    	
    	// Set new value
    	$configItem->value = $values['value'];
    	 
    	// Update in database
    	$configItem->save();
    	 
    	// Redirect to config item list
    	return redirect()->route('management/config-items');
    }
    
}
