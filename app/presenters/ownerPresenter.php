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

    public function __construct(Nette\Database\Context $database) {
	$this->database = $database;
	$this->data_model = new \DataModel($database);
	$this->translator = new DFSTranslator();
    }

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

        $this->template->timeline_rows = $this->data_model->getTimeline($id);
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
	$rows = $this->database->table("tbl_userowner")->limit(9)->fetchAll();
	$this->template->owners = $rows;
    }

    public function renderOwner_dog_list_home($id = 0) {
	if ($id == 0)
	    $id = $this->logged_in_owner_id;
	$rows = $this->database->table("tbl_dogs")->where("profile_id=? AND user_id=?", $id, $this->logged_in_id)->fetchAll();
	$this->template->rows = $rows;
    }

    public function renderOwner_photogallery($id = 0) {
        if ($id == 0)
            $id = $this->logged_in_owner_id;
        $rows = $this->database->table("tbl_photos")->where("profile_id=?", $id)->fetchAll();
        $this->template->photos = $rows;
        $this->renderOwner_profile_home($id);
    }
    /*     * ******************* component factories ******************** */

    /**
     * Edit form factory.
     * @return Form
     */
    protected function createComponentOwnerCreateProfile() {
	$form = new Form();
	$form->addText('txtOwnerProfilePhoto');//->setRequired($this->translate("Required field"));
	$form->addTextArea('txtOwnerDescritpion')->setRequired($this->translate("Required field"));
	$form->addSubmit('btnSubmit', 'Create profile')->onClick[] = array($this, 'frmCreateOwnerProfileSucceeded');

	return $form;
    }

    public function frmCreateOwnerProfileSucceeded($button) {
	try {
	    $values = $button->getForm()->getValues();

	    $data = $this->data_model->assignFields($values, 'frmOwnerCreateProfile');
	    $data['user_id'] = $this->logged_in_id;

	    $this->database->table("tbl_userowner")->insert($data);
	    $id = $this->database->getInsertId();

	    $this->data_model->addToTimeline($id, $id, 1, \DataModel::getProfileName($id), $data['owner_profile_picture']);

	    $this->flashMessage($this->translate("Profile has been successfully created."), "Success");
	    $this->redirect("owner:owner_profile_home");
	} catch (\ErrorException $exc) {
	    $this->flashMessage($exc->getMessage(), "Warning");
	}
    }

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
