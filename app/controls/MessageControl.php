<?php

use Nette\Application\UI;

class MessageControl extends UI\Control {

    private $row;
    private $logged_in_id;
    private $profile_id;
    private $active_profile_id;
    private $data_model;
    private $database;

    public function __construct($row, $active_profile_id, $logged_in_id, $profile_id, DataModel $data_model, Nette\Database\Context $database) {
        parent::__construct();
        $this->row = $row;
        $this->active_profile_id = $active_profile_id;
        $this->logged_in_id = $logged_in_id;
        $this->profile_id = $profile_id;
        $this->data_model = $data_model;
        $this->database = $database;
    }

    public function render() {
        $this->template->setFile(__DIR__ . "/MessageControl.latte");
        $this->template->row = $this->row;
        $this->template->active_profile_id = $this->active_profile_id;
        $this->template->logged_in_id = $this->logged_in_id;
        $this->template->render();
    }

    protected function createComponentFrmContactForm() {
//        return new Nette\Application\UI\Multiplier(function () {
        $form = new UI\Form();
        $form->getElementPrototype()->class('ajax');
        $form->addHidden("txtUrl");

        if ($this->logged_in_id > 0) {
            $user = $this->database->table("tbl_user")->where("id=?", $this->logged_in_id)->fetch();
            $form->addText("txtName")->setValue($user->name);
            $form->addText("txtSurname")->setValue($user->surname);
            $form->addText("txtEmail")->setValue($user->email);
        } else {
            $form->addText("txtName")->setRequired();
            $form->addText("txtSurname")->setRequired();
            $form->addText("txtEmail")->setRequired();
        }

        $form->addTextArea("txtMessage")->setRequired();
        $form->addSubmit('btnSubmit', "submit");
        $form->onSuccess[] = callback($this, 'messageSucceeded');
        return $form;
//        });
    }

    public function messageSucceeded(UI\Form $form) {
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
