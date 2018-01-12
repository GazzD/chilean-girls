<?php

namespace App\Models;


class Picture extends AppModel
{
    public $timestamps = true;
    public $table = 'pictures';
    protected $fillable = ['enabled', 'image', 'name', 'gallery_id'];
    
    public function gallery()
    {
        return $this->belongsTo('App\Models\Gallery');
    }
}