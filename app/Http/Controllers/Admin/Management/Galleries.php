<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Admin\AppManagementController;
use App\Models\Gallery as GalleryModel;
use App\Models\GirlModel;
use App\Models\Category;
use App\Models\Picture as PictureModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JsValidator;

class Galleries extends AppManagementController
{
    /**
     * Define your validation messages in a property in
     * the controller to reuse the messages.
     */
    protected $validationMessages = [
        'required'   => 'El campo es requerido.',
        'image'      => 'El campo debe ser una imagen.',
        'max'        => 'El campo exede el número máximo de caracteres permitidos',
    ];
    
    protected $addValidationRules = array();
    protected $editValidationRules = array();
    
    public function __construct() {
        $this->addValidationRules['mainPicture'] = 'required|image';
        $this->addValidationRules['name'] = 'required';
        $this->addValidationRules['categoryId'] = 'required';
        $this->addValidationRules['price'] = 'required';
        $this->addValidationRules['model'] = 'required';
        $this->addValidationRules['pictures.*'] = 'required|image';
        
        $this->editValidationRules['name'] = 'required';
        $this->editValidationRules['categoryId'] = 'required';
        $this->editValidationRules['price'] = 'required';
        $this->editValidationRules['model'] = 'required';
    }
    /**
     * Display a listing of the resource.
     *
     * @return admin.galleries.index
     */
    public function index()
    {
        // Load page configuration values
        $pageDefault = 50;
        $pageSizes = [5,10,20,50,100];
        
        // Add breadcrumbs
        $this->addBreadcrumb('Galerías', route('management/galleries'));
        
        // Set Title and subtitle
        $this->title = 'Galerías';
        $this->subtitle = 'listado';
        
        // Find all carousel items
        $galleries = GalleryModel::with('category')
            ->get()
        ;
        
        // Display view
        return $this->view('pages.admin.management.galleries.index')
            ->with('galleries', $galleries)
            ->with('pageSizes', $pageSizes)
        ;
    }

    /**
     * Show the form for adding a new resource.
     *
     * @return admin.galleries.add
     */
    public function add()
    {
        // Add breadcrumbs
        $this->addBreadcrumb('Galerías', route('management/galleries'));
        $this->addBreadcrumb('Agregar', route('management/galleries/add'));
         
        // Set Title and subtitle
        $this->title = 'Galería';
        $this->subtitle = 'agregar';
        
        // Prepare view data
        $validator = JsValidator::make($this->addValidationRules, $this->validationMessages, [], "#addGalleryForm")->view('pages.admin.validations.validation-with-tabs');
        
        // Create new carousel item
        $gallery = new GalleryModel();
        $models = GirlModel::pluck('nickname', 'id');
        $categories = Category::pluck('name','id');
        
        return $this->view('pages.admin.management.galleries.add')
            ->with('gallery', $gallery)
            ->with('models', $models)
            ->with('validator', $validator)
            ->with('categories',$categories)
        ;
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @redirect admin.galleries
     */
    public function delete($id)
    {
        // Load image
        $gallery = GalleryModel::with('pictures')->find($id);
         
        // Remove if not empty
        if(!empty($gallery)){
            try {
                // Remove files
                if($gallery->mainImage != null) {
                    $file = public_path($gallery->mainImage);
                    if(file_exists($file)){
                        unlink($file);
                    }
                }
                foreach ($gallery->pictures as $picture) {
                    // Remove files
                    $file = public_path($picture->image);
                    if(file_exists($file)){
                        unlink($file);
                    }
                    
                    // Delete picture
                    $picture->delete();
                    
                }
                
                // Remove from database
                GalleryModel::destroy($id);
                
            } catch(\Exception $e){
                $errors = array('message' => 'Ha ocurrido un error. Por favor intenta de nuevo más tarde.');
                return redirect()->route('management/galleries')->withErrors($errors);
            }            
        }
        
        // Redirect to product categories list
        return redirect()->route('management/galleries');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return admin.galleries.detail
     */
    public function detail($id)
    {
        // Add breadcrumbs
        $this->addBreadcrumb('Galerías', route('management/galleries'));
        $this->addBreadcrumb('Detalle', route('management/galleries/detail',$id));
        
        // Set Title and subtitle
        $this->title = 'Modelo';
        $this->subtitle = 'detalle';
        
        // Find carousel item by id
        $gallery = GalleryModel::with('model')
            ->with('pictures')
            ->with('category')
            ->find($id)
        ;
        
        if($gallery){
            // Display view
            return $this->view('pages.admin.management.galleries.detail')
                ->with('gallery', $gallery)
            ;
        } else {
            return response()->view('errors.admin.404');
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return admin.galleries.edit
     */
    public function edit($id)
    {
        // Add breadcrumbs
        $this->addBreadcrumb('Galerías', route('management/galleries'));
        $this->addBreadcrumb('Editar', route('management/galleries/edit', $id));
        
        // Set Title and subtitle
        $this->title = 'Galerías';
        $this->subtitle = 'editar';
         
        // Prepare view data
        $validator = JsValidator::make($this->editValidationRules, $this->validationMessages, [], "#editGalleryForm")->view('pages.admin.validations.validation-with-tabs');
        
        // Load carousel item
        $gallery = GalleryModel::with('model')->with('pictures')->find($id);
        $models = GirlModel::pluck('nickname', 'id');
        $categories = Category::pluck('name','id');
        if($gallery){
            // Display view
            return $this->view('pages.admin.management.galleries.edit')
                ->with('gallery', $gallery)
                ->with('models', $models)
                ->with('categories',$categories)
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
     * @return admin.galleries.add
     */
    public function store(Request $request)
    {
        // Get values
        $values = $request->all();
        
        // Validate
        $this->validate($request, $this->addValidationRules, $this->validationMessages);
        
        // Create new gallery
        $gallery = new GalleryModel();
        
        $gallery->name = $values['name'];
        $gallery->modelId = $values['model'];
        $gallery->price = $values['price'];
        $gallery->category_id = $values['categoryId'];
        
        // Store gallery main image
        if ($values['mainPicture'] != null) {
            $imageName = $this->uploadFile($values['mainPicture']);
            $gallery->mainImage = 'uploads/gallery/'.$imageName;
            
        }
        
        if (isset($values['enabled'])) {
            $gallery->enabled = true;
        } else {
            $gallery->enabled = false;
        }
        
        // Store in database
        $gallery->save();
        
        // Store gallery pictures
        if ($values['pictures'] != null) {
            foreach ($values['pictures'] as $uploadedPicture) {
                $imageName = $this->uploadFile($uploadedPicture);
                $picture = new PictureModel();
                $picture->enabled = true;
                $picture->galleryId = $gallery->id;
                $picture->image = 'uploads/gallery/'.$imageName;
                $picture->name = $imageName;
                $picture->save();
            }
        }
        
        return redirect()->route('management/galleries');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return admin.galleries.edit
     */
    public function update(Request $request, $id)
    {
        // Get values
        $values = $request->all();
        
        // Validate
        $this->validate($request, $this->editValidationRules, $this->validationMessages);
        
        // Load carousel item
        $gallery = GalleryModel::find($id);
        
        $gallery->name = $values['name'];
        $gallery->modelId = $values['model'];
        $gallery->price = $values['price'];
        $gallery->category_id = $values['categoryId'];
        
        if (isset($values['mainPicture'])) {
            // Remove current image from server
            $file = public_path($gallery->mainImage);
            if(file_exists($file)){
                unlink($file);
            }
            // Store new image
            $imageName = $this->uploadFile($values['mainPicture']);
            $gallery->mainImage = 'uploads/gallery/'.$imageName;
        }
        
        // Override gallery pictures
        if (isset($values['pictures'])) {
            // Remove current gallery pictures
            foreach ($gallery->pictures as $picture) {
                // Remove current pictures from server
                $file = public_path($picture->image);
                if(file_exists($file)){
                    unlink($file);
                }
                
                // Delete picture
                $picture->delete();
            }
            
            // Store new images
            foreach ($values['pictures'] as $uploadedPicture) {
                // Store new image
                $imageName = $this->uploadFile($uploadedPicture);
                $picture = new PictureModel();
                $picture->enabled = true;
                $picture->galleryId = $gallery->id;
                $picture->image = 'uploads/gallery/'.$imageName;
                $picture->name = $imageName;
                $picture->save();
                
            }
        }
        
        if (isset($values['enabled'])) {
            $gallery->enabled = true;
        } else {
            $gallery->enabled = false;
        }
        
        // Update in database
        $gallery->save();
        
        return redirect()->route('management/galleries');
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
        $file->move(public_path('uploads/gallery/'), $fileName);
        
        return $fileName;
    }
    
}
