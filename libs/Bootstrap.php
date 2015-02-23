<?php

class Bootstrap {

    function __construct() {
        $url = isset($_GET['url']) ? $_GET['url'] : null; //to isset gia xwris url
        $url = rtrim($url, '/'); // gia ta slashes meta to url
        $url = explode('/', $url);
        //print_r($url);
        
        if (empty($url[0])){
            require 'controllers/index.php';
            $controller = new Index();
            require 'views/header.php';
            $controller->index();
            require 'views/footer.php';
            return false;
        }
        
        $file = 'controllers/' . $url[0] . '.php';
        if  (file_exists($file)) {
            require $file;
        } else {
            $this->error();
        }
        
        
        $controller = new $url[0];  
        
        $controller->loadmodel($url[0]);
    //   var_dump($controller);
        
        // calling methods area
        if (isset($url[2])) {
			echo  method_exists($controller, $url[1]);
            // elegxo an dwsw px login/dfgfd
            if (method_exists($controller, $url[1])) {
                $controller->{$url[1]}($url[2]);
            } else {
                $this->error();
            }     
        } else {
            if (isset($url[1])) {
                if (method_exists($controller, $url[1])) {
                    $controller->{$url[1]}(); 
                } else {
                    $this->error();
                }
            } else {
                require 'views/header.php';
                $controller->index(); 
                require 'views/footer.php';
            }
        }
       
    }
   
    
    function error() {
        require 'controllers/error.php';
        $controller = new Error();
        $controller->index();
        return false;   
    }

}
