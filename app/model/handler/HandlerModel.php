<?php

class HandlerModel {

    private $db;

    public function __construct(Nette\Database\Context $database) {
        $this->db = $database;
    }

    public function fetchAll() {

//        echo \Nette\Environment::getConfig('database');
//        $connection = new \Nette\Database\Connection(\Nette\Environment::getConfig('database'));
        return $this->db->table("tbl_userkennel");
    }

}
