<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class bloggerPresenter extends BasePresenter {

    protected function createComponentFormAddArticle() {
        $form = new Form();

        $categories = $this->database->table("tbl_articles_groups")->where("parent_id=?", 3)->fetchAll(); // Articles group ID

        $ddlCategories = array();

        foreach ($categories as $category) {
            $ddlCategories[$category->group_name] = $category->group_name;
        }

        $form->addSelect("ddlArticleCategory")->setPrompt($this->translate("Please select"))->setItems($ddlCategories)->setRequired();
        $form->addText("txtArticleMainImage")->setRequired();
        $form->addText("txtArticleHeading")->setRequired();
        $form->addText("txtArticleDescription")->setRequired();
        $form->addUpload("txtArticleFileUpload")->setRequired();
        $form->addCheckbox("chkArticleTerms")->setRequired();
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmSubmitAddArticle');
        $form->addSubmit('btnCancel')->setValidationScope(FALSE)->onClick[] = array($this, 'frmCancelAddArticle');

        return $form;
    }

    public function frmCancelAddArticle($button) {
        $this->redirect("blogger:become_blogger");
    }

    public function frmSubmitAddArticle($button) {
        if ($this->logged_in_id > 0) {
            $values = $button->getForm()->getValues();

            $mail = new Nette\Mail\Message();

            $user = $this->database->table("tbl_user")->where("id=?", $this->logged_in_id)->fetch();

            $body = "<h1>New Article</h1><br/><hr/><br/>";

            $body .= "<b>Author's name:</b> " . $user->name . "<br/>";
            $body .= "<b>Author's surname:</b> " . $user->surname . "<br/>";
            $body .= "<b>Author's email:</b> " . $user->email . "<br/>";
            $body .= "<b>Author's state:</b> " . $user->state . "<br/>";

            $body .= "<br/><br/><hr><br/><br/>";

            $body .= "<b>Category:</b><br/>" . $values["ddlArticleCategory"] . "<br/>" . "<br/>";
            $body .= "<b>Heading:</b><br/>" . $values["txtArticleHeading"] . "<br/>" . "<br/>";
            $body .= "<b>Description:</b><br/>" . $values["txtArticleDescription"] . "<br/>" . "<br/>";

            $file = $values['txtArticleFileUpload'];

            $file_ext = strtolower(mb_substr($file->getSanitizedName(), strrpos($file->getSanitizedName(), ".")));

            $file_name = "article_document" . $file_ext;

            $mail->addAttachment($file_name, $file->getContents());

            $file_ext = strtolower(mb_substr($values["txtArticleMainImage"], strrpos($values["txtArticleMainImage"], ".")));
            $mail->addAttachment("article_main_image$file_ext", file_get_contents($values["txtArticleMainImage"]));

            $mail->setHtmlBody($body);
            $mail->addTo("radoslav.mihalus@gmail.com");
            $mail->addTo("info@dogforshow.com");
            $mail->setFrom($user->email);
            $mail->setEncoding("utf-8");
            $mail->setSubject("DOGFORSHOW - new article");

            $mailer = new Nette\Mail\SmtpMailer(array(
                'host' => 'mail.dogforshow.com',
                'username' => 'info@dogforshow.com',
                'password' => 'awqbn154',
            ));

            $mailer->send($mail);

            $this->flashMessage($this->translate("Your message has been successfully sent."), "Success");
            $this->redirect("blogger:become_blogger");
        } else {
            $this->flashMessage("You must be logged in", "Warning");
            $this->redirect("this");
        }
    }

    protected function createComponentFormAddInterview() {
        $form = new Form();

        $categories = $this->database->table("tbl_articles_groups")->where("parent_id=?", 4)->fetchAll(); // Articles group ID

        $ddlCategories = array();

        foreach ($categories as $category) {
            $ddlCategories[$category->group_name] = $category->group_name;
        }

        $form->addSelect("ddlInterviewCategory")->setPrompt($this->translate("Please select"))->setItems($ddlCategories)->setRequired();
        $form->addText("txtInterviewMainImage")->setRequired();
        $form->addText("txtInterviewHeading")->setRequired();
        $form->addText("txtInterviewDescription")->setRequired();
        $form->addUpload("txtInterviewFileUpload")->setRequired();
        $form->addCheckbox("chkArticleTerms")->setRequired();
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmSubmitAddInterview');
        $form->addSubmit('btnCancel')->setValidationScope(FALSE)->onClick[] = array($this, 'frmCancelAddArticle');

        return $form;
    }

    public function frmSubmitAddInterview($button) {
        if ($this->logged_in_id > 0) {
            $values = $button->getForm()->getValues();

            $mail = new Nette\Mail\Message();

            $user = $this->database->table("tbl_user")->where("id=?", $this->logged_in_id)->fetch();

            $body = "<h1>New Interview</h1><br/><hr/><br/>";

            $body .= "<b>Author's name:</b> " . $user->name . "<br/>";
            $body .= "<b>Author's surname:</b> " . $user->surname . "<br/>";
            $body .= "<b>Author's email:</b> " . $user->email . "<br/>";
            $body .= "<b>Author's state:</b> " . $user->state . "<br/>";

            $body .= "<br/><br/><hr><br/><br/>";

            $body .= "<b>Category:</b><br/>" . $values["ddlInterviewCategory"] . "<br/>" . "<br/>";
            $body .= "<b>Heading:</b><br/>" . $values["txtInterviewHeading"] . "<br/>" . "<br/>";
            $body .= "<b>Description:</b><br/>" . $values["txtInterviewDescription"] . "<br/>" . "<br/>";

            $file = $values['txtInterviewFileUpload'];

            $file_ext = strtolower(mb_substr($file->getSanitizedName(), strrpos($file->getSanitizedName(), ".")));

            $file_name = "interview_document" . $file_ext;

            $mail->addAttachment($file_name, $file->getContents());

            $file_ext = strtolower(mb_substr($values["txtInterviewMainImage"], strrpos($values["txtInterviewMainImage"], ".")));
            $mail->addAttachment("interview_main_image$file_ext", file_get_contents($values["txtInterviewMainImage"]));

            $mail->setHtmlBody($body);
            $mail->addTo("radoslav.mihalus@gmail.com");
            $mail->addTo("info@dogforshow.com");
            $mail->setFrom($user->email);
            $mail->setEncoding("utf-8");
            $mail->setSubject("DOGFORSHOW - new interview");

            $mailer = new Nette\Mail\SmtpMailer(array(
                'host' => 'mail.dogforshow.com',
                'username' => 'info@dogforshow.com',
                'password' => 'awqbn154',
            ));

            $mailer->send($mail);

            $this->flashMessage($this->translate("Your message has been successfully sent."), "Success");
            $this->redirect("blogger:become_blogger");
        } else {
            $this->flashMessage("You must be logged in", "Warning");
            $this->redirect("this");
        }
    }

    protected function createComponentFormAddPhotos() {
        $form = new Form();

        $categories = $this->database->table("tbl_articles_groups")->where("parent_id=?", 5)->fetchAll(); // Articles group ID

        $ddlCategories = array();

        foreach ($categories as $category) {
            $ddlCategories[$category->group_name] = $category->group_name;
        }

        $form->addSelect("ddlPhotogalleryCategory")->setPrompt($this->translate("Please select"))->setItems($ddlCategories)->setRequired();
        $form->addText("txtPhotogalleryMainImage")->setRequired();
        $form->addText("txtPhotogalleryHeading")->setRequired();
        $form->addText("txtPhotogalleryDescription")->setRequired();
        $form->addText("txtPhotogalleryImage");
        $form->addText("txtPhotogalleryImageDescription");
        for ($i = 2; $i < 21; $i++) {
            $form->addText("txtPhotogalleryImage" . $i);
            $form->addText("txtPhotogalleryImageDescription" . $i);
        }
        $form->addCheckbox("chkArticleTerms")->setRequired();
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmSubmitAddPhotos');
        $form->addSubmit('btnCancel')->setValidationScope(FALSE)->onClick[] = array($this, 'frmCancelAddArticle');

        return $form;
    }

    public function frmSubmitAddPhotos($button) {
        if ($this->logged_in_id > 0) {
            $values = $button->getForm()->getValues();

            $mail = new Nette\Mail\Message();

            $user = $this->database->table("tbl_user")->where("id=?", $this->logged_in_id)->fetch();

            $body = "<h1>New Photos</h1><br/><hr/><br/>";

            $body .= "<b>Author's name:</b> " . $user->name . "<br/>";
            $body .= "<b>Author's surname:</b> " . $user->surname . "<br/>";
            $body .= "<b>Author's email:</b> " . $user->email . "<br/>";
            $body .= "<b>Author's state:</b> " . $user->state . "<br/>";

            $body .= "<br/><br/><hr><br/><br/>";

            $body .= "<b>Category:</b><br/>" . $values["ddlPhotogalleryCategory"] . "<br/>" . "<br/>";
            $body .= "<b>Heading:</b><br/>" . $values["txtPhotogalleryHeading"] . "<br/>" . "<br/>";
            $body .= "<b>Description:</b><br/>" . $values["txtPhotogalleryDescription"] . "<br/>" . "<br/>";

            $file_ext = strtolower(mb_substr($values["txtPhotogalleryMainImage"], strrpos($values["txtPhotogalleryMainImage"], ".")));
            $file_name = "photogalery_main_image" . $file_ext;
            $mail->addAttachment($file_name, file_get_contents($values["txtPhotogalleryMainImage"]));

            $file_ext = strtolower(mb_substr($values["txtPhotogalleryImage"], strrpos($values["txtPhotogalleryImage"], ".")));
            $mail->addAttachment("photogalery_image1$file_ext", file_get_contents($values["txtPhotogalleryImage"]));
            $body .= "<b>photogalery_image1$file_ext:</b><br/>" . $values["txtPhotogalleryImageDescription"] . "<br/>" . "<br/>";

            for ($i = 2; $i < 21; $i++) {
                if (strlen($values["txtPhotogalleryImage" . $i]) > 0) {
                    $file_ext = strtolower(mb_substr($values["txtPhotogalleryImage" . $i], strrpos($values["txtPhotogalleryImage" . $i], ".")));
                    $mail->addAttachment("photogalery_image" . $i . "$file_ext", file_get_contents($values["txtPhotogalleryImage" . $i]));
                    $body .= "<b>photogalery_image" . $i . "$file_ext:</b><br/>" . $values["txtPhotogalleryImageDescription" . $i] . "<br/>" . "<hr>";
                }
            }

            $mail->setHtmlBody($body);
            $mail->addTo("radoslav.mihalus@gmail.com");
            $mail->addTo("info@dogforshow.com");
            $mail->setFrom($user->email);
            $mail->setEncoding("utf-8");
            $mail->setSubject("DOGFORSHOW - new photos");

            $mailer = new Nette\Mail\SmtpMailer(array(
                'host' => 'mail.dogforshow.com',
                'username' => 'info@dogforshow.com',
                'password' => 'awqbn154',
            ));

            $mailer->send($mail);

            $this->flashMessage($this->translate("Your message has been successfully sent."), "Success");
            $this->redirect("blogger:become_blogger");
        } else {
            $this->flashMessage("You must be logged in", "Warning");
            $this->redirect("this");
        }
    }

    protected function createComponentFormAddVideos() {
        $form = new Form();

        $categories = $this->database->table("tbl_articles_groups")->where("parent_id=?", 6)->fetchAll(); // Articles group ID

        $ddlCategories = array();

        foreach ($categories as $category) {
            $ddlCategories[$category->group_name] = $category->group_name;
        }

        $form->addSelect("ddlVideogalleryCategory")->setPrompt($this->translate("Please select"))->setItems($ddlCategories)->setRequired();
        $form->addText("txtVideogalleryMainImage")->setRequired();
        $form->addText("txtVideogalleryHeading")->setRequired();
        $form->addText("txtVideogalleryDescription")->setRequired();
        $form->addText("txtVideogalleryUrl")->setRequired();
        $form->addCheckbox("chkArticleTerms")->setRequired();
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmSubmitAddVideo');
        $form->addSubmit('btnCancel')->setValidationScope(FALSE)->onClick[] = array($this, 'frmCancelAddArticle');

        return $form;
    }

    public function frmSubmitAddVideo($button) {
        if ($this->logged_in_id > 0) {
            $values = $button->getForm()->getValues();

            $mail = new Nette\Mail\Message();

            $user = $this->database->table("tbl_user")->where("id=?", $this->logged_in_id)->fetch();

            $body = "<h1>New Video</h1><br/><hr/><br/>";

            $body .= "<b>Author's name:</b> " . $user->name . "<br/>";
            $body .= "<b>Author's surname:</b> " . $user->surname . "<br/>";
            $body .= "<b>Author's email:</b> " . $user->email . "<br/>";
            $body .= "<b>Author's state:</b> " . $user->state . "<br/>";

            $body .= "<br/><br/><hr><br/><br/>";

            $body .= "<b>Category:</b><br/>" . $values["ddlVideogalleryCategory"] . "<br/>" . "<br/>";
            $body .= "<b>Heading:</b><br/>" . $values["txtVideogalleryHeading"] . "<br/>" . "<br/>";
            $body .= "<b>Description:</b><br/>" . $values["txtVideogalleryDescription"] . "<br/>" . "<br/>";
            $body .= "<b>Video URL:</b><br/>" . $values["txtVideogalleryUrl"] . "<br/>" . "<br/>";

            $file_ext = strtolower(mb_substr($values["txtVideogalleryMainImage"], strrpos($values["txtVideogalleryMainImage"], ".")));
            $file_name = "videogalery_main_image" . $file_ext;
            $mail->addAttachment($file_name, file_get_contents($values["txtVideogalleryMainImage"]));

            $mail->setHtmlBody($body);
            $mail->addTo("radoslav.mihalus@gmail.com");
            $mail->addTo("info@dogforshow.com");
            $mail->setFrom($user->email);
            $mail->setEncoding("utf-8");
            $mail->setSubject("DOGFORSHOW - new video");

            $mailer = new Nette\Mail\SmtpMailer(array(
                'host' => 'mail.dogforshow.com',
                'username' => 'info@dogforshow.com',
                'password' => 'awqbn154',
            ));

            $mailer->send($mail);

            $this->flashMessage($this->translate("Your message has been successfully sent."), "Success");
            $this->redirect("blogger:become_blogger");
        } else {
            $this->flashMessage("You must be logged in", "Warning");
            $this->redirect("this");
        }
    }

}
