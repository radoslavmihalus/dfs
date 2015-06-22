<?php

namespace App\Presenters;

use Nette,
    App\Model;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter {

    public $translator;

    function beforeRender() {
        $this->translator = new DFSTranslator();
        $this->template->setTranslator($this->translator);
    }

    function translate($message) {
        return $this->translator->translate($message);
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