<?php

namespace App\Presenters;

use Nette,
    App\Model;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter {

    private $translator;
    private $database;

    public function __construct(Nette\Database\Context $database) {
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

    function assignFields($valuesArray, $form) {
        $return = array();

        foreach ($valuesArray as $key => $value) {
            $field = $this->getField($form, $key);
            if (strlen($field) > 0)
                $return[$field] = $value;
        }

        return $return;
    }

    function beforeRender() {
        $translator = new DFSTranslator();
        $this->template->setTranslator($translator);
    }

}

class DFSTranslator implements Nette\Localization\ITranslator {

    /**
     * Translates the given string.
     * @param  string   message
     * @param  int      plural count
     * @return string
     */
    //private $database;

    public function __construct() { //Nette\Database\Context $database) {
        //$this->database = $database;
    }

    public function translate($message, $count = NULL) {
        return '*' . $message;
    }

}

?>