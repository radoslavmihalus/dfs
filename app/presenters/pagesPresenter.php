<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class pagesPresenter extends BasePresenter {

//    private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
        $this->translator = new DFSTranslator();
    }

    protected function startup() {
        parent::startup();
    }

    protected function beforeRender() {
        parent::beforeRender();
    }
    
    protected function renderGeneral_terms($lang)
    {
        
    }
    
    /*     * ******** renderers ************* */
    
    public function actionGeneral_terms($lang) {
        $mysection = $this->getSession('language');

        $mysection->lang = $lang;

        $this->translator->lang = $mysection->lang;
        
        $this->template->lang = $this->translator->lang;
    }
    public function actionCookie_policy($lang) {
        $mysection = $this->getSession('language');

        $mysection->lang = $lang;

        $this->translator->lang = $mysection->lang;
        
        $this->template->lang = $this->translator->lang;
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
    protected function createComponentAlbumForm() {
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
