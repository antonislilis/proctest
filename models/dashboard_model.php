<?php

class Dashboard_Model extends Model {

    function __construct() {
        parent::__construct();
    }

     function setCurrencies(){
        $newValue = $_POST['newValue'];
        $sth = $this->db->prepare('UPDATE currencies SET value = "'.$newValue.'"');
        $sth->execute();
    }
}