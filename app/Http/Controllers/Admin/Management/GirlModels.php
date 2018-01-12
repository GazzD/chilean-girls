<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Admin\AppManagementController;
use App\Models\GirlModel as GirlModelModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JsValidator;
use Illuminate\Support\Facades\Storage;

class GirlModels extends AppManagementController
{
    /**
     * Define your validation messages in a property in
     * the controller to reuse the messages.
     */
    protected $validationMessages = [
        'required'   => 'El campo es requerido.',
        'image'      => 'El campo debe ser una imagen.',
        'max'        => 'El campo exede el número máximo de caracteres permitidos',
        'mimes'      => 'El campo debe ser un video'
    ];
    
    protected $addValidationRules = array();
    protected $editValidationRules = array();
    
    public function __construct() {
        $this->addValidationRules['instagram'] = 'required';
        $this->addValidationRules['nickname'] = 'required';
        $this->addValidationRules['profileImage'] = 'required|image';
        $this->addValidationRules['promoPicture'] = 'required|image';
        $this->addValidationRules['summary'] = 'required';
        $this->addValidationRules['promoVideo'] = 'mimes:mp4,ogx,oga,ogv,ogg,webm';
        
        $this->editValidationRules['instagram'] = 'required';
        $this->editValidationRules['nickname'] = 'required';
        $this->editValidationRules['profileImage'] = 'image';
        $this->editValidationRules['promoPicture'] = 'image';
        $this->editValidationRules['summary'] = 'required';
        $this->editValidationRules['promoVideo'] = 'mimes:mp4,ogx,oga,ogv,ogg,webm';
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return admin.models.index
     */
    public function index()
    {
        // Load page configuration values
        $pageDefault = 50;
        $pageSizes = [5,10,20,50,100];
        
        // Add breadcrumbs
        $this->addBreadcrumb('Modelos', route('management/models'));
        
        // Set Title and subtitle
        $this->title = 'Modelos';
        $this->subtitle = 'listado';
        
        // Find all carousel items
        $models = GirlModelModel::all();
        
        // Display view
        return $this->view('pages.admin.management.girl-models.index')
            ->with('models', $models)
            ->with('pageSizes', $pageSizes);
        ;
    }

    /**
     * Show the form for adding a new resource.
     *
     * @return admin.models.add
     */
    public function add()
    {
        // Add breadcrumbs
        $this->addBreadcrumb('Modelos', route('management/models'));
        $this->addBreadcrumb('Agregar', route('management/models/add'));
         
        // Set Title and subtitle
        $this->title = 'Modelo';
        $this->subtitle = 'agregar';
        
        // Prepare view data
        $validator = JsValidator::make($this->addValidationRules, $this->validationMessages, [], "#addGirlModelForm")->view('pages.admin.validations.validation-with-tabs');
        
        // Create new carousel item
        $model = new GirlModelModel();
        
        return $this->view('pages.admin.management.girl-models.add')
            ->with('model', $model)
            ->with('validator', $validator)
        ;
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @redirect admin.models
     */
    public function delete($id)
    {
        // Load image
        $model = GirlModelModel::find($id);
         
        // Remove if not empty
        if(!empty($model)){
            try {
                // Remove files
                if($model->profilePicture != null) {
                    $file = public_path($model->profilePicture);
                    if(file_exists($file)){
                        unlink($file);
                    }
                }
                
                if($model->promoPicture != null) {
                    $file = public_path($model->promoPicture);
                    if(file_exists($file)){
                        unlink($file);
                    }
                }
                
                if($model->promoVideo != null) {
                    $file = public_path($model->promoVideo);
                    if(file_exists($file)){
                        unlink($file);
                    }
                }
                
                // Remove from database
                GirlModelModel::destroy($id);
                
            } catch(\Exception $e){
                $errors = array('message' => 'Ha ocurrido un error. Por favor intenta de nuevo más tarde.');
                return redirect()->route('management/models')->withErrors($errors);
            }            
        }
        
        // Redirect to product categories list
        return redirect()->route('management/models');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return admin.models.detail
     */
    public function detail($id)
    {
        // Add breadcrumbs
        $this->addBreadcrumb('Modelos', route('management/models'));
        $this->addBreadcrumb('Detalle', route('management/models/detail',$id));
        
        // Set Title and subtitle
        $this->title = 'Modelo';
        $this->subtitle = 'detalle';
        
        // Find carousel item by id
        $model = GirlModelModel::find($id);
        
        if($model){
            // Display view
            return $this->view('pages.admin.management.girl-models.detail')
                ->with('model', $model)
            ;
        } else {
            return response()->view('errors.admin.404');
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return admin.models.edit
     */
    public function edit($id)
    {
        // Add breadcrumbs
        $this->addBreadcrumb('Modelos', route('management/models'));
        $this->addBreadcrumb('Editar', route('management/models/edit', $id));
        
        // Set Title and subtitle
        $this->title = 'Modelos';
        $this->subtitle = 'editar';
         
        // Target types
        $targetTypes = array(
            '_self'        => 'Abrir en la misma página',
            '_blank'    => 'Abrir en otro tab'
        );
         
        // Get order max value
        $orderOptionMax = 10;
        $orderOptions = array();
        // Set values to order array
        for ($o = 1; $o <= $orderOptionMax; $o++) {
            $orderOptions[$o] = $o;
        }
        
        // Prepare view data
        $validator = JsValidator::make($this->editValidationRules, $this->validationMessages, [], "#editGirlModelForm")->view('pages.admin.validations.validation-with-tabs');
        
        // Load carousel item
        $model = GirlModelModel::find($id);
        
        if($model){
            // Display view
            return $this->view('pages.admin.management.girl-models.edit')
                ->with('model', $model)
                ->with('orderOptions', $orderOptions)
                ->with('targetTypes', $targetTypes)
                ->with('validator', $validator)
            ;
        }else{
            return response()->view('errors.admin.404');
        }
        
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return admin.models.add
     */
    public function store(Request $request)
    {
        // Get values
        $values = $request->all();
        
        // Validate
        $this->validate($request, $this->addValidationRules, $this->validationMessages);
        
        // Create new carousel item
        $model = new GirlModelModel();
        
        $model->nickname = $values['nickname'];
        $model->instagram = $values['instagram'];
        $model->summary = $values['summary'];
        $model->friendlyUrl = $this->prettyUrl($model->nickname);
        
        // Store profile image
        if ($values['profileImage'] != null) {
            $imageName = $this->uploadFile($values['profileImage']);
            $model->profilePicture = 'uploads/model/profile/'.$imageName;
        }
        
        if ($values['promoPicture'] != null) {
            $imageName = $this->uploadFile($values['promoPicture']);
            $model->promoPicture = 'uploads/model/profile/'.$imageName;
        }
        
        // Store promotional video
        if (isset($values['promoVideo']) && $values['promoVideo'] != null) {
            $imageName = $this->uploadFile($values['promoVideo']);
            $model->promoVideo = 'uploads/model/profile/'.$imageName;
        }
        
        if (isset($values['enabled'])) {
            $model->enabled = true;
        } else {
            $model->enabled = false;
        }
        
        // Store in database
        $model->save();
        
        return redirect()->route('management/models');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return admin.models.edit
     */
    public function update(Request $request, $id)
    {
        // Get values
        $values = $request->all();
        
        // Validate
        $this->validate($request, $this->editValidationRules, $this->validationMessages);
        
        // Load carousel item
        $model = GirlModelModel::find($id);
        
        $model->nickname = $values['nickname'];
        $model->instagram = $values['instagram'];
        $model->summary = $values['summary'];
        $model->friendlyUrl = $this->prettyUrl($model->nickname);
        
        if (isset($values['profileImage'])) {
            // Remove current image from server
            $file = public_path($model->profilePicture);
            if(file_exists($file)){
                unlink($file);
            }
            // Store new image 
            $imageName = $this->uploadFile($values['profileImage']);
            $model->profilePicture = 'uploads/model/profile/'.$imageName;
        }
        
        if (isset($values['promoPicture'])) {
            // Remove current image from server
            $file = public_path($model->promoPicture);
            if(file_exists($file) && $model->promoPicture){
                unlink($file);
            }
            // Store new image
            $imageName = $this->uploadFile($values['promoPicture']);
            $model->promoPicture = 'uploads/model/profile/'.$imageName;
        }
        
        if (isset($values['promoVideo'])) {
            // Remove current image from server
            $file = public_path($model->promoVideo);
            if(file_exists($file)){
                unlink($file);
            }
            
            // Store new image
            $imageName = $this->uploadFile($values['promoVideo']);
//             $disk = Storage::disk('local');
//             $disk->put('uploads/model/profile/xx.'.$request->file('promoVideo')->getClientOriginalExtension(), $request->file('promoVideo')->getRealPath());
            
            $model->promoVideo = 'uploads/model/profile/'.$imageName;
        }
        
        if (isset($values['enabled'])) {
            $model->enabled = true;
        } else {
            $model->enabled = false;
        }
        
        // Update in database
        $model->save();
        
        return redirect()->route('management/models');
    }
    
    /**
     * Upload files in uploads folder.
     *
     * @param  @file
     * @return String @fileName
     */
    private function uploadFile($file)
    {
        //Get timeDate
        $carbon = Carbon::now();
        $format = $carbon->format('YmdHis');
        
        //Generate Alphanumeric Random String
        $randstring = '';
        $string_array = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
        
        for ($i = 0; $i < 6; $i++) {
            $randstring .= $string_array[array_rand($string_array)];
        }
        
        $fileName = $format."_".$randstring."_".$file->getClientOriginalName();
        $file->move(public_path('uploads/model/profile/'), $fileName);
        
        return $fileName;
    }
    
}
