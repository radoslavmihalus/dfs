<?php

use Nette\Application\UI;

class CommentsControl extends UI\Control {

    private $row;
    private $logged_in_id;
    private $profile_id;
    private $active_profile_id;
    private $data_model;
    private $database;

    public function __construct($row, $active_profile_id, $logged_in_id, $profile_id, $data_model, $database) {
        parent::__construct();
        $this->row = $row;
        $this->active_profile_id = $active_profile_id;
        $this->logged_in_id = $logged_in_id;
        $this->profile_id = $profile_id;
        $this->data_model = $data_model;
        $this->database = $database;
    }

    public function render() {
        $this->template->setFile(__DIR__ . "/comments_control.latte");
        $this->template->row = $this->row;
        $this->template->active_profile_id = $this->active_profile_id;
        $this->template->logged_in_id = $this->logged_in_id;
        $this->template->render();
    }

    public function handleTimelineRemoveComment($id = 0) {
//        if (isset($_GET['id']))
//            $id = $_GET['id'];

//        $this->database->table("tbl_comments")->where("id=?", $id)->fetch();

//        if (\DataModel::getPermission($id, $this->logged_in_profile_id, 8))
        $this->database->table("tbl_comments")->where("id=?", $id)->delete();

        if ($this->presenter->isAjax()) {
            $this->presenter->payload->message = "Success";
            $this->redrawControl();
        } else {
            $this->redirect("this", array(id => $this->profile_id));
        }
    }

    protected function createComponentCommentTimeline() {
//        return new Nette\Application\UI\Multiplier(function () {
        $form = new UI\Form();
        $form->getElementPrototype()->class('ajax');
        $form->addHidden("snippet_id");
        $form->addText("comment")->setRequired();
        $form->addSubmit('btnSubmit', "submit");
        $form->onSuccess[] = callback($this, 'commentSucceeded');
        return $form;
//        });
    }

    public function commentSucceeded(UI\Form $form) {
        $values = $form->values;

        $this->data_model->addTimelineComment($this->logged_in_id, $this->profile_id, $values['snippet_id'], $values['comment']);

        if ($this->presenter->isAjax()) {
            $this->presenter->payload->message = "Success";
            $form->setValues([], TRUE);
            $this->redrawControl();
        } else {
            $this->presenter->redirect('this');
        }
    }

}
