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

    public function fetchResult() {
        $count = $this->data_model->getTimelineCount();

        $this->paginator->getPaginator()->setItemCount($count);
        $this->paginator->getPaginator()->setItemsPerPage(10);

        return $this->data_model->getTimeline(0, $this->paginator->getPaginator()->getLength(), $this->paginator->getPaginator()->getOffset());
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

    //dynamic loading timeline start

    public function actionTimeline_wall($reset = 0) {
        if ($reset == 1) {
            $page = $this->session->getSection("timeline_page");
            $page->page = 0;
        }
    }

    public function renderTimeline_wall() {
        $page = $this->session->getSection("timeline_page");

        if ($page->page > 0) {
            $this->paginator->getPaginator()->setPage($page->page);
        }

        $this->template->timeline_rows = $this->fetchResult($offset);

        $page->page = $page->page + 1;

        $i = 0;
        // vypise prvnich 9 hodnot
    }

    public function handleLoadMore() {
        $page = $this->session->getSection("timeline_page");
        $page->page = $page->page + 1;
        $result = $this->fetchResult();

        $this->template->timeline_rows = $result;

        if ($this->isAjax()) {
            $this->redrawControl("timeline");
        }

        // zvýšení poradi o 9 - pocet vypsaných prvků
    }

    //dynamic loading timeline end
}
