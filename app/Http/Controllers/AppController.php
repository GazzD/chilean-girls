<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
    
    function prettyUrl($string) {
        $entitiesRegExp = '`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i';
        
        $string = htmlentities($string, ENT_NOQUOTES, 'UTF-8');
        $string = preg_replace($entitiesRegExp, '\1', $string);
        $string = html_entity_decode($string, ENT_NOQUOTES, 'UTF-8');
        $string = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $string);
        $string = strtolower(trim($string, '-'));
        return $string;
    }
    
    function view($view = null, $data = [], $mergeData = []) {
        return view($view, $data, $mergeData)
             // >with('auth', $auth)
        ;
    
    }
    
}
