<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class bloggerPresenter extends BasePresenter {
    
    protected function createComponentFormAddArticle() {
        $form = new Form();

        $form->addSelect("ddlArticleCategory")->setPrompt($this->translate("Please select"));
        $form->addText("txtArticleMainImage");
        $form->addText("txtArticleHeading");
        $form->addText("txtArticleDescription");
        $form->addText("txtArticleFileUpload");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmSubmitDogFilter');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'frmCancelDogFilter');

        return $form;
    }
    
    protected function createComponentFormAddInterview() {
        $form = new Form();

        $form->addSelect("ddlInterviewCategory")->setPrompt($this->translate("Please select"));
        $form->addText("txtInterviewMainImage");
        $form->addText("txtInterviewHeading");
        $form->addText("txtInterviewDescription");
        $form->addText("txtInterviewFileUpload");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmSubmitDogFilter');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'frmCancelDogFilter');

        return $form;
    }
    
    protected function createComponentFormAddPhotos() {
        $form = new Form();

        $form->addSelect("ddlPhotogalleryCategory")->setPrompt($this->translate("Please select"));
        $form->addText("txtPhotogalleryMainImage");
        $form->addText("txtPhotogalleryHeading");
        $form->addText("txtPhotogalleryDescription");
        $form->addText("txtPhotogalleryImage");
        $form->addText("txtPhotogalleryImageDescription");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmSubmitDogFilter');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'frmCancelDogFilter');

        return $form;
    }
    
    protected function createComponentFormAddVideos() {
        $form = new Form();

        $form->addSelect("ddlVideogalleryCategory")->setPrompt($this->translate("Please select"));
        $form->addText("txtVideogalleryMainImage");
        $form->addText("txtVideogalleryHeading");
        $form->addText("txtVideogalleryDescription");
        $form->addText("txtVideogalleryUrl");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmSubmitDogFilter');
        $form->addSubmit('btnCancel')->onClick[] = array($this, 'frmCancelDogFilter');

        return $form;
    }

}
