<?php

namespace App\Models;


class GirlModel extends AppModel
{
    public $timestamps = true;
    public $table = 'models';
    protected $fillable = ['enabled', 'image', 'name', 'link', 'target'];
    
    public function galleries()
    {
        return $this->hasMany('App\Models\Gallery', 'model_id', 'id');
    }
    
    public function videos()
    {
        return $this->hasMany('App\Models\Video', 'model_id', 'id');
    }
}