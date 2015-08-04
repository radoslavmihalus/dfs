<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class handlerPresenter extends BasePresenter {

    /** @persistent int */
    public $handler_id;
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

    public function renderHandler_awards_list($id = 0) {
        $this->renderDefault($id);
        $championships = $this->database->table("tbl_handlers_awards")->where("handler_id = ?", $id)->fetchAll();
        $this->template->championships = $championships;
    }

    public function renderHandler_coowner_list($id = 0) {
        $this->renderDefault($id);
        $coowners = $this->database->table("tbl_handlers_coowners")->where("handler_id=?", $id)->fetchAll();
        $this->template->coowners = $coowners;
    }

    public function renderHandler_show_list($id = 0) {
        $this->renderDefault($id);
    }

    public function renderHandler_health_list($id = 0) {
        $this->renderDefault($id);
        $healths = $this->database->table("tbl_handlers_health")->where("handler_id=?", $id)->fetchAll();
        $this->template->healths = $healths;
    }

    public function renderHandler_workexam_list($id = 0) {
        $this->renderDefault($id);
        $workexams = $this->database->table("tbl_handlers_workexams")->where("handler_id=?", $id)->fetchAll();
        $this->template->workexams = $workexams;
    }

    public function renderHandler_mating_list($id = 0) {
        $this->renderDefault($id);
        $matings = $this->database->table("tbl_handlers_matings")->where("handler_id=?", $id)->fetchAll();
        $this->template->matings = $matings;
    }

    public function renderHandler_list($id = 0) {
        if ($id > 0)
            $rows = $this->database->table("tbl_dogs")->where("profile_id=? AND user_id=?", $id, $this->logged_in_id)->fetchAll();
        else
            $rows = $this->database->table("tbl_dogs")->fetchAll();

        $this->template->rows = $rows;
    }

    public function renderHandler_for_mating_list($id = 0) {
        if ($id > 0)
            $rows = $this->database->table("tbl_dogs")->where("profile_id=? AND user_id=? AND offer_for_mating=1", $id, $this->logged_in_id)->fetchAll();
        else
            $rows = $this->database->table("tbl_dogs")->where("offer_for_mating=1")->fetchAll();

        $this->template->rows = $rows;
    }

    public function renderDefault($id = 0) {
        $dog = $this->database->table("tbl_dogs")->where("id=?", $id)->fetch();
        $this->template->dog = $dog;
        $this->handler_id = $id;

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
    public function actionHandler_edit_profile($id) {
        $this->handler_id = $id;
    }

    public function actionHandler_championschip_edit($id) {
        $this->title_id = $id;
    }

    public function actionHandler_workexam_edit($id) {
        $this->workexam_id = $id;
    }

    public function actionHandler_health_edit($id) {
        $this->health_id = $id;
    }

    public function actionHandler_championschip_add($id = 0) {
        if ($id == 0)
            $id = $this->handler_id;
        $this->handler_id = $id;
    }

    public function actionHandler_coowner_add($id = 0) {
        if ($id == 0)
            $id = $this->handler_id;
        $this->handler_id = $id;
    }

    public function actionHandler_coowner_edit($id = 0) {
        $this->coowner_id = $id;
    }

    public function actionHandler_mating_edit($id = 0) {
        $this->mating_id = $id;
    }

    public function actionHandler_mating_add($id = 0) {
        if ($id == 0)
            $id = $this->handler_id;
        $this->handler_id = $id;
    }

    /**
     * End of actions
     */

    /**
     * 
     * FormComponents factory
     */
    protected function createComponentFormCreateHandlerProfile() {
        $form = new Form();

        $result = $this->database->table("lk_countries")->order("CountryName_en");
        $countries = array();

        $countries[] = $this->translate("Please select state...");

        foreach ($result as $row) {
            $countries[$row->CountryName_en] = $row->CountryName_en;
        }

        $sex = array(
            'Handler' => 'Handler',
            'Bitch' => 'Bitch'
        );

        $form->addRadioList("radGender", NULL, $sex)->setRequired();
        $form->addCheckbox("chckMating");
        $form->addText("ddlBreedList")->setRequired();
        $form->addText("txtHandlerName")->setRequired();
        $form->addUpload("txtHandlerProfilePhoto")->setRequired();
        $form->addText("txtPedigreeRegistrationNumber");
        $form->addText("ddlDate")->setRequired();
        $form->addText("txtHandlerHeight");
        $form->addText("txtHandlerWeight");
        $form->addSelect("ddlCountry")->setItems($countries)->setRequired();
        $form->addText("ddlHandlerFather");
        $form->addText("ddlHandlerMother");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmCreateHandlerProfileSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');

        return $form;
    }

    protected function createComponentFormEditHandlerProfile() {
        $id = $this->handler_id;
        $form = new Form();

        $profile = $this->database->table("tbl_dogs")->where("id=?", $id)->fetch();

        $result = $this->database->table("lk_countries")->order("CountryName_en");
        $countries = array();

        foreach ($result as $row) {
            $countries[$row->CountryName_en] = $row->CountryName_en;
        }

        $sex = array(
            'Handler' => 'Handler',
            'Bitch' => 'Bitch'
        );

        $time = strtotime($profile->date_of_birth);
        $date = date('d.m.Y', $time);

        $form->addRadioList("radGender", NULL, $sex)->setDefaultValue($profile->dog_gender);
        $form->addCheckbox("chckMating")->setValue($profile->offer_for_mating);
        $form->addText("ddlBreedList")->setValue($profile->breed_name)->setRequired();
        $form->addText("txtHandlerName")->setValue($profile->dog_name)->setRequired();
        $form->addText("txtPedigreeRegistrationNumber")->setValue($profile->dog_registration_number);
        $form->addText("ddlDate")->setValue($date)->setRequired();
        $form->addText("txtHandlerHeight")->setValue($profile->height);
        $form->addText("txtHandlerWeight")->setValue($profile->weight);
        $form->addSelect("ddlCountry")->setItems($countries)->setValue($profile->country)->setRequired();
        $form->addText("ddlHandlerFather")->setValue($profile->dog_father);
        $form->addText("ddlHandlerMother")->setValue($profile->dog_mother);
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditHandlerProfileSucceeded');

        return $form;
    }

    protected function createComponentFormEditHandlerProfilePicture() {
        $id = $this->handler_id;
        $form = new Form();
        $form->addUpload("txtHandlerProfilePhoto")->setRequired();
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditHandlerProfilePictureSucceeded');
        return $form;
    }

    protected function createComponentFormAddTitle() {
        $id = $this->handler_id;
        $form = new Form();
        $form->addHidden("handler_id")->setValue($id);
        $form->addText("ddlDate");
        $form->addText("txtChampionshipName");
        $form->addUpload("txtChampionshipPicture");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmHandlerAddTitleSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormEditTitle() {
        $row = $this->database->table("tbl_handlers_championship")->where("id=?", $this->title_id)->fetch();
        $form = new Form();

        $time = strtotime($row->date);
        $date = date('d.m.Y', $time);

        $form->addHidden("handler_id")->setValue($row->handler_id);
        $form->addText("ddlDate")->setValue($date);
        $form->addText("txtChampionshipName")->setValue($row->description);
        $form->addUpload("txtChampionshipPicture");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmHandlerEditTitleSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormAddHealth() {
        $id = $this->handler_id;
        $form = new Form();
        $form->addHidden("handler_id")->setValue($id);
        $form->addText("ddlDate")->setRequired();
        $form->addText("txtHealthName")->setRequired();
        $form->addUpload("txtHealthPicture");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmHandlerAddHealthSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormEditHealth() {
        $row = $this->database->table("tbl_handlers_health")->where("id=?", $this->health_id)->fetch();
        $form = new Form();

        $time = strtotime($row->date);
        $date = date('d.m.Y', $time);

        $form->addHidden("handler_id")->setValue($row->handler_id);
        $form->addText("ddlDate")->setValue($date)->setRequired();
        $form->addText("txtHealthName")->setValue($row->description)->setRequired();
        $form->addUpload("txtHealthPicture");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmHandlerEditHealthSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormEditMating() {
        $row = $this->database->table("tbl_handlers_matings")->where("id=?", $this->mating_id)->fetch();
        $form = new Form();

        $time = strtotime($row->date);
        $date = date('d.m.Y', $time);

        $form->addHidden("handler_id")->setValue($row->handler_id);
        $form->addText("ddlDate")->setValue($date)->setRequired();
        $form->addText("txtMatingBitchName")->setValue($row->description)->setRequired();
        $form->addUpload("txtMatingBitchPicture");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmHandlerEditMatingSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormAddMating() {
        $form = new Form();

        $form->addHidden("handler_id")->setValue($this->handler_id);
        $form->addText("ddlDate")->setValue($date)->setRequired();
        $form->addText("txtMatingBitchName")->setRequired();
        $form->addUpload("txtMatingBitchPicture");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmHandlerAddMatingSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormEditWorkExam() {
        $row = $this->database->table("tbl_handlers_workexams")->where("id=?", $this->workexam_id)->fetch();
        $form = new Form();

        $time = strtotime($row->date);
        $date = date('d.m.Y', $time);

        $form->addHidden("handler_id")->setValue($row->handler_id);
        $form->addText("ddlDate")->setValue($date)->setRequired();
        $form->addText("txtWorkExamName")->setValue($row->description)->setRequired();
        $form->addUpload("txtWorkExamPicture");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmHandlerEditWorkexamSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormAddWorkExam() {
        $form = new Form();

        $form->addHidden("handler_id")->setValue($this->handler_id);
        $form->addText("ddlDate")->setValue($date)->setRequired();
        $form->addText("txtWorkExamName")->setRequired();
        $form->addUpload("txtWorkExamPicture");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmHandlerAddWorkexamSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormAddCoowner() {
        $id = $this->handler_id;

        $result = $this->database->table("lk_countries")->order("CountryName_en");
        $countries = array();

        $countries[] = $this->translate("Please select state...");

        foreach ($result as $row) {
            $countries[$row->CountryName_en] = $row->CountryName_en;
        }

        $form = new Form();
        $form->addHidden("handler_id")->setValue($id);
        $form->addText("txtCoownerName")->setRequired();
        $form->addSelect("ddlCountry")->setItems($countries)->setRequired();
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmHandlerAddCoownerSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormEditCoowner() {
        $id = $this->handler_id;

        $result = $this->database->table("lk_countries")->order("CountryName_en");
        $countries = array();

        $countries[] = $this->translate("Please select state...");

        foreach ($result as $row) {
            $countries[$row->CountryName_en] = $row->CountryName_en;
        }

        $result = $this->database->table("tbl_handlers_coowners")->where("id=?", $this->coowner_id)->fetch();

        $form = new Form();
        $form->addHidden("handler_id")->setValue($id);
        $form->addText("txtCoownerName")->setValue($result->coowner_name);
        $form->addSelect("ddlCountry")->setItems($countries)->setValue($result->coowner_state);
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmHandlerEditCoownerSucceeded');
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
    public function frmEditHandlerProfilePictureSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();
            $values["txtHandlerProfilePhoto"] = $this->data_model->processImage($values['txtHandlerProfilePhoto']);
            $values = $this->data_model->assignFields($values, "frmEditHandlerProfilePicture");
            $this->database->table("tbl_handlers_championship")->where("id=?", $this->handler_id)->update($values);
        } catch (\ErrorException $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
    }

    public function frmHandlerEditTitleSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values["txtChampionshipPicture"] = $this->data_model->processImage($values['txtChampionshipPicture']);

            $values = $this->data_model->assignFields($values, "frmHandlerAddTitle");

            unset($values["handler_id"]);

            $this->database->table("tbl_handlers_championship")->where("id=?", $this->title_id)->update($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }

        $this->redirect("dog_championschip_list", $this->handler_id);
    }

    public function frmHandlerEditHealthSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values["txtHealthPicture"] = $this->data_model->processImage($values['txtHealthPicture']);

            $values = $this->data_model->assignFields($values, "frmHandlerAddHealth");

            unset($values["handler_id"]);

            $this->database->table("tbl_handlers_health")->where("id=?", $this->health_id)->update($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }

        $this->redirect("dog_health_list", $this->handler_id);
    }

    public function frmHandlerAddHealthSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values["txtHealthPicture"] = $this->data_model->processImage($values['txtHealthPicture']);

            $values = $this->data_model->assignFields($values, "frmHandlerAddHealth");

            //unset($values["handler_id"]);

            $this->database->table("tbl_handlers_health")->insert($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }

        $this->redirect("dog_health_list", $this->handler_id);
    }

    public function frmHandlerEditWorkexamSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values["txtWorkExamPicture"] = $this->data_model->processImage($values['txtWorkExamPicture']);

            $values = $this->data_model->assignFields($values, "frmHandlerAddWorkexam");

            unset($values["handler_id"]);

            $this->database->table("tbl_handlers_workexams")->where("id=?", $this->workexam_id)->update($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }

        $this->redirect("dog_workexam_list", $this->handler_id);
    }

    public function frmHandlerAddWorkexamSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values["txtWorkExamPicture"] = $this->data_model->processImage($values['txtWorkExamPicture']);

            $values = $this->data_model->assignFields($values, "frmHandlerAddWorkexam");

            //unset($values["handler_id"]);

            $this->database->table("tbl_handlers_workexams")->insert($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }

        $this->redirect("dog_workexam_list", $this->handler_id);
    }

    public function frmHandlerEditMatingSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values["txtMatingBitchPicture"] = $this->data_model->processImage($values['txtMatingBitchPicture']);

            $values = $this->data_model->assignFields($values, "frmHandlerAddMating");

            unset($values["handler_id"]);

            $this->database->table("tbl_handlers_matings")->where("id=?", $this->mating_id)->update($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }

        $this->redirect("dog_mating_list", $this->handler_id);
    }

    public function frmHandlerAddMatingSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values["txtMatingBitchPicture"] = $this->data_model->processImage($values['txtMatingBitchPicture']);

            $values = $this->data_model->assignFields($values, "frmHandlerAddMating");

            //unset($values["handler_id"]);

            $this->database->table("tbl_handlers_matings")->insert($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }

        $this->redirect("dog_mating_list", $this->handler_id);
    }

    public function frmHandlerAddCoownerSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();
            $values = $this->data_model->assignFields($values, "frmHandlerAddCoowner");
            $this->database->table("tbl_handlers_coowners")->insert($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
            exit;
        }
        $this->redirect("dog_coowner_list", $this->handler_id);
    }

    public function frmHandlerEditCoownerSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();
            $values = $this->data_model->assignFields($values, "frmHandlerAddCoowner");
            unset($values["handler_id"]);
            $this->database->table("tbl_handlers_coowners")->where("id=?", $this->coowner_id)->update($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
        $this->redirect("dog_coowner_list", $this->handler_id);
    }

    public function frmHandlerAddTitleSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $values['txtChampionshipPicture'] = $this->data_model->processImage($values['txtChampionshipPicture']);

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values = $this->data_model->assignFields($values, "frmHandlerAddTitle");

            $this->database->table("tbl_handlers_championship")->insert($values);

            $this->flashMessage("Title successfully added.", "Success");
        } catch (\ErrorException $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
        $this->redirect("dog_championschip_list", $this->handler_id);
    }

    public function frmCreateHandlerProfileSucceeded($button) {
        try {

            $values = $button->getForm()->getValues();

            $values['txtHandlerProfilePhoto'] = $this->data_model->processImage($values['txtHandlerProfilePhoto']);

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values = $this->data_model->assignFields($values, "frmCreateHandlerProfile");
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

    public function frmEditHandlerProfileSucceeded($button) {
        try {

            $values = $button->getForm()->getValues();

            //$values['txtHandlerProfilePhoto'] = $this->data_model->processImage($values['txtHandlerProfilePhoto']);

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values = $this->data_model->assignFields($values, "frmCreateHandlerProfile");
            $values['user_id'] = $this->logged_in_id;
            $values['profile_id'] = $this->profile_id;

            $this->database->table("tbl_dogs")->where("id=?", $this->handler_id)->update($values);

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
        $this->redirect('dog:dog_championschip_list', $this->handler_id);
    }

}
