<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class handlerPresenter extends BasePresenter {

    /** @var Model\AlbumRepository */
    //private $albums;
//    public function __construct() {
//        
//    }

    private $kmodel;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
        $this->kmodel = new \HandlerModel($database);
        $this->translator = new DFSTranslator();
    }

    protected function startup() {
        parent::startup();
    }
    
    
    public function renderHandler_list()
    {
        $this->template->handlers = $this->kmodel->fetchAll();
    }

    /*     * ******************* view default ******************** */

    public function renderDefault() {
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
    protected function createComponentHandlerCreateProfile() {
        $form = new Form();
        $form->addUpload('txtHandlerProfilePhoto');
        $form->addTextArea('txtHandlerDescritpion');
        $form->addText('hidddlBreedList');
        $form->addSubmit('btnSubmit', 'Create profile')->onClick[] = array($this, 'frmCreateProfileSucceeded');

        return $form;

//		$form = new Form;
//		$form->addText('artist', 'Artist:')
//			->setRequired('Please enter an artist.');
//
//		$form->addText('title', 'Title:')
//			->setRequired('Please enter a title.');
//
//		$form->addSubmit('save', 'Save')
//			->setAttribute('class', 'default')
//			->onClick[] = array($this, 'albumFormSucceeded');
//
//		$form->addSubmit('cancel', 'Cancel')
//			->setValidationScope(array())
//			->onClick[] = array($this, 'formCancelled');
//
//		$form->addProtection();
//		return $form;
    }

    public function frmCreateProfileSucceeded($button) {
        $values = $button->getForm()->getValues();

        var_dump($values);
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
