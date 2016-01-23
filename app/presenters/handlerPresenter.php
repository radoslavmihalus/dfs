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
    public $show_id;
    public $show_group_id;
    private $logged_in_handler_id;
    public $filter_handler_name;
    public $filter_handler_country;
    public $filter_handler_breed;

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

    /*     * ******** renderers ************* */

    public function actionHandler_list($lang) {
        $mysection = $this->getSession('language');

        $mysection->lang = $lang;

        $this->translator->lang = $mysection->lang;

        $this->template->lang = $this->translator->lang;
    }

    public function renderHandler_awards_list($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_handler_id;
        $this->renderHandler_profile_home($id);
        $championships = $this->database->table("tbl_handler_awards")->where("handler_id = ?", $id)->order("date DESC")->fetchAll();
        $this->template->championships = $championships;
    }

    public function renderHandler_certificates_list($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_handler_id;
        $this->renderHandler_profile_home($id);
        $certificates = $this->database->table("tbl_handler_certificates")->where("handler_id=?", $id)->order("date DESC")->fetchAll();
        $this->template->certificates = $certificates;
    }

    public function renderHandler_show_list($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_handler_id;
        $this->renderHandler_profile_home($id);

        $handler_shows = $this->database->table("tbl_handler_show_groups")->where("handler_id=?", $id)->order("show_date DESC")->fetchAll();

        $this->template->handler_shows = $handler_shows;
    }

    public function renderHandler_handling_breed_list($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_handler_id;
        $this->renderHandler_profile_home($id);
        $handling_breeds = $this->database->table("tbl_handler_breed")->where("handler_id=?", $id)->fetchAll();
        $this->template->handling_breeds = $handling_breeds;
    }

    public function renderHandler_list() {
        try {
            $section = $this->getSession('handler_filter');

            $this->filter_handler_name = $section->filter_handler_name;
            $this->filter_handler_breed = $section->filter_handler_breed;
            $this->filter_handler_country = $section->filter_handler_country;

            if ($this->filter_handler_name == NULL)
                $this->filter_handler_name = "";
            if ($this->filter_handler_breed == NULL)
                $this->filter_handler_breed = "";
            if ($this->filter_handler_country == NULL)
                $this->filter_handler_country = "";
        } catch (\Exception $ex) {
            if ($this->filter_handler_name == NULL)
                $this->filter_handler_name = "";
            if ($this->filter_handler_breed == NULL)
                $this->filter_handler_breed = "";
            if ($this->filter_handler_country == NULL)
                $this->filter_handler_country = "";
        }

        $users_id = array();

        if (strlen($this->filter_handler_breed) > 1) {
            $breeds = $this->database->table("tbl_handler_breed")->select("handler_id")->where("breed_name LIKE ?", "%" . $this->filter_handler_breed . "%")->group("handler_id")->fetchAll();

            $hids = array();

            foreach ($breeds as $breed) {
                $hids[] = $breed->handler_id;
            }

            $handlers = $this->database->table("tbl_userhandler")->select("user_id")->where("id IN ?", $hids)->group("user_id")->fetchAll();

            $uids = array();

            foreach ($handlers as $handler) {
                $uids[] = $handler->user_id;
            }

            $users = $this->database->table("tbl_user")->select("id")
                    ->where("concat(name,' ',surname) LIKE ?", "%" . $this->filter_handler_name . "%")
                    ->where("state LIKE ?", "%" . $this->filter_handler_country . "%")
                    ->where("id IN ?", $uids)
                    ->fetchAll();
        } else {
            $users = $this->database->table("tbl_user")->select("id")
                    ->where("concat(name,' ',surname) LIKE ?", "%" . $this->filter_handler_name . "%")
                    ->where("state LIKE ?", "%" . $this->filter_handler_country . "%")
                    ->fetchAll();
        }

        foreach ($users as $user) {
            $users_id[] = $user->id;
        }

        $count = $this->database->table("tbl_userhandler")->where("user_id IN ?", $users_id)->count();

        $this->paginator->getPaginator()->setItemCount($count);
        $this->paginator->getPaginator()->setItemsPerPage(20);

        $rows = $this->database->table("tbl_userhandler")
                        ->where("user_id IN ?", $users_id)
//                        ->order('premium_expiry_date DESC, id DESC')
                        ->order('id DESC')
                        ->limit($this->paginator->getPaginator()->getLength(), $this->paginator->getPaginator()->getOffset())->fetchAll();

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

    public function renderHandler_photogallery($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_handler_id;
        $rows = $this->database->table("tbl_photos")->where("profile_id=?", $id)->fetchAll();
        $this->template->photos = $rows;
        $this->renderHandler_profile_home($id);
    }

    public function renderHandler_videogallery($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_handler_id;
        $rows = $this->database->table("tbl_videos")->where("profile_id=?", $id)->fetchAll();
        $this->template->photos = $rows;
        $this->renderHandler_profile_home($id);
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
        $user_row = $this->database->table("tbl_user")->where("id=?", $this->logged_in_id)->fetch();

        $have_puppies = \DataModel::havePuppies($id);

        $profile_image = $row->handler_profile_picture;
        $this->logged_in_profile_id = $user_row->active_profile_id;
        $name = $row->name . ' ' . $row->surname;
        if (strlen($row->handler_background_image) > 2) {
            $have_background_image = TRUE;
            $background_image = $row->handler_background_image;
        } else
            $have_background_image = FALSE;
        $state = $row->state;

        $this->template->have_puppies = $have_puppies;
        $this->template->profile_image = $profile_image;
        $this->template->logged_in_profile_id = $this->logged_in_profile_id;
        $this->template->owner_name = $name;
        $this->template->have_background_image = $have_background_image;
        $this->template->background_image = $background_image;
        $this->template->state = $state;
        $this->template->handler_description = $row->handler_description;

        $this->template->profile_id = $id;

        try {
            $this->page_title = "DOGFORSHOW - " . \DataModel::getProfileName($id);
        } catch (\Exception $ex) {
            $this->page_title = "DOGFORSHOW";
        }

        $this->template->page_title = $this->page_title;
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

        $count = $this->data_model->getTimelineCount($id);

        $this->paginator->getPaginator()->setItemCount($count);
        $this->paginator->getPaginator()->setItemsPerPage(20);

        $this->template->timeline_rows = $this->data_model->getTimeline($id, $this->paginator->getPaginator()->getLength(), $this->paginator->getPaginator()->getOffset());
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

        if (!\DataModel::getPremium($this->logged_in_id)) {
            $cnt = $this->database->table("tbl_handler_awards")->where("handler_id=?", $this->handler_id)->count();

            if ($cnt > 4) {
                $this->redirect("user:user_premium");
                $this->terminate();
            }
        }
    }

    public function actionHandler_certificates_add($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_handler_id;
        $this->handler_id = $id;

        if (!\DataModel::getPremium($this->logged_in_id)) {
            $cnt = $this->database->table("tbl_handler_certificates")->where("handler_id=?", $this->handler_id)->count();

            if ($cnt > 4) {
                $this->redirect("user:user_premium");
                $this->terminate();
            }
        }
    }

    public function actionHandler_show_edit($id = 0) {
        $this->show_id = $id;
    }

    public function actionHandler_show_edit_name($show_id = 0) {
        $this->show_id = $show_id;
    }

    public function actionHandler_show_add_name($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_handler_id;
        $this->handler_id = $id;

        if (!\DataModel::getPremium($this->logged_in_id)) {
            $cnt = $this->database->table("tbl_handler_show_groups")->where("handler_id=?", $this->handler_id)->count();

            if ($cnt > 4) {
                $this->redirect("user:user_premium");
                $this->terminate();
            }
        }
    }

    public function actionHandler_show_add($show_id = 0) {
        $this->show_group_id = $show_id;
    }

    public function actionHandler_create_profile($id) {
        if (!\DataModel::getPremium($this->logged_in_id)) {
            if (\DataModel::hasProfile($this->logged_in_id)) {
                $this->redirect("user:user_premium");
                $this->terminate();
            }
        }
    }

    /**
     * End of actions
     */

    /**
     * handlers
     */
    public function handleDeleteAward($id) {
        $certificate = $this->database->table("tbl_handler_awards")->where("id=?", $id)->fetch();
        $handler = $this->database->table("tbl_userhandler")->where("id=?", $certificate->handler_id)->fetch();

        if ($this->logged_in_id == $handler->user_id) {
            $this->database->table("tbl_handler_awards")->where("id=?", $id)->delete();
            $this->database->table("tbl_timeline")->where("event_id=?", $id)->delete();
        }

        $this->redirect("handler_awards_list", array("id" => $handler->id));
    }

    public function handleDeleteCertificate($id) {
        $certificate = $this->database->table("tbl_handler_certificates")->where("id=?", $id)->fetch();
        $handler = $this->database->table("tbl_userhandler")->where("id=?", $certificate->handler_id)->fetch();

        if ($this->logged_in_id == $handler->user_id) {
            $this->database->table("tbl_handler_awards")->where("id=?", $id)->delete();
            $this->database->table("tbl_timeline")->where("event_id=?", $id)->delete();
        }

        $this->redirect("handler_certificates_list", array("id" => $handler->id));
    }

    /**
     * End of handlers
     */

    /**
     * 
     * FormComponents factory
     */
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
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmHandlerAddShowSucceeded');

        return $form;
    }

    protected function createComponentFormEditShowHandler() {
        $form = new Form();

        $show = $this->database->table("tbl_handler_shows")->where("id=?", $this->show_id)->fetch();

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

        $form->addText("txtHandlerDogName")->setValue($show->dog_name)->setRequired();
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
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmHandlerEditShowSucceeded');

        return $form;
    }

    function createComponentFormAddShowNameHandler() {
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
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmHandlerAddShowNameSucceeded');

        return $form;
    }

    function createComponentFormEditShowNameHandler() {
        $form = new Form();

        $show = $this->database->table("tbl_handler_show_groups")->where("id=?", $this->show_id)->fetch();
        $time = strtotime($show->show_date);
        $date = date('d.m.Y', $time);

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

        $form->addText("ddlDate")->setValue($date)->setRequired();
        $form->addSelect("ddlShowType")->setItems($show_types)->setValue($show->show_type)->setPrompt($this->translate("Please select"))->setRequired();
        $form->addText("txtShowName")->setValue($show->show_name)->setRequired();
        $form->addSelect("ddlCountry")->setItems($countries)->setValue($show->show_country)->setPrompt($this->translate("Please select"))->setRequired();
        $form->addSubmit("btnSubmit", "Edit")->onClick[] = array($this, 'frmHandlerEditShowNameSucceeded');

        return $form;
    }

    protected function createComponentHandler_list_filter() {
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

        $this->filter_handler_name = NULL;
        $this->filter_handler_breed = NULL;
        $this->filter_handler_country = NULL;

        try {
            $section = $this->getSession('handler_filter');

            $this->filter_handler_name = $section->filter_handler_name;
            $this->filter_handler_breed = $section->filter_handler_breed;
            $this->filter_handler_country = $section->filter_handler_country;
        } catch (\Exception $ex) {
            
        }

        $form->addText("txtHandlerName")->setValue($this->filter_handler_name);
        $form->addSelect("ddlCountry")->setPrompt($this->translate("Please select"))->setItems($countries)->setValue($this->filter_handler_country);
        $form->addText("ddlBreedList")->setValue($this->filter_handler_breed);
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmSubmitHandlerFilter');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'frmCancelHandlerFilter');

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
    public function frmSubmitHandlerFilter($button) {
        $values = $button->getForm()->getValues();

        $section = $this->getSession('handler_filter');

        $this->filter_handler_name = $values->txtHandlerName;
        $this->filter_handler_breed = $values->ddlBreedList;
        $this->filter_handler_country = $values->ddlCountry;

        $section->filter_handler_name = $this->filter_handler_name;
        $section->filter_handler_breed = $this->filter_handler_breed;
        $section->filter_handler_country = $this->filter_handler_country;

        $this->redirect("this");
    }

    public function frmCancelHandlerFilter($button) {
        $values = $button->getForm()->getValues();

        $section = $this->getSession('handler_filter');

        $section->filter_handler_name = NULL;
        $section->filter_handler_breed = NULL;
        $section->filter_handler_country = NULL;

        $this->redirect("this");
    }

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

            $this->flashMessage($this->translate("Profile has been successfully updated."), "Success");
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

            $this->flashMessage($this->translate("Profile has been successfully updated."), "Success");
            $this->redirect("handler:handler_handling_breed_list", array("id" => $this->logged_in_handler_id));
        } catch (\ErrorException $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
    }

    public function frmHandlerAddShowSucceeded($button) {
        $values = $button->getForm()->getValues();

        $data = array();

        $data['show_id'] = $this->show_group_id;
        $data['dog_name'] = $values->txtHandlerDogName;
        $data['judge_name'] = $values->txtJudgeName;
        $data['show_class'] = $values->ddlShowClass;

        $data['handler_id'] = $this->logged_in_handler_id;

        try {
            $show_group = $this->database->table("tbl_handler_show_groups")->where("id=?", $this->show_group_id)->fetch();
            $date = date("d.m.Y", strtotime($show_group->show_date));
            $result = $date . " - " . $show_group->show_name . ": ";
        } catch (\Exception $ex) {
            $result = "";
        }

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

        $this->database->table("tbl_handler_shows")->insert($data);
        $id = $this->database->getInsertId();

        $this->data_model->addToTimeline($this->logged_in_handler_id, $id, 11, $result, $values->txtShowImage);

        $this->redirect("handler_show_list");
    }

    public function frmHandlerEditShowSucceeded($button) {
        $values = $button->getForm()->getValues();

        $data = array();

        $data['dog_name'] = $values->txtHandlerDogName;
        $data['judge_name'] = $values->txtJudgeName;
        $data['show_class'] = $values->ddlShowClass;

        $data['handler_id'] = $this->logged_in_handler_id;

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

        $this->database->table("tbl_handler_shows")->where("id=?", $this->show_id)->update($data);

        $this->redirect("handler_show_list");
    }

    public function frmHandlerAddShowNameSucceeded($button) {
        $values = $button->getForm()->getValues();
        $data = array();
        $time = strtotime($values['ddlDate']);
        $values['ddlDate'] = date('Y-m-d', $time);

//ddlDate,ddlShowType,txtShowName,ddlCountry
        $data['handler_id'] = $this->logged_in_handler_id;
        $data['show_date'] = $values->ddlDate;
        $data['show_name'] = $values->txtShowName;
        $data['show_type'] = $values->ddlShowType;
        $data['show_country'] = $values->ddlCountry;

        $this->database->table("tbl_handler_show_groups")->insert($data);
        $this->redirect("handler_show_list");
    }

    public function frmHandlerEditShowNameSucceeded($button) {
        $values = $button->getForm()->getValues();
        $data = array();
        $time = strtotime($values['ddlDate']);
        $values['ddlDate'] = date('Y-m-d', $time);

//ddlDate,ddlShowType,txtShowName,ddlCountry
//$data['handler_id'] = $this->logged_in_handler_id;
        $data['show_date'] = $values->ddlDate;
        $data['show_name'] = $values->txtShowName;
        $data['show_type'] = $values->ddlShowType;
        $data['show_country'] = $values->ddlCountry;

        $this->database->table("tbl_handler_show_groups")->where("id=?", $this->show_id)->update($data);
        $this->redirect("handler_show_list");
    }

    public function formCanceled() {
        $this->redirect('dog:dog_championschip_list', $this->handler_id);
    }

}
