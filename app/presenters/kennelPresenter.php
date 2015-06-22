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
    private $database;
    private $logged_in_id;
    private $data_model;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
        $this->data_model = new \DataModel($database);
    }

    protected function startup() {
        parent::startup();
        $mysection = $this->getSession('userdata');
        $myid = $mysection->id;
        $this->logged_in_id = $myid;
        $userdata = $this->database->table("tbl_user")->where("id = ?", $myid);

        foreach ($userdata as $user) {
            $this->template->fullname = $user->name . ' ' . $user->surname;
            $this->template->profile_type = 'Kennel';
            $this->template->profile_type_icon = 'fa fa-home'; //handler - glyphicons glyphicons-shirt ... owner - fa fa-user
        }
    }

    /*     * ******************* view default ******************** */

    public function renderKennel_list() {
        $rows = $this->database->query("SELECT tbl_userkennel.*, tbl_user.state FROM tbl_userkennel INNER JOIN tbl_user ON tbl_user.id = tbl_userkennel.user_id")->fetchAll();

        $this->template->result = $rows;
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
    //Create profile

    protected function createComponentKennelCreateProfile() {

        $form = new Form();
        $form->addText('txtKennelName');
        $form->addText('txtKennelFciNumber');
        $form->addUpload('txtKennelProfilePicture');
        $form->addText('txtKennelWebsite');
        $form->addTextArea('txtKennelDescription');
        $form->addText('hidddlBreedList');
        $form->addSubmit('btnSubmit', 'Create profile')->onClick[] = array($this, 'frmCreateProfileSucceeded');

        return $form;
    }

    public function frmCreateProfileSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $form = $button->getForm();

            $img = $form['txtKennelProfilePicture']->getValue();

            //var_dump($values['txtKennelProfilePicture']);

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
                    throw new \Exception("Only .gif / .jpeg / .jpg / .png extensions are allowed", "1");
                    break;
            }

            $filename = \KennelUpdateModel::generateRandomString() . ".$ext";

            $img->move("$target_path/$filename");

            $values['txtKennelProfilePicture'] = "$target_path/$filename";

            $values = $this->data_model->assignFields($values, 'frmKennelCreateProfile');
            $values['user_id'] = $this->logged_in_id;

            $this->database->table("tbl_userkennel")->insert($values);
            $profileid = $this->database->getInsertId();

            $this->redirectUrl("kennel-profile");
            exit;
        } catch (\Exception $exc) {
            $this->flashMessage($exc->getMessage());
        }


        //var_dump($values);
    }

    //Update profile

    protected function createComponentKennelEditProfile() {
        $data = $this->database->table("tbl_userkennel")->where("user_id=?", $this->logged_in_id);

        $data = $this->data_model->assignFieldsReverse($data, "frmKennelCreateProfile");
        
        var_dump($data);
        
        $form = new Form();
        
        $form->setValues($data, TRUE);
        
        $form->addText('txtKennelName');
        $form->addText('txtKennelFciNumber');
        $form->addText('txtKennelWebsite');
        $form->addTextArea('txtKennelDescription');
        $form->addText('hidddlBreedList');
        $form->addSubmit('btnSubmit', 'Create profile')->onClick[] = array($this, 'frmCreateProfileSucceeded');

        return $form;
    }

}
