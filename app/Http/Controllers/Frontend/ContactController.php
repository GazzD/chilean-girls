<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\AppController;
use JsValidator;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactAdminMail;

class ContactController extends AppController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//         $this->middleware('auth');
    }
    
    protected $validationMessages = [
        'required'  => 'El campo es requerido.',
        'image'     => 'El campo debe ser una imagen.',
        'max'       => 'El campo exede el número máximo de caracteres permitidos',
        'url'       => 'El campo debe ser una url válida.'
    ];
    
    protected $contactValidationRules = [
        'name'                  => 'required',
        'lastname'              => 'required',
        'email'                 => 'required|email',
        'country'               => 'required',
        'birthDate'            => 'required',
//         'g-recaptcha-response'  => 'required|captcha'
    ];
    
    
    public function index()
    {
        // Prepare view data
        $validator = JsValidator::make($this->contactValidationRules, $this->validationMessages, [], "#contactForm")->view('pages.admin.validations.validation-with-tabs');
        
        return $this->view('pages.frontend.contact.index')
            ->with('validator', $validator)
        ;
    }
    
    public function store(Request $request)
    {
        // Get values
        $values = $request->all();
        
        $this->contactValidationRules['picture1'] = 'required|image';
        $this->contactValidationRules['picture2'] = 'required|image';
        $this->contactValidationRules['picture3'] = 'required|image';
        
        // Validate
        $this->validate($request, $this->contactValidationRules, $this->validationMessages);
        
        // Store contact 
        $contact = new Contact();
        $contact->name = $values['name'];
        $contact->lastname = $values['lastname'];
        $contact->email = $values['email'];
        $contact->country = $values['country'];
        $contact->birthDate = $values['birthDate'];
        
        // Optional data
        $contact->portfolio = $values['portfolio'];
        $contact->message = $values['message'];
        $contact->model = isset($values['model'])?true:false;
        
        $contact->save();
        
        // Store uploaded pictures
        $picture1Extension = $values['picture1']->getClientOriginalExtension();
        $picture1Name = $contact->id.'-'.$this->prettyUrl($values['name']).'-1.'.$picture1Extension;
        $destinationPath = 'uploads'.DIRECTORY_SEPARATOR .'contact';
        $picture1Path = $values['picture1']->move($destinationPath,$picture1Name);
        
        $picture2Extension = $values['picture2']->getClientOriginalExtension();
        $picture2Name = $contact->id.'-'.$this->prettyUrl($values['name']).'-2.'.$picture2Extension;
        $destinationPath = 'uploads'.DIRECTORY_SEPARATOR .'contact';
        $picture2Path = $values['picture2']->move($destinationPath,$picture2Name);
        
        $picture3Extension = $values['picture3']->getClientOriginalExtension();
        $picture3Name = $contact->id.'-'.$this->prettyUrl($values['name'])."-3.".$picture3Extension;
        $destinationPath = 'uploads'.DIRECTORY_SEPARATOR .'contact';
        $picture3Path = $values['picture3']->move($destinationPath,$picture3Name);
        
        $contact->picture1 = $picture1Path;
        $contact->picture2 = $picture2Path;
        $contact->picture3 = $picture3Path;
        $contact->save();
        
        // Send email
        Mail::to('postula@chileangirls.com')->send(new ContactAdminMail($contact));
        
        // Display view
        return redirect()->back()->with('successMessage', 'Mensaje envíado existosamente');
    }
}
