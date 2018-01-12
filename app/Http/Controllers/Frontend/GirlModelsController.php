<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\AppController;
use App\Models\GirlModel;

class GirlModelsController extends AppController
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
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($friendlyUrl)
    {
        // Find model by nickname
        $girlModel = GirlModel::with('galleries')
            ->with('videos')
            ->where('friendly_url', $friendlyUrl)
            ->first()
        ;
        
        // Return view
        return $this->view('pages.frontend.girl-models.index')
            ->with('model', $girlModel)
        ;
    }
}
