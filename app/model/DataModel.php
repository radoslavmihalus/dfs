<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DataModel {

    private $database;

    function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    function getField($form_name, $element_name) {
        $fields = $this->database->query("SELECT * FROM form_fields WHERE form_name=? AND element_name=?", $form_name, $element_name);

        $return = "";

        foreach ($fields as $field) {
            $return = $field->field_name;
        }
        return $return;
    }

    function getFieldReverse($form_name, $field_name) {
        $fields = $this->database->query("SELECT * FROM form_fields WHERE form_name=? AND field_name=?", $form_name, $field_name);

        $return = "";

        foreach ($fields as $field) {
            $return = $field->element_name;
        }
        return $return;
    }

    function assignFields($valuesArray, $form) {
        $return = array();

        foreach ($valuesArray as $key => $value) {
            $field = $this->getField($form, $key);
            if (strlen($field) > 0)
                $return[$field] = $value;
        }

        return $return;
    }

    function assignFieldsReverse($valuesArray, $form) {
        $return = array();

        foreach ($valuesArray as $key => $value) {
            $field = $this->getFieldReverse($form, $key);
            if (strlen($field) > 0)
                $return[$field] = $value;
        }

        return $return;
    }

    /***
     * @img = file upload control
     */
    function processImage($img) {
        $target_path = "uploads/";

        $ext = '';

        $ext = explode('.', $img->name);

        $length = count($ext);

        $ext = $ext[$length - 1];

        switch ($ext) {
            case 'gif':
                $ext = 'gif';
                break;
            case 'jpeg':
                $ext = 'jpg';
                break;
            case 'jpg':
                $ext = 'jpg';
                break;
            case 'png':
                $ext = 'png';
                break;
            default :
                throw new \ErrorException("Only .gif / .jpeg / .jpg / .png extensions are allowed", "1");
                break;
        }

        $filename = \KennelUpdateModel::generateRandomString() . ".$ext";

        $img->move("$target_path/$filename");

        $return = "$target_path/$filename";
        
        return $return;
    }

}
