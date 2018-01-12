<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Admin\AppManagementController;
use App\Models\AdminUser as AdminUserModel;
use App\Models\AdminUserRole as AdminUserRoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use JsValidator;

class AdminUsers extends AppManagementController
{
       /**
     * Define your validation messages in a property in
     * the controller to reuse the messages.
     */
    
    protected $validationMessages = [
        'email' => 'Debe introducir un correo válido.',
        'numeric'     => 'El campo debe contener solo dígitos.',
        'regex'    => 'La contraseña debe ser de una loguitud mínima de 8 caractéres, una mayúscula, una minúscula y un caracter especial.',
        'required'    => 'Este campo es requerido.',
        'required_with' => 'Este campo es requerido.',
        'same' => 'Las contraseñas deben coincidir.',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return admin.carousel-items.index
     */    
    protected $addValidationRules = array();
    protected $editValidationRules = array();
    protected $changePasswordValidationRules = array();
    
    public function __construct() {
            $this->addValidationRules['email'] = 'required|email|unique:admin_users,email';
            $this->addValidationRules['firstName'] = 'required';
            $this->addValidationRules['lastName'] = 'required';
            $this->addValidationRules['password'] = 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';
            $this->addValidationRules['passwordConfirmation'] = 'required_with:password|same:password';
            $this->addValidationRules['phone'] = 'required|numeric';
            $this->addValidationRules['adminUserRoleId'] = 'required';
            
            $this->editValidationRules['email'] = 'required|email|unique:admin_users,email';
            $this->editValidationRules['firstName'] = 'required';
            $this->editValidationRules['lastName'] = 'required';
            $this->editValidationRules['phone'] = 'required|numeric';
            $this->editValidationRules['adminUserRoleId'] = 'required';
            $this->changePasswordValidationRules['password'] = 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';
            $this->changePasswordValidationRules['passwordConfirmation'] = 'required_with:password|same:password';
    }
    
    public function index()
    {
        // Load page configuration values
        $pageDefault = 50;
        $pageSizes = [5,10,20,50,100];
        
        // Add breadcrumbs
        $this->addBreadcrumb('Administradores', route('management/admin-users'));
        
        // Set Title and subtitle
        $this->title = 'Administradores';
        
        // Find all admin users
        $adminUsers = AdminUserModel::all();
        
        // Display view
        return $this->view('pages.admin.management.admin-users.index')
            ->with('adminUsers', $adminUsers)
            ->with('pageDefault', $pageDefault)
            ->with('pageSizes', $pageSizes);
        ;
    }

    /**
     * Show the form for adding a new resource.
     *
     * @return admin.admin-users.add
     */
    public function add()
    {
        // Add breadcrumbs
        $this->addBreadcrumb('Admin users', route('management/admin-users'));
        $this->addBreadcrumb('Add', route('management/admin-users/add'));
            
        // Set Title and subtitle
        $this->title = 'Administradores';
        $this->subtitle = 'agregar nueva entrada';
        
        // Find all roles
        $adminUserRoles = AdminUserRoleModel::orderBy('name')
            ->get()->pluck('name', 'id')->toArray()
        ;
        
        // Prepare view data
        $validator = JsValidator::make($this->addValidationRules, $this->validationMessages, [], "#addAdminUserForm")->view('pages.admin.validations.validation-with-tabs');
            
        // Create new admin user
        $adminUser = new adminUserModel();
        
        // Display view
        return $this->view('pages.admin.management.admin-users.add')
            ->with('adminUser', $adminUser)
            ->with('adminUserRoles', $adminUserRoles)
            ->with('validator', $validator)
        ;
    }
    
    public function changePassword($id)
    {
        // Add breadcrumbs
        $this->addBreadcrumb('Administradores', route('management/admin-users'));
        $this->addBreadcrumb('Cambiar contraseña', route('management/admin-users/edit',$id));
    
        // Set Title and subtitle
        $this->title = 'Administrador';
        $this->subtitle = 'cambiar contraseña entrada #'.$id;
    
        // Prepare view data
        $validator = JsValidator::make($this->changePasswordValidationRules, $this->validationMessages, [], "#changePasswordForm");
    
        // Load admin user
        $adminUser = AdminUserModel::find($id);
    
        if($adminUser){
    
            // Display view
            return $this->view('pages.admin.management.admin-users.change-password')
            ->with('adminUser', $adminUser)
            ->with('validator', $validator)
            ;
        } else {
            // Redirect to page not found error 404
            return response()->view('errors.admin.404');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @redirect admin.admin-users
     */
    public function delete($id)
    {
        // Load admin user
        $adminUser = AdminUserModel::find($id);
        
        // Remove if not empty
        if($adminUser){
            try {
                // Try to delete admin user
                AdminUserModel::destroy($id);
                // Return to index page
                return redirect()->route('management/admin-users');
                 
            } catch(\Exception $e){
                // Catch exception and return error
                $errors = array('message' => 'Ha ocurrido un error. Por favor intenta de nuevo más tarde.');
                return redirect()->route('management/admin-users')->withErrors($errors);
            }
            
        } else {
            // Redirect to admin users list
            return redirect()->route('management/admin-users');
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return admin.admin-users.detail
     */
    public function detail($id)
    {
        // Add breadcrumbs
        $this->addBreadcrumb('Administradores', route('management/admin-users'));
        $this->addBreadcrumb('Detalle', route('management/admin-users/detail',$id));
         
        // Set Title and subtitle
        $this->title = 'Administradores';
        $this->subtitle = 'entrada #'.$id;
        
        // Find Admin user by id
        $adminUser = AdminUserModel::where('id', $id)
            ->with('adminUserRole')
            ->first()
        ;
        
        if($adminUser){
            // Display view
            return $this->view('pages.admin.management.admin-users.detail')
                ->with('adminUser', $adminUser)
            ;
        } else {
            // Redirect to page not found error 404
            return response()->view('errors.admin.404');
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return admin.admin-users.edit
     */
    public function edit($id)
    {
        // Add breadcrumbs
        $this->addBreadcrumb('Administradores', route('management/admin-users'));
        $this->addBreadcrumb('Editar', route('management/admin-users/edit',$id));
        
        // Set Title and subtitle
        $this->title = 'Administrador';
        $this->subtitle = 'editar entrada #'.$id;
        
         // Find all admin user roles
        $adminUserRoles = AdminUserRoleModel::orderBy('name')
            ->get()->pluck('name', 'id')->toArray()
        ;
         
        // Prepare view data
        $editValidator = JsValidator::make($this->editValidationRules, $this->validationMessages, [], "#editAdminUserForm")->view('pages.admin.validations.validation-with-tabs');
        
        // Load admin user
        $adminUser = AdminUserModel::where('id', $id)
            ->with('adminUserRole')
            ->first()
        ;

        if($adminUser){
            // Display view
            return $this->view('pages.admin.management.admin-users.edit')
                ->with('adminUser', $adminUser)
                ->with('adminUserRoles', $adminUserRoles)
                ->with('editValidator', $editValidator)
            ;
        } else {
            return response()->view('errors.admin.404');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return admin.admin-users.add
     */
    public function store(Request $request)
    {    
        // Update rules
        $this->addValidationRules['adminUserRoleId'] = 'required';
        
        // Get values
        $values = $request->all();

        // Validate
        $this->validate($request, $this->addValidationRules, $this->validationMessages);
            
        // Create new admin user item
        $adminUser = new AdminUserModel();
        $adminUser->email = $values['email'];
        $adminUser->firstName = $values['firstName'];
        $adminUser->lastName = $values['lastName'];
        $adminUser->password = sha1($values['password']);
        $adminUser->phone = $values['phone'];
        $adminUser->adminUserRoleId = $values['adminUserRoleId'];
        
        // Set enabled
        if (isset($values['enabled'])) {
            $adminUser->enabled = true;
        } else {
            $adminUser->enabled = false;
        }
        
        // Store in database
        $adminUser->save();
        
        // Prepare data for send notification email
        $adminUserEmail = $adminUser->email;
        $data = ['adminUser'=>$adminUser, 'notificationMessage' => 'Your account has been created by a system administrator. Your Password is: '.$values['password']];
        
        // Send notification email
//         Mail::send('pages.admin.emails.notification-admin-user-creation', $data, function($m) use($adminUserEmail){
//             $m->from(env('NOTIFICATION_MAIL_FROM_ADDRESS'), env('NOTIFICATION_MAIL_FROM_NAME'));
//             $m->to($adminUserEmail, env('NOTIFICATION_MAIL_FROM_NAME'))->subject('Your account has been created');
//         });
        
        // Redirect to admin users list
        return redirect()->route('management/admin-users');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return admin.admin-users.edit
     */
    public function update(Request $request, $id)
    {
        // Get values
        $values = $request->all();
        
        // Validate
        $this->editValidationRules['email'] = "required|email|unique:admin_users,email,".$request->id;
        
        $this->validate($request, $this->editValidationRules, $this->validationMessages);
        
        // Load admin user
        $adminUser = AdminUserModel::with('adminUserRole')->find($id);
        
        $adminUser->email = $values['email'];
        $adminUser->firstName = $values['firstName'];
        $adminUser->lastName = $values['lastName'];
        $adminUser->phone = $values['phone'];
        $adminUser->adminUserRoleId = $values['adminUserRoleId'];
        
        // Set enabled
        if (isset($values['enabled'])) {
            $adminUser->enabled = true;
        } else {
            $adminUser->enabled = false;
        }

        $message = 'Your data has been updated by a system administrator.';
        
        // Update in database
        $adminUser->save();
        
        // Prepare data for send notification email
        $adminUserEmail = $values['email'];
        $data = ['adminUser' => $adminUser, 'notificationMessage' => $message];
         
        // Send notification email
//         Mail::send('pages.admin.emails.notification-admin-user-edit', $data, function($m) use($adminUserEmail){
//             $m->from(env('NOTIFICATION_MAIL_FROM_ADDRESS'), env('NOTIFICATION_MAIL_FROM_NAME'));
//             $m->to($adminUserEmail, env('NOTIFICATION_MAIL_FROM_NAME'))->subject('Your account has been updated');
//         });
             // Redirect to admin users list
            return redirect()->route('management/admin-users');
        }
        
        public function updatePassword (Request $request, $id)
        {
            // Get values
            $values = $request->all();
        
            // Validate
            $this->validate($request, $this->changePasswordValidationRules, $this->validationMessages);
        
            // Load admin user
            $adminUser = AdminUserModel::find($id);
        
            // Update password
            $adminUser->password = sha1($values['password']);
            $message = "Your data has been updated by a system administrator. Your new password is: ".$values['password'];
        
            // Update in database
            $adminUser->save();
        
            // Prepare data for send notification email
            $adminUserEmail = $adminUser->email; 
            $data = ['adminUser' => $adminUser, 'notificationMessage' => $message];
        
            // Send notification email
            Mail::send('pages.admin.emails.notification-admin-user-edit', $data, function($m) use($adminUserEmail){
                $m->from(env('NOTIFICATION_MAIL_FROM_ADDRESS'), env('NOTIFICATION_MAIL_FROM_NAME'));
                $m->to($adminUserEmail, env('NOTIFICATION_MAIL_FROM_NAME'))->subject('Your account has been updated');
            });
                // Redirect to admin users edit
                return redirect()->route('management/admin-users/edit',$id);
        
        }
        
    }
    