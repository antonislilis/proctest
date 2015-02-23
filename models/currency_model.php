<?php

class Currency_Model extends Model
{
    public function __construct()
    {
        parent::__construct(); 
    }
    
    public function getCurrencies()
    {
        $sth = $this->db->prepare('SELECT * FROM currencies');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $data = array('options' => $sth->fetchAll());
        //echo json_encode($data);
        //print_r($data);
        return $data;
    }
}
