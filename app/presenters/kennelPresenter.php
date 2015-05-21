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

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    protected function startup() {
        parent::startup();
        $mysection = $this->getSession('userdata');
        $myid = $mysection->id;
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

    public function renderKennel_list()
    {
        $this->template->image = "http://i00.i.aliimg.com/wsphoto/v1/32309935404_1/2015-Women-Halter-Push-Up-Bikini-Sexy-None-Swimwear-Beachwear-Swimsuit-Biquini-bikinis-Set.jpg"; //"img/referer1.jpg";
        $this->template->name = "Meno kenela";
        $this->template->registration_date = "22.06.1980";
        $this->template->state = "Bosna";
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

        //var_dump($values);
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
