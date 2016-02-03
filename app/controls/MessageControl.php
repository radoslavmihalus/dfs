<?php

use Nette\Application\UI;

class MessageControl extends UI\Control {

    private $row;
    private $logged_in_id;
    private $profile_id;
    private $active_profile_id;
    private $data_model;
    private $database;
    private $translator;

    public function __construct($row, $active_profile_id, $logged_in_id, $profile_id, DataModel $data_model, Nette\Database\Context $database, $translator) {
        parent::__construct();
        $this->row = $row;
        $this->active_profile_id = $active_profile_id;
        $this->logged_in_id = $logged_in_id;
        $this->profile_id = $profile_id;
        $this->data_model = $data_model;
        $this->database = $database;
        $this->translator = $translator;
    }

    public function render() {
        $this->template->setFile(__DIR__ . "/MessageControl.latte");
        $this->template->setTranslator($this->translator);
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

        try {
            if ($this->logged_in_id > 0)
                $recaptcha = "123456789012345";
            else
                $recaptcha = $_POST['g-recaptcha-response'];


            if (strlen($recaptcha) > 10) {
                $mail = new Message();

                $mail->setFrom($values['txtName'] . ' ' . $values['txtSurname'] . ' <' . $values['txtEmail'] . '>') //$values['txtEmail']) //DOGFORSHOW <info@dogforshow.com>
                        ->addTo('info@dogforshow.com')
                        ->addTo('radoslav.mihalus@gmail.com')
                        ->setSubject('DOGFORSHOW - Contact Form')
                        ->setHtmlBody('Name: ' . $values['txtName'] . '<br/>Surname: ' . $values['txtSurname'] . '<br/>Email: ' . $values['txtEmail'] . '<br/><br/>Message:<br/>' . $values['txtMessage'])
                        ->setContentType('text/html')
                        ->setEncoding('UTF-8');

                $mailer = new SendmailMailer();
                $mailer->send($mail);

                $this->flashMessage($this->translate("Your message has been successfully sent. We will contact you as soon as possible."), "Info");
            } else {
                $this->flashMessage($this->translate("Your message has not been sent. Verification is required."), "Info");
            }
//}
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
    }

}
