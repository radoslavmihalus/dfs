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

    public function renderSitemap_lp() {
        $this->template->langs = $this->getAllLangs();
        $this->template->date = date("Y-m-d");
    }

    public function renderSitemap_kennels() {
        $this->template->langs = $this->getAllLangs();
        $this->template->date = date("Y-m-d");
        $this->template->kennels = $this->getAllKennels();
    }

    public function renderSitemap_owners() {
        $this->template->langs = $this->getAllLangs();
        $this->template->date = date("Y-m-d");
        $this->template->owners = $this->getAllOwners();
    }

    public function renderSitemap_handlers() {
        $this->template->langs = $this->getAllLangs();
        $this->template->date = date("Y-m-d");
        $this->template->handlers = $this->getAllHandlers();
    }

    public function renderSitemap_dogs() {
        $this->template->langs = $this->getAllLangs();
        $this->template->date = date("Y-m-d");
        $this->template->dogs = $this->getAllDogs();
    }

    public function renderSitemap_puppies() {
        $this->template->langs = $this->getAllLangs();
        $this->template->date = date("Y-m-d");
        $this->template->puppies = $this->getAllPuppies();
    }

    public function getAllKennels() {
        $kennels = $this->database->table("tbl_userkennel")->order("id DESC")->limit(6000)->fetchAll();

        return $kennels;
    }

    public function getAllOwners() {
        $owners = $this->database->table("tbl_userowner")->order("id DESC")->limit(6000)->fetchAll();

        return $owners;
    }

    public function getAllHandlers() {
        $handlers = $this->database->table("tbl_userhandler")->order("id DESC")->limit(6000)->fetchAll();

        return $handlers;
    }

    public function getAllDogs() {
        $dogs = $this->database->table("tbl_dogs")->order("id DESC")->limit(6000)->fetchAll();

        return $dogs;
    }

    public function getAllPuppies() {
        $puppies = $this->database->table("tbl_puppies")->order("id DESC")->limit(6000)->fetchAll();

        return $puppies;
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
