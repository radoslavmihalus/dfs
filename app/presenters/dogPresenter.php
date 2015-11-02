<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class dogPresenter extends BasePresenter {
    /** @var Model\AlbumRepository */
    //private $albums;
//    public function __construct() {
//        
//    }

    /** @persistent int */
    public $dog_id;
    public $show_id;
    public $title_id;
    public $health_id;
    public $coowner_id;
    public $mating_id;
    public $workexam_id;
    public $filter_dog_name;
    public $filter_dog_breed;
    public $filter_dog_gender;
    public $filter_dog_country;

    protected function startup() {
        parent::startup();
    }

    /**
     * 
     * Render methods
     * 
     */
    public function beforeRender() {
        parent::beforeRender();
    }

    public function renderDog_pedigree_list($id = 0) {
        $this->renderDefault($id);
        $dog = $this->database->table("tbl_dogs")->where("id=?", $id)->fetch();
        $pedigree = $this->database->table("tbl_pedigree")->where("dog_name=?", $dog->dog_name)->fetch();
        $this->template->dog_name = $dog->dog_name;
        $this->template->pedigree = $pedigree;
    }

    public function renderDog_championschip_list($id = 0) {
        $this->renderDefault($id);
        $championships = $this->database->table("tbl_dogs_championship")->where("dog_id=?", $id)->order("date DESC")->fetchAll();
        $this->template->championships = $championships;
    }

    public function renderDog_coowner_list($id = 0) {
        $this->renderDefault($id);
        $coowners = $this->database->table("tbl_dogs_coowners")->where("dog_id=?", $id)->fetchAll();
        $this->template->coowners = $coowners;
    }

    public function renderDog_show_list($id = 0) {
        $this->renderDefault($id);
        $dog_shows = $this->database->table("tbl_dogs_shows")->where("dog_id=?", $this->dog_id)->order("show_date DESC")->fetchAll();
        $this->template->dog_shows = $dog_shows;
    }

    public function renderDog_health_list($id = 0) {
        $this->renderDefault($id);
        $healths = $this->database->table("tbl_dogs_health")->where("dog_id=?", $id)->order("date DESC")->fetchAll();
        $this->template->healths = $healths;
    }

    public function renderDog_workexam_list($id = 0) {
        $this->renderDefault($id);
        $workexams = $this->database->table("tbl_dogs_workexams")->where("dog_id=?", $id)->order("date DESC")->fetchAll();
        $this->template->workexams = $workexams;
    }

    public function renderDog_mating_list($id = 0) {
        $this->renderDefault($id);
        $matings = $this->database->table("tbl_dogs_matings")->where("dog_id=?", $id)->order("date DESC")->fetchAll();
        $this->template->matings = $matings;
    }

    public function renderDog_list($id = 0) {
        if ($id > 0) {
            $count = $this->database->table("tbl_dogs")->where("profile_id=?", $id)->count();

            $this->paginator->getPaginator()->setItemCount($count);
            $this->paginator->getPaginator()->setItemsPerPage(9);

            $rows = $this->database->table("tbl_dogs")->where("profile_id=?", $id)->order("id DESC")->limit($this->paginator->getPaginator()->getLength(), $this->paginator->getPaginator()->getOffset())->fetchAll();
        } else {
            try {
                $section = $this->getSession('dog_filter');

                $this->filter_dog_name = $section->filter_dog_name;
                $this->filter_dog_breed = $section->filter_dog_breed;
                $this->filter_dog_country = $section->filter_dog_country;
                $this->filter_dog_gender = $section->filter_dog_gender;

                if ($this->filter_dog_name == NULL)
                    $this->filter_dog_name = "";
                if ($this->filter_dog_breed == NULL)
                    $this->filter_dog_breed = "";
                if ($this->filter_dog_country == NULL)
                    $this->filter_dog_country = "";
                if ($this->filter_dog_gender == NULL || $this->filter_dog_gender == "NA")
                    $this->filter_dog_gender = "";
            } catch (\Exception $ex) {
                
            }

            $count = $this->database->table("tbl_dogs")
                    ->where("dog_name LIKE ?", "%" . $this->filter_dog_name . "%")
                    ->where("breed_name LIKE ?", "%" . $this->filter_dog_breed . "%")
                    ->where("dog_gender LIKE ?", "%" . $this->filter_dog_gender . "%")
                    ->where("country LIKE ?", "%" . $this->filter_dog_country . "%")
                    ->count();

            $this->paginator->getPaginator()->setItemCount($count);
            $this->paginator->getPaginator()->setItemsPerPage(9);

            $rows = $this->database->table("tbl_dogs")->order("id DESC")
                            ->where("dog_name LIKE ?", "%" . $this->filter_dog_name . "%")
                            ->where("breed_name LIKE ?", "%" . $this->filter_dog_breed . "%")
                            ->where("dog_gender LIKE ?", "%" . $this->filter_dog_gender . "%")
                            ->where("country LIKE ?", "%" . $this->filter_dog_country . "%")
                            ->limit($this->paginator->getPaginator()->getLength(), $this->paginator->getPaginator()->getOffset())->fetchAll();
        }

        $this->template->rows = $rows;
    }

    public function renderDog_bis_list() {

        $rows = $this->database->table("tbl_dogs_shows")->select("dog_id")->where("BIS1=? OR JBIS1=?", 1, 1)->fetchAll();

        $ids = array();

        foreach ($rows as $row) {
            $ids[] = $row->dog_id;
        }

        $count = $this->database->table("tbl_dogs")->where("id", $ids)->count();

        $this->paginator->getPaginator()->setItemCount($count);
        $this->paginator->getPaginator()->setItemsPerPage(9);

        $rows = $this->database->table("tbl_dogs")->where("id", $ids)->order("id DESC")->limit($this->paginator->getPaginator()->getLength(), $this->paginator->getPaginator()->getOffset())->fetchAll();
        //->where(":tbl_dogs:tbl_dogs_shows.JBIS1=1 OR :tbl_dogs:tbl_dogs_shows.BIS1=1")
//        $i = 0;
//
//        $ids = "";
//
//        foreach ($rows_bis as $row) {
//            if ($i == 0)
//                $ids .= $row->dog_id;
//            else
//                $ids .= "," . $row->dog_id;
//
//            $i++;
//        }
//
//        $rows = $this->database->query("SELECT * FROM tbl_dogs WHERE id IN ($ids) ORDER BY id DESC");

        $this->template->rows = $rows;
    }

    public function renderDog_for_mating_list($id = 0) {
        try {
            $section = $this->getSession('dog_mating_filter');

            $this->filter_dog_name = $section->filter_dog_name;
            $this->filter_dog_breed = $section->filter_dog_breed;
            $this->filter_dog_country = $section->filter_dog_country;
            $this->filter_dog_gender = $section->filter_dog_gender;

            if ($this->filter_dog_name == NULL)
                $this->filter_dog_name = "";
            if ($this->filter_dog_breed == NULL)
                $this->filter_dog_breed = "";
            if ($this->filter_dog_country == NULL)
                $this->filter_dog_country = "";
            if ($this->filter_dog_gender == NULL || $this->filter_dog_gender == "NA")
                $this->filter_dog_gender = "";
        } catch (\Exception $ex) {
            
        }

        $count = $this->database->table("tbl_dogs")
                ->where("offer_for_mating=1")
                ->where("dog_name LIKE ?", "%" . $this->filter_dog_name . "%")
                ->where("breed_name LIKE ?", "%" . $this->filter_dog_breed . "%")
                ->where("country LIKE ?", "%" . $this->filter_dog_country . "%")
                ->count();

        $this->paginator->getPaginator()->setItemCount($count);
        $this->paginator->getPaginator()->setItemsPerPage(9);


        $rows = $this->database->table("tbl_dogs")
                        ->where("offer_for_mating=1")
                        ->where("dog_name LIKE ?", "%" . $this->filter_dog_name . "%")
                        ->where("breed_name LIKE ?", "%" . $this->filter_dog_breed . "%")
                        ->where("country LIKE ?", "%" . $this->filter_dog_country . "%")
                        ->order("id DESC")->limit($this->paginator->getPaginator()->getLength(), $this->paginator->getPaginator()->getOffset())->fetchAll();

        $this->template->rows = $rows;
    }

    public function renderDog_photogallery($id = 0) {
        $rows = $this->database->table("tbl_photos")->where("profile_id=?", $id)->fetchAll();
        $this->template->photos = $rows;
        $this->renderDefault($id);
    }

    public function renderDefault($id = 0) {
        $dog = $this->database->table("tbl_dogs")->where("id=?", $id)->fetch();
        $this->template->dog = $dog;

        try {
            $this->page_title = "DOGFORSHOW - " . $dog->dog_name;
        } catch (\Exception $ex) {
            $this->page_title = "DOGFORSHOW";
        }

        $this->dog_id = $id;

        $this->template->current_profile_type = $this->data_model->getProfileType($dog->profile_id);

        $titles = \DataModel::getDogTitles($this->dog_id);

        $this->template->cajc = $titles['CAJC'];
        $this->template->jbob = $titles['JBOB'];
        $this->template->jbog = $titles['JBOG'];
        $this->template->jbis = $titles['JBIS'];
        $this->template->cac = $titles['CAC'];
        $this->template->cacib = $titles['CACIB'];
        $this->template->bos = $titles['BOS'];
        $this->template->bob = $titles['BOB'];
        $this->template->bog = $titles['BOG'];
        $this->template->bis = $titles['BIS'];
    }

    /**
     *  End of render methods
     */

    /**
     * Actions
     */
    public function actionDog_edit_profile($id) {
        $this->dog_id = $id;
    }

    public function actionDog_championschip_edit($id) {
        $this->title_id = $id;
    }

    public function actionDog_workexam_edit($id) {
        $this->workexam_id = $id;
    }

    public function actionDog_workexam_add($dog_id = 0) {
        if ($dog_id == 0)
            $dog_id = $this->dog_id;
        $this->dog_id = $dog_id;

        if (!\DataModel::getPremium($this->logged_in_id)) {
            $cnt = $this->database->table("tbl_dogs_workexams")->where("dog_id=?", $this->dog_id)->count();

            if ($cnt > 4) {
                $this->redirect("user:user_premium");
                $this->terminate();
            }
        }
    }

    public function actionDog_health_add($dog_id = 0) {
        if ($dog_id == 0)
            $dog_id = $this->dog_id;
        $this->dog_id = $dog_id;

        if (!\DataModel::getPremium($this->logged_in_id)) {
            $cnt = $this->database->table("tbl_dogs_health")->where("dog_id=?", $this->dog_id)->count();

            if ($cnt > 4) {
                $this->redirect("user:user_premium");
                $this->terminate();
            }
        }
    }

    public function actionDog_health_edit($id) {
        $this->health_id = $id;
    }

    public function actionDog_championschip_add($id = 0) {
        if ($id == 0)
            $id = $this->dog_id;
        $this->dog_id = $id;

        if (!\DataModel::getPremium($this->logged_in_id)) {
            $cnt = $this->database->table("tbl_dogs_championship")->where("dog_id=?", $this->dog_id)->count();

            if ($cnt > 4) {
                $this->redirect("user:user_premium");
                $this->terminate();
            }
        }
    }

    public function actionDog_coowner_add($id = 0) {
        if ($id == 0)
            $id = $this->dog_id;
        $this->dog_id = $id;
    }

    public function actionDog_coowner_edit($id = 0) {
        $this->coowner_id = $id;
    }

    public function actionDog_mating_edit($id = 0) {
        $this->mating_id = $id;
    }

    public function actionDog_mating_add($id = 0) {
        if ($id == 0)
            $id = $this->dog_id;
        $this->dog_id = $id;

        if (!\DataModel::getPremium($this->logged_in_id)) {
            $cnt = $this->database->table("tbl_dogs_matings")->where("dog_id=?", $this->dog_id)->count();

            if ($cnt > 4) {
                $this->redirect("user:user_premium");
                $this->terminate();
            }
        }
    }

    public function actionDog_pedigree_edit($id = 0) {
        if ($id == 0)
            $id = $this->dog_id;
        $this->dog_id = $id;
    }

    public function actionDog_show_add($id = 0) {
        if ($id == 0)
            $id = $this->dog_id;
        $this->dog_id = $id;

        if (!\DataModel::getPremium($this->logged_in_id)) {
            $cnt = $this->database->table("tbl_dogs_shows")->where("dog_id=?", $this->dog_id)->count();

            if ($cnt > 4) {
                $this->redirect("user:user_premium");
                $this->terminate();
            }
        }
    }

    public function actionDog_show_edit($id = 0) {
        $this->show_id = $id;
    }

    /**
     * End of actions
     */
    public function handleDeleteDog($id = 0) {
        $id = $_GET['id'];
        $row = $this->database->table("tbl_dogs")->where("id=?", $id)->fetch();
        if ($row->user_id == $this->logged_in_id) {
            //$this->database->table("tbl_dogs")->where("dog_id=?", $id)->delete();
            $this->database->table("tbl_dogs")->where("id=?", $id)->delete();
            $this->database->table("tbl_timeline")->where("event_id=?", $id)->delete();
        }
        $this->redirect(\DataModel::getDogsProfileLinkUrl($this->logged_in_profile_id), array("id" => $this->logged_in_profile_id));
    }

    public function handleDeleteChampionship($id = 0) {
        $id = $_GET['id'];
        $row = $this->database->table("tbl_dogs_championship")->where("id=?", $id)->fetch();
        $row = $this->database->table("tbl_dogs")->where("id=?", $row->dog_id)->fetch();
        if ($row->user_id == $this->logged_in_id) {
            $this->database->table("tbl_dogs_championship")->where("id=?", $id)->delete();
            $this->database->table("tbl_timeline")->where("event_id=?", $id)->delete();
        }
        $this->redirect("dog:dog_championschip_list", array("id" => $row->id));
    }

    public function handleDeleteCoowner($id = 0) {
        $id = $_GET['id'];
        $row = $this->database->table("tbl_dogs_coowners")->where("id=?", $id)->fetch();
        $row = $this->database->table("tbl_dogs")->where("id=?", $row->dog_id)->fetch();
        if ($row->user_id == $this->logged_in_id) {
            $this->database->table("tbl_dogs_coowners")->where("id=?", $id)->delete();
            $this->database->table("tbl_timeline")->where("event_id=?", $id)->delete();
        }
        $this->redirect("dog:dog_coowner_list", array("id" => $row->id));
    }

    public function handleDeleteHealth($id = 0) {
        $id = $_GET['id'];
        $row = $this->database->table("tbl_dogs_health")->where("id=?", $id)->fetch();
        $row = $this->database->table("tbl_dogs")->where("id=?", $row->dog_id)->fetch();
        if ($row->user_id == $this->logged_in_id) {
            $this->database->table("tbl_dogs_health")->where("id=?", $id)->delete();
            $this->database->table("tbl_timeline")->where("event_id=?", $id)->delete();
        }
        $this->redirect("dog:dog_health_list", array("id" => $row->id));
    }

    public function handleDeleteMating($id = 0) {
        $id = $_GET['id'];
        $row = $this->database->table("tbl_dogs_matings")->where("id=?", $id)->fetch();
        $row = $this->database->table("tbl_dogs")->where("id=?", $row->dog_id)->fetch();
        if ($row->user_id == $this->logged_in_id) {
            $this->database->table("tbl_dogs_matings")->where("id=?", $id)->delete();
            $this->database->table("tbl_timeline")->where("event_id=?", $id)->delete();
        }
        $this->redirect("dog:dog_mating_list", array("id" => $row->id));
    }

//    public function handleDeletePlannedLitter($id = 0) {
//        $id = $_GET['id'];
//        $row = $this->database->table("tbl_planned_litters")->where("id=?", $id)->fetch();
//        $row = $this->database->table("tbl_dogs")->where("id=?", $row->dog_id)->fetch();
//        if ($row->user_id == $this->logged_in_id) {
//            $this->database->table("tbl_dogs_matings")->where("id=?", $id)->delete();
//        }
//        $this->redirect("dog:dog_mating_list", array("id" => $row->id));
//    }

    public function handleDeleteShow($id = 0) {
        $id = $_GET['id'];
        $row = $this->database->table("tbl_dogs_shows")->where("id=?", $id)->fetch();
        $row = $this->database->table("tbl_dogs")->where("id=?", $row->dog_id)->fetch();
        if ($row->user_id == $this->logged_in_id) {
            $this->database->table("tbl_dogs_shows")->where("id=?", $id)->delete();
            $this->database->table("tbl_timeline")->where("event_id=?", $id)->delete();
        }
        $this->redirect("dog:dog_show_list", array("id" => $row->id));
    }

    public function handleDeleteWorkexam($id = 0) {
        $id = $_GET['id'];
        $row = $this->database->table("tbl_dogs_workexams")->where("id=?", $id)->fetch();
        $row = $this->database->table("tbl_dogs")->where("id=?", $row->dog_id)->fetch();
        if ($row->user_id == $this->logged_in_id) {
            $this->database->table("tbl_dogs_workexams")->where("id=?", $id)->delete();
            $this->database->table("tbl_timeline")->where("event_id=?", $id)->delete();
        }
        $this->redirect("dog:dog_workexam_list", array("id" => $row->id));
    }

    /**
     * 
     * FormComponents factory
     */
    protected function createComponentDog_list_filter() {
        $form = new Form();

        $lang = "en";

        try {
            $section = $this->getSession('language');
            if (strlen($section->lang) > 1)
                $lang = strtolower($section->lang);
        } catch (\Exception $ex) {
            $lang = "en";
        }

        $result = $this->database->table("lk_countries")->order("CountryName_$lang");
        $countries = array();

        //$countries[] = $this->translate("Please select state...");

        foreach ($result as $row) {
            $countries[$row->CountryName_en] = $this->translate($row->CountryName_en);
        }

        $sex = array(
            'NA' => 'NA',
            'Dog' => 'Dog',
            'Bitch' => 'Bitch'
        );

        $this->filter_dog_name = NULL;
        $this->filter_dog_breed = NULL;
        $this->filter_dog_country = NULL;
        $this->filter_dog_gender = 'NA';

        try {
            $section = $this->getSession('dog_filter');

            $this->filter_dog_name = $section->filter_dog_name;
            $this->filter_dog_breed = $section->filter_dog_breed;
            $this->filter_dog_country = $section->filter_dog_country;
            $this->filter_dog_gender = $section->filter_dog_gender;
        } catch (\Exception $ex) {
            
        }

        $form->addText("txtDogName")->setValue($this->filter_dog_name);
        $form->addRadioList("radGender", NULL, $sex)->setValue($this->filter_dog_gender);
        $form->addSelect("ddlCountry")->setPrompt($this->translate("Please select"))->setItems($countries)->setValue($this->filter_dog_country);
        $form->addText("ddlBreedList")->setValue($this->filter_dog_breed);
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmSubmitDogFilter');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'frmCancelDogFilter');

        return $form;
    }

    public function frmSubmitDogFilter($button) {
        $values = $button->getForm()->getValues();

        $section = $this->getSession('dog_filter');

        $this->filter_dog_name = $values->txtDogName;
        $this->filter_dog_breed = $values->ddlBreedList;
        $this->filter_dog_country = $values->ddlCountry;
        $this->filter_dog_gender = $values->radGender;

        $section->filter_dog_name = $this->filter_dog_name;
        $section->filter_dog_breed = $this->filter_dog_breed;
        $section->filter_dog_country = $this->filter_dog_country;
        $section->filter_dog_gender = $this->filter_dog_gender;

        $this->redirect("this");
    }

    public function frmCancelDogFilter($button) {
        $values = $button->getForm()->getValues();

        $section = $this->getSession('dog_filter');

        $section->filter_dog_name = NULL;
        $section->filter_dog_breed = NULL;
        $section->filter_dog_country = NULL;
        $section->filter_dog_gender = NULL;

        $this->redirect("this");
    }

    protected function createComponentDog_mating_list_filter() {
        $form = new Form();

        $lang = "en";

        try {
            $section = $this->getSession('language');
            if (strlen($section->lang) > 1)
                $lang = strtolower($section->lang);
        } catch (\Exception $ex) {
            $lang = "en";
        }

        $result = $this->database->table("lk_countries")->order("CountryName_$lang");
        $countries = array();

        //$countries[] = $this->translate("Please select state...");

        foreach ($result as $row) {
            $countries[$row->CountryName_en] = $this->translate($row->CountryName_en);
        }

        $this->filter_dog_name = NULL;
        $this->filter_dog_breed = NULL;
        $this->filter_dog_country = NULL;
        $this->filter_dog_gender = 'NA';

        try {
            $section = $this->getSession('dog_mating_filter');

            $this->filter_dog_name = $section->filter_dog_name;
            $this->filter_dog_breed = $section->filter_dog_breed;
            $this->filter_dog_country = $section->filter_dog_country;
            $this->filter_dog_gender = $section->filter_dog_gender;
        } catch (\Exception $ex) {
            
        }

        $form->addText("txtDogName")->setValue($this->filter_dog_name);
        $form->addSelect("ddlCountry")->setPrompt($this->translate("Please select"))->setItems($countries)->setValue($this->filter_dog_country);
        $form->addText("ddlBreedList")->setValue($this->filter_dog_breed);
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmSubmitMatingDogFilter');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'frmCancelMatingDogFilter');

        return $form;
    }

    public function frmSubmitMatingDogFilter($button) {
        $values = $button->getForm()->getValues();

        $section = $this->getSession('dog_mating_filter');

        $this->filter_dog_name = $values->txtDogName;
        $this->filter_dog_breed = $values->ddlBreedList;
        $this->filter_dog_country = $values->ddlCountry;

        $section->filter_dog_name = $this->filter_dog_name;
        $section->filter_dog_breed = $this->filter_dog_breed;
        $section->filter_dog_country = $this->filter_dog_country;

        $this->redirect("this");
    }

    public function frmCancelMatingDogFilter($button) {
        $values = $button->getForm()->getValues();

        $section = $this->getSession('dog_mating_filter');

        $section->filter_dog_name = NULL;
        $section->filter_dog_breed = NULL;
        $section->filter_dog_country = NULL;
        $section->filter_dog_gender = NULL;

        $this->redirect("this");
    }

    protected function createComponentFormCreateDogProfile() {
        $form = new Form();

        $lang = "en";

        try {
            $section = $this->getSession('language');
            if (strlen($section->lang) > 1)
                $lang = strtolower($section->lang);
        } catch (\Exception $ex) {
            $lang = "en";
        }

        $result = $this->database->table("lk_countries")->order("CountryName_$lang");
        $countries = array();

        //$countries[] = $this->translate("Please select state...");

        foreach ($result as $row) {
            $countries[$row->CountryName_en] = $this->translate($row->CountryName_en);
        }

        $sex = array(
            'Dog' => 'Dog',
            'Bitch' => 'Bitch'
        );

        $form->addRadioList("radGender", NULL, $sex)->setRequired($this->translate("Required field"));
        $form->addCheckbox("chckMating");
        $form->addText("ddlBreedList")->setRequired($this->translate("Required field"));
        $form->addText("txtDogName")->setRequired($this->translate("Required field"));
        $form->addText("txtDogProfilePhoto")->setRequired($this->translate("Required field"));
        $form->addText("txtPedigreeRegistrationNumber")->setRequired($this->translate("Required field"));
        $form->addText("ddlDate")->setRequired($this->translate("Required field"));
        $form->addText("txtDogHeight");
        $form->addText("txtDogWeight");
        $form->addSelect("ddlCountry")->setPrompt($this->translate("Please select"))->setItems($countries)->setRequired($this->translate("Required field"));
        $form->addText("ddlDogFather")->setRequired($this->translate("Required field"));
        $form->addText("ddlDogMother")->setRequired($this->translate("Required field"));
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmCreateDogProfileSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');

        return $form;
    }

    protected function createComponentFormEditDogProfile() {
        $id = $this->dog_id;
        $form = new Form();

        $profile = $this->database->table("tbl_dogs")->where("id=?", $id)->fetch();

        $lang = "en";

        try {
            $section = $this->getSession('language');
            if (strlen($section->lang) > 1)
                $lang = strtolower($section->lang);
        } catch (\Exception $ex) {
            $lang = "en";
        }

        $result = $this->database->table("lk_countries")->order("CountryName_$lang");
        $countries = array();

        foreach ($result as $row) {
            $countries[$row->CountryName_en] = $this->translate($row->CountryName_en);
        }

        $time = strtotime($profile->date_of_birth);
        $date = date('d.m.Y', $time);

        $sex = array(
            'Dog' => 'Dog',
            'Bitch' => 'Bitch'
        );

        $form->addRadioList("radGender", NULL, $sex)->setValue($profile->dog_gender)->setRequired($this->translate("Required field"));

        //$form->addHidden("hidradGender")->setValue($profile->dog_gender);
        $form->addCheckbox("chckMating")->setValue($profile->offer_for_mating);
        $form->addText("ddlBreedList")->setValue($profile->breed_name)->setRequired();
        $form->addText("txtDogName")->setValue($profile->dog_name)->setRequired();
        $form->addText("txtDogProfilePhoto")->setValue($profile->dog_image)->setRequired();
        $form->addText("txtPedigreeRegistrationNumber")->setValue($profile->dog_registration_number)->setRequired();
        $form->addText("ddlDate")->setValue($date)->setRequired();
        $form->addText("txtDogHeight")->setValue($profile->height);
        $form->addText("txtDogWeight")->setValue($profile->weight);
        $form->addSelect("ddlCountry")->setItems($countries)->setPrompt($this->translate("Please select"))->setValue($profile->country)->setRequired();
        $form->addText("ddlDogFather")->setValue($profile->dog_father);
        $form->addText("ddlDogMother")->setValue($profile->dog_mother);
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditDogProfileSucceeded');

        return $form;
    }

    protected function createComponentFormEditDogProfilePicture() {
        $id = $this->dog_id;
        $form = new Form();
        $form->addHidden("txtDogProfilePhoto")->setRequired();
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditDogProfilePictureSucceeded');
        return $form;
    }

    protected function createComponentFormAddTitle() {
        $id = $this->dog_id;
        $form = new Form();
        $form->addHidden("dog_id")->setValue($id);
        $form->addText("ddlDate");
        $form->addText("txtChampionshipName");
        $form->addHidden("txtChampionshipPicture");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmDogAddTitleSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormAddPedigree() {
        $dog = $this->database->table("tbl_dogs")->where("id=?", $this->dog_id)->fetch();

        $txtF = \DataModel::getFatherName($dog->dog_name);
        $txt1 = \DataModel::getFatherName($txtF);
        $txt2 = \DataModel::getFatherName($txt1);
        $txt3 = \DataModel::getMotherName($txt1);
        $txt4 = \DataModel::getMotherName($txtF);
        $txt5 = \DataModel::getFatherName($txt4);
        $txt6 = \DataModel::getMotherName($txt4);


        $txtM = \DataModel::getMotherName($dog->dog_name);
        $txt7 = \DataModel::getFatherName($txtM);
        $txt8 = \DataModel::getFatherName($txt7);
        $txt9 = \DataModel::getMotherName($txt7);
        $txt10 = \DataModel::getMotherName($txtM);
        $txt11 = \DataModel::getFatherName($txt10);
        $txt12 = \DataModel::getMotherName($txt10);


        $form = new Form();
        $form->addText("txtPedigreeFather")->setValue($txtF)->setRequired();
        $form->addText("txtPedigreeMother")->setValue($txtM)->setRequired();
        $form->addText("txtPedigree1")->setValue($txt1)->setRequired();
        $form->addText("txtPedigree2")->setValue($txt2)->setRequired();
        $form->addText("txtPedigree3")->setValue($txt3)->setRequired();
        $form->addText("txtPedigree4")->setValue($txt4)->setRequired();
        $form->addText("txtPedigree5")->setValue($txt5)->setRequired();
        $form->addText("txtPedigree6")->setValue($txt6)->setRequired();
        $form->addText("txtPedigree7")->setValue($txt7)->setRequired();
        $form->addText("txtPedigree8")->setValue($txt8)->setRequired();
        $form->addText("txtPedigree9")->setValue($txt9)->setRequired();
        $form->addText("txtPedigree10")->setValue($txt10)->setRequired();
        $form->addText("txtPedigree11")->setValue($txt11)->setRequired();
        $form->addText("txtPedigree12")->setValue($txt12)->setRequired();
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmAddPedigreeSucceeded');
        return $form;
    }

    protected function createComponentFormEditTitle() {
        $row = $this->database->table("tbl_dogs_championship")->where("id=?", $this->title_id)->fetch();
        $form = new Form();

        $time = strtotime($row->date);
        $date = date('d.m.Y', $time);

        $form->addHidden("dog_id")->setValue($row->dog_id);
        $form->addText("ddlDate")->setValue($date);
        $form->addText("txtChampionshipName")->setValue($row->description);
        $form->addHidden("txtChampionshipPicture")->setValue($row->image);
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmDogEditTitleSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormAddHealth() {
        $id = $this->dog_id;
        $form = new Form();
        $form->addHidden("dog_id")->setValue($id);
        $form->addText("ddlDate")->setRequired();
        $form->addText("txtHealthName")->setRequired();
        $form->addHidden("txtHealthPicture");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmDogAddHealthSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormEditHealth() {
        $row = $this->database->table("tbl_dogs_health")->where("id=?", $this->health_id)->fetch();
        $form = new Form();

        $time = strtotime($row->date);
        $date = date('d.m.Y', $time);

        $form->addHidden("dog_id")->setValue($row->dog_id);
        $form->addText("ddlDate")->setValue($date)->setRequired();
        $form->addText("txtHealthName")->setValue($row->description)->setRequired();
        $form->addHidden("txtHealthPicture")->setValue($row->image);
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmDogEditHealthSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormEditMating() {
        $row = $this->database->table("tbl_dogs_matings")->where("id=?", $this->mating_id)->fetch();
        $form = new Form();

        $time = strtotime($row->date);
        $date = date('d.m.Y', $time);

        $form->addHidden("dog_id")->setValue($row->dog_id);
        $form->addText("ddlDate")->setValue($date)->setRequired();
        $form->addText("txtMatingBitchName")->setValue($row->description)->setRequired();
        $form->addHidden("txtMatingBitchPicture")->setValue($row->image);
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmDogEditMatingSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormAddMating() {
        $form = new Form();

        $form->addHidden("dog_id")->setValue($this->dog_id);
        $form->addText("ddlDate")->setValue($date)->setRequired();
        $form->addText("txtMatingBitchName")->setRequired();
        $form->addHidden("txtMatingBitchPicture");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmDogAddMatingSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormEditWorkExam() {
        $row = $this->database->table("tbl_dogs_workexams")->where("id=?", $this->workexam_id)->fetch();
        $form = new Form();

        $time = strtotime($row->date);
        $date = date('d.m.Y', $time);

        $form->addHidden("dog_id")->setValue($row->dog_id);
        $form->addText("ddlDate")->setValue($date)->setRequired();
        $form->addText("txtWorkExamName")->setValue($row->description)->setRequired();
        $form->addHidden("txtWorkExamPicture")->setValue($row->image);
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmDogEditWorkexamSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormAddWorkExam() {
        $form = new Form();

        $form->addHidden("dog_id")->setValue($this->dog_id);
        $form->addText("ddlDate")->setRequired();
        $form->addText("txtWorkExamName")->setRequired();
        $form->addHidden("txtWorkExamPicture");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmDogAddWorkexamSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormAddCoowner() {
        $id = $this->dog_id;
        $lang = "en";

        try {
            $section = $this->getSession('language');
            if (strlen($section->lang) > 1)
                $lang = strtolower($section->lang);
        } catch (\Exception $ex) {
            $lang = "en";
        }

        $result = $this->database->table("lk_countries")->order("CountryName_$lang");
        $countries = array();

        $countries[] = $this->translate("Please select state...");

        foreach ($result as $row) {
            $countries[$row->CountryName_en] = $this->translate($row->CountryName_en);
        }

        $form = new Form();
        $form->addHidden("dog_id")->setValue($id);
        $form->addText("txtCoownerName")->setRequired();
        $form->addSelect("ddlCountry")->setItems($countries)->setRequired();
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmDogAddCoownerSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormEditCoowner() {
        $id = $this->dog_id;

        $lang = "en";

        try {
            $section = $this->getSession('language');
            if (strlen($section->lang) > 1)
                $lang = strtolower($section->lang);
        } catch (\Exception $ex) {
            $lang = "en";
        }

        $result = $this->database->table("lk_countries")->order("CountryName_$lang");
        $countries = array();

        $countries[] = $this->translate("Please select state...");

        foreach ($result as $row) {
            $countries[$row->CountryName_en] = $this->translate($row->CountryName_en);
        }

        $result = $this->database->table("tbl_dogs_coowners")->where("id=?", $this->coowner_id)->fetch();

        $form = new Form();
        $form->addHidden("dog_id")->setValue($id);
        $form->addText("txtCoownerName")->setValue($result->coowner_name);
        $form->addSelect("ddlCountry")->setItems($countries)->setValue($result->coowner_state);
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmDogEditCoownerSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormAddShow() {
        $form = new Form();

        $class = array();

        $class["MinorPuppy"] = $this->translate("Minor Puppy");
        $class["Puppy"] = $this->translate("Puppy");
        $class["Junior"] = $this->translate("Junior");
        $class["Intermediate"] = $this->translate("Intermediate");
        $class["Open"] = $this->translate("Open");
        $class["Working"] = $this->translate("Working");
        $class["Champions"] = $this->translate("Champions");
        $class["Veteran"] = $this->translate("Veteran");
        $class["Honor"] = $this->translate("Honor");


        $assesment_minor_puppy = array();
        $assesment_minor_puppy["VP1"] = "VP1";
        $assesment_minor_puppy["VP2"] = "VP2";
        $assesment_minor_puppy["VP3"] = "VP3";
        $assesment_minor_puppy["VP"] = "VP";

        $titles_minor_puppy = array();
        $titles_minor_puppy["BestMinorPuppy1"] = "BestMinorPuppy1";
        $titles_minor_puppy["BestMinorPuppy2"] = "BestMinorPuppy2";
        $titles_minor_puppy["BestMinorPuppy3"] = "BestMinorPuppy3";

        $titles_puppy = array();
        $titles_puppy["BestPuppy1"] = "BestPuppy1";
        $titles_puppy["BestPuppy2"] = "BestPuppy2";
        $titles_puppy["BestPuppy3"] = "BestPuppy3";

        $assesment = array();
        $assesment["EXC1"] = "EXC1";
        $assesment["EXC2"] = "EXC2";
        $assesment["EXC3"] = "EXC3";
        $assesment["EXC4"] = "EXC4";
        $assesment["VG1"] = "VG1";
        $assesment["VG2"] = "VG2";
        $assesment["VG3"] = "VG3";
        $assesment["VG4"] = "VG4";

        $titles_junior = array();
        $titles_junior["CAJC"] = "CAJC";
        $titles_junior["JBOB"] = "JBOB";
        $titles_junior["BOB"] = "BOB";
        $titles_junior["BOS"] = "BOS";

        $titles_junior_bog = array();
        $titles_junior_bog["JBOG1"] = "JBOG1";
        $titles_junior_bog["JBOG2"] = "JBOG2";
        $titles_junior_bog["JBOG3"] = "JBOG3";

        $titles_junior_bis = array();
        $titles_junior_bis["JBIS1"] = "JBIS1";
        $titles_junior_bis["JBIS2"] = "JBIS2";
        $titles_junior_bis["JBIS3"] = "JBIS3";

        $titles_bog = array();
        $titles_bog["BOG1"] = "BOG1";
        $titles_bog["BOG2"] = "BOG2";
        $titles_bog["BOG3"] = "BOG3";

        $titles_bis = array();
        $titles_bis["BIS1"] = "BIS1";
        $titles_bis["BIS2"] = "BIS2";
        $titles_bis["BIS3"] = "BIS3";

        $titles = array();
        $titles["CAC"] = "CAC";
        $titles["RESCAC"] = "RESCAC";
        $titles["CACIB"] = "CACIB";
        $titles["RESCACIB"] = "RESCACIB";
        $titles["BOS"] = "BOS";
        $titles["BOB"] = "BOB";

        $lang = "en";

        try {
            $section = $this->getSession('language');
            if (strlen($section->lang) > 1)
                $lang = strtolower($section->lang);
        } catch (\Exception $ex) {
            $lang = "en";
        }

        $result = $this->database->table("lk_countries")->order("CountryName_$lang");
        $countries = array();
        foreach ($result as $row) {
            $countries[$row->CountryName_en] = $this->translate($row->CountryName_en);
        }

        $show_types = array();
        $show_types["Regional"] = $this->translate("Regional");
        $show_types["Club"] = $this->translate("Club");
        $show_types["SpecialCAC"] = $this->translate("Special CAC");
        $show_types["NationalCAC"] = $this->translate("National CAC");
        $show_types["NationalCACNW"] = $this->translate("National CAC, NW");
        $show_types["InternationalCACIB"] = $this->translate("International CACIB");
        $show_types["EuropeanShow"] = $this->translate("European show");
        $show_types["WorldShow"] = $this->translate("World show");

        $form->addText("ddlDate")->setRequired();
        $form->addSelect("ddlShowType")->setItems($show_types)->setPrompt($this->translate("Please select"))->setRequired();
        $form->addText("txtShowName")->setRequired();
        $form->addSelect("ddlCountry")->setItems($countries)->setPrompt($this->translate("Please select"))->setRequired();
        $form->addText("txtHandlerName");
        $form->addText("txtJudgeName");
        $form->addSelect("ddlShowClass")->setPrompt($this->translate("Please select"))->setItems($class)->setRequired();
        $form->addCheckboxList("chckAssesmentMinorPuppy")->setItems($assesment_minor_puppy);
        $form->addCheckboxList("chckTitlesMinorPuppy")->setItems($titles_minor_puppy);
        $form->addCheckboxList("chckTitlesPuppy")->setItems($titles_puppy);
        $form->addCheckboxList("chckAssesment")->setItems($assesment);
        $form->addCheckboxList("chckTitlesJunior")->setItems($titles_junior);
        $form->addCheckboxList("chckTitlesJuniorBOG")->setItems($titles_junior_bog);
        $form->addCheckboxList("chckTitlesJuniorBIS")->setItems($titles_junior_bis);
        $form->addCheckboxList("chckTitlesBOG")->setItems($titles_bog);
        $form->addCheckboxList("chckTitlesBIS")->setItems($titles_bis);
        $form->addCheckboxList("chckTitles")->setItems($titles);
        $form->addText("txtOtherTitle");
        $form->addText("txtShowImage");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmAddShowSucceeded');

        return $form;
    }

    public function createComponentFormEditShow() {
        $form = new Form();

        $show = $this->database->table("tbl_dogs_shows")->where("id=?", $this->show_id)->fetch();

        $class = array();

        $class["MinorPuppy"] = $this->translate("Minor Puppy");
        $class["Puppy"] = $this->translate("Puppy");
        $class["Junior"] = $this->translate("Junior");
        $class["Intermediate"] = $this->translate("Intermediate");
        $class["Open"] = $this->translate("Open");
        $class["Working"] = $this->translate("Working");
        $class["Champions"] = $this->translate("Champions");
        $class["Veteran"] = $this->translate("Veteran");
        $class["Honor"] = $this->translate("Honor");


        $assesment_minor_puppy = array();
        $assesment_minor_puppy["VP1"] = "VP1";
        $assesment_minor_puppy["VP2"] = "VP2";
        $assesment_minor_puppy["VP3"] = "VP3";
        $assesment_minor_puppy["VP"] = "VP";

        $sel_assesment_minor_puppy = array();
        if ($show->VP1 == 1)
            $sel_assesment_minor_puppy["VP1"] = "VP1";
        if ($show->VP2 == 1)
            $sel_assesment_minor_puppy["VP2"] = "VP2";
        if ($show->VP3 == 1)
            $sel_assesment_minor_puppy["VP3"] = "VP3";
        if ($show->VP == 1)
            $sel_assesment_minor_puppy["VP"] = "VP";

        $titles_minor_puppy = array();
        $titles_minor_puppy["BestMinorPuppy1"] = "BestMinorPuppy1";
        $titles_minor_puppy["BestMinorPuppy2"] = "BestMinorPuppy2";
        $titles_minor_puppy["BestMinorPuppy3"] = "BestMinorPuppy3";

        $sel_titles_minor_puppy = array();
        if ($show->BestMinorPuppy1 == 1)
            $sel_titles_minor_puppy["BestMinorPuppy1"] = "BestMinorPuppy1";
        if ($show->BestMinorPuppy2 == 1)
            $sel_titles_minor_puppy["BestMinorPuppy2"] = "BestMinorPuppy2";
        if ($show->BestMinorPuppy3 == 1)
            $sel_titles_minor_puppy["BestMinorPuppy3"] = "BestMinorPuppy3";

        $titles_puppy = array();
        $titles_puppy["BestPuppy1"] = "BestPuppy1";
        $titles_puppy["BestPuppy2"] = "BestPuppy2";
        $titles_puppy["BestPuppy3"] = "BestPuppy3";

        $sel_titles_puppy = array();
        if ($show->BestPuppy1 == 1)
            $sel_titles_puppy["BestPuppy1"] = "BestPuppy1";
        if ($show->BestPuppy2 == 1)
            $sel_titles_puppy["BestPuppy2"] = "BestPuppy2";
        if ($show->BestPuppy3 == 1)
            $sel_titles_puppy["BestPuppy3"] = "BestPuppy3";

        $assesment = array();
        $assesment["EXC1"] = "EXC1";
        $assesment["EXC2"] = "EXC2";
        $assesment["EXC3"] = "EXC3";
        $assesment["EXC4"] = "EXC4";
        $assesment["VG1"] = "VG1";
        $assesment["VG2"] = "VG2";
        $assesment["VG3"] = "VG3";
        $assesment["VG4"] = "VG4";

        $sel_assesment = array();
        if ($show->EXC1 == 1)
            $sel_assesment["EXC1"] = "EXC1";
        if ($show->EXC2 == 1)
            $sel_assesment["EXC2"] = "EXC2";
        if ($show->EXC3 == 1)
            $sel_assesment["EXC3"] = "EXC3";
        if ($show->EXC4 == 1)
            $sel_assesment["EXC4"] = "EXC4";
        if ($show->VG1 == 1)
            $sel_assesment["VG1"] = "VG1";
        if ($show->VG2 == 1)
            $sel_assesment["VG2"] = "VG2";
        if ($show->VG3 == 1)
            $sel_assesment["VG3"] = "VG3";
        if ($show->VG4 == 1)
            $sel_assesment["VG4"] = "VG4";

        $titles_junior = array();
        $titles_junior["CAJC"] = "CAJC";
        $titles_junior["JBOB"] = "JBOB";
        $titles_junior["BOB"] = "BOB";
        $titles_junior["BOS"] = "BOS";

        $sel_titles_junior = array();
        if ($show->CAJC == 1)
            $sel_titles_junior["CAJC"] = "CAJC";
        if ($show->JBOB == 1)
            $sel_titles_junior["JBOB"] = "JBOB";
        if ($show->BOB == 1)
            $sel_titles_junior["BOB"] = "BOB";
        if ($show->BOS == 1)
            $sel_titles_junior["BOS"] = "BOS";

        $titles_junior_bog = array();
        $titles_junior_bog["JBOG1"] = "JBOG1";
        $titles_junior_bog["JBOG2"] = "JBOG2";
        $titles_junior_bog["JBOG3"] = "JBOG3";

        $sel_titles_junior_bog = array();
        if ($show->JBOG1 == 1)
            $sel_titles_junior_bog["JBOG1"] = "JBOG1";
        if ($show->JBOG2 == 1)
            $sel_titles_junior_bog["JBOG2"] = "JBOG2";
        if ($show->JBOG3 == 1)
            $sel_titles_junior_bog["JBOG3"] = "JBOG3";


        $titles_junior_bis = array();
        $titles_junior_bis["JBIS1"] = "JBIS1";
        $titles_junior_bis["JBIS2"] = "JBIS2";
        $titles_junior_bis["JBIS3"] = "JBIS3";

        $sel_titles_junior_bis = array();
        if ($show->JBIS1 == 1)
            $sel_titles_junior_bis["JBIS1"] = "JBIS1";
        if ($show->JBIS2 == 1)
            $sel_titles_junior_bis["JBIS2"] = "JBIS2";
        if ($show->JBIS3 == 1)
            $sel_titles_junior_bis["JBIS3"] = "JBIS3";

        $titles_bog = array();
        $titles_bog["BOG1"] = "BOG1";
        $titles_bog["BOG2"] = "BOG2";
        $titles_bog["BOG3"] = "BOG3";

        $sel_titles_bog = array();
        if ($show->BOG1 == 1)
            $sel_titles_bog["BOG1"] = "BOG1";
        if ($show->BOG2 == 1)
            $sel_titles_bog["BOG2"] = "BOG2";
        if ($show->BOG3 == 1)
            $sel_titles_bog["BOG3"] = "BOG3";

        $titles_bis = array();
        $titles_bis["BIS1"] = "BIS1";
        $titles_bis["BIS2"] = "BIS2";
        $titles_bis["BIS3"] = "BIS3";

        $sel_titles_bis = array();
        if ($show->BIS1 == 1)
            $sel_titles_bis["BIS1"] = "BIS1";
        if ($show->BIS2 == 1)
            $sel_titles_bis["BIS2"] = "BIS2";
        if ($show->BIS3 == 1)
            $sel_titles_bis["BIS3"] = "BIS3";

        $titles = array();
        $titles["CAC"] = "CAC";
        $titles["RESCAC"] = "RESCAC";
        $titles["CACIB"] = "CACIB";
        $titles["RESCACIB"] = "RESCACIB";
        $titles["BOS"] = "BOS";
        $titles["BOB"] = "BOB";

        $sel_titles = array();
        if ($show->CAC == 1)
            $sel_titles["CAC"] = "CAC";
        if ($show->RESCAC == 1)
            $sel_titles["RESCAC"] = "RESCAC";
        if ($show->CACIB == 1)
            $sel_titles["CACIB"] = "CACIB";
        if ($show->RESCACIB == 1)
            $sel_titles["RESCACIB"] = "RESCACIB";
        if ($show->BOS == 1)
            $sel_titles["BOS"] = "BOS";
        if ($show->BOB == 1)
            $sel_titles["BOB"] = "BOB";

        $lang = "en";

        try {
            $section = $this->getSession('language');
            if (strlen($section->lang) > 1)
                $lang = strtolower($section->lang);
        } catch (\Exception $ex) {
            $lang = "en";
        }

        $result = $this->database->table("lk_countries")->order("CountryName_$lang");
        $countries = array();
        foreach ($result as $row) {
            $countries[$row->CountryName_en] = $this->translate($row->CountryName_en);
        }

        $show_types = array();
        $show_types["Regional"] = $this->translate("Regional");
        $show_types["Club"] = $this->translate("Club");
        $show_types["SpecialCAC"] = $this->translate("Special CAC");
        $show_types["NationalCAC"] = $this->translate("National CAC");
        $show_types["NationalCACNW"] = $this->translate("National CAC, NW");
        $show_types["InternationalCACIB"] = $this->translate("International CACIB");
        $show_types["EuropeanShow"] = $this->translate("European show");
        $show_types["WorldShow"] = $this->translate("World show");

        $time = strtotime($show->show_date);
        $date = date('d.m.Y', $time);

        $form->addText("ddlDate")->setValue($date)->setRequired();
        $form->addSelect("ddlShowType")->setItems($show_types)->setValue($show->show_type)->setPrompt($this->translate("Please select"))->setRequired();
        $form->addText("txtShowName")->setValue($show->show_name)->setRequired();
        $form->addSelect("ddlCountry")->setItems($countries)->setValue($show->show_country)->setPrompt($this->translate("Please select"))->setRequired();
        $form->addText("txtHandlerName")->setValue($show->handler_name);
        $form->addText("txtJudgeName")->setValue($show->judge_name);
        $form->addSelect("ddlShowClass")->setPrompt($this->translate("Please select"))->setItems($class)->setValue($show->show_class)->setRequired();
        $form->addCheckboxList("chckAssesmentMinorPuppy")->setItems($assesment_minor_puppy)->setValue($sel_assesment_minor_puppy);
        $form->addCheckboxList("chckTitlesMinorPuppy")->setItems($titles_minor_puppy)->setValue($sel_titles_minor_puppy);
        $form->addCheckboxList("chckTitlesPuppy")->setItems($titles_puppy)->setValue($sel_titles_puppy);
        $form->addCheckboxList("chckAssesment")->setItems($assesment)->setValue($sel_assesment);
        $form->addCheckboxList("chckTitlesJunior")->setItems($titles_junior)->setValue($sel_titles_junior);
        $form->addCheckboxList("chckTitlesJuniorBOG")->setItems($titles_junior_bog)->setValue($sel_titles_junior_bog);
        $form->addCheckboxList("chckTitlesJuniorBIS")->setItems($titles_junior_bis)->setValue($sel_titles_junior_bis);
        $form->addCheckboxList("chckTitlesBOG")->setItems($titles_bog)->setValue($sel_titles_bog);
        $form->addCheckboxList("chckTitlesBIS")->setItems($titles_bis)->setValue($sel_titles_bis);
        $form->addCheckboxList("chckTitles")->setItems($titles)->setValue($sel_titles);
        $form->addText("txtOtherTitle")->setValue($show->other_title);
        $form->addText("txtShowImage")->setValue($show->show_image);
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditShowSucceeded');

        return $form;
    }

    /**
     * 
     * End of FormComponents factory
     * 
     */

    /**
     * 
     * Forms actions
     * 
     */
    public function frmEditDogProfilePictureSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();
            $values["txtDogProfilePhoto"] = $this->data_model->processImage($values['txtDogProfilePhoto']);
            $values = $this->data_model->assignFields($values, "frmEditDogProfilePicture");
            $this->database->table("tbl_dogs_championship")->where("id=?", $this->dog_id)->update($values);
        } catch (\ErrorException $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
    }

    public function frmDogEditTitleSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values["txtChampionshipPicture"] = $this->data_model->processImage($values['txtChampionshipPicture']);

            $values = $this->data_model->assignFields($values, "frmDogAddTitle");

            unset($values["dog_id"]);

            $this->database->table("tbl_dogs_championship")->where("id=?", $this->title_id)->update($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }

        $this->redirect("dog_championschip_list", $this->dog_id);
    }

    public function frmAddPedigreeSucceeded($button) {
        try {
            $dog = $this->database->table("tbl_dogs")->where("id=?", $this->dog_id)->fetch();
            $values = $button->getForm()->getValues();

            $this->data_model->setParents($dog->dog_name, $values['txtPedigreeFather'], $values['txtPedigreeMother']);
            $this->data_model->setParents($values['txtPedigreeFather'], $values['txtPedigree1'], $values['txtPedigree4']);
            $this->data_model->setParents($values['txtPedigreeMother'], $values['txtPedigree7'], $values['txtPedigree10']);
            $this->data_model->setParents($values['txtPedigree1'], $values['txtPedigree2'], $values['txtPedigree3']);
            $this->data_model->setParents($values['txtPedigree7'], $values['txtPedigree8'], $values['txtPedigree9']);
            $this->data_model->setParents($values['txtPedigree4'], $values['txtPedigree5'], $values['txtPedigree6']);
            $this->data_model->setParents($values['txtPedigree10'], $values['txtPedigree11'], $values['txtPedigree12']);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
        $this->redirect("dog:dog_pedigree_list", array("id" => $this->dog_id));
    }

    public function frmDogEditHealthSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values["txtHealthPicture"] = $this->data_model->processImage($values['txtHealthPicture']);

            $values = $this->data_model->assignFields($values, "frmDogAddHealth");

            unset($values["dog_id"]);

            $this->database->table("tbl_dogs_health")->where("id=?", $this->health_id)->update($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }

        $this->redirect("dog_health_list", $this->dog_id);
    }

    public function frmDogAddHealthSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values["txtHealthPicture"] = $this->data_model->processImage($values['txtHealthPicture']);

            $values = $this->data_model->assignFields($values, "frmDogAddHealth");

            //unset($values["dog_id"]);

            $this->database->table("tbl_dogs_health")->insert($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }

        $this->redirect("dog_health_list", $this->dog_id);
    }

    public function frmDogEditWorkexamSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values["txtWorkExamPicture"] = $this->data_model->processImage($values['txtWorkExamPicture']);

            $values = $this->data_model->assignFields($values, "frmDogAddWorkexam");

            unset($values["dog_id"]);

            $this->database->table("tbl_dogs_workexams")->where("id=?", $this->workexam_id)->update($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }

        $this->redirect("dog_workexam_list", $this->dog_id);
    }

    public function frmDogAddWorkexamSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values["txtWorkExamPicture"] = $this->data_model->processImage($values['txtWorkExamPicture']);

            $values = $this->data_model->assignFields($values, "frmDogAddWorkexam");

            //unset($values["dog_id"]);

            $this->database->table("tbl_dogs_workexams")->insert($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }

        $this->redirect("dog_workexam_list", $this->dog_id);
    }

    public function frmDogEditMatingSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values["txtMatingBitchPicture"] = $this->data_model->processImage($values['txtMatingBitchPicture']);

            $values = $this->data_model->assignFields($values, "frmDogAddMating");

            unset($values["dog_id"]);

            $this->database->table("tbl_dogs_matings")->where("id=?", $this->mating_id)->update($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }

        $this->redirect("dog_mating_list", $this->dog_id);
    }

    public function frmDogAddMatingSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values["txtMatingBitchPicture"] = $this->data_model->processImage($values['txtMatingBitchPicture']);

            $values = $this->data_model->assignFields($values, "frmDogAddMating");

            //unset($values["dog_id"]);

            $this->database->table("tbl_dogs_matings")->insert($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }

        $this->redirect("dog_mating_list", $this->dog_id);
    }

    public function frmDogAddCoownerSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();
            $values = $this->data_model->assignFields($values, "frmDogAddCoowner");
            $this->database->table("tbl_dogs_coowners")->insert($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
            exit;
        }
        $this->redirect("dog_coowner_list", $this->dog_id);
    }

    public function frmDogEditCoownerSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();
            $values = $this->data_model->assignFields($values, "frmDogAddCoowner");
            unset($values["dog_id"]);
            $this->database->table("tbl_dogs_coowners")->where("id=?", $this->coowner_id)->update($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
        $this->redirect("dog_coowner_list", $this->dog_id);
    }

    public function frmDogAddTitleSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $values['txtChampionshipPicture'] = $this->data_model->processImage($values['txtChampionshipPicture']);

            $description = $values['txtChampionshipName'];
            $image = $values['txtChampionshipPicture'];

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values = $this->data_model->assignFields($values, "frmDogAddTitle");

            $this->database->table("tbl_dogs_championship")->insert($values);

            $id = $this->database->getInsertId();

            $this->data_model->addToTimeline($this->dog_id, $id, 14, $description, $image);

            $this->flashMessage($this->translate("Record has been successfully added."), "Success");
        } catch (\ErrorException $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
        $this->redirect("dog_championschip_list", $this->dog_id);
    }

    public function frmCreateDogProfileSucceeded($button) {
        try {

            $values = $button->getForm()->getValues();

            $values['txtDogProfilePhoto'] = $this->data_model->processImage($values['txtDogProfilePhoto']);

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values = $this->data_model->assignFields($values, "frmCreateDogProfile");
            $values['user_id'] = $this->logged_in_id;
            $values['profile_id'] = $this->profile_id;

            $this->database->table("tbl_dogs")->insert($values);
            $id = $this->database->getInsertId();

            $father_name = $values['dog_father'];
            $mother_name = $values['dog_mother'];
            $this->data_model->setParents($values['dog_name'], $father_name, $mother_name);
            $this->data_model->addToTimeline($this->profile_id, $id, 12, $values['dog_name'], $values['dog_image']);


            $this->flashMessage($this->translate("Profile has been successfully created."), "Success");

            switch ($this->profile_type) {
                case 1:
                    $this->redirect("kennel:kennel_dog_list", $this->profile_id);
                    break;
                case 2:
                    $this->redirect("owner:owner_dog_list", $this->profile_id);
                    break;
            }
        } catch (\ErrorException $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
    }

    public function frmEditDogProfileSucceeded($button) {
        try {

            $values = $button->getForm()->getValues();

            //$values['txtDogProfilePhoto'] = $this->data_model->processImage($values['txtDogProfilePhoto']);

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values = $this->data_model->assignFields($values, "frmCreateDogProfile");
            $values['user_id'] = $this->logged_in_id;
            $values['profile_id'] = $this->profile_id;

            $this->database->table("tbl_dogs")->where("id=?", $this->dog_id)->update($values);

            $father_name = $values['dog_father'];
            $mother_name = $values['dog_mother'];
            $this->data_model->setParents($values['dog_name'], $father_name, $mother_name);

            $this->flashMessage($this->translate("Profile has been successfully updated."), "Success");

//            switch ($this->profile_type) {
//                case 1:
//                    $this->redirect("kennel:kennel_profile_home", $this->profile_id);
//                    break;
//                case 2:
//                    $this->redirect("owner:owner_profile_home", $this->profile_id);
//                    break;
//                case 3:
//                    $this->redirect("handler:handler_profile_home", $this->profile_id);
//                    break;
//            }
            $this->redirect("dog:dog_championschip_list", $this->dog_id);
        } catch (\ErrorException $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
    }

    public function frmAddShowSucceeded($button) {
        $values = $button->getForm()->getValues();

        $data = array();

        $result = $values->ddlDate . " - " . $values->txtShowName . ": ";

        $data['dog_id'] = $this->dog_id;
        $data['handler_name'] = $values->txtHandlerName;
        $data['judge_name'] = $values->txtJudgeName;
        $data['show_class'] = $values->ddlShowClass;

        $time = strtotime($values['ddlDate']);
        $values['ddlDate'] = date('Y-m-d', $time);

        $data['show_date'] = $values->ddlDate;
        $data['show_name'] = $values->txtShowName;
        $data['show_type'] = $values->ddlShowType;
        $data['show_country'] = $values->ddlCountry;

        foreach ($values->chckAssesmentMinorPuppy as $item) {
            $data[$item] = 1;
            $result .= $this->translate($item) . ",";
        }

        foreach ($values->chckTitlesMinorPuppy as $item) {
            $data[$item] = 1;
            $result .= $this->translate($item) . ",";
        }

        foreach ($values->chckTitlesPuppy as $item) {
            $data[$item] = 1;
            $result .= $this->translate($item) . ",";
        }

        foreach ($values->chckAssesment as $item) {
            $data[$item] = 1;
            $result .= $this->translate($item) . ",";
        }

        foreach ($values->chckTitlesJunior as $item) {
            $data[$item] = 1;
            $result .= $this->translate($item) . ",";
        }

        foreach ($values->chckTitlesJuniorBOG as $item) {
            $data[$item] = 1;
            $result .= $this->translate($item) . ",";
        }

        foreach ($values->chckTitlesJuniorBIS as $item) {
            $data[$item] = 1;
            $result .= $this->translate($item) . ",";
        }

        foreach ($values->chckTitlesBOG as $item) {
            $data[$item] = 1;
            $result .= $this->translate($item) . ",";
        }

        foreach ($values->chckTitlesBIS as $item) {
            $data[$item] = 1;
            $result .= $this->translate($item) . ",";
        }

        foreach ($values->chckTitles as $item) {
            $data[$item] = 1;
            $result .= $this->translate($item) . ",";
        }

        $data['other_title'] = $values->txtOtherTitle;
        $result .= $data['other_title'];

        $data['show_image'] = $values->txtShowImage;

        $this->database->table("tbl_dogs_shows")->insert($data);

        $id = $this->database->getInsertId();

        $this->data_model->addToTimeline($this->dog_id, $id, 11, $result, $values->txtShowImage);


        $this->redirect("dog:dog_show_list", array(id => $this->dog_id));
    }

    public function frmEditShowSucceeded($button) {
        $values = $button->getForm()->getValues();

        $data = array();

        $data['handler_name'] = $values->txtHandlerName;
        $data['judge_name'] = $values->txtJudgeName;
        $data['show_class'] = $values->ddlShowClass;

        $time = strtotime($values['ddlDate']);
        $values['ddlDate'] = date('Y-m-d', $time);

        $data['show_date'] = $values->ddlDate;
        $data['show_name'] = $values->txtShowName;
        $data['show_type'] = $values->ddlShowType;
        $data['show_country'] = $values->ddlCountry;

        $data['VP1'] = 0;
        $data['VP2'] = 0;
        $data['VP3'] = 0;
        $data['VP'] = 0;
        $data['BestMinorPuppy1'] = 0;
        $data['BestMinorPuppy2'] = 0;
        $data['BestMinorPuppy3'] = 0;
        $data['BestPuppy1'] = 0;
        $data['BestPuppy2'] = 0;
        $data['BestPuppy3'] = 0;
        $data['EXC1'] = 0;
        $data['EXC2'] = 0;
        $data['EXC3'] = 0;
        $data['EXC4'] = 0;
        $data['VG1'] = 0;
        $data['VG2'] = 0;
        $data['VG3'] = 0;
        $data['VG4'] = 0;
        $data['CAJC'] = 0;
        $data['JBOB'] = 0;
        $data['BOB'] = 0;
        $data['BOS'] = 0;
        $data['JBOG1'] = 0;
        $data['JBOG2'] = 0;
        $data['JBOG3'] = 0;
        $data['JBIS1'] = 0;
        $data['JBIS2'] = 0;
        $data['JBIS3'] = 0;
        $data['BOG1'] = 0;
        $data['BOG2'] = 0;
        $data['BOG3'] = 0;
        $data['BIS1'] = 0;
        $data['BIS2'] = 0;
        $data['BIS3'] = 0;
        $data['CAC'] = 0;
        $data['RESCAC'] = 0;
        $data['CACIB'] = 0;
        $data['RESCACIB'] = 0;

        foreach ($values->chckAssesmentMinorPuppy as $item) {
            $data[$item] = 1;
        }

        foreach ($values->chckTitlesMinorPuppy as $item) {
            $data[$item] = 1;
        }

        foreach ($values->chckTitlesPuppy as $item) {
            $data[$item] = 1;
        }

        foreach ($values->chckAssesment as $item) {
            $data[$item] = 1;
        }

        foreach ($values->chckTitlesJunior as $item) {
            $data[$item] = 1;
        }

        foreach ($values->chckTitlesJuniorBOG as $item) {
            $data[$item] = 1;
        }

        foreach ($values->chckTitlesJuniorBIS as $item) {
            $data[$item] = 1;
        }

        foreach ($values->chckTitlesBOG as $item) {
            $data[$item] = 1;
        }

        foreach ($values->chckTitlesBIS as $item) {
            $data[$item] = 1;
        }

        foreach ($values->chckTitles as $item) {
            $data[$item] = 1;
        }

        $data['other_title'] = $values->txtOtherTitle;

        $data['show_image'] = $values->txtShowImage;

        $this->database->table("tbl_dogs_shows")->where("id=?", $this->show_id)->update($data);

        $this->redirect("dog:dog_show_list", array(id => $this->dog_id));
    }

    public function formCanceled() {
        $this->redirect('dog:dog_championschip_list', $this->dog_id);
    }

}
