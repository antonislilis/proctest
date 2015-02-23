<?php

class Index extends Controller {
    function __construct() {
        parent::__construct();   
    }
    
    function index() {
        $dust = new \Dust\Dust();
		$template = $dust->compileFile('views/index/index.dust');
		

		
		
		$output = $dust->renderTemplate($template, array());
		// echo the output
		echo($output);
    }
    
    function details() {
        $this->view->render('index/index');
    }
}

