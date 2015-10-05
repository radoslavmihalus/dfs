<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ImportModel {

    private $database;

    function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    static function importProfiles() {
        require_once 'www/inc/config_ajax.php';
        $importdb = getImportContext();
        $database = getContext();

        $users = $importdb->table("wp_users")->fetchAll();
        $database->table("tbl_user")->delete();

        foreach ($users as $user) {
            $rand = rand(10000, 99999);
            $pass = "gnrtx" . $rand;
        }

        return $return;
    }

}
