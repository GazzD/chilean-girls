<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Admin\AppManagementController;
use App\Models\CarouselItem as CarouselItemModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JsValidator;

class CarouselItems extends AppManagementController
{
    /**
     * Define your validation messages in a property in
     * the controller to reuse the messages.
     */
    protected $validationMessages = [
        'required'    => 'El campo es requerido.',
        'image'        => 'El campo debe ser una imagen.',
        'max'        => 'El campo exede el número máximo de caracteres permitidos',            
        'url'        => 'El campo debe ser una url válida.'
    ];

    protected $addValidationRules = array();
    protected $editValidationRules = array();
    
    public function __construct() {
        $this->addValidationRules['order'] = 'required';
        $this->addValidationRules['image'] = 'required|image';
        $this->addValidationRules['link'] = 'required|url';
        $this->addValidationRules['name'] = 'required|max:20';
        $this->addValidationRules['target'] = 'required';
        
        
        $this->editValidationRules['order'] = 'required';
        $this->editValidationRules['image'] = 'image';
        $this->editValidationRules['link'] = 'required|url';
        $this->editValidationRules['name'] = 'required|max:20';
        $this->editValidationRules['target'] = 'required';
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return admin.carousel-items.index
     */
    public function index()
    {
        // Load page configuration values
        $pageDefault = 50;
        $pageSizes = [5,10,20,50,100];
        
        // Add breadcrumbs
        $this->addBreadcrumb('Elementos del carrusel', route('management/carousel-items'));
        
        // Set Title and subtitle
        $this->title = 'Elementos del carrusel';
        $this->subtitle = 'listado';
        
        // Find all carousel items
        $carouselItems = CarouselItemModel::all();
        
        // Display view
        return $this->view('pages.admin.management.carousel-items.index')
            ->with('carouselItems', $carouselItems)
            ->with('pageSizes', $pageSizes);
        ;
    }

    /**
     * Show the form for adding a new resource.
     *
     * @return admin.carousel-items.add
     */
    public function add()
    {
        // Add breadcrumbs
        $this->addBreadcrumb('Elementos del carrusel', route('management/carousel-items'));
        $this->addBreadcrumb('Agregar', route('management/carousel-items/add'));
         
        // Set Title and subtitle
        $this->title = 'Elemento del carrusel';
        $this->subtitle = 'agregar';
        
        // Target types
        $targetTypes = array(
            '_self'        => 'Abre en la misma página',
            '_blank'    => 'Abrir en otro tab'
        );
            
        // Prepare view data
        $validator = JsValidator::make($this->addValidationRules, $this->validationMessages, [], "#addCarouselItemForm")->view('pages.admin.validations.validation-with-tabs');
        $orderOptions = array();
        // Set values to order array
        $orderOptionMax = 10;
        for ($o = 1; $o <= $orderOptionMax; $o++) {
            $orderOptions[$o] = $o;
        }
        // Create new carousel item
        $carouselItem = new CarouselItemModel();
        
        return $this->view('pages.admin.management.carousel-items.add')
            ->with('carouselItem', $carouselItem)
            ->with('orderOptions', $orderOptions)
            ->with('targetTypes', $targetTypes)
            ->with('validator', $validator)
        ;
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @redirect admin.carousel-items
     */
    public function delete($id)
    {
        // Load image
        $carouselItem = CarouselItemModel::find($id);
         
        // Remove if not empty
        if(!empty($carouselItem)){
            try {
                // Remove files for each language
                if($carouselItem->image != null) {
                    $file = public_path($carouselItem->image);
                    if(file_exists($file)){
                        unlink($file);
                    }
                }
                
                // Remove from database
                CarouselItemModel::destroy($id);
                
            } catch(\Exception $e){
                $errors = array('message' => 'Ha ocurrido un error. Por favor intenta de nuevo más tarde.');
                return redirect()->route('management/carousel-items')->withErrors($errors);
            }            
        }
        
        // Redirect to product categories list
        return redirect()->route('management/carousel-items');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return admin.carousel-items.detail
     */
    public function detail($id)
    {
        // Add breadcrumbs
        $this->addBreadcrumb('Elementos del carrusel', route('management/carousel-items'));
        $this->addBreadcrumb('Detalle', route('management/carousel-items/detail',$id));
        
        // Set Title and subtitle
        $this->title = 'Elemento del carrusel';
        $this->subtitle = 'detalle';
        
        // Target types
        $targetTypes = array(
            '_self'     => 'Abrir en la misma página',
            '_blank'    => 'Abrir en otro tab'
        );
        
        // Find carousel item by id
        $carouselItem = CarouselItemModel::find($id);
        
        if($carouselItem){
            // Display view
            return $this->view('pages.admin.management.carousel-items.detail')
                ->with('carouselItem', $carouselItem)
                ->with('targetTypes', $targetTypes)
            ;
        } else {
            return response()->view('errors.admin.404');
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return admin.carousel-items.edit
     */
    public function edit($id)
    {
        // Add breadcrumbs
        $this->addBreadcrumb('Elementos del carrusel', route('management/carousel-items'));
        $this->addBreadcrumb('Editar', route('management/carousel-items/edit', $id));
        
        // Set Title and subtitle
        $this->title = 'Elementos del carrusel';
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
        $validator = JsValidator::make($this->editValidationRules, $this->validationMessages, [], "#editCarouselItemForm")->view('pages.admin.validations.validation-with-tabs');
        
        // Load carousel item
        $carouselItem = CarouselItemModel::find($id);
        
        if($carouselItem){
            // Display view
            return $this->view('pages.admin.management.carousel-items.edit')
                ->with('carouselItem', $carouselItem)
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
     * @return admin.carousel-items.add
     */
    public function store(Request $request)
    {
        // Get values
        $values = $request->all();
        
        // Validate
        $this->validate($request, $this->addValidationRules, $this->validationMessages);
        
        // Create new carousel item
        $carouselItem = new CarouselItemModel();
        
        $carouselItem->name = $values['name'];
        $carouselItem->link = $values['link'];
        $carouselItem->target = $values['target'];
        $carouselItem->order = $values['order'];
        
        // Store images
        if ($values['image'] != null) {
            $imageName = $this->uploadFile($values['image']);
            $carouselItem->image = 'uploads/carousel-item/'.$imageName;
        }
        
        if (isset($values['enabled'])) {
            $carouselItem->enabled = true;
        } else {
            $carouselItem->enabled = false;
        }
        
        // Store in database
        $carouselItem->save();

        return redirect()->route('management/carousel-items');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return admin.carousel-items.edit
     */
    public function update(Request $request, $id)
    {
        // Get values
        $values = $request->all();
        
        // Validate
        $this->validate($request, $this->editValidationRules, $this->validationMessages);
        
        // Load carousel item
        $carouselItem = CarouselItemModel::find($id);
        
        $carouselItem->name = $values['name'];
        $carouselItem->order = $values['order'];
        $carouselItem->link = $values['link'];
        $carouselItem->target = $values['target'];
        $carouselItem->order = $values['order'];
        
        if (isset($values['image'])) {
            // Remove current image from server
            $file = public_path($carouselItem->image);
            if(file_exists($file)){
                unlink($file);
            }
            // Store new image 
            $imageName = $this->uploadFile($values['image']);
            $carouselItem->image = 'uploads/carousel-item/'.$imageName;
        }
        
        if (isset($values['enabled'])) {
            $carouselItem->enabled = true;
        } else {
            $carouselItem->enabled = false;
        }
        
        // Update in database
        $carouselItem->save();
        
        return redirect()->route('management/carousel-items');
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
        $file->move(public_path('uploads/carousel-item/'), $fileName);
        
        return $fileName;
    }
    
}
