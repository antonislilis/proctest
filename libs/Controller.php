<?php

class Controller {

    function __construct() { 
        //$this->view = new View();    
    }
    
    public function loadmodel($name) {
        $path = 'models/'.$name.'_model.php';  
        
        // psaxnoume gia ena name px login
        // koitame sto models
        // an yparxei
        if (file_exists($path)) {    
            require 'models/'.$name. '_model.php';
            $modelName = $name . '_Model';          
            $this->model = new $modelName;    
        }
    }

}

