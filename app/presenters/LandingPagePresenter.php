<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form,
    Nette\Mail\Message,
    Nette\Mail\SendmailMailer;

class LandingPagePresenter extends BasePresenter {

    //private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
        $this->translator = new DFSTranslator();
    }

    protected function startup() {
        parent::startup();

        if (isset($_GET['activated']))
        {
            $this->flashMessage($this->translate("Account has been successfully activated."), "Success");
            $this->redirect("default");
        }

        if (isset($_GET['resend_al'])) {
            $row = $this->database->table("tbl_user")->where("id=?", $_GET['resend_al'])->fetch();

            $mail_to = $row->email;
            $name_to = $row->name;
            $userid = $row->id;

            $this->sendActivationEmail($mail_to, $name_to, $userid);

            $this->flashMessage($this->translate("Your activation link has been successfully sent."), "Success");
            
            $this->redirect("default");
        }
    }

    public function renderLogout() {
        $this->session->destroy();
        $this->flashMessage($this->translate("You have been successsfully logged out"), "Info");
        $this->redirect("default");
    }

    /*     * ******************* view default ******************** */

    public function renderDefault() {
    }

    /*     * ******************* component factories ******************** */

    /**
     * Edit form factory.
     * @return Form
     */
    protected function createComponentFrmContactForm() {
        $form = new Form();
        $form->addText('txtName')->setRequired($this->translate("Required field"));
        $form->addText('txtSurname')->setRequired($this->translate("Required field"));
        $form->addText('txtEmail')->setRequired($this->translate("Required field"));
        $form->addTextArea('txtMessage')->setRequired($this->translate("Required field"));
        $form->addText('txtVerify')->setRequired($this->translate("Required field"));
        $form->addSubmit('btnSubmit', 'Create profile')->onClick[] = array($this, 'frmContactFormSucceeded');

        return $form;
    }

    public function frmContactFormSucceeded($button) {
        $values = $button->getForm()->getValues();

        try {
            $mail = new Message();

            if ($values['txtVerify'] != 2) {
                throw new \Exception("CAPTCHA is not valid.");
            } else {
                $mail->setFrom($values['txtName'] . ' ' . $values['txtSurname'] . ' <' . $values['txtEmail'] . '>') //$values['txtEmail']) //DOGFORSHOW <info@dogforshow.com>
                        ->addTo('info@dogforshow.com')
                        ->addTo('radoslav.mihalus@gmail.com')
                        ->setSubject('DOGFORSHOW - Contact Form')
                        ->setBody('Name: ' . $values['txtName'] . '<br/>Surname: ' . $values['txtSurname'] . '<br/>Email: ' . $values['txtEmail'] . '<br/><br/>Message:<br/>' . $values['txtMessage'])
                        ->setContentType('text/html')
                        ->setEncoding('UTF-8');

//var_dump($mail);

                $mailer = new SendmailMailer();
                $mailer->send($mail);

                $this->flashMessage($this->translate("Your message was been successfully sent. We will contact you as soon as possible."), "Info");
            }
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
    }

}
