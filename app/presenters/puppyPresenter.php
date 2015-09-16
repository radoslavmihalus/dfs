<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class puppyPresenter extends BasePresenter {
    /** @var Model\AlbumRepository */
    //private $albums;
//    public function __construct() {
//        
//    }

    /** @persistent int */
    public $dog_id;
    public $planned_litter_id;

    protected function startup() {
	parent::startup();
    }

    public function beforeRender() {
	parent::beforeRender();
    }

    /*     * ******************* view default ******************** */

    public function renderPuppy_pedigree_list($id = 0) {
	$this->renderDefault($id);
	$dog = $this->database->table("tbl_puppies")->where("id=?", $id)->fetch();
	$pedigree = $this->database->table("tbl_pedigree")->where("dog_name=?", $dog->puppy_name)->fetch();
	$this->template->dog_name = $dog->puppy_name;
	$this->template->pedigree = $pedigree;
    }

    public function renderPuppy_description($id = 0) {
	$this->renderDefault($id);
    }

    public function renderDefault($id = 0) {
	$dog = $this->database->table("tbl_puppies")->where("id=?", $id)->fetch();
	$this->template->dog = $dog;
	$this->dog_id = $id;
    }

    public function renderPuppy_edit_profile($id = 0) {
	$this->dog_id = $id;
    }

    /*     * ******************* action methods ******************** */

    public function actionPuppy_create_profile($plid = 0) {
	$this->planned_litter_id = $plid;
    }

    public function actionPuppy_edit_profile($id = 0) {
	$this->dog_id = $id;
    }

    public function actionPuppy_pedigree_edit($id = 0) {
	if ($id == 0)
	    $id = $this->dog_id;
	$this->dog_id = $id;
    }

    /*     * ******************* component factories ******************** */

    protected function createComponentFormPuppyCreateProfile() {

	$lang = "en";

	try {
	    $section = $this->getSession('language');
	    if (strlen($section->lang) > 1)
	    $lang = strtolower($section->lang);
	} catch (Exception $ex) {
	    $lang = "en";
	}
	$result = $this->database->table("lk_countries")->order("CountryName_$lang")->fetchAll();
	$countries = array();

	$countries[] = $this->translate("Please select state...");

	foreach ($result as $row) {
	    $countries[$row->CountryName_en] = $row->CountryName_en;
	}

	$result = $this->database->table("tbl_planned_litters")->where("kennel_id=?", $this->profile_id)->order("year DESC, month DESC")->fetchAll();
	$planned_litters = array();

	$planned_litters[0] = $this->translate("Please select planned litter...");

	foreach ($result as $row) {
	    $planned_litters[$row->id] = $row->name . ' [' . $row->month . '/' . $row->year . ']';
	}

	$sex = array(
	    'Dog' => 'Dog',
	    'Bitch' => 'Bitch'
	);

	$form = new Form();

	if ($this->planned_litter_id > 0)
	    $form->addSelect("ddlPlannedLitter")->setItems($planned_litters)->setValue($this->planned_litter_id)->setRequired($this->translate("Required field"));
	else
	    $form->addSelect("ddlPlannedLitter")->setItems($planned_litters)->setRequired($this->translate("Required field"));
	$form->addRadioList("radGender", NULL, $sex)->setRequired($this->translate("Required field"));
	$form->addText("txtPuppyName")->setRequired($this->translate("Required field"));
	$form->addText("txtPuppyProfilePhoto")->setRequired($this->translate("Required field"));
	$form->addText("ddlDate")->setRequired($this->translate("Required field"));
	$form->addSelect("ddlCountry")->setItems($countries)->setRequired($this->translate("Required field"));
	$form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmCreatePuppyProfileSucceeded');

	return $form;
    }

    protected function createComponentFormPuppyEditProfile() {
	$puppy = $this->database->table("tbl_puppies")->where("id=?", $this->dog_id)->fetch();

	$lang = "en";

	try {
	    $section = $this->getSession('language');
	    if (strlen($section->lang) > 1)
	    $lang = strtolower($section->lang);
	} catch (Exception $ex) {
	    $lang = "en";
	}
	$result = $this->database->table("lk_countries")->order("CountryName_$lang")->fetchAll();
	$countries = array();

	$countries[] = $this->translate("Please select state...");

	foreach ($result as $row) {
	    $countries[$row->CountryName_en] = $row->CountryName_en;
	}

	$result = $this->database->table("tbl_planned_litters")->where("kennel_id=?", $this->profile_id)->order("year DESC, month DESC")->fetchAll();
	$planned_litters = array();

	$planned_litters[0] = $this->translate("Please select planned litter...");

	foreach ($result as $row) {
	    $planned_litters[$row->id] = $row->name . ' [' . $row->month . '/' . $row->year . ']';
	}

	$sex = array(
	    'Dog' => 'Dog',
	    'Bitch' => 'Bitch'
	);

	$form = new Form();

	$time = strtotime($puppy->date_of_birth);
	$date = date('d.m.Y', $time);

	$form->addSelect("ddlPlannedLitter")->setItems($planned_litters)->setValue($puppy->planned_litter_id)->setRequired($this->translate("Required field"));
	$form->addRadioList("radGender", NULL, $sex)->setValue($puppy->puppy_gender)->setRequired($this->translate("Required field"));
	$form->addText("txtPuppyName")->setValue($puppy->puppy_name)->setRequired($this->translate("Required field"));
	$form->addText("txtPuppyProfilePhoto")->setValue($puppy->puppy_photo)->setRequired($this->translate("Required field"));
	$form->addText("ddlDate")->setValue($date)->setRequired($this->translate("Required field"));
	$form->addSelect("ddlCountry")->setItems($countries)->setValue($puppy->country)->setRequired($this->translate("Required field"));
	$form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditPuppyProfileSucceeded');

	return $form;
    }

    protected function createComponentFormAddPedigree() {
	$dog = $this->database->table("tbl_puppies")->where("id=?", $this->dog_id)->fetch();

	$txtF = \DataModel::getFatherName($dog->puppy_name);
	$txt1 = \DataModel::getFatherName($txtF);
	$txt2 = \DataModel::getFatherName($txt1);
	$txt3 = \DataModel::getMotherName($txt1);
	$txt4 = \DataModel::getMotherName($txtF);
	$txt5 = \DataModel::getFatherName($txt4);
	$txt6 = \DataModel::getMotherName($txt4);


	$txtM = \DataModel::getMotherName($dog->puppy_name);
	$txt7 = \DataModel::getFatherName($txtM);
	$txt8 = \DataModel::getFatherName($txt7);
	$txt9 = \DataModel::getMotherName($txt7);
	$txt10 = \DataModel::getMotherName($txtM);
	$txt11 = \DataModel::getFatherName($txt10);
	$txt12 = \DataModel::getMotherName($txt10);


	$form = new Form();
	$form->addText("txtPedigreeFather")->setValue($txtF)->setRequired($this->translate("Required field"));
	$form->addText("txtPedigreeMother")->setValue($txtM)->setRequired($this->translate("Required field"));
	$form->addText("txtPedigree1")->setValue($txt1)->setRequired($this->translate("Required field"));
	$form->addText("txtPedigree2")->setValue($txt2)->setRequired($this->translate("Required field"));
	$form->addText("txtPedigree3")->setValue($txt3)->setRequired($this->translate("Required field"));
	$form->addText("txtPedigree4")->setValue($txt4)->setRequired($this->translate("Required field"));
	$form->addText("txtPedigree5")->setValue($txt5)->setRequired($this->translate("Required field"));
	$form->addText("txtPedigree6")->setValue($txt6)->setRequired($this->translate("Required field"));
	$form->addText("txtPedigree7")->setValue($txt7)->setRequired($this->translate("Required field"));
	$form->addText("txtPedigree8")->setValue($txt8)->setRequired($this->translate("Required field"));
	$form->addText("txtPedigree9")->setValue($txt9)->setRequired($this->translate("Required field"));
	$form->addText("txtPedigree10")->setValue($txt10)->setRequired($this->translate("Required field"));
	$form->addText("txtPedigree11")->setValue($txt11)->setRequired($this->translate("Required field"));
	$form->addText("txtPedigree12")->setValue($txt12)->setRequired($this->translate("Required field"));
	$form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmAddPedigreeSucceeded');
	return $form;
    }

    public function frmCreatePuppyProfileSucceeded($button) {
	$id = 0;

	try {
	    $values = $button->getForm()->getValues();

	    $time = strtotime($values['ddlDate']);
	    $values['ddlDate'] = date('Y-m-d', $time);

	    $data['user_id'] = $this->logged_in_id;
	    $data['puppy_gender'] = $values['radGender'];
	    $data['profile_id'] = $this->profile_id;
	    $data['planned_litter_id'] = $values['ddlPlannedLitter'];
	    $data['puppy_name'] = $values['txtPuppyName'];
	    $data['puppy_photo'] = $values['txtPuppyProfilePhoto'];
	    $data['date_of_birth'] = $values['ddlDate'];
	    $data['country'] = $values['ddlCountry'];


	    $planned_litter = \DataModel::getPlannedLitterById($data['planned_litter_id']);
	    $father_name = $planned_litter->dog_name;
	    $mother_name = $planned_litter->bitch_name;
	    $this->data_model->setParents($data['puppy_name'], $father_name, $mother_name);

	    $this->database->table("tbl_puppies")->insert($data);

	    $id = $this->database->getInsertId();
	} catch (\Exception $ex) {
	    $this->flashMessage($ex->getMessage(), "Error");
	}

	$this->redirect("puppy:puppy_description", array("id" => $id));
    }

    public function frmEditPuppyProfileSucceeded($button) {
	try {
	    $values = $button->getForm()->getValues();

	    $time = strtotime($values['ddlDate']);
	    $values['ddlDate'] = date('Y-m-d', $time);

	    $data['user_id'] = $this->logged_in_id;
	    $data['puppy_gender'] = $values['radGender'];
	    $data['profile_id'] = $this->profile_id;
	    $data['planned_litter_id'] = $values['ddlPlannedLitter'];
	    $data['puppy_name'] = $values['txtPuppyName'];
	    $data['puppy_photo'] = $values['txtPuppyProfilePhoto'];
	    $data['date_of_birth'] = $values['ddlDate'];
	    $data['country'] = $values['ddlCountry'];

	    $planned_litter = \DataModel::getPlannedLitterById($data['planned_litter_id']);
	    $father_name = $planned_litter->dog_name;
	    $mother_name = $planned_litter->bitch_name;
	    $this->data_model->setParents($data['puppy_name'], $father_name, $mother_name);

	    $this->database->table("tbl_puppies")->where("id=?", $this->dog_id)->update($data);
	} catch (\Exception $ex) {
	    $this->flashMessage($ex->getMessage(), "Error");
	}

	$this->redirect("puppy:puppy_description", array("id" => $this->dog_id));
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

}
