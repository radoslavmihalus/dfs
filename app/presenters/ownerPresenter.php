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
            parent::startup();
        }

        $row = $this->database->query("SELECT tbl_userowner.*, tbl_user.state FROM tbl_userowner INNER JOIN tbl_user ON tbl_user.id = tbl_userowner.user_id WHERE tbl_userowner.id=?", $id)->fetch();

        $have_puppies = FALSE;

        $profile_image = $row->owner_profile_picture;
        $logged_in_profile_id = $row->id;
        $name = $this->template->fullname;
        if (strlen($row->owner_background_image) > 2) {
            $have_background_image = TRUE;
            $background_image = $row->owner_background_image;
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

        //$this->renderKennel_description_home($id);
    }

    /*     * ******************* component factories ******************** */

    /**
     * Edit form factory.
     * @return Form
     */
    protected function createComponentOwnerCreateProfile() {
        $form = new Form();
        $form->addUpload('txtOwnerProfilePhoto');
        $form->addTextArea('txtOwnerDescritpion');
        $form->addSubmit('btnSubmit', 'Create profile')->onClick[] = array($this, 'frmCreateOwnerProfileSucceeded');

        return $form;
    }

    public function frmCreateOwnerProfileSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $breeds = $values['ddlBreedList'];

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

            $values = $this->data_model->assignFields($values, 'frmOwnerCreateProfile');
            $values['user_id'] = $this->logged_in_id;

            $this->database->table("tbl_userowner")->insert($values);
            $id = $this->database->getInsertId();

            $this->flashMessage("Your owner profile has been successfully created.", "Success");
            $this->redirect("owner:owner_profile_home");
        } catch (\ErrorException $exc) {
            $this->flashMessage($exc->getMessage(), "Error");
        }
    }

    public function createComponentownerEditProfile($button) {
        $form = new Form();
        $form->addTextArea('txtOwnerDescritpion');
        $form->addSubmit('btnSubmit', 'Create profile')->onClick[] = array($this, 'frmEditOwnerProfileSucceeded');

        return $form;
    }

    public function albumFormSucceeded($button) {
//		$values = $button->getForm()->getValues();
//		$id = (int) $this->getParameter('id');
//		if ($id) {
//			$this->albums->findById($id)->update($values);
//			$this->flashMessage('The album has been updated.');
//		} else {
//			$this->albums->insert($values);
//			$this->flashMessage('The album has been added.');
//		}
//		$this->redirect('default');
    }

    /**
     * Delete form factory.
     * @return Form
     */
    protected function createComponentDeleteForm() {
//		$form = new Form;
//		$form->addSubmit('cancel', 'Cancel')
//			->onClick[] = array($this, 'formCancelled');
//
//		$form->addSubmit('delete', 'Delete')
//			->setAttribute('class', 'default')
//			->onClick[] = array($this, 'deleteFormSucceeded');
//
//		$form->addProtection();
//		return $form;
    }

    public function deleteFormSucceeded() {
//		$this->albums->findById($this->getParameter('id'))->delete();
//		$this->flashMessage('Album has been deleted.');
//		$this->redirect('default');
    }

    public function formCancelled() {
        $this->redirect('default');
    }

}
