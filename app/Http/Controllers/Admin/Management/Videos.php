<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Admin\AppManagementController;
use App\Models\Video as VideoModel;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JsValidator;
use Illuminate\Support\Facades\Storage;
use App\Models\GirlModel;

class Videos extends AppManagementController
{
    /**
     * Define your validation messages in a property in
     * the controller to reuse the messages.
     */
    protected $validationMessages = [
        'required'   => 'El campo es requerido.',
        'numeric'    => 'El campo debe ser numérico.',
        'max'        => 'El campo exede el número máximo de caracteres permitidos',
        'mimes'      => 'El campo debe ser un video'
    ];
    
    protected $addValidationRules = array();
    protected $editValidationRules = array();
    
    public function __construct() {
        $this->addValidationRules['model'] = 'required';
        $this->addValidationRules['name'] = 'required';
        $this->addValidationRules['price'] = 'required|numeric';
        $this->addValidationRules['summary'] = 'required';
        $this->addValidationRules['video'] = 'required|mimes:mp4,ogx,oga,ogv,ogg,webm';
        
        $this->editValidationRules['model'] = 'required';
        $this->editValidationRules['name'] = 'required';
        $this->editValidationRules['price'] = 'required|numeric';
        $this->editValidationRules['summary'] = 'required';
        $this->editValidationRules['video'] = 'mimes:mp4,ogx,oga,ogv,ogg,webm';
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return admin.videos.index
     */
    public function index()
    {
        // Load page configuration values
        $pageDefault = 50;
        $pageSizes = [5,10,20,50,100];
        
        // Add breadcrumbs
        $this->addBreadcrumb('Videos', route('management/videos'));
        
        // Set Title and subtitle
        $this->title = 'Videos';
        $this->subtitle = 'listado';
        
        // Find all carousel items
        $videos = VideoModel::with('model')
            ->with('category')
            ->get()
        ;
        
        // Display view
        return $this->view('pages.admin.management.videos.index')
            ->with('videos', $videos)
            ->with('pageSizes', $pageSizes);
        ;
    }
    
    /**
     * Show the form for adding a new resource.
     *
     * @return admin.videos.add
     */
    public function add()
    {
        // Add breadcrumbs
        $this->addBreadcrumb('Videos', route('management/videos'));
        $this->addBreadcrumb('Agregar', route('management/videos/add'));
         
        // Set Title and subtitle
        $this->title = 'Video';
        $this->subtitle = 'agregar';
        
        // Prepare view data
        $validator = JsValidator::make($this->addValidationRules, $this->validationMessages, [], "#addVideoForm")->view('pages.admin.validations.validation-with-tabs');
        
        // Create new carousel item
        $video = new VideoModel();
        
        $models = GirlModel::pluck('nickname', 'id');
        $categories = Category::pluck('name','id');
        
        return $this->view('pages.admin.management.videos.add')
            ->with('models', $models)
            ->with('video', $video)
            ->with('categories',$categories)
            ->with('validator', $validator)
        ;
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @redirect admin.videos
     */
    public function delete($id)
    {
        // Load image
        $video = VideoModel::find($id);
         
        // Remove if not empty
        if(!empty($video)){
            try {
                // Remove files
                if($video->video != null) {
                    $file = public_path($video->video);
                    if(file_exists($file)){
                        unlink($file);
                    }
                }
                
                // Remove from database
                VideoModel::destroy($id);
                
            } catch(\Exception $e){
                $errors = array('message' => 'Ha ocurrido un error. Por favor intenta de nuevo más tarde.');
                return redirect()->route('management/videos')->withErrors($errors);
            }            
        }
        
        // Redirect to product categories list
        return redirect()->route('management/videos');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return admin.videos.detail
     */
    public function detail($id)
    {
        // Add breadcrumbs
        $this->addBreadcrumb('Videos', route('management/videos'));
        $this->addBreadcrumb('Detalle', route('management/videos/detail',$id));
        
        // Set Title and subtitle
        $this->title = 'Video';
        $this->subtitle = 'detalle';
        
        // Find carousel item by id
        $video = VideoModel::with('model')
            ->with('category')
            ->find($id)
        ;
        
        if($video){
            // Display view
            return $this->view('pages.admin.management.videos.detail')
                ->with('video', $video)
            ;
        } else {
            return response()->view('errors.admin.404');
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return admin.videos.edit
     */
    public function edit($id)
    {
        // Add breadcrumbs
        $this->addBreadcrumb('Videos', route('management/videos'));
        $this->addBreadcrumb('Editar', route('management/videos/edit', $id));
        
        // Set Title and subtitle
        $this->title = 'Video';
        $this->subtitle = 'editar';
        
        // Load models
        $models = GirlModel::pluck('nickname', 'id');
        
        //Load categories
        $categories = Category::pluck('name','id');
        
        // Get order max value
        $orderOptionMax = 10;
        
        // Prepare view data
        $validator = JsValidator::make($this->editValidationRules, $this->validationMessages, [], "#editVideoForm")->view('pages.admin.validations.validation-with-tabs');
        
        // Load carousel item
        $video = VideoModel::find($id);
        
        if($video){
            // Display view
            return $this->view('pages.admin.management.videos.edit')
                ->with('video', $video)
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
     * @return admin.videos.add
     */
    public function store(Request $request)
    {
        // Get values
        $values = $request->all();
        
        // Validate
        $this->validate($request, $this->addValidationRules, $this->validationMessages);
        
        // Create new video
        $video = new VideoModel();
        
        $video->name = $values['name'];
        $video->modelId = $values['model'];
        $video->summary = $values['summary'];
        $video->price = $values['price'];
        $video->category_id = $values['categoryId'];
        
        
        // Store promotional video
        if ($values['video'] != null) {
            $imageName = $this->uploadFile($values['video']);
            $video->video = 'uploads/video/'.$imageName;
        }
        
        if (isset($values['enabled'])) {
            $video->enabled = true;
        } else {
            $video->enabled = false;
        }
        
        // Store in database
        $video->save();

        return redirect()->route('management/videos');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return admin.videos.edit
     */
    public function update(Request $request, $id)
    {
        // Get values
        $values = $request->all();
        
        // Validate
        $this->validate($request, $this->editValidationRules, $this->validationMessages);
        
        // Load carousel item
        $video = VideoModel::find($id);
        
        $video->name = $values['name'];
        $video->modelId = $values['model'];
        $video->summary = $values['summary'];
        $video->price = $values['price'];
        $video->category_id = $values['categoryId'];
        
        if (isset($values['video'])) {
            // Remove current image from server
            $file = public_path($video->video);
            if(file_exists($file)){
                unlink($file);
            }
            
            // Store new image
            $imageName = $this->uploadFile($values['video']);
//             $disk = Storage::disk('local');
//             $disk->put('uploads/video/profile/xx.'.$request->file('promoVideo')->getClientOriginalExtension(), $request->file('promoVideo')->getRealPath());
            
            $video->video = 'uploads/video/'.$imageName;
        }
        
        if (isset($values['enabled'])) {
            $video->enabled = true;
        } else {
            $video->enabled = false;
        }
        
        // Update in database
        $video->save();
        
        return redirect()->route('management/videos');
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
        $file->move(public_path('uploads/video/'), $fileName);
        
        return $fileName;
    }
    
}
