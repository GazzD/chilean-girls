<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\AppController;
use App\Models\GirlModel;
use App\Models\CarouselItem;

class HomeController extends AppController
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
    public function index()
    {
        // Load carousel items
        $carouselItems = CarouselItem::where('enabled', true)->orderBy('order')->get();
        
        // Load models
        $models = GirlModel::where('enabled', true)->get();
        
        return $this->view('pages.frontend.home.index')
            ->with('carouselItems', $carouselItems)
            ->with('models', $models)
        ;
    }
    
    public function contact()
    {
        return $this->view('pages.frontend.contact.index');
    }
}
