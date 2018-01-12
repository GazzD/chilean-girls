<?php

namespace App\Models;


class CarouselItem extends AppModel
{
	public $timestamps = true;
	public $table = 'carousel_items';
	public $translatedAttributes = ['image', 'name', 'link', 'target'];
	protected $fillable = ['enabled', 'image', 'name', 'link', 'target'];
	
}