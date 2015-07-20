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

    protected function startup() {
        parent::startup();
    }

    /*     * ******************* view default ******************** */

    public function beforeRender() {
        parent::beforeRender();
    }

    public function renderDog_championschip_list($id = 0) {
        $this->renderDefault($id);
        $championships = $this->database->table("tbl_dogs_championship")->where("dog_id=?",$id)->fetchAll();
        $this->template->championships = $championships;
    }

    public function renderDog_show_list($id = 0) {
        $this->renderDefault($id);
    }

    public function renderDog_list($id = 0) {
        if ($id > 0)
            $rows = $this->database->table("tbl_dogs")->where("profile_id=? AND user_id=?", $id, $this->logged_in_id)->fetchAll();
        else
            $rows = $this->database->table("tbl_dogs")->fetchAll();

        $this->template->rows = $rows;
    }

    public function renderDefault($id = 0) {
        $dog = $this->database->table("tbl_dogs")->where("id=?", $id)->fetch();
        $this->template->dog = $dog;
    }

    /*     * ******************* views add & edit ******************** */

    public function renderAdd() {
        //$this['albumForm']['save']->caption = 'Add';
    }

    public function renderEdit($id = 0) {
//		$form = $this['albumForm'];
//		if (!$form->isSubmitted()) {
//			$album = $this->albums->findById($id);
//			if (!$album) {
//				$this->error('Record not found');
//			}
//			$form->setDefaults($album);
//		}
    }

    /*     * ******************* view delete ******************** */

    public function renderDelete($id = 0) {
//		$this->template->album = $this->albums->findById($id);
//		if (!$this->template->album) {
//			$this->error('Record not found');
//		}
    }

    /*     * ******************* component factories ******************** */

    /**
     * Edit form factory.
     * @return Form
     */
    protected function createComponentFormCreateDogProfile() {
        $form = new Form();

        $result = $this->database->table("lk_countries")->order("CountryName_en");
        $countries = array();

        foreach ($result as $row) {
            $countries[$row->CountryName_en] = $row->CountryName_en;
        }

        $sex = array(
            'Dog' => 'Dog',
            'Bitch' => 'Bitch'
        );

        $form->addRadioList("radGender", NULL, $sex);
        $form->addCheckbox("chckMating");
        $form->addText("ddlBreedList");
        $form->addText("txtDogName");
        $form->addUpload("txtDogProfilePhoto");
        $form->addText("txtPedigreeRegistrationNumber");
        $form->addText("ddlDate");
        $form->addText("txtDogHeight");
        $form->addText("txtDogWeight");
        $form->addSelect("ddlCountry")->setItems($countries);
        $form->addText("ddlDogFather");
        $form->addText("ddlDogMother");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmCreateDogProfileSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCancelled');

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

        $sex = array(
            'Dog' => 'Dog',
            'Bitch' => 'Bitch'
        );

        $form->addRadioList("radGender", NULL, $sex)->setValue($profile->dog_gender);
        $form->addCheckbox("chckMating")->setValue($profile->offer_for_mating);
        $form->addText("ddlBreedList")->setValue($profile->breed_name);
        $form->addText("txtDogName")->setValue($profile->dog_name);
        $form->addText("txtPedigreeRegistrationNumber")->setValue($profile->dog_registration_number);
        $form->addText("ddlDate")->setValue($profile->date_of_birth);
        $form->addText("txtDogHeight")->setValue($profile->height);
        $form->addText("txtDogWeight")->setValue($profile->weight);
        $form->addSelect("ddlCountry")->setItems($countries)->setValue($profile->country);
        $form->addText("ddlDogFather")->setValue($profile->dog_father);
        $form->addText("ddlDogMother")->setValue($profile->dog_mother);
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmCreateDogProfileSucceeded');

        return $form;
    }

    protected function createComponentFormEditDogProfilePicture() {
        $id = $this->dog_id;
        $form = new Form();
        $form->addUpload("txtDogProfilePhoto");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmCreateDogProfileSucceeded');
        return $form;
    }

    protected function createComponentFormAddTitle() {
        $id = $this->dog_id;
        $form = new Form();
        $form->addHidden("dog_id")->setValue($id);
        $form->addText("ddlDate");
        $form->addText("txtChampionshipName");
        $form->addUpload("txtChampionshipPicture");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmDogAddTitleSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    protected function createComponentFormEditTitle() {
        $id = $this->dog_id;
        
        
        
        $form = new Form();
        $form->addHidden("dog_id")->setValue($id);
        $form->addText("ddlDate")->setValue();
        $form->addText("txtChampionshipName");
        $form->addUpload("txtChampionshipPicture");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmDogAddTitleSucceeded');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
        return $form;
    }

    public function actionDog_edit_profile($id) {
        $this->dog_id = $id;
    }

    public function actionDog_championschip_edit_profile($id) {
        $this->title_id = $id;
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

    public function formCancelled() {
        $this->redirect('dog:dog_list');
    }

}
