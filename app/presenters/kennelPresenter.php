<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class kennelPresenter extends BasePresenter {

    /** @var Model\AlbumRepository */
//private $albums;
//    public function __construct() {
//        
//    }
//    private $database;
    private $logged_in_kennel_id;
    private $award_id;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
        $this->data_model = new \DataModel($database);
        $this->translator = new DFSTranslator();
    }

    protected function startup() {
        parent::startup();
        try {
            $kennel_data = $this->database->table("tbl_userkennel")->where("user_id=?", $this->logged_in_id)->fetch();
            $this->logged_in_kennel_id = $kennel_data->id;
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

    /*     * ******************* view default ******************** */

    public function beforeRender() {
        parent::beforeRender();

        if ($this->isAjax())
            $this->invalidateControl('articles');
    }

    /*     * ******** renderers ************* */

    public function renderKennel_list() {
        $rows = $this->database->query("SELECT tbl_userkennel.*, tbl_user.state, FALSE as have_puppies FROM tbl_userkennel INNER JOIN tbl_user ON tbl_user.id = tbl_userkennel.user_id")->fetchAll();

        $this->template->result = $rows;
    }

    public function renderKennel_awards_list($id = 0) {
        $this->renderKennel_profile_home($id);
        if ($id == 0)
            $id = $this->logged_in_kennel_id;

        $result_awards = $this->database->table("link_kennel_awards")->where("kennel_id=?", $id)->order("kennel_award_date DESC")->fetchAll();

        $this->template->result_awards = $result_awards;
    }

    public function renderKennel_profile_home($id = 0) {
        if ($id == 0) {
            $id = $this->logged_in_kennel_id;
            $redirect = FALSE;
            if ($profile_data['active_profile_id'] != $id)
                $redirect = TRUE;
            $profile_data['active_profile_id'] = $id;
            $profile_data['active_profile_type'] = 1;
            $this->database->table("tbl_user")->where("id=?", $this->logged_in_id)->update($profile_data);
            $this->current_user_id = $this->logged_in_id;
            parent::startup();
//	    if ($redirect)
//		$this->redirect("kennel:kennel_profile_home");
        } else {
            $userRow = $this->database->table("tbl_userkennel")->where("id=?", $id)->fetch();
            $this->current_user_id = $userRow->user_id;
        }



        $row = $this->database->query("SELECT tbl_userkennel.*, tbl_user.state FROM tbl_userkennel INNER JOIN tbl_user ON tbl_user.id = tbl_userkennel.user_id WHERE tbl_userkennel.id=?", $id)->fetch();

        $have_puppies = \DataModel::havePuppies($id);

        $profile_image = $row->kennel_profile_picture;
        $logged_in_profile_id = $row->id;
        $name = $row->kennel_name;
        if (strlen($row->kennel_background_image) > 2) {
            $have_background_image = TRUE;
            $background_image = $row->kennel_background_image;
        } else
            $have_background_image = FALSE;
        $state = $row->state;

        $this->template->have_puppies = $have_puppies;
        $this->template->profile_image = $profile_image;
        $this->template->logged_in_profile_id = $logged_in_profile_id;
        $this->template->kennel_name = $name;
        $this->template->have_background_image = $have_background_image;
        $this->template->background_image = $background_image;
        $this->template->state = $state;

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

        $this->renderKennel_description_home($id);
        $this->renderKennel_dog_list_home($id);
    }

    public function renderKennel_dog_list($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_kennel_id;
        $rows = $this->database->table("tbl_dogs")->where("profile_id=?", $id)->order("id DESC")->fetchAll();
        $this->template->rows = $rows;
        $this->renderKennel_profile_home($id);
    }

    public function renderKennel_planned_litter_list($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_kennel_id;
        $rows = $this->database->table("tbl_planned_litters")->where("kennel_id=?", $id)->order("year,month DESC")->fetchAll();
        $this->template->planned_litter_rows = $rows;
        $this->renderKennel_profile_home($id);
    }

    public function renderPlanned_litter_list($id = 0) {
        $rows = $this->database->table("tbl_planned_litters")->order("year,month DESC")->fetchAll();
        $this->template->planned_litter_rows = $rows;
        //$this->renderKennel_profile_home($id);
    }

    public function renderKennel_puppy_list($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_kennel_id;
        $rows = $this->database->table("tbl_planned_litters")->where("kennel_id=?", $id)->order("year,month DESC")->fetchAll();
        $this->template->planned_litters = $rows;
        $this->renderKennel_profile_home($id);
    }

    public function renderKennel_photogallery($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_kennel_id;
        $rows = $this->database->table("tbl_photos")->where("profile_id=?", $id)->fetchAll();
        $this->template->photos = $rows;
        $this->renderKennel_profile_home($id);
    }

    public function renderKennel_dog_list_home($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_kennel_id;
        $rows = $this->database->table("tbl_dogs")->where("profile_id=? AND user_id=?", $id, $this->current_user_id)->fetchAll();
        $this->template->rows = $rows;
    }

    public function renderKennel_description_home($id = 0) {
//        $row = $this->database->query("SELECT tbl_userkennel.*, link_kennel_breed.breed_name FROM tbl_userkennel INNER JOIN link_kennel_breed ON link_kennel_breed.kennel_id = tbl_userkennel.id WHERE tbl_userkennel.id=?", $id)->fetch();
        $row = $this->database->query("SELECT tbl_userkennel.* FROM tbl_userkennel WHERE tbl_userkennel.id=?", $id)->fetch();

        $have_puppies = FALSE;

        $kennel_fci_number = $row->kennel_fci_number;
        $logged_in_profile_id = $row->id;
        $kennel_description = $row->kennel_description;
        $kennel_website = $row->kennel_website;

        $this->template->kennel_fci_number = $kennel_fci_number;
        $this->template->kennel_description = $kennel_description;
        $this->template->kennel_website = $kennel_website;

        $breeds = $this->database->query("SELECT link_kennel_breed.breed_name FROM link_kennel_breed WHERE kennel_id=?", $row->id)->fetchAll();

        $this->template->breeds = $breeds;
    }

    /*     * ******** renderers ************* */

    /*     * ******** actions ************* */

    public function actionKennel_awards_edit($id) {
        $this->award_id = $id;
    }

    /*     * ******** actions ************* */

    /*     * ******** handlers ************* */

    public function handleDeleteAward($id) {
        $award = $this->database->table("link_kennel_awards")->where("id=?", $id)->fetch();
        $kennel = $this->database->table("tbl_userkennel")->where("id=?", $award->kennel_id)->fetch();

        if ($kennel->user_id == $this->logged_in_id)
            $this->database->table("link_kennel_awards")->where("id=?", $id)->delete();

        $this->redirect("kennel_awards_list", array("id" => $kennel->id));
    }

    /*     * ******** handlers ************* */


    /*     * ****************** component factories ******************** */

//Create profile

    protected function createComponentKennelCreateProfile() {

        $form = new Form();
        $form->addText('txtKennelName')->setRequired($this->translate("Required field"));
        $form->addText('txtKennelFciNumber');
        $form->addText('txtKennelProfilePicture')->setRequired($this->translate("Required field"));
        $form->addText('txtKennelWebsite');
        $form->addTextArea('txtKennelDescription');
        $form->addText('ddlBreedList')->setRequired($this->translate("Required field"));
        $form->addSubmit('btnSubmit', 'Create profile')->onClick[] = array($this, 'frmCreateProfileSucceeded');

        return $form;
    }

//Update profile

    protected function createComponentKennelEditProfile() {
        $data = $this->database->table("tbl_userkennel")->where("user_id=?", $this->logged_in_id)->fetch();

        $form = new Form();

        $breed_rows = $this->database->query("SELECT link_kennel_breed.breed_name FROM link_kennel_breed WHERE kennel_id=?", $data->id)->fetchAll();

        $breeds = "";
        $i = 0;
        foreach ($breed_rows as $row) {
            if ($i == 0)
                $breeds .= $row->breed_name;
            else
                $breeds .= "," . $row->breed_name;

            $i++;
        }

        $form->addText('txtKennelName')->setValue($data->kennel_name)->setRequired($this->translate("Required field"));
        $form->addText('txtKennelFciNumber')->setValue($data->kennel_fci_number);
        $form->addText('txtKennelWebsite')->setValue($data->kennel_website);
        $form->addTextArea('txtKennelDescription')->setValue($data->kennel_description);
        $form->addText("ddlBreedList")->setValue($breeds)->setRequired($this->translate("Required field"));
        $this->template->breeds = $breeds;
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditProfileSucceeded');

        return $form;
    }

    protected function createComponentKennelEditProfileCoverImage() {
        $form = new Form();

        $form->addHidden('txtKennelCoverPhoto')->setRequired($this->translate("Required field"));
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditProfileCoverImageSuccess');

        return $form;
    }

    protected function createComponentKennelEditProfileImage() {
        $form = new Form();

        $form->addHidden('txtKennelProfilePicture')->setRequired($this->translate("Required field"));
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditProfileImageSuccess');

        return $form;
    }

    protected function createComponentFrmAddAward() {
        $form = new Form();

        $form->addText("ddlDate")->setRequired($this->translate("Required field"));
        $form->addText("txtAwardName")->setRequired($this->translate("Required field"));
        $form->addHidden("txtAwardPicture");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmAddAwardSuccess');

        return $form;
    }

    protected function createComponentFrmEditAward() {

        $parid = $this->award_id;

        $row = $this->database->table("link_kennel_awards")->where("id = ?", $parid)->fetch();

        $form = new Form();

        $time = strtotime($row->kennel_award_date);
        $date = date('d.m.Y', $time);

        $form->addText("ddlDate")->setRequired($this->translate("Required field"))->setValue($date);
        $form->addText("txtAwardName")->setRequired($this->translate("Required field"))->setValue($row->kennel_award_title);
        $form->addHidden("txtAwardPicture")->setValue($row->kennel_award_image);
        $form->addHidden("hidAwardId")->setValue($row->id);
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditAwardSuccess');

        return $form;
    }

    protected function createComponentFormAddPlannedLitter() {
        $form = new Form();

        $years = array();
        $months = array();

        $y = date("Y");
        $yf = $y + 3;
        $yt = $y - 10;

        for ($i = $yf; $i > $yt; $i--) {
            $years[$i] = $i;
        }

        for ($i = 1; $i < 13; $i++) {
            $months[$i] = $i;
        }

        $lang = "en";

        try {
            $section = $this->getSession('language');
            if (strlen($section->lang) > 1)
                $lang = strtolower($section->lang);
        } catch (Exception $ex) {
            $lang = "en";
        }

        $countries = array();

        $rows = $this->database->table("lk_countries")->order("CountryName_$lang")->fetchAll();

        foreach ($rows as $country) {
            $countries[$country->CountryName_en] = $this->translate($country->CountryName_en);
        }

        $form->addSelect("ddlDateYear")->setRequired($this->translate("Required field"))->setItems($years);
        $form->addSelect("ddlDateMonth")->setRequired($this->translate("Required field"))->setItems($months); //->setRequired();
        $form->addText("txtPlannedLitterName")->setRequired($this->translate("Required field")); //->setRequired();
        $form->addText("ddlPlannedLitterDogName")->setRequired($this->translate("Required field")); //->setRequired();
        $form->addText("ddlPlannedLitterBitchName")->setRequired($this->translate("Required field")); //->setRequired();
        $form->addText("txtPlannedLitterDogProfilePhoto")->setRequired($this->translate("Required field")); //->setRequired();
        $form->addText("txtPlannedLitterBitchProfilePhoto")->setRequired($this->translate("Required field")); //->setRequired();
        $form->addText("ddlBreedList")->setRequired($this->translate("Required field")); //->setRequired();
        $form->addSelect("ddlCountry")->setItems($countries)->setPrompt($this->translate("Please select country..."))->setRequired($this->translate("Required field")); //->setRequired();
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmAddPlannedLitterSuccess');
        //$form->addSubmit('btnCancel')->onClick[] = array($this, 'frmAddPlannedLitterCancel');

        return $form;
    }

    /*     * ****************** component factories ******************** */

    public function frmCreateProfileSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $breeds = $values['ddlBreedList'];

            $form = $button->getForm();

            $values = $this->data_model->assignFields($values, 'frmKennelCreateProfile');
            $values['user_id'] = $this->logged_in_id;

            $this->database->table("tbl_userkennel")->insert($values);
            $id = $this->database->getInsertId();

            $breeds = explode(",", $breeds);

            foreach ($breeds as $breed) {
                $this->database->query("INSERT INTO link_kennel_breed(kennel_id, breed_name) VALUES(?,?)", $id, $breed);
            }

            $this->data_model->addToTimeline($id, $id, 1, $values['kennel_name'], $values['kennel_profile_picture']);

            $this->flashMessage($this->translate("Profile has been successfully created."), "Success");
            $this->redirect("kennel:kennel_profile_home");
        } catch (\ErrorException $exc) {
            $this->flashMessage($exc->getMessage(), "Error");
        }


//var_dump($values);
    }

    public function frmEditProfileSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $breeds = $values['ddlBreedList'];

            $breeds = explode(",", $breeds);

            foreach ($breeds as $breed) {
                $result = $this->database->table("tbl_breeds")->where("BreedName=?", $breed)->count();

                if ($result == 0)
                    throw new \ErrorException($this->translate("Breed list does not contain entered breed"));
            }

            $values = $this->data_model->assignFields($values, 'frmKennelEditProfile');

            var_dump($values);

            $this->database->table("tbl_userkennel")->where("user_id = ?", $this->logged_in_id)->update($values);

            $row = $this->database->table("tbl_userkennel")->where("user_id = ?", $this->logged_in_id)->fetch();

            $id = $row->id;

            $this->database->table("link_kennel_breed")->where("kennel_id=?", $id)->delete();

            foreach ($breeds as $breed) {
                $this->database->query("INSERT INTO link_kennel_breed(kennel_id, breed_name) VALUES(?,?)", $id, $breed);
            }

            $this->data_model->addToTimeline($id, $id, 2, $row->kennel_name, $row->kennel_profile_picture);

            $this->flashMessage($this->translate("Profile has been successfully updated."), "Success");
            $this->redirect("kennel:kennel_profile_home", $id);
        } catch (\ErrorException $exc) {
            $this->flashMessage($exc->getMessage(), "Error");
        }
    }

    public function frmEditProfileImageSuccess($button) {
        $values = $button->getForm()->getValues();

        $values = $this->data_model->assignFields($values, 'frmEditProfileImage');
        $values['user_id'] = $this->logged_in_id;

        $mysection = $this->getSession('userdata');
        $myid = $mysection->id;

        $this->database->table("tbl_userkennel")->where("user_id = ?", $myid)->update($values);

        $userdata = $this->database->table("tbl_userkennel")->where("user_id = ?", $myid)->fetch();

        $this->data_model->addToTimeline($userdata->id, $userdata->id, 3, $userdata->kennel_name, $userdata->kennel_profile_picture);
    }

    public function frmEditProfileCoverImageSuccess($button) {
        $values = $button->getForm()->getValues();

        $values = $this->data_model->assignFields($values, 'frmEditProfileCoverImage');
        $values['user_id'] = $this->logged_in_id;

        $mysection = $this->getSession('userdata');
        $myid = $mysection->id;

        $this->database->table("tbl_userkennel")->where("user_id = ?", $myid)->update($values);

        $userdata = $this->database->table("tbl_userkennel")->where("user_id = ?", $myid)->fetch();

        $this->data_model->addToTimeline($userdata->id, $userdata->id, 4, $userdata->kennel_name, $userdata->kennel_profile_picture);
    }

    public function frmAddAwardSuccess($button) {
        try {
            $values = $button->getForm()->getValues();

            $form = $button->getForm();

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values = $this->data_model->assignFields($values, 'frmAddAward');
            $values['kennel_id'] = $this->logged_in_kennel_id;

            $this->database->table("link_kennel_awards")->insert($values);
            $id = $this->database->getInsertId();

            $this->data_model->addToTimeline($this->logged_in_kennel_id, $id, 5, date("d.m.Y", strtotime($values['kennel_award_date'])) . " - " . $values['kennel_award_title'], $values['kennel_award_image']);

            $this->flashMessage($this->translate("Record has been successfully added."), "Success");
            $this->redirect("kennel:kennel_awards_list");
        } catch (\ErrorException $exc) {
            $this->flashMessage($exc->getMessage(), "Error");
        }
    }

    public function frmEditAwardSuccess($button) {
        try {
            $values = $button->getForm()->getValues();

            $id = $this->award_id;

            $form = $button->getForm();

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values = $this->data_model->assignFields($values, 'frmEditAward');
            //$values['kennel_id'] = $this->logged_in_kennel_id;

            $this->database->table("link_kennel_awards")->where("id = ?", $id)->update($values);

            $this->data_model->addToTimeline($this->logged_in_kennel_id, $id, 6, date("d.m.Y", strtotime($values['kennel_award_date'])) . " - " . $values['kennel_award_title'], $values['kennel_award_image']);

            $this->flashMessage($this->translate("Record has been successfully updated."), "Success");
            $this->redirect("kennel:kennel_awards_list");
        } catch (\ErrorException $exc) {
            $this->flashMessage($exc->getMessage(), "Error");
        }
    }

    public function frmAddPlannedLitterSuccess($button) {
        try {
            $values = $button->getForm()->getValues();

            $exc = "<ul>";

            if ($values['txtPlannedLitterName'] == "") {
                $exc .= "<li>" . $this->translate("Name of planned litter can't be empty") . "</li>";
            }

            if ($values['ddlPlannedLitterDogName'] == "") {
                $exc .= "<li>" . $this->translate("Dog name can't be empty") . "</li>";
            }

            if ($values['ddlPlannedLitterDogName'] == "") {
                $exc .= "<li>" . $this->translate("Dog image can't be empty") . "</li>";
            }

            if ($values['ddlPlannedLitterDogName'] == "") {
                $exc .= "<li>" . $this->translate("Bitch name can't be empty") . "</li>";
            }

            if ($values['ddlPlannedLitterDogName'] == "") {
                $exc .= "<li>" . $this->translate("Bitch image can't be empty") . "</li>";
            }

            $exc .= "</ul>";

            if ($exc != "<ul></ul>")
                throw new \ErrorException($exc);


            $values['kennel_id'] = $this->logged_in_kennel_id;

            $values = $this->data_model->assignFields($values, "frmPlannedLitter");

            $this->database->table("tbl_planned_litters")->insert($values);
            $id = $this->database->getInsertId();

            $this->data_model->addToTimeline($this->logged_in_kennel_id, $id, 7, $values['name'] . " - " . $values['month'] . "/" . $values['year'], $values['dog_image']);
            $this->redirect("kennel_planned_litter_list", array(id => $this->logged_in_kennel_id));
        } catch (\ErrorException $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
    }

}
