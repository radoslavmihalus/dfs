<?php

namespace App\Model;

use Nette;

class DFSTranslator extends Nette\Object implements Nette\Localization\ITranslator {

    /**
     * Translates the given string.
     * @param  string   message
     * @param  int      plural count
     * @return string
     */
    //private $database;

    public function __construct(){ //Nette\Database\Context $database) {
        //$this->database = $database;
    }

    public function translate($message, $count = NULL) {
        return '*' . $message;
    }

}
