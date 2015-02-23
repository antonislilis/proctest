<?php

class Currency extends Controller {

    protected $GetCurrenciesData;

    function __construct() {
        parent::__construct();
    }

    function index() {


        $dust = new \Dust\Dust();
        $template = $dust->compileFile('views/currency/index.dust');
        $options = $this->getCurrencies();
        $output = $dust->renderTemplate($template, $options);
        // echo the output
        echo($output);

        // $view = new View('currency/index', $this->getCurrencies());
        // echo $view->output;
    }

    public function getCurrencies() {
        return $this->model->GetCurrencies();
    }

}
