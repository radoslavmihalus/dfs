<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form,
    Nette\Mail\Message,
    Nette\Mail\SendmailMailer;

class loginPresenter extends \App\Presenters\BasePresenter {

    protected function createComponentFrmLogin() {
        $form = new Form();

        //$form->getElementPrototype()->class('ajax');
//        $form->addText("Email")->setRequired();
        $attr = array();
        $attr['autocomplete'] = "off";
        $form->getElementPrototype()->addAttributes($attr);
        $form->addText("Email");
        $form->addPassword("Password");
        $form->addSubmit("submit", "submit");
        $form->onSuccess[] = [$this, 'LoginUser'];

        return $form;
    }

    public function LoginUser(Nette\Forms\Form $form) {
        $values = $form->getValues();

        try {
            $this->getUser()->login($values['Email'], $values['Password']);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage());
        }

        if ($this->isAjax())
            $this->redrawControl("LoginSnippet");
        else {
            if ($this->user->loggedIn)
                $this->redirect("items:items");
            else
                $this->redirect("this");
        }
    }

}
