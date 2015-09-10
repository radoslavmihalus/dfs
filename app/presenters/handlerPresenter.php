<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class handlerPresenter extends BasePresenter {

    /** @persistent int */
    public $handler_id;
    public $award_id;
    public $certificate_id;
    private $logged_in_handler_id;

    protected function startup() {
	parent::startup();

	try {
	    $handler_data = $this->database->table("tbl_userhandler")->where("user_id=?", $this->logged_in_id)->fetch();
	    $this->logged_in_handler_id = $handler_data->id;
	} catch (\Exception $ex) {
	    
	}

	$result = $this->database->table("tbl_breeds");

	$i = 0;

	$dditems = "";

	foreach ($result as $row) {
	    if ($i == 0)
		$dditems .= $row->BreedName;
	    else
		$dditems .= "," . $row->BreedName;

	    $i++;
	}

//echo $dditems;
	$this->template->dd_breeds_items = $dditems;
    }

    /**
     * 
     * Render methods
     * 
     */
    public function beforeRender() {
	parent::beforeRender();
	if ($this->isAjax())
	    $this->invalidateControl('articles');
    }

    public function renderHandler_awards_list($id = 0) {
	if ($id == 0)
	    $id = $this->logged_in_handler_id;
	$this->renderHandler_profile_home($id);
	$championships = $this->database->table("tbl_handler_awards")->where("handler_id = ?", $id)->fetchAll();
	$this->template->championships = $championships;
    }

    public function renderHandler_certificates_list($id = 0) {
	if ($id == 0)
	    $id = $this->logged_in_handler_id;
	$this->renderHandler_profile_home($id);
	$certificates = $this->database->table("tbl_handler_certificates")->where("handler_id=?", $id)->fetchAll();
	$this->template->certificates = $certificates;
    }

    public function renderHandler_show_list($id = 0) {
	if ($id == 0)
	    $id = $this->logged_in_handler_id;
	$this->renderHandler_profile_home($id);
    }

    public function renderHandler_handling_breed_list($id = 0) {
	if ($id == 0)
	    $id = $this->logged_in_handler_id;
	$this->renderHandler_profile_home($id);
	$handling_breeds = $this->database->table("tbl_handler_breed")->where("handler_id=?", $id)->fetchAll();
	$this->template->handling_breeds = $handling_breeds;
    }

    public function renderHandler_list() {
	$rows = $this->database->table("tbl_userhandler")->fetchAll();

	$this->template->handler_rows = $rows;
    }

    public function renderDefault($id = 0) {
	$dog = $this->database->table("tbl_userhandler")->where("id=?", $id)->fetch();
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

    public function renderHandler_profile_home($id = 0) {
	if ($id == 0) {
	    $id = $this->logged_in_handler_id;
	    $redirect = FALSE;
	    if ($profile_data['active_profile_id'] != $id)
		$redirect = TRUE;
	    $profile_data['active_profile_id'] = $id;
	    $profile_data['active_profile_type'] = 3;
	    $this->database->table("tbl_user")->where("id=?", $this->logged_in_id)->update($profile_data);
	    $this->current_user_id = $this->logged_in_id;
	    parent::startup();
//	    if ($redirect)
//		$this->redirect("kennel:kennel_profile_home");
	} else {
	    $userRow = $this->database->table("tbl_userhandler")->where("id=?", $id)->fetch();
	    $this->current_user_id = $userRow->user_id;
	}
	$row = $this->database->query("SELECT tbl_userhandler.*, tbl_user.name, tbl_user.surname, tbl_user.state FROM tbl_userhandler INNER JOIN tbl_user ON tbl_user.id = tbl_userhandler.user_id WHERE tbl_userhandler.id=?", $id)->fetch();

	$have_puppies = FALSE;

	$profile_image = $row->handler_profile_picture;
	$logged_in_profile_id = $row->id;
	$name = $row->name . ' ' . $row->surname;
	if (strlen($row->handler_background_image) > 2) {
	    $have_background_image = TRUE;
	    $background_image = $row->handler_background_image;
	} else
	    $have_background_image = FALSE;
	$state = $row->state;

	$this->template->have_puppies = $have_puppies;
	$this->template->profile_image = $profile_image;
	$this->template->logged_in_profile_id = $logged_in_profile_id;
	$this->template->owner_name = $name;
	$this->template->have_background_image = $have_background_image;
	$this->template->background_image = $background_image;
	$this->template->state = $state;
	$this->template->handler_description = $row->handler_description;

	$this->template->profile_id = $id;

	// getTimeline        
//        $rows = NULL;
//
//        $table = "tbl_" . rand(100000000, 999999999);
//
//        if ($id == 0)
//            $this->database->query("CREATE TABLE $table SELECT tbl_timeline.*, (IF(tbl_timeline.profile_id>=300000000,(SELECT owner_profile_picture FROM tbl_userowner WHERE id=tbl_timeline.profile_id), (SELECT kennel_profile_picture FROM tbl_userkennel WHERE tbl_userkennel.id=tbl_timeline.profile_id))) as timeline_profile_image, (IF(tbl_timeline.profile_id>=300000000,(SELECT concat(tbl_user.name,' ',tbl_user.surname) as timeline_name FROM tbl_user WHERE tbl_user.id=(SELECT user_id FROM tbl_userowner WHERE id=tbl_timeline.profile_id)), (SELECT kennel_name FROM tbl_userkennel WHERE tbl_userkennel.id=tbl_timeline.profile_id))) as timeline_name FROM tbl_timeline order by `date` DESC");
//        else
//            $this->database->query("CREATE TABLE $table SELECT tbl_timeline.*, (IF(tbl_timeline.profile_id>=300000000,(SELECT owner_profile_picture FROM tbl_userowner WHERE id=tbl_timeline.profile_id), (SELECT kennel_profile_picture FROM tbl_userkennel WHERE tbl_userkennel.id=tbl_timeline.profile_id))) as timeline_profile_image, (IF(tbl_timeline.profile_id>=300000000,(SELECT concat(tbl_user.name,' ',tbl_user.surname) as timeline_name FROM tbl_user WHERE tbl_user.id=(SELECT user_id FROM tbl_userowner WHERE id=tbl_timeline.profile_id)), (SELECT kennel_name FROM tbl_userkennel WHERE tbl_userkennel.id=tbl_timeline.profile_id))) as timeline_name FROM tbl_timeline where profile_id = ? order by `date` DESC", $id);
//
//        $this->database->query("ALTER TABLE `$table` ADD PRIMARY KEY (`id`)");
//        $this->database->query("ALTER TABLE `$table` CHANGE `id` `id` BIGINT( 20 ) NOT NULL AUTO_INCREMENT");
//        
//        $rows = $this->database->table($table)->fetchAll();
	// getTimeline

	$this->template->timeline_rows = $this->data_model->getTimeline($id);
	$this->template->timeline_name = $name;
	$this->template->timeline_profile_image = $profile_image;
    }

    /**
     *  End of render methods
     */

    /**
     * Actions
     */
    public function actionHandler_handling_breed_add($id) {
	$this->handler_id = $id;
    }

    public function actionHandler_awards_edit($id) {
	$this->award_id = $id;
    }

    public function actionHandler_certificates_edit($id) {
	$this->certificate_id = $id;
    }

    public function actionHandler_awards_add($id = 0) {
	if ($id == 0)
	    $id = $this->logged_in_handler_id;
	$this->handler_id = $id;
    }

    public function actionHandler_certificates_add($id = 0) {
	if ($id == 0)
	    $id = $this->logged_in_handler_id;
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

	$form->addText("ddlBreedList")->setRequired($this->translate("Required field"));
	$form->addText("txtHandlerProfilePhoto")->setRequired($this->translate("Required field"));
	$form->addTextArea("txtHandlerDescription")->setRequired($this->translate("Required field"));
	$form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmCreateHandlerProfileSucceeded');

	return $form;
    }

    protected function createComponentFormEditHandlerProfile() {
	$data = $this->database->table("tbl_userhandler")->where("user_id=?", $this->logged_in_id)->fetch();
	$breed_rows = $this->database->query("SELECT tbl_handler_breed.breed_name FROM tbl_handler_breed WHERE handler_id=?", $data->id)->fetchAll();

	$breeds = "";
	$i = 0;
	foreach ($breed_rows as $row) {
	    if ($i == 0)
		$breeds .= $row->breed_name;
	    else
		$breeds .= "," . $row->breed_name;

	    $i++;
	}

	$form = new Form();

	$form->addText("ddlBreedList")->setValue($breeds)->setRequired($this->translate("Required field"));
	$form->addTextArea("txtHandlerDescription")->setValue($data->handler_description)->setRequired($this->translate("Required field"));
	$form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditHandlerProfileSucceeded');

	return $form;
    }

    protected function createComponentFormAddBreedForHandling() {
	$breed_rows = $this->database->query("SELECT tbl_handler_breed.breed_name FROM tbl_handler_breed WHERE handler_id=?", $this->logged_in_handler_id)->fetchAll();

	$breeds = "";
	$i = 0;
	foreach ($breed_rows as $row) {
	    if ($i == 0)
		$breeds .= $row->breed_name;
	    else
		$breeds .= "," . $row->breed_name;

	    $i++;
	}

	$form = new Form();

	$form->addText("ddlBreedList")->setValue($breeds)->setRequired($this->translate("Required field"));
	$form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditHandlerBreedSucceeded');

	return $form;
    }

    protected function createComponentFormEditHandlerProfilePicture() {
	$id = $this->handler_id;
	$form = new Form();
	$form->addText("txtHandlerProfilePhoto")->setRequired();
	$form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditHandlerProfilePictureSucceeded');
	return $form;
    }

    protected function createComponentFormAddAward() {
	$id = $this->handler_id;
	$form = new Form();
//	$form->addHidden("handler_id")->setValue($id);
	$form->addText("ddlDate")->setRequired($this->translate("Required field"));
	$form->addText("txtAwardName")->setRequired($this->translate("Required field"));
	$form->addText("txtAwardPicture");
	$form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmHandlerAddAwardSucceeded');
	$form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
	return $form;
    }

    protected function createComponentFormEditAward() {
	$row = $this->database->table("tbl_handler_awards")->where("id=?", $this->award_id)->fetch();
	$form = new Form();

	$time = strtotime($row->date);
	$date = date('d.m.Y', $time);

//	$form->addHidden("handler_id")->setValue($row->handler_id);
	$form->addText("ddlDate")->setValue($date)->setRequired($this->translate("Required field"));
	$form->addText("txtAwardName")->setValue($row->description)->setRequired($this->translate("Required field"));
	$form->addText("txtAwardPicture")->setValue($row->image);
	$form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmHandlerEditAwardSucceeded');
	return $form;
    }

    protected function createComponentFormAddCertificate() {
	$id = $this->handler_id;
	$form = new Form();
//	$form->addHidden("handler_id")->setValue($id);
	$form->addText("ddlDate")->setRequired($this->translate("Required field"));
	$form->addText("txtCertificateName")->setRequired($this->translate("Required field"));
	$form->addText("txtCertificatePicture");
	$form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmHandlerAddCertificateSucceeded');
//	$form->addSubmit('btnCancel')->onClick[] = array($this, 'formCanceled');
	return $form;
    }

    protected function createComponentFormEditCertificate() {
	$row = $this->database->table("tbl_handler_certificates")->where("id=?", $this->certificate_id)->fetch();
	$form = new Form();

	$time = strtotime($row->date);
	$date = date('d.m.Y', $time);

//	$form->addHidden("handler_id")->setValue($row->handler_id);
	$form->addText("ddlDate")->setValue($date)->setRequired($this->translate("Required field"));
	$form->addText("txtCertificateName")->setValue($row->description)->setRequired($this->translate("Required field"));
	$form->addText("txtCertificatePicture")->setValue($row->image);
	$form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmHandlerEditCertificateSucceeded');
	return $form;
    }

    protected function createComponentFormAddShowHandler() {
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

	$form->addText("txtHandlerDogName")->setRequired();
	$form->addText("txtJudgeName");
	$form->addSelect("ddlShowClass")->setPrompt($this->translate("Please select..."))->setItems($class)->setRequired();
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
	$form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmHandlerAddShowSucceeded');

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

	    $this->data_model->addToTimeline($this->handler_id, $this->handler_id, 3, \DataModel::getProfileName($this->handler_id), $values['handler_profile_picture']);
	} catch (\ErrorException $ex) {
	    $this->flashMessage($ex->getMessage(), "Error");
	}
    }

    public function frmHandlerAddAwardSucceeded($button) {
	try {
	    $values = $button->getForm()->getValues();

	    $time = strtotime($values['ddlDate']);
	    $values['ddlDate'] = date('Y-m-d', $time);

	    $data['handler_id'] = $this->logged_in_handler_id;
	    $data['description'] = $values['txtAwardName'];
	    $data['date'] = $values['ddlDate'];
	    $data['image'] = $values['txtAwardPicture'];

	    //$values = $this->data_model->assignFields($values, "frmHandlerAddTitle");
	    //unset($values["handler_id"]);

	    $this->database->table("tbl_handler_awards")->insert($data);
	    $id = $this->database->getInsertId();

	    $this->data_model->addToTimeline($this->handler_id, $id, 5, $data['description'], $data['image']);

	    $this->flashMessage($this->translate("Record has been successfully added."));
	} catch (\Exception $ex) {
	    $this->flashMessage($ex->getMessage(), "Error");
	}

	$this->redirect("handler_awards_list", $this->handler_id);
    }

    public function frmHandlerAddCertificateSucceeded($button) {
	try {
	    $values = $button->getForm()->getValues();

	    $time = strtotime($values['ddlDate']);
	    $values['ddlDate'] = date('Y-m-d', $time);

	    $data['handler_id'] = $this->logged_in_handler_id;
	    $data['description'] = $values['txtCertificateName'];
	    $data['date'] = $values['ddlDate'];
	    $data['image'] = $values['txtCertificatePicture'];

	    //$values = $this->data_model->assignFields($values, "frmHandlerAddTitle");
	    //unset($values["handler_id"]);

	    $this->database->table("tbl_handler_certificates")->insert($data);
	    $id = $this->database->getInsertId();

	    $this->data_model->addToTimeline($this->handler_id, $id, 8, $data['description'], $data['image']);


	    $this->flashMessage($this->translate("Record has been successfully added."));
	} catch (\Exception $ex) {
	    $this->flashMessage($ex->getMessage(), "Error");
	}

	$this->redirect("handler_certificates_list", $this->handler_id);
    }

    public function frmHandlerEditAwardSucceeded($button) {
	try {
	    $values = $button->getForm()->getValues();

	    $time = strtotime($values['ddlDate']);
	    $values['ddlDate'] = date('Y-m-d', $time);

	    $data = array();

	    $data['description'] = $values['txtAwardName'];
	    $data['date'] = $values['ddlDate'];
	    $data['image'] = $values['txtAwardPicture'];

	    //$values = $this->data_model->assignFields($values, "frmHandlerAddTitle");
	    //unset($values["handler_id"]);

	    $this->database->table("tbl_handler_awards")->where("id=?", $this->award_id)->update($data);
	    $this->data_model->addToTimeline($this->handler_id, $this->award_id, 6, $data['description'], $data['image']);

	    $this->flashMessage($this->translate("Record has been successfully updated."));
	} catch (\Exception $ex) {
	    $this->flashMessage($ex->getMessage(), "Error");
	}

	$this->redirect("handler_awards_list", $this->handler_id);
    }

    public function frmHandlerEditCertificateSucceeded($button) {
	try {
	    $values = $button->getForm()->getValues();

	    $time = strtotime($values['ddlDate']);
	    $values['ddlDate'] = date('Y-m-d', $time);

	    $data = array();

	    $data['description'] = $values['txtCertificateName'];
	    $data['date'] = $values['ddlDate'];
	    $data['image'] = $values['txtCertificatePicture'];

	    //$values = $this->data_model->assignFields($values, "frmHandlerAddTitle");
	    //unset($values["handler_id"]);

	    $this->database->table("tbl_handler_certificates")->where("id=?", $this->certificate_id)->update($data);
	    $this->data_model->addToTimeline($this->handler_id, $this->certificate_id, 9, $data['description'], $data['image']);

	    $this->flashMessage($this->translate("Record has been successfully updated."));
	} catch (\Exception $ex) {
	    $this->flashMessage($ex->getMessage(), "Error");
	}

	$this->redirect("handler_certificates_list", $this->handler_id);
    }

    public function frmCreateHandlerProfileSucceeded($button) {
	try {
	    $values = $button->getForm()->getValues();
	    $breeds = $values['ddlBreedList'];

	    $values = $this->data_model->assignFields($values, "frmCreateHandlerProfile");
	    $values['user_id'] = $this->logged_in_id;

	    $this->database->table("tbl_userhandler")->insert($values);
	    $id = $this->database->getInsertId();

	    $breeds = explode(",", $breeds);

	    foreach ($breeds as $breed) {
		$this->database->query("INSERT INTO tbl_handler_breed(kennel_id, breed_name) VALUES(?,?)", $id, $breed);
	    }

	    $this->data_model->addToTimeline($id, $id, 1, \DataModel::getProfileName($id), $values['handler_profile_picture']);

	    $this->flashMessage("Your profile successfully created.", "Success");
	    $this->redirect("handler:handler_profile_home");
	} catch (\ErrorException $ex) {
	    $this->flashMessage($ex->getMessage(), "Error");
	}
    }

    public function frmEditHandlerProfileSucceeded($button) {
	try {
	    $values = $button->getForm()->getValues();
	    $breeds = $values['ddlBreedList'];
	    $values = $this->data_model->assignFields($values, "frmHandlerEditProfile");

	    $this->database->table("tbl_userhandler")->where("id=?", $this->logged_in_handler_id)->update($values);

	    $this->database->table("tbl_handler_breed")->where("handler_id=?", $this->logged_in_handler_id)->delete();

	    $breeds = explode(",", $breeds);

	    foreach ($breeds as $breed) {
		$this->database->query("INSERT INTO tbl_handler_breed(handler_id, breed_name) VALUES(?,?)", $this->logged_in_handler_id, $breed);
	    }

	    $this->data_model->addToTimeline($this->logged_in_handler_id, $this->logged_in_handler_id, 2, \DataModel::getProfileName($this->logged_in_handler_id), $values['handler_profile_picture']);

	    $this->flashMessage("Your profile successfully updated.", "Success");
	    $this->redirect("handler:handler_profile_home");
	} catch (\ErrorException $ex) {
	    $this->flashMessage($ex->getMessage(), "Error");
	}
    }

    public function frmEditHandlerBreedSucceeded($button) {
	try {
	    $values = $button->getForm()->getValues();
	    $breeds = $values['ddlBreedList'];

	    $this->database->table("tbl_handler_breed")->where("handler_id=?", $this->logged_in_handler_id)->delete();

	    $breeds = explode(",", $breeds);

	    foreach ($breeds as $breed) {
		$this->database->query("INSERT INTO tbl_handler_breed(handler_id, breed_name) VALUES(?,?)", $this->logged_in_handler_id, $breed);
	    }

	    $this->data_model->addToTimeline($this->logged_in_handler_id, $this->logged_in_handler_id, 2, \DataModel::getProfileName($this->logged_in_handler_id), $values['handler_profile_picture']);

	    $this->flashMessage("Your profile successfully updated.", "Success");
	    $this->redirect("handler:handler_handling_breed_list", array("id" => $this->logged_in_handler_id));
	} catch (\ErrorException $ex) {
	    $this->flashMessage($ex->getMessage(), "Error");
	}
    }

    public function frmHandlerAddShowSucceeded($button) {
	$values = $button->getForm()->getValues();

	$data = array();

	$data['dog_name'] = $values->txtHandlerDogName;
	$data['judge_name'] = $values->txtJudgeName;
	$data['show_class'] = $values->ddlShowClass;

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

	$this->database->table("tbl_handler_shows")->insert($data);
	
	$this->redirect("handler_show_list");
    }

    public function formCanceled() {
	$this->redirect('dog:dog_championschip_list', $this->handler_id);
    }

}
