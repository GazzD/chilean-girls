<?php

namespace App\Models;


class Gallery extends AppModel
{
    public $timestamps = true;
    public $table = 'galleries';
    protected $fillable = ['enabled', 'main_image', 'name', 'price', 'model_id','category_id'];
    
    public function model()
    {
        return $this->belongsTo('App\Models\GirlModel');
    }
    
    public function pictures()
    {
        return $this->hasMany('App\Models\Picture');
    }
    
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    
}