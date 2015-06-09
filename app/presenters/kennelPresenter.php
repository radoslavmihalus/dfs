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

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    function getField($form_name, $element_name) {
        $fields = $this->database->query("SELECT * FROM form_fields WHERE form_name=? AND element_name=?", $form_name, $element_name);

        $return = "";

        foreach ($fields as $field) {
            $return = $field->field_name;
        }
        return $return;
    }

    function getFieldReverse($form_name, $field_name) {
        $fields = $this->database->query("SELECT * FROM form_fields WHERE form_name=? AND field_name=?", $form_name, $field_name);

        $return = "";

        foreach ($fields as $field) {
            $return = $field->element_name;
        }
        return $return;
    }

    function assignFields($valuesArray, $form) {
        $return = array();

        foreach ($valuesArray as $key => $value) {
            $field = $this->getField($form, $key);
            if (strlen($field) > 0)
                $return[$field] = $value;
        }

        return $return;
    }

    function assignFieldsReverse($valuesArray, $form) {
        $return = array();

        foreach ($valuesArray as $key => $value) {
            $field = $this->getFieldReverse($form, $key);
            if (strlen($field) > 0)
                $return[$field] = $value;
        }

        return $return;
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

//        $translator = new DFSTranslator();
//        $this->template->setTranslator($translator);
//$this->setLayout('@layout.latte');
//		if (!$this->getUser()->isLoggedIn()) {
//			if ($this->getUser()->logoutReason === Nette\Security\IUserStorage::INACTIVITY) {
//				$this->flashMessage('You have been signed out due to inactivity. Please sign in again.');
//			}
//			$this->redirect('Sign:in', array('backlink' => $this->storeRequest()));
//		}
    }

    /*     * ******************* view default ******************** */

    public function renderKennel_list() {
        $rows = $this->database->query("SELECT tbl_userkennel.*, tbl_user.state FROM tbl_userkennel INNER JOIN tbl_user ON tbl_user.id = tbl_userkennel.user_id")->fetchAll();

        $this->template->result = $rows;

        //var_dump($rows);
//        $this->template->image = "http://i00.i.aliimg.com/wsphoto/v1/32309935404_1/2015-Women-Halter-Push-Up-Bikini-Sexy-None-Swimwear-Beachwear-Swimsuit-Biquini-bikinis-Set.jpg"; //"img/referer1.jpg";
//        $this->template->name = "Meno kenela";
//        $this->template->registration_date = "22.06.1980";
//        $this->template->state = "Bosna";
    }

    public function renderDefault() {
        //$this->flashMessage("OK");
//predanie argumentov //$this->template->albums = $this->albums->findAll()->order('artist')->order('title');
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
    protected function createComponentKennelCreateProfile() {

        $form = new Form();
        $form->addText('txtKennelName')->setValue("Kennel");
        $form->addText('txtKennelFciNumber');
        $form->addUpload('txtKennelProfilePicture');
        $form->addText('txtKennelWebsite');
        $form->addTextArea('txtKennelDescription');
        $form->addText('hidddlBreedList');
        $form->addSubmit('btnSubmit', 'Create profile')->onClick[] = array($this, 'frmCreateProfileSucceeded');

        return $form;
    }

    public function frmCreateProfileSucceeded($button) {
        $values = $button->getForm()->getValues();

        var_dump($values);

        $values = $this->assignFields($values, 'frmKennelCreateProfile');

        $values['user_id'] = $this->logged_in_id;

        $this->database->table("tbl_userkennel")->insert($values);

        $userid = $this->database->getInsertId();

        //var_dump($values);
    }

}
