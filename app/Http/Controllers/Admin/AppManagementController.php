<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use stdClass;

class AppManagementController extends Controller
{
    use ValidatesRequests;
    
    protected $breadcrumbs = array();
    protected $configItems = array();
    protected $languages = array();
    protected $subtitle = '';
    protected $title = '';
    
    function addBreadcrumb($title, $url, $icon=null)
    {
        // Create new breadcrumb
        $breadcrumb = new stdClass();
        $breadcrumb->title = $title;
        $breadcrumb->url = $url;
        $breadcrumb->icon = $icon;
        
        // Add breadcrumb to array
        $this->breadcrumbs[] = $breadcrumb;
    }
    
    function prettyUrl($string) {
        $entitiesRegExp = '`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i';
        
        $string = htmlentities($string, ENT_NOQUOTES, 'UTF-8');
        $string = preg_replace($entitiesRegExp, '\1', $string);
        $string = html_entity_decode($string, ENT_NOQUOTES, 'UTF-8');
        $string = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $string);
        $string = strtolower(trim($string, '-'));
        return $string;
    }
    
    function view($view = null, $data = [], $mergeData = [])
    {
        return view($view, $data, $mergeData)
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('configItems', $this->configItems)
            ->with('languages', $this->languages)
            ->with('subtitle', $this->subtitle)
            ->with('title', $this->title)
        ;
    }

}
