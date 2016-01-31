<?php


namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class ownerPresenter extends BasePresenter {

    /** @var Model\AlbumRepository */
    //private $albums;
//    public function __construct() {
//        
//    }
//    private $database;
    private $logged_in_owner_id;
    public $filter_owner_name;
    public $filter_owner_breed;
    public $filter_owner_country;

//    public function __construct(Nette\Database\Context $database) {
//	$this->database = $database;
//	$this->data_model = new \DataModel($database);
//	$this->translator = new DFSTranslator();
//    }

    protected function startup() {
        parent::startup();

        try {
            $owner_data = $this->database->table("tbl_userowner")->where("user_id=?", $this->logged_in_id)->fetch();
            $this->logged_in_owner_id = $owner_data->id;
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

    public function beforeRender() {
        parent::beforeRender();
    }

    /*     * ******** renderers ************* */

    public function actionOwner_list($lang) {
        $mysection = $this->getSession('language');

        $mysection->lang = $lang;

        $this->translator->lang = $mysection->lang;

        $this->template->lang = $this->translator->lang;
    }

    /*     * ******************* view default ******************** */

    public function renderOwner_profile_home($id = 0) {
        if ($id == 0) {
            $id = $this->logged_in_owner_id;

            $profile_data['active_profile_id'] = $id;
            $profile_data['active_profile_type'] = 2;
            $this->database->table("tbl_user")->where("id=?", $this->logged_in_id)->update($profile_data);
            $this->current_user_id = $this->logged_in_id;
            parent::startup();
        } else {
            $userRow = $this->database->table("tbl_userowner")->where("id=?", $id)->fetch();
            $this->current_user_id = $userRow->user_id;
        }

        $row = $this->database->query("SELECT tbl_userowner.*, concat(tbl_user.name,' ',tbl_user.surname) as fullname, tbl_user.state FROM tbl_userowner INNER JOIN tbl_user ON tbl_user.id = tbl_userowner.user_id WHERE tbl_userowner.id=?", $id)->fetch();

        $user_row = $this->database->table("tbl_user")->where("id=?", $this->logged_in_id)->fetch();

        $have_puppies = FALSE;

        $profile_image = $row->owner_profile_picture;
        $this->logged_in_profile_id = $user_row->active_profile_id;
        $name = $row->fullname;
        if (strlen($row->owner_background_image) > 2) {
            $have_background_image = TRUE;
            $background_image = $row->owner_background_image;
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
        $this->template->profile_id = $id;

        $count = $this->data_model->getTimelineCount($id);

        try {
            $this->page_title = "DOGFORSHOW - " . \DataModel::getProfileName($id);
        } catch (\Exception $ex) {
            $this->page_title = "DOGFORSHOW";
        }

        $this->template->page_title = $this->page_title;

        $this->paginator->getPaginator()->setItemCount($count);
        $this->paginator->getPaginator()->setItemsPerPage(20);

        $this->template->timeline_rows = $this->data_model->getTimeline($id, $this->paginator->getPaginator()->getLength(), $this->paginator->getPaginator()->getOffset());
        $this->template->timeline_name = $name;
        $this->template->timeline_profile_image = $profile_image;

        $this->renderOwner_description_home($id);
        $this->renderOwner_dog_list_home($id);
    }

    public function renderOwner_description_home($id = 0) {
        $row = $this->database->query("SELECT tbl_userowner.* FROM tbl_userowner WHERE tbl_userowner.id=?", $id)->fetch();

        $owner_description = $row->owner_description;

        $this->template->owner_description = $owner_description;
    }

    public function renderOwner_dog_list($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_owner_id;
        $rows = $this->database->table("tbl_dogs")->where("profile_id=? AND user_id=?", $id, $this->logged_in_id)->fetchAll();
        $this->template->rows = $rows;
        $this->renderOwner_profile_home($id);
    }

    public function renderOwner_list() {
        try {
            $section = $this->getSession('owner_filter');

            $this->filter_owner_name = $section->filter_owner_name;
            $this->filter_owner_breed = $section->filter_owner_breed;
            $this->filter_owner_country = $section->filter_owner_country;

            if ($this->filter_owner_name == NULL)
                $this->filter_owner_name = "";
            if ($this->filter_owner_breed == NULL)
                $this->filter_owner_breed = "";
            if ($this->filter_owner_country == NULL)
                $this->filter_owner_country = "";
        } catch (\Exception $ex) {
            
        }

        if (strlen($this->filter_owner_breed) > 1) {
            $user_ids = $this->database->table("tbl_dogs")->select("user_id")->where("breed_name LIKE ?", "%" . $this->filter_owner_breed . "%")->group("user_id");

            $uids = array();

            foreach ($user_ids as $user_id) {
                $uids[] = $user_id->user_id;
            }

            $users = $this->database->table("tbl_user")->select("id")
                    ->where("concat(name,' ',surname) LIKE ?", "%" . $this->filter_owner_name . "%")
                    ->where("state LIKE ?", "%" . $this->filter_owner_country . "%")
                    ->where("id IN ?", $uids)
                    ->fetchAll();
        } else {
            $users = $this->database->table("tbl_user")->select("id")
                    ->where("concat(name,' ',surname) LIKE ?", "%" . $this->filter_owner_name . "%")
                    ->where("state LIKE ?", "%" . $this->filter_owner_country . "%")
                    ->fetchAll();
        }

        $ids = array();

        foreach ($users as $user) {
            $ids[] = $user->id;
        }

        $count = $this->database->table("tbl_userowner")->where("user_id IN ?", $ids)->count();
        $this->paginator->getPaginator()->setItemCount($count);
        $this->paginator->getPaginator()->setItemsPerPage(20);

        $rows = $this->database->table("tbl_userowner")
                        ->where("user_id IN ?", $ids)
//                        ->order('premium_expiry_date DESC, id DESC')
                        ->order('id DESC')
                        ->limit($this->paginator->getPaginator()->getLength(), $this->paginator->getPaginator()->getOffset())->fetchAll();

        $this->template->owners = $rows;
    }

    public function renderOwner_dog_list_home($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_owner_id;
        $rows = $this->database->table("tbl_dogs")->where("profile_id=?", $id)->fetchAll();
        $this->template->rows = $rows;
    }

    public function renderOwner_photogallery($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_owner_id;
        $rows = $this->database->table("tbl_photos")->where("profile_id=?", $id)->fetchAll();
        $this->template->photos = $rows;
        $this->renderOwner_profile_home($id);
    }

    public function renderOwner_videogallery($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_owner_id;
        $rows = $this->database->table("tbl_videos")->where("profile_id=?", $id)->fetchAll();
        $this->template->photos = $rows;
        $this->renderOwner_profile_home($id);
    }

    public function actionOwner_create_profile($id) {
        if (!\DataModel::getPremium($this->logged_in_id)) {
            if (\DataModel::hasProfile($this->logged_in_id)) {
                $this->redirect("user:user_premium");
                $this->terminate();
            }
        }
    }

    /*     * ******************* component factories ******************** */

    /**
     * Edit form factory.
     * @return Form
     */
    public function createComponentOwnerEditProfile($button) {
        $form = new Form();

        $row = $this->database->query("SELECT tbl_userowner.* FROM tbl_userowner WHERE tbl_userowner.id=?", $this->logged_in_owner_id)->fetch();

        $form->addTextArea('txtOwnerDescritpion')->setRequired($this->translate("Required field"))->setValue($row->owner_description);
        $form->addSubmit('btnSubmit', 'Create profile')->onClick[] = array($this, 'frmEditOwnerProfileSucceeded');

        return $form;
    }

    public function createComponentOwnerEditCoverPicture() {
        $form = new Form();
        $form->addText('txtOwnerCoverPhoto')->setRequired($this->translate("Required field"));
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditOwnerCoverPhotoSucceeded');

        return $form;
    }

    public function createComponentOwnerEditProfilePicture() {
        $form = new Form();
        $form->addText('txtOwnerProfilePhoto')->setRequired($this->translate("Required field"));
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditOwnerProfilePhotoSucceeded');

        return $form;
    }

    public function createComponentOwner_list_filter() {
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

        $this->filter_owner_name = NULL;
        $this->filter_owner_breed = NULL;
        $this->filter_owner_country = NULL;

        try {
            $section = $this->getSession('owner_filter');

            $this->filter_owner_name = $section->filter_owner_name;
            $this->filter_owner_breed = $section->filter_owner_breed;
            $this->filter_owner_country = $section->filter_owner_country;
        } catch (\Exception $ex) {
            
        }

        $form->addText("txtOwnerName")->setValue($this->filter_owner_name);
        $form->addSelect("ddlCountry")->setPrompt($this->translate("Please select"))->setItems($countries)->setValue($this->filter_owner_country);
        $form->addText("ddlBreedList")->setValue($this->filter_owner_breed);
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmSubmitOwnerFilter');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'frmCancelOwnerFilter');

        return $form;
    }

    public function frmSubmitOwnerFilter($button) {
        $values = $button->getForm()->getValues();

        $section = $this->getSession('owner_filter');

        $this->filter_owner_name = $values->txtOwnerName;
        $this->filter_owner_breed = $values->ddlBreedList;
        $this->filter_owner_country = $values->ddlCountry;

        $section->filter_owner_name = $this->filter_owner_name;
        $section->filter_owner_breed = $this->filter_owner_breed;
        $section->filter_owner_country = $this->filter_owner_country;

        $this->redirect("this");
    }

    public function frmCancelOwnerFilter($button) {
        $values = $button->getForm()->getValues();

        $section = $this->getSession('owner_filter');

        $section->filter_owner_name = NULL;
        $section->filter_owner_breed = NULL;
        $section->filter_owner_country = NULL;

        $this->redirect("this");
    }

    public function frmEditOwnerProfileSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $values = $this->data_model->assignFields($values, 'frmOwnerEditProfile');

            $this->database->table("tbl_userowner")->where("id = ?", $this->logged_in_owner_id)->update($values);

            $this->data_model->addToTimeline($this->logged_in_owner_id, $this->logged_in_owner_id, 2, \DataModel::getProfileName($this->logged_in_owner_id), $values['owner_profile_picture']);

            $this->flashMessage($this->translate("Profile has been successfully updated."), "Success");
            $this->redirect("owner:owner_profile_home");
        } catch (\ErrorException $exc) {
            $this->flashMessage($exc->getMessage(), "Error");
        }
    }

    public function frmEditOwnerCoverPhotoSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $form = $button->getForm();

            $img = $form['txtOwnerCoverPhoto']->getValue();

            $target_path = "uploads/";

            $ext = '';

            $ext = explode('.', $img->name);

            $length = count($ext);

            $ext = $ext[$length - 1];

            switch ($ext) {
                case 'gif':
                    $ext = 'gif';
                    break;
                case 'jpeg':
                    $ext = 'jpg';
                    break;
                case 'jpg':
                    $ext = 'jpg';
                    break;
                case 'png':
                    $ext = 'png';
                    break;
                default :
                    throw new \ErrorException("Only .gif / .jpeg / .jpg / .png extensions are allowed", "1");
                    break;
            }

            $filename = \KennelUpdateModel::generateRandomString() . ".$ext";

            $img->move("$target_path/$filename");

            $values['txtOwnerCoverPhoto'] = "$target_path/$filename";

            $values = $this->data_model->assignFields($values, 'frmOwnerEditCoverPhoto');

            $this->database->table("tbl_userowner")->where("id = ?", $this->logged_in_owner_id)->update($values);

            $this->flashMessage($this->translate("Record has been successfully updated."), "Success");
            $this->redirect("owner:owner_profile_home");
        } catch (\ErrorException $exc) {
            $this->flashMessage($exc->getMessage(), "Error");
        }
    }

    public function frmEditOwnerProfilePhotoSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $form = $button->getForm();

            $img = $form['txtOwnerProfilePhoto']->getValue();

            $target_path = "uploads/";

            $ext = '';

            $ext = explode('.', $img->name);

            $length = count($ext);

            $ext = $ext[$length - 1];

            switch ($ext) {
                case 'gif':
                    $ext = 'gif';
                    break;
                case 'jpeg':
                    $ext = 'jpg';
                    break;
                case 'jpg':
                    $ext = 'jpg';
                    break;
                case 'png':
                    $ext = 'png';
                    break;
                default :
                    throw new \ErrorException("Only .gif / .jpeg / .jpg / .png extensions are allowed", "1");
                    break;
            }

            $filename = \KennelUpdateModel::generateRandomString() . ".$ext";

            $img->move("$target_path/$filename");

            $values['txtOwnerProfilePhoto'] = "$target_path/$filename";

            $values = $this->data_model->assignFields($values, 'frmOwnerEditProfilePhoto');

            $this->database->table("tbl_userowner")->where("id = ?", $this->logged_in_owner_id)->update($values);

            $this->flashMessage($this->translate("Record has been successfully updated."), "Success");
            $this->redirect("owner:owner_profile_home");
        } catch (\ErrorException $exc) {
            $this->flashMessage($exc->getMessage(), "Error");
        }
    }

}
