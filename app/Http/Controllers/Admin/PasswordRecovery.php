<?php

namespace App\Http\Controllers\Admin;


use App\Models\AdminUser;
use App\Models\AdminUserPasswordRecovery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use JsValidator;


class PasswordRecovery extends AppManagementController
{
	
	/**
	 * Define your validation messages in a property in
	 * the controller to reuse the messages.
	 */
	
	protected $validationMessages = [
			'email' => 'The field must be a valid email address.',
			'regex'	=> 'The password must have minimum 8 characters including upper and lower case, numbers and special characters.',
			'required' => 'The field is required',
			'required_with' => 'The field is required',
			'same' => 'The new password fields must match.',
	];
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return admin.carousel-items.index
	 */
	protected $passwordRecoveryValidationRules = array();
	protected $changePasswordValidationRules = array();
	
	public function __construct() {
		parent::__construct();
		
		$this->passwordRecoveryValidationRules['email'] = 'required|email';
		
		$this->changePasswordValidationRules['password'] = 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';
		$this->changePasswordValidationRules['repeatPassword'] = 'required_with:password|same:password';
		
	}
	
    public function index()
    {
    	// Create client side validator
    	$validator = JsValidator::make($this->passwordRecoveryValidationRules, $this->validationMessages, [], '#password-recovery-form');
    	
    	// Show view
    	return $this->view('pages.admin.password-recovery.index')
    		->with('validator', $validator)
    	;
		
	}
	
	public function changePassword($code)
	{
		// Load custom password recovery request
		$adminUserPasswordRecovery = AdminUserPasswordRecovery::where('code', $code)->first();
		
		// Verify code
		if ($adminUserPasswordRecovery) {
			switch ($adminUserPasswordRecovery->status) {
				case 'NEW':
					// Validation to change password
					$validator = JsValidator::make($this->changePasswordValidationRules, $this->validationMessages, [], '#change-password-form');
					
					return $this->view('pages.admin.password-recovery.change-password')
						->with('adminUserPasswordRecovery', $adminUserPasswordRecovery)
						->with('validator', $validator)
					;
					break;
					
				case 'USED':
					return $this->view('pages.admin.password-recovery.change-password')
						->with('errorMessage', 'The code for changing your password has expired.')
					;
					break;
					
				case 'EXPIRED':
					return $this->view('pages.admin.password-recovery.change-password')
						->with('errorMessage', 'The code for changing your password has expired')
					;
					break;
			}
		} else {
			return response()->view('errors.admin.public.404');
		}
	}
	
	public function messagePasswordChanged()
	{
		return $this->view('pages.admin.password-recovery.message-password-changed');
	}
	
	public function passwordRecovery(Request $request)
	{
		
		// Validate from server side
		$this->validate($request, $this->passwordRecoveryValidationRules);

		// Get form values
    	$values = $request->all();
    	$email = $values["email"];
    	
    	// Get adminUser that wants to do password recovery
    	$adminUser = AdminUser::where('email', $email)->first();
    		
    	if ($adminUser != null) {
    		
    		$adminUserPasswordRecovery = AdminUserPasswordRecovery::where('admin_user_id', $adminUser->id)->update(['status'=>'EXPIRED']);
    		    			
    		// Save AdminUser Password Recovery
	    	$adminUserPasswordRecovery = new AdminUserPasswordRecovery();
			$adminUserPasswordRecovery->code = str_random(20);
			$adminUserPasswordRecovery->creationDate = date("Y/m/d h:i:sa");
			$adminUserPasswordRecovery->creationIpAddress = $_SERVER['REMOTE_ADDR'];
			$adminUserPasswordRecovery->adminUserId = $adminUser->id;
			$adminUserPasswordRecovery->status = 'NEW';
				
			$adminUserPasswordRecovery->save();
					
	    	$data = ['adminUser' => $adminUser, 'code' => $adminUserPasswordRecovery->code];
	    		 
	    	// Send mail to adminUser
	    	Mail::send('pages.admin.emails.notification-recovery-password-change', $data, function ($m) use ($adminUser) {
	    		$m->from($this->configItems['medprozone.password.recovery.from'], 'Medprozone');
	    		$m->to($adminUser->email, 'Medprozone Website')->subject('[Medprozone] Password recovery');
	    	});
	    	
	    	return redirect()->route('password-recovery')->with('successMessage', "We've sent an email to ".$email.". Click the link in the email to reset your password. ");
    	} else {
    		
    		return redirect()->route('password-recovery')->with('errorMessage', "We couldn't find your account with that information");
    	}

	}

	public function storeChangePassword(Request $request, $code)
	{
		$this->validate($request, $this->changePasswordValidationRules);
		
		// Get form values
    	$values = $request->all();
    	    		
    	$password = $values['password'];
    	$repeatPassword = $values['repeatPassword'];
    	$adminUserId = $values['adminUserId'];
    	$adminUserPasswordRecoveryId = $values['adminUserPasswordRecoveryId'];
    	
    	$adminUser = AdminUser::where('id', $adminUserId)->first();
    	$adminUserPasswordRecovery = AdminUserPasswordRecovery::where('id', $adminUserPasswordRecoveryId)->first();
    		
    	if ($adminUser != null) {
    			
    		// Update AdminUser Password Recovery
			$adminUserPasswordRecovery['usage_date'] = date("Y/m/d h:i:sa");
			$adminUserPasswordRecovery['usage_ip_address'] = $_SERVER['REMOTE_ADDR'];
			$adminUserPasswordRecovery['status'] = 'USED';
				
			$adminUserPasswordRecovery->save();

			// Update AdminUser Password 
			$adminUser->password = sha1($password);
			
			$adminUser->save();
					
	    	$data = ['adminUser' => $adminUser, 'code' => $adminUserPasswordRecovery->code];
	    		 
	    	// Send mail to adminUser
	    	Mail::send('pages.admin.emails.notification-password-change', $data, function ($m) use ($adminUser) {
	    		$m->from($this->configItems['medprozone.password.recovery.from'], 'Medprozone');
	    		$m->to($adminUser->email, 'Medprozone Website')->subject('[Medprozone] Password recovery');
	    	});
	    		
	    	return redirect()->route('password-recovery/message-password-changed', $code)->with('successMessage', 'Your password has been changed.');

    	} else {
    		return redirect()->route('password-recovery/message-password-changed', $code)->with('errorMessage', 'An error ocurred while trying to change your password. Please try again later.');
    	}
	}

}

