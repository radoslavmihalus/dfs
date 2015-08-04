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
    public $title_id;
    public $health_id;
    public $coowner_id;
    public $mating_id;
    public $workexam_id;

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

    public function renderDog_championschip_list($id = 0) {
        $this->renderDefault($id);
        $championships = $this->database->table("tbl_dogs_championship")->where("dog_id=?", $id)->fetchAll();
        $this->template->championships = $championships;
    }

    public function renderDog_coowner_list($id = 0) {
        $this->renderDefault($id);
        $coowners = $this->database->table("tbl_dogs_coowners")->where("dog_id=?", $id)->fetchAll();
        $this->template->coowners = $coowners;
    }

    public function renderDog_show_list($id = 0) {
        $this->renderDefault($id);
    }

    public function renderDog_health_list($id = 0) {
        $this->renderDefault($id);
        $healths = $this->database->table("tbl_dogs_health")->where("dog_id=?", $id)->fetchAll();
        $this->template->healths = $healths;
    }

    public function renderDog_workexam_list($id = 0) {
        $this->renderDefault($id);
        $workexams = $this->database->table("tbl_dogs_workexams")->where("dog_id=?", $id)->fetchAll();
        $this->template->workexams = $workexams;
    }

    public function renderDog_mating_list($id = 0) {
        $this->renderDefault($id);
        $matings = $this->database->table("tbl_dogs_matings")->where("dog_id=?", $id)->fetchAll();
        $this->template->matings = $matings;
    }

    public function renderDog_list($id = 0) {
        if ($id > 0)
            $rows = $this->database->table("tbl_dogs")->where("profile_id=? AND user_id=?", $id, $this->logged_in_id)->fetchAll();
        else
            $rows = $this->database->table("tbl_dogs")->fetchAll();

        $this->template->rows = $rows;
    }

    public function renderDog_for_mating_list($id = 0) {
        if ($id > 0)
            $rows = $this->database->table("tbl_dogs")->where("profile_id=? AND user_id=? AND offer_for_mating=1", $id, $this->logged_in_id)->fetchAll();
        else
            $rows = $this->database->table("tbl_dogs")->where("offer_for_mating=1")->fetchAll();

        $this->template->rows = $rows;
    }

    public function renderDefault($id = 0) {
        $dog = $this->database->table("tbl_dogs")->where("id=?", $id)->fetch();
        $this->template->dog = $dog;
        $this->dog_id = $id;

        $this->template->cajc = 0;
        $this->template->jbob = 0;
        $this->template->jbog = 0;
        $this->template->jbis = 0;
        $this->template->cac = 0;
        $this->template->cacib = 0;
        $this->template->bos = 0;
        $this->template->bob = 0;
        $this->template->bog = 0;
        $this->template->bis = 0;
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

    public function actionDog_health_edit($id) {
        $this->health_id = $id;
    }

    public function actionDog_championschip_add($id = 0) {
        if ($id == 0)
            $id = $this->dog_id;
        $this->dog_id = $id;
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
    }

    /**
     * End of actions
     */

    /**
     * 
     * FormComponents factory
     */
    protected function createComponentFormCreateDogProfile() {
        $form = new Form();

        $result = $this->database->table("lk_countries")->order("CountryName_en");
        $countries = array();

        $countries[] = $this->translate("Please select state...");

        foreach ($result as $row) {
            $countries[$row->CountryName_en] = $row->CountryName_en;
        }

        $sex = array(
            'Dog' => 'Dog',
            'Bitch' => 'Bitch'
        );

        $form->addRadioList("radGender", NULL, $sex)->setRequired();
        $form->addCheckbox("chckMating");
        $form->addText("ddlBreedList")->setRequired();
        $form->addText("txtDogName")->setRequired();
        $form->addHidden("txtDogProfilePhoto")->setRequired();
        $form->addText("txtPedigreeRegistrationNumber");
        $form->addText("ddlDate")->setRequired();
        $form->addText("txtDogHeight");
        $form->addText("txtDogWeight");
        $form->addSelect("ddlCountry")->setItems($countries)->setRequired();
        $form->addText("ddlDogFather");
        $form->addText("ddlDogMother");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmCreateDogProfileSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');

        return $form;
    }

    protected function createComponentFormEditDogProfile() {
        $id = $this->dog_id;
        $form = new Form();

        $profile = $this->database->table("tbl_dogs")->where("id=?", $id)->fetch();

        $result = $this->database->table("lk_countries")->order("CountryName_en");
        $countries = array();

        foreach ($result as $row) {
            $countries[$row->CountryName_en] = $row->CountryName_en;
        }

        $time = strtotime($profile->date_of_birth);
        $date = date('d.m.Y', $time);

        $sex = array(
            'Dog' => 'Dog',
            'Bitch' => 'Bitch'
        );

        $form->addRadioList("radGender", NULL, $sex)->setValue($profile->dog_gender);

        //$form->addHidden("hidradGender")->setValue($profile->dog_gender);
        $form->addCheckbox("chckMating")->setValue($profile->offer_for_mating);
        $form->addText("ddlBreedList")->setValue($profile->breed_name)->setRequired();
        $form->addText("txtDogName")->setValue($profile->dog_name)->setRequired();
        $form->addText("txtPedigreeRegistrationNumber")->setValue($profile->dog_registration_number);
        $form->addText("ddlDate")->setValue($date)->setRequired();
        $form->addText("txtDogHeight")->setValue($profile->height);
        $form->addText("txtDogWeight")->setValue($profile->weight);
        $form->addSelect("ddlCountry")->setItems($countries)->setValue($profile->country)->setRequired();
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

    protected function createComponentFormEditTitle() {
        $row = $this->database->table("tbl_dogs_championship")->where("id=?", $this->title_id)->fetch();
        $form = new Form();

        $time = strtotime($row->date);
        $date = date('d.m.Y', $time);

        $form->addHidden("dog_id")->setValue($row->dog_id);
        $form->addText("ddlDate")->setValue($date);
        $form->addText("txtChampionshipName")->setValue($row->description);
        $form->addHidden("txtChampionshipPicture");
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
        $form->addText("ddlDate")->setValue($date)->setRequired();
        $form->addText("txtWorkExamName")->setRequired();
        $form->addHidden("txtWorkExamPicture");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmDogAddWorkexamSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormAddCoowner() {
        $id = $this->dog_id;

        $result = $this->database->table("lk_countries")->order("CountryName_en");
        $countries = array();

        $countries[] = $this->translate("Please select state...");

        foreach ($result as $row) {
            $countries[$row->CountryName_en] = $row->CountryName_en;
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

        $result = $this->database->table("lk_countries")->order("CountryName_en");
        $countries = array();

        $countries[] = $this->translate("Please select state...");

        foreach ($result as $row) {
            $countries[$row->CountryName_en] = $row->CountryName_en;
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

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values = $this->data_model->assignFields($values, "frmDogAddTitle");

            $this->database->table("tbl_dogs_championship")->insert($values);

            $this->flashMessage("Title successfully added.", "Success");
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

            $this->flashMessage("Your dog profile successfully created.", "Success");

            switch ($this->profile_type) {
                case 1:
                    $this->redirect("kennel:kennel_profile_home", $this->profile_id);
                    break;
                case 2:
                    $this->redirect("owner:owner_profile_home", $this->profile_id);
                    break;
                case 3:
                    $this->redirect("handler:handler_profile_home", $this->profile_id);
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

            $this->flashMessage("Your dog profile successfully created.", "Success");

            switch ($this->profile_type) {
                case 1:
                    $this->redirect("kennel:kennel_profile_home", $this->profile_id);
                    break;
                case 2:
                    $this->redirect("owner:owner_profile_home", $this->profile_id);
                    break;
                case 3:
                    $this->redirect("handler:handler_profile_home", $this->profile_id);
                    break;
            }
        } catch (\ErrorException $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
    }

    public function formCanceled() {
        $this->redirect('dog:dog_championschip_list', $this->dog_id);
    }

}
