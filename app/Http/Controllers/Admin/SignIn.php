<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use JsValidator;

class SignIn extends AppManagementController
{
    protected $authenticationValidateRules = [
        'email' => 'email|required',
        'password' => 'required',
    ];
    
    public function index(Request $request)
       {
           // If already signed in, redirect to account
           if($request->session()->has('admin.auth.admin-user.id')) {
               return redirect()->route('admin');
           }
            
           // Create admin user validator
           $validator = JsValidator::make($this->authenticationValidateRules, [], [], '#sign-in-form');
           
           return $this->view('pages.admin.sign-in.index')
               ->with('validator', $validator)
           ;
    }
    
    public function authenticate(Request $request)
    {
        $parameters = $request->all();
        
        // Get request parameters
        $email = $parameters['email'];
        $password = $parameters['password'];
        
        // Authenticate user
        $adminUser = AdminUser::authenticate($email, $password);
        
        if($adminUser){
            session()->put('admin.auth.admin-user.id', $adminUser->id);
            session()->put('admin.auth.admin-user.firstName', $adminUser->firstName);
            session()->put('admin.auth.admin-user.lastName', $adminUser->lastName);
            session()->put('admin.auth.admin-user.email', $adminUser->email);
            
            // If user requested an url, redirect
            if($request->session()->has('admin.auth.requested-url')) {
                return redirect($request->session()->get('admin.auth.requested-url'));
            }
            
            return redirect()->route('admin');
        }else{
            session()->flash('error-message', 'Usuario o contraseña incorrecta.');            
            return redirect()->back()->withInput();
        }
    }
}
