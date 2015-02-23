<?php
//ftiaxnw ena object ths database
class Model {

    function __construct() {
        $this->db = new Database();
		$this->db->exec("set names utf8");
    }

}
