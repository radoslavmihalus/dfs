<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class sitemapPresenter extends BasePresenter {

    public function renderSitemap() {
        $this->template->langs = $this->getAllLangs();
        $this->template->date = date("Y-m-d");
    }

    public function getAllLangs() {
        $langs = array();
        $langs[] = "cz";
        $langs[] = "en";
        $langs[] = "hu";
        $langs[] = "ru";
        $langs[] = "sk";

        return $langs;
    }

}
