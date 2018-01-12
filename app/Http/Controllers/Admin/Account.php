<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminUser as AdminUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use JsValidator;

class Account extends AppManagementController
{
    protected $validationMessages = [
        'min'         => 'La contraseña debe contener al menos 8 caracteres.',
        'required'      => 'Este campo es requerido.',
        'required_with' => 'Este campo es requerido.',
        'same'          => 'Las contraseñas deben coincidir.',
    ];
    
    protected $editValidationRules = array();
    protected $changePasswordValidationRules = array();
    
    public function __construct() {
        $this->changePasswordValidationRules['password'] = 'required|min:8';
        $this->changePasswordValidationRules['passwordConfirmation'] = 'required|same:password';
    }
    
    public function index()
    {
        // Add breadcrumbs
        $this->addBreadcrumb('Mi cuenta', route('account'));
        
        // Set Title and subtitle
        $this->title = 'Mi cuenta';
        
        // Prepare view data
        $validator = JsValidator::make($this->editValidationRules, $this->validationMessages, [], "#settingsForm")->view('pages.admin.validations.validation-with-tabs');
        
        // Load admin user
        $adminUser = AdminUserModel::find(session()->get('admin.auth.admin-user.id'));
        
        // Display view
        return $this->view('pages.admin.account.index')
        ->with('adminUser', $adminUser)
        ->with('validator', $validator)
        ;
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return admin.account.password-change
     */
    public function changePassword()
    {
        // Add breadcrumbs
        $this->addBreadcrumb('Account', route('account'));
        $this->addBreadcrumb('Change password', route('account/change-password'));
        
        // Set Title and subtitle
        $this->title = 'Mi cuenta';
        $this->subtitle = 'cambia tu contraseña';
        
        // Prepare view data
        $validator = JsValidator::make($this->changePasswordValidationRules, $this->validationMessages, [], "#changePasswordForm");
        
        // Load adminUser
        $adminUser = AdminUserModel::find(session()->get('admin.auth.admin-user.id'));
        
        if($adminUser){
            // Display view
            return $this->view('pages.admin.account.change-password')
            ->with('adminUser', $adminUser)
            ->with('validator', $validator)
            ;
        }
        
        // Redirect to page not found error 404
        return response()->view('errors.admin.404');
    }
    
    /**
     * Show the form for update the specified resource.
     *
     * @return admin.account
     */
    public function updatePassword(Request $request)
    {
        // Get values
//         dump(123456);die;
        $values = $request->all();
        //         dump($adminUser);die;
        // Validate
        $this->validate($request, $this->changePasswordValidationRules, $this->validationMessages);
        
        // Load admin user
        $adminUser = AdminUSerModel::find(session()->get('admin.auth.admin-user.id'));
        
        // Update password
        $adminUser->password = bcrypt($values['password']);
        
        // Store in database
        $adminUser->save();
        
        // Prepare data for send notification email
        $adminUserEmail = $adminUser->email;
        $adminUserEmail = 'bigtor.cardozo@gmail.com';
        $data = ['adminUser' => $adminUser, 'notificationMessage' => 'Su contraseña ha sido actualizada'];
        
        // Send notification email
        Mail::send('pages.admin.emails.account-update-notification', $data, function($m) use($adminUserEmail){
            $m->from('no-reply@chileangirls.cl', 'Chilean Girls');
            $m->to($adminUserEmail, 'Chilean Girls')->subject("Su cuenta ha sido actualizada");
        });
            
            return redirect()->route('account');
    }
}