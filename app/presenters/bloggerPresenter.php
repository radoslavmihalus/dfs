<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class bloggerPresenter extends BasePresenter {
    
    protected function createComponentFormAddArticle() {
        $form = new Form();

        $form->addSelect("ddlArticleCategory")->setPrompt($this->translate("Please select"));
        $form->addText("txtArticleHeading");
        $form->addText("txtArticleMainImage");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmSubmitDogFilter');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'frmCancelDogFilter');

        return $form;
    }

}
