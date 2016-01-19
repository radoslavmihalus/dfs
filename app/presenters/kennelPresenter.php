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
    private $planned_litter_id;
    public $filter_kennel_name;
    public $filter_kennel_breed;
    public $filter_kennel_country;
    public $filter_pl_name;
    public $filter_pl_breed;
    public $filter_pl_country;

//    public function __construct(Nette\Database\Context $database) {
//        $this->database = $database;
//        $this->data_model = new \DataModel($database);
//        $this->translator = new DFSTranslator();
//    }

    protected function startup() {
        parent::startup();

        try {
            $mysection = $this->getSession('language');
            $this->translator->lang = $mysection->lang;
            $mylang = $mysection->lang;
        } catch (\Exception $ex) {
            $mylang = "en";

            if (isset($_GET['lang']))
                $mylang = $_GET['lang'];

            $this->translator->lang = $mylang;

            try {
                $mysection = $this->getSession('language');
                $mysection->lang = $mylang;
            } catch (\Exception $ex) {
                
            }
        }

        if (isset($_GET['lang']))
            $mylang = $_GET['lang'];

        $this->translator->lang = $mylang;


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

    public function actionKennel_list($lang) {
        $mysection = $this->getSession('language');

        $mysection->lang = $lang;

        $this->translator->lang = $mysection->lang;

        $this->template->lang = $this->translator->lang;
    }

    public function actionPlanned_litter_list($lang) {
        $mysection = $this->getSession('language');

        $mysection->lang = $lang;

        $this->translator->lang = $mysection->lang;

        $this->template->lang = $this->translator->lang;
    }

    public function renderKennel_list() {
        try {
            $section = $this->getSession('kennel_filter');

            $this->filter_kennel_name = $section->filter_kennel_name;
            $this->filter_kennel_breed = $section->filter_kennel_breed;
            $this->filter_kennel_country = $section->filter_kennel_country;

            if ($this->filter_kennel_name == NULL)
                $this->filter_kennel_name = "";
            if ($this->filter_kennel_breed == NULL)
                $this->filter_kennel_breed = "";
            if ($this->filter_kennel_country == NULL)
                $this->filter_kennel_country = "";
        } catch (\Exception $ex) {
            
        }

        $ids = array();

        if (strlen($this->filter_kennel_breed) > 1) {
            $id_rows = $this->database->table("link_kennel_breed")->select('kennel_id')->where("breed_name=?", $this->filter_kennel_breed)->group('kennel_id')->fetchAll();

            foreach ($id_rows as $id_row) {
                $ids[] = $id_row->kennel_id;
            }
        }

        $ids_users = array();

        if (strlen($this->filter_kennel_country) > 1) {
            $id_rows = $this->database->table("tbl_user")->select('id')->where("state=?", $this->filter_kennel_country)->group('id')->fetchAll();

            foreach ($id_rows as $id_row) {
                $ids_users[] = $id_row->id;
            }
        }

        if (strlen($this->filter_kennel_breed) > 1) {
            if (strlen($this->filter_kennel_country) > 1)
                $count = $this->database->table("tbl_userkennel")
                        ->where("kennel_name LIKE ?", "%" . $this->filter_kennel_name . "%")
                        ->where("user_id IN ?", $ids_users)
                        ->where("id IN ?", $ids)
                        ->count();
            else
                $count = $this->database->table("tbl_userkennel")
                        ->where("kennel_name LIKE ?", "%" . $this->filter_kennel_name . "%")
                        ->where("id IN ?", $ids)
                        ->count();
        } else {
            if (strlen($this->filter_kennel_country) > 1)
                $count = $this->database->table("tbl_userkennel")
                        ->where("kennel_name LIKE ?", "%" . $this->filter_kennel_name . "%")
                        ->where("user_id IN ?", $ids_users)
                        ->count();
            else
                $count = $this->database->table("tbl_userkennel")
                        ->where("kennel_name LIKE ?", "%" . $this->filter_kennel_name . "%")
                        ->count();
        }

        $this->paginator->getPaginator()->setItemCount($count);
        $this->paginator->getPaginator()->setItemsPerPage(20);

        if (strlen($this->filter_kennel_breed) > 1) {
            if (strlen($this->filter_kennel_country) > 1)
                $rows = $this->database->table("tbl_userkennel")
                                ->where("kennel_name LIKE ?", "%" . $this->filter_kennel_name . "%")
                                ->where("user_id IN ?", $ids_users)
                                ->where("id IN ?", $ids)
                                ->order('premium_expiry_date DESC, id DESC')
                                ->limit($this->paginator->getPaginator()->getLength(), $this->paginator->getPaginator()->getOffset())->fetchAll();
            else
                $rows = $this->database->table("tbl_userkennel")
                                ->where("kennel_name LIKE ?", "%" . $this->filter_kennel_name . "%")
                                ->where("id IN ?", $ids)
                                ->order('premium_expiry_date DESC, id DESC')
                                ->limit($this->paginator->getPaginator()->getLength(), $this->paginator->getPaginator()->getOffset())->fetchAll();
        } else {
            if (strlen($this->filter_kennel_country) > 1)
                $rows = $this->database->table("tbl_userkennel")
                                ->where("kennel_name LIKE ?", "%" . $this->filter_kennel_name . "%")
                                ->where("user_id IN ?", $ids_users)
                                ->order('premium_expiry_date DESC, id DESC')
                                ->limit($this->paginator->getPaginator()->getLength(), $this->paginator->getPaginator()->getOffset())->fetchAll();
            else {
                $rows = $this->database->table("tbl_userkennel")
                                ->where("kennel_name LIKE ?", "%" . $this->filter_kennel_name . "%")
                                ->order('premium_expiry_date DESC, id DESC')
                                ->limit($this->paginator->getPaginator()->getLength(), $this->paginator->getPaginator()->getOffset())->fetchAll();
            }
        }

//$rows = $this->database->query("SELECT .*, tbl_user.state, FALSE as have_puppies FROM tbl_userkennel INNER JOIN tbl_user ON tbl_user.id = tbl_userkennel.user_id ORDER BY tbl_userkennel.kennel_create_date DESC limit ". $this->paginator->getLength() . "," . $this->paginator->getOffset())->fetchAll();

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

        $user_row = $this->database->table("tbl_user")->where("id=?", $this->logged_in_id)->fetch();

        $have_puppies = \DataModel::havePuppies($id);

        $profile_image = $row->kennel_profile_picture;
        $this->logged_in_profile_id = $user_row->active_profile_id;
        $name = $row->kennel_name;
        if (strlen($row->kennel_background_image) > 2) {
            $have_background_image = TRUE;
            $background_image = $row->kennel_background_image;
        } else
            $have_background_image = FALSE;
        $state = $row->state;

        try {
            $this->page_title = "DOGFORSHOW - " . \DataModel::getProfileName($id);
        } catch (\Exception $ex) {
            $this->page_title = "DOGFORSHOW";
        }

        $this->template->page_title = $this->page_title;

        $this->template->have_puppies = $have_puppies;
        $this->template->profile_image = $profile_image;
        $this->template->logged_in_profile_id = $this->logged_in_profile_id;
        $this->template->kennel_name = $name;
        $this->template->have_background_image = $have_background_image;
        $this->template->background_image = $background_image;
        $this->template->state = $state;
        $this->template->logged_in_id = $this->logged_in_id;

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

        $count = $this->data_model->getTimelineCount($id);

        $this->paginator->getPaginator()->setItemCount($count);
        $this->paginator->getPaginator()->setItemsPerPage(20);

        $this->template->timeline_rows = $this->data_model->getTimeline($id, $this->paginator->getPaginator()->getLength(), $this->paginator->getPaginator()->getOffset());

        $this->template->timeline_name = $name;
        $this->template->timeline_profile_image = $profile_image;

        $this->renderKennel_description_home($id);
        $this->renderKennel_dog_list_home($id);
    }

    public function renderKennel_dog_list($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_kennel_id;
        $rows = $this->database->table("tbl_dogs")->where("profile_id=?", $id)->order("id ASC")->fetchAll();
        $this->template->rows = $rows;
        $this->renderKennel_profile_home($id);
    }

    public function renderKennel_planned_litter_list($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_kennel_id;
        $rows = $this->database->table("tbl_planned_litters")->where("kennel_id=?", $id)->order("year DESC,month DESC")->fetchAll();
        $this->template->planned_litter_rows = $rows;
        $this->renderKennel_profile_home($id);
    }

    public function renderPlanned_litter_list($id = 0) {
        try {
            $section = $this->getSession('pl_filter');

            $this->filter_pl_name = $section->filter_pl_name;
            $this->filter_pl_breed = $section->filter_pl_breed;
            $this->filter_pl_country = $section->filter_pl_country;

            if ($this->filter_pl_name == NULL)
                $this->filter_pl_name = "";
            if ($this->filter_pl_breed == NULL)
                $this->filter_pl_breed = "";
            if ($this->filter_pl_country == NULL)
                $this->filter_pl_country = "";
        } catch (\Exception $ex) {
            
        }

        $ids = array();

        if (strlen($this->filter_pl_name) > 1) {
            $kennels = $this->database->table("tbl_userkennel")->select("id")->where("kennel_name LIKE ?", "%" . $this->filter_pl_name . "%")->fetchAll();

            foreach ($kennels as $kennel) {
                $ids[] = $kennel->id;
            }
        }

        if (strlen($this->filter_pl_name) > 1) {
            $count = $this->database->table("tbl_planned_litters")
                    ->where("bitch_breed LIKE ?", "%" . $this->filter_pl_breed . "%")
                    ->where("bitch_state LIKE ?", "%" . $this->filter_pl_country . "%")
                    ->where("kennel_id IN ?", $ids)
                    ->count();
        } else {
            $count = $this->database->table("tbl_planned_litters")
                    ->where("bitch_breed LIKE ?", "%" . $this->filter_pl_breed . "%")
                    ->where("bitch_state LIKE ?", "%" . $this->filter_pl_country . "%")
                    ->count();
        }

        $this->paginator->getPaginator()->setItemCount($count);
        $this->paginator->getPaginator()->setItemsPerPage(20);

        if (strlen($this->filter_pl_name) > 1) {
            $rows = $this->database->table("tbl_planned_litters")
                            ->where("bitch_breed LIKE ?", "%" . $this->filter_pl_breed . "%")
                            ->where("bitch_state LIKE ?", "%" . $this->filter_pl_country . "%")
                            ->where("kennel_id IN ?", $ids)
                            ->order("year DESC,month DESC")->limit($this->paginator->getPaginator()->getLength(), $this->paginator->getPaginator()->getOffset())->fetchAll();
        } else {
            $rows = $this->database->table("tbl_planned_litters")
                            ->where("bitch_breed LIKE ?", "%" . $this->filter_pl_breed . "%")
                            ->where("bitch_state LIKE ?", "%" . $this->filter_pl_country . "%")
                            ->order("year DESC,month DESC")->limit($this->paginator->getPaginator()->getLength(), $this->paginator->getPaginator()->getOffset())->fetchAll();
        }
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

    public function renderKennel_videogallery($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_kennel_id;
        $rows = $this->database->table("tbl_videos")->where("profile_id=?", $id)->fetchAll();
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

    public function actionKennel_awards_add($id = 0) {
        if (!\DataModel::getPremium($this->logged_in_id)) {
            try {
                $cnt = $this->database->table("link_kennel_awards")->where("kennel_id=?", $this->logged_in_kennel_id)->count();
            } catch (\Exception $ex) {
                $cnt = 0;
            }
            if ($cnt > 4) {
                $this->redirect("user:user_premium");
                $this->terminate();
            }
        }
    }

    public function actionKennel_planned_litter_edit($id) {
        if (!\DataModel::getPremium($this->logged_in_id)) {
            $this->redirect("user:user_premium");
            $this->terminate();
        }
        $this->planned_litter_id = $id;
    }

    public function actionKennel_planned_litter_add($id = 0) {
//$this->planned_litter_id = $id;
        if (!\DataModel::getPremium($this->logged_in_id)) {
            $this->redirect("user:user_premium");
            $this->terminate();
        }
    }

    public function actionKennel_create_profile($id) {
        if (!\DataModel::getPremium($this->logged_in_id)) {
            if (\DataModel::hasProfile($this->logged_in_id)) {
                $this->redirect("user:user_premium");
                $this->terminate();
            }
        }
    }

    /*     * ******** actions ************* */

    /*     * ******** handlers ************* */

    public function handleDeleteAward($id) {
        $award = $this->database->table("link_kennel_awards")->where("id=?", $id)->fetch();
        $kennel = $this->database->table("tbl_userkennel")->where("id=?", $award->kennel_id)->fetch();

        if ($kennel->user_id == $this->logged_in_id) {
            $this->database->table("link_kennel_awards")->where("id=?", $id)->delete();
        }

        $this->redirect("kennel_awards_list", array("id" => $kennel->id));
    }

    public function handleDeletePlannedLitter($id) {
        $pl = $this->database->table("tbl_planned_litters")->where("id=?", $id)->fetch();
        $kennel = $this->database->table("tbl_userkennel")->where("id=?", $pl->kennel_id)->fetch();

        if ($kennel->user_id == $this->logged_in_id) {
            $this->database->table("tbl_planned_litters")->where("id=?", $id)->delete();
            $this->database->table("tbl_puppies")->where("planned_litter_id=?", $id)->delete();
            $this->database->table("tbl_timeline")->where("event_id=?", $id)->delete();
        }

        $this->redirect("kennel_planned_litter_list", array("id" => $kennel->id));
    }

    /*     * ******** handlers ************* */


    /*     * ****************** component factories ******************** */

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

    protected function createComponentKennel_list_filter() {
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

        $this->filter_kennel_name = NULL;
        $this->filter_kennel_breed = NULL;
        $this->filter_kennel_country = NULL;

        try {
            $section = $this->getSession('kennel_filter');

            $this->filter_kennel_name = $section->filter_kennel_name;
            $this->filter_kennel_breed = $section->filter_kennel_breed;
            $this->filter_kennel_country = $section->filter_kennel_country;
        } catch (\Exception $ex) {
            
        }

        $form->addText("txtKennelName")->setValue($this->filter_kennel_name);
        $form->addSelect("ddlCountry")->setPrompt($this->translate("Please select"))->setItems($countries)->setValue($this->filter_kennel_country);
        $form->addText("ddlBreedList")->setValue($this->filter_kennel_breed);
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmSubmitKennelFilter');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'frmCancelKennelFilter');

        return $form;
    }

    public function frmSubmitKennelFilter($button) {
        $values = $button->getForm()->getValues();

        $section = $this->getSession('kennel_filter');

        $this->filter_kennel_name = $values->txtKennelName;
        $this->filter_kennel_breed = $values->ddlBreedList;
        $this->filter_kennel_country = $values->ddlCountry;

        $section->filter_kennel_name = $this->filter_kennel_name;
        $section->filter_kennel_breed = $this->filter_kennel_breed;
        $section->filter_kennel_country = $this->filter_kennel_country;

        $this->redirect("this");
    }

    public function frmCancelKennelFilter($button) {
        $values = $button->getForm()->getValues();

        $section = $this->getSession('kennel_filter');

        $section->filter_kennel_name = NULL;
        $section->filter_kennel_breed = NULL;
        $section->filter_kennel_country = NULL;

        $this->redirect("this");
    }

    protected function createComponentPlanned_litter_list_filter() {
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

        $this->filter_pl_name = NULL;
        $this->filter_pl_breed = NULL;
        $this->filter_pl_country = NULL;

        try {
            $section = $this->getSession('pl_filter');

            $this->filter_pl_name = $section->filter_pl_name;
            $this->filter_pl_breed = $section->filter_pl_breed;
            $this->filter_pl_country = $section->filter_pl_country;
        } catch (\Exception $ex) {
            
        }

        $form->addText("txtKennelName")->setValue($this->filter_pl_name);
        $form->addSelect("ddlCountry")->setPrompt($this->translate("Please select"))->setItems($countries)->setValue($this->filter_pl_country);
        $form->addText("ddlBreedList")->setValue($this->filter_pl_breed);
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmSubmitPLFilter');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'frmCancelPLFilter');

        return $form;
    }

    public function frmSubmitPLFilter($button) {
        $values = $button->getForm()->getValues();

        $section = $this->getSession('pl_filter');

        $this->filter_pl_name = $values->txtKennelName;
        $this->filter_pl_breed = $values->ddlBreedList;
        $this->filter_pl_country = $values->ddlCountry;

        $section->filter_pl_name = $this->filter_pl_name;
        $section->filter_pl_breed = $this->filter_pl_breed;
        $section->filter_pl_country = $this->filter_pl_country;

        $this->redirect("this");
    }

    public function frmCancelPLFilter($button) {
        $values = $button->getForm()->getValues();

        $section = $this->getSession('pl_filter');

        $section->filter_pl_name = NULL;
        $section->filter_pl_breed = NULL;
        $section->filter_pl_country = NULL;

        $this->redirect("this");
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
        } catch (\Exception $ex) {
            $lang = "en";
        }

        $countries = array();

        $rows = $this->database->table("lk_countries")->order("CountryName_$lang")->fetchAll();

        foreach ($rows as $country) {
            $countries[$country->CountryName_en] = $this->translate($country->CountryName_en);
        }

        $rows = $this->database->table("tbl_dogs")->where("profile_id = ?", $this->logged_in_kennel_id)->where("dog_gender=?", "Bitch")->fetchAll();
        $bitches = array();
        foreach ($rows as $bitch) {
            $bitches[$bitch->dog_name] = $bitch->dog_name;
        }

        $form->addSelect("ddlDateYear")->setRequired($this->translate("Required field"))->setItems($years);
        $form->addSelect("ddlDateMonth")->setRequired($this->translate("Required field"))->setItems($months); //->setRequired();
        $form->addText("txtPlannedLitterName")->setRequired($this->translate("Required field")); //->setRequired();
        $form->addText("ddlPlannedLitterDogName")->setRequired($this->translate("Required field")); //->setRequired();
        $form->addSelect("ddlPlannedLitterBitchName")->setPrompt($this->translate("Please select"))->setItems($bitches)->setRequired($this->translate("Required field")); //->setRequired();
        $form->addText("txtPlannedLitterDogProfilePhoto")->setRequired($this->translate("Required field")); //->setRequired();
//$form->addText("txtPlannedLitterBitchProfilePhoto")->setRequired($this->translate("Required field")); //->setRequired();
        $form->addText("ddlBreedList")->setRequired($this->translate("Required field")); //->setRequired();
        $form->addSelect("ddlCountry")->setItems($countries)->setPrompt($this->translate("Please select country..."))->setRequired($this->translate("Required field")); //->setRequired();
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmAddPlannedLitterSuccess');
//$form->addSubmit('btnCancel')->onClick[] = array($this, 'frmAddPlannedLitterCancel');

        return $form;
    }

    protected function createComponentFormEditPlannedLitter() {
        $pl = $this->database->table("tbl_planned_litters")->where("id=?", $this->planned_litter_id)->fetch();

        $form = new Form();

        $years = array();
        $months = array();

        $y = date("Y");
        $yf = $y + 3;
        $yt = $y - 20;

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
        } catch (\Exception $ex) {
            $lang = "en";
        }

        $countries = array();

        $rows = $this->database->table("lk_countries")->order("CountryName_$lang")->fetchAll();

        foreach ($rows as $country) {
            $countries[$country->CountryName_en] = $this->translate($country->CountryName_en);
        }

        $rows = $this->database->table("tbl_dogs")->where("profile_id = ?", $this->logged_in_kennel_id)->where("dog_gender=?", "Bitch")->fetchAll();
        $bitches = array();
        foreach ($rows as $bitch) {
            $bitches[$bitch->dog_name] = $bitch->dog_name;
        }

        $form->addSelect("ddlDateYear")->setRequired($this->translate("Required field"))->setItems($years)->setValue($pl->year);
        $form->addSelect("ddlDateMonth")->setRequired($this->translate("Required field"))->setItems($months)->setValue($pl->month); //->setRequired();
        $form->addText("txtPlannedLitterName")->setRequired($this->translate("Required field"))->setValue($pl->name); //->setRequired();
        $form->addText("ddlPlannedLitterDogName")->setRequired($this->translate("Required field"))->setValue($pl->dog_name); //->setRequired();
        $form->addSelect("ddlPlannedLitterBitchName")->setPrompt($this->translate("Please select"))->setItems($bitches)->setRequired($this->translate("Required field")); //->setRequired();
        try {
            $form->getComponent("ddlPlannedLitterBitchName")->setValue($pl->bitch_name);
        } catch (\Exception $ex) {
            
        }
//$form->addText("ddlPlannedLitterBitchName")->setRequired($this->translate("Required field")); //->setRequired();
        $form->addText("txtPlannedLitterDogProfilePhoto")->setRequired($this->translate("Required field"))->setValue($pl->dog_image); //->setRequired();
//$form->addText("txtPlannedLitterBitchProfilePhoto")->setRequired($this->translate("Required field")); //->setRequired();
        $form->addText("ddlBreedList")->setRequired($this->translate("Required field"))->setValue($pl->dog_breed); //->setRequired();
        $form->addSelect("ddlCountry")->setItems($countries)->setPrompt($this->translate("Please select country..."))->setRequired($this->translate("Required field"))->setValue($pl->dog_state); //->setRequired();
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditPlannedLitterSuccess');
//$form->addSubmit('btnCancel')->onClick[] = array($this, 'frmAddPlannedLitterCancel');

        return $form;
    }

    /*     * ****************** component factories ******************** */

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

            $exc .= "</ul>";

            $data['kennel_id'] = $this->logged_in_kennel_id;

//$values = $this->data_model->assignFields($values, "frmPlannedLitter");

            $data['name'] = $values['txtPlannedLitterName'];

            $data['year'] = $values['ddlDateYear'];
            $data['month'] = $values['ddlDateMonth'];

            $data['dog_name'] = $values['ddlPlannedLitterDogName'];
            $data['dog_breed'] = $values['ddlBreedList'];
            $data['dog_state'] = $values['ddlCountry'];
            $data['dog_image'] = $values['txtPlannedLitterDogProfilePhoto'];

            $data['bitch_name'] = $values['ddlPlannedLitterBitchName'];

            if (\DataModel::haveDogProfile($data['bitch_name'])) {
                $bitch = \DataModel::getDogProfileByName($data['bitch_name']);

                $data['bitch_breed'] = $bitch->breed_name;
                $data['bitch_state'] = $bitch->country;
                $data['bitch_image'] = $bitch->dog_image;
            } else {
                $exc .= "<li>" . $this->translate("Bitch must be registered in our database.") . "</li>";
            }

            if ($exc != "<ul></ul>")
                throw new \ErrorException($exc);


            $this->database->table("tbl_planned_litters")->insert($data);
            $id = $this->database->getInsertId();

            $this->data_model->addToTimeline($this->logged_in_kennel_id, $id, 7, $data['name'] . " - " . $data['month'] . "/" . $data['year'], $data['dog_image']);
            $this->redirect("kennel_planned_litter_list", array(id => $this->logged_in_kennel_id));
        } catch (\ErrorException $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
    }

    public function frmEditPlannedLitterSuccess($button) {
        try {
            $values = $button->getForm()->getValues();

            $exc = "<ul>";

            if ($values['txtPlannedLitterName'] == "") {
                $exc .= "<li>" . $this->translate("Name of planned litter can't be empty") . "</li>";
            }

            $exc .= "</ul>";

//$data['kennel_id'] = $this->logged_in_kennel_id;
//$values = $this->data_model->assignFields($values, "frmPlannedLitter");

            $data['name'] = $values['txtPlannedLitterName'];

            $data['year'] = $values['ddlDateYear'];
            $data['month'] = $values['ddlDateMonth'];

            $data['dog_name'] = $values['ddlPlannedLitterDogName'];
            $data['dog_breed'] = $values['ddlBreedList'];
            $data['dog_state'] = $values['ddlCountry'];
            $data['dog_image'] = $values['txtPlannedLitterDogProfilePhoto'];

            $data['bitch_name'] = $values['ddlPlannedLitterBitchName'];

            if (\DataModel::haveDogProfile($data['bitch_name'])) {
                $bitch = \DataModel::getDogProfileByName($data['bitch_name']);

                $data['bitch_breed'] = $bitch->breed_name;
                $data['bitch_state'] = $bitch->country;
                $data['bitch_image'] = $bitch->dog_image;
            } else {
                $exc .= "<li>" . $this->translate("Bitch must be registered in our database.") . "</li>";
            }

            if ($exc != "<ul></ul>")
                throw new \ErrorException($exc);


            $this->database->table("tbl_planned_litters")->where("id=?", $this->planned_litter_id)->update($data);
//$id = $this->database->getInsertId();

            $this->data_model->addToTimeline($this->logged_in_kennel_id, $id, 7, $data['name'] . " - " . $data['month'] . "/" . $data['year'], $data['dog_image']);
            $this->redirect("kennel_planned_litter_list", array(id => $this->logged_in_kennel_id));
        } catch (\ErrorException $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
    }

}
