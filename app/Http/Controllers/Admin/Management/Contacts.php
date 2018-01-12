<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Admin\MedprozoneManagementController;
use App\Models\Contact as ContactModel;

class Contacts extends MedprozoneManagementController
{
    /**
     * Display a listing of the resource.
     *
     * @return admin.contacts.index
     */
    
    public function index()
    {
        // Load page size values
        $pageSizes = explode(",", $this->configItems['medprozone.admin.paginatorSizes']);
        
        // Load paginator default value
        $pageDefault = $this->configItems['medprozone.admin.paginatorDefault.value'];
        
        // Add breadcrumbs
        $this->addBreadcrumb('Contacts', route('management/contacts'));
        
        // Set Title and subtitle
        $this->title = 'Contacts';
        
        // Find all contact
        $contacts = ContactModel::all();
        
        // Display view
        return $this->view('pages.admin.management.contacts.index')
            ->with('contacts', $contacts)
            ->with('pageDefault', $pageDefault)
            ->with('pageSizes', $pageSizes);
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return admin.contacts.detail
     */
    public function detail($id)
    {
        // Add breadcrumbs
        $this->addBreadcrumb('Contacts', route('management/contacts'));
        $this->addBreadcrumb('Detail', route('management/contacts/detail',$id));
        
        // Set Title and subtitle
        $this->title = 'Contactos';
        $this->subtitle = 'entry #'.$id;
        
        // Find product by id
        $contact = ContactModel::find($id);
        
        if ($contact) {
            // Display view
            return $this->view('pages.admin.management.contacts.detail')
                ->with('contact', $contact)
            ;
        } else {
            return response()->view('errors.admin.404');
        }
        
    }

}
