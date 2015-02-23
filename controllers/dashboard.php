<?php

class Dashboard extends Controller {

    protected $url = array("url" => "http://localhost/cur_calc/");
    protected $arr = array
        (
        array("url" => "http://localhost/cur_calc/", "tony" => "antonis")
    );

    function __construct() {
        parent::__construct();
        }

    function index() {
        $dust = new \Dust\Dust();
        $template = $dust->compileFile('views/dashboard/index.dust');
        $allCurrencies = $this->getAllCurrencies();
        $output = $dust->renderTemplate($template, $allCurrencies);
        // echo the output
        echo($output);
    }

    function getAllCurrencies() {
        $this->model = new General_Model();
        return $this->model->getAllCurrencies();
    }

    function setCurrencies(){
        
    }
}
