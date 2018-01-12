<?php

namespace App\Models;


class Video extends AppModel
{
    public $timestamps = true;
    public $table = 'videos';
    protected $fillable = ['video', 'enabled', 'price', 'video', 'model_id','category_id'];
    
    public function model()
    {
        return $this->belongsTo('App\Models\GirlModel');
    }
    
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}