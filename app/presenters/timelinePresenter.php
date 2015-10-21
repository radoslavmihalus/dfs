<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class timelinePresenter extends BasePresenter {

//    private $database;
//    public function __construct(Nette\Database\Context $database) {
//        $this->database = $database;
//        $this->translator = new DFSTranslator();
//        $this->data_model = new \DataModel($database);
//    }

    protected function startup() {
        parent::startup();
    }

    public function beforeRender() {
        parent::beforeRender();

        $count = $this->data_model->getTimelineCount();

        $this->paginator->getPaginator()->setItemCount($count);
        $this->paginator->getPaginator()->setItemsPerPage(9);

        $this->template->timeline_rows = $this->data_model->getTimeline(0, $this->paginator->getPaginator()->getLength(), $this->paginator->getPaginator()->getOffset());
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
