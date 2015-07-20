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
    }

    public function renderLogout() {
        $this->session->destroy();
        $this->flashMessage("You have been successsfully logged out", "Info");
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
        $form->addText('txtName');
        $form->addText('txtSurname');
        $form->addText('txtEmail');
        $form->addTextArea('txtMessage');
        $form->addText('txtVerify');
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

                $this->flashMessage("Your message was been successfully sent. We will contact you as soon as possible.", "Info");
            }
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
    }
    
    public function frmSignInSucceeded($button) {
        $is_error = FALSE;
        //try {
            $values = $button->getForm()->getValues();

            $exception = '<ul>';

            if ($values['ddlCountries'] == "0")
                $exception .= "<li>" . $this->translate("Please select state") . "</li>";

            if ($values['txtPassword'] != $values['txtConfirmPassword']) {
                $exception .= "<li>" . $this->translate("Password and confirm password does not match") . "</li>";
            }

            $values = $this->assignFields($values, 'frmSignIn');

            if (preg_match('/[0-9]+/', $values['name']) || preg_match('/[0-9]+/', $values['surname'])) {
                $exception .= "<li>" . $this->translate("Fields Name and Surname cannot contains digits") . "</li>";
            }

            $exception .= '</ul>';

            //echo $exception;

            if ($exception != '<ul></ul>') {
                throw new \Exception($exception);
            }

            $this->database->table("tbl_user")->insert($values);
            $userid = $this->database->getInsertId();

            $mail = new Message();
            $mail->setFrom('DOGFORSHOW <info@dogforshow.com>')
                    ->addTo($values['email'])
                    ->setSubject($this->translate('Welcome to DOGFORSHOW'))
                    ->setHtmlBody('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Welcome to DOGFORSHOW</title>
    </head>
    <body bgcolor="#f6f8f1" style="margin: 0; padding: 0; min-width: 100%!important;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;background-color:#8C8067;" >
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <table style="padding-bottom:20px; margin-top:10px; width: 90%; max-width: 600px;" class="content" bgcolor="white" align="center" cellpadding="10" cellspacing="0" border="0">
                        <tr>
                            <td align="center" style="border-bottom:#8C8067 1px solid">
                                <h1 style="font-size:23px;color:#8C8067;">' . $this->translate("Hello") . ' ' . $values['name'] . '</h1>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <p style="font-size:15px;">' . $this->translate('Thank you for your registration to DOGFORSHOW. Please activate your account by clicking on the following link') . '</p>
                            </td>
                        </tr>
			<tr>
                            <td align="center">
                                <p style="font-size:15px;"><a href="http://dfs.fsofts.eu" style="padding:10px; color:#FFFFFF; background-color: #c12e2a; text-decoration: none; text-transform: uppercase; font-weight: bold;">' . $this->translate('Activate account') . '</a></p>
                            </td>
                        </tr>
                    </table>
                    <table style="margin-top: 10px; width: 90%; max-width: 600px;color:white;" align="center" cellpadding="10" cellspacing="0" border="0">
                        <tr>
                            <td align="center">
                                <p style="font-size:12px;">' . $this->translate('This email was automatically sent by DOGFORSHOW system. Please dont reply on this email') . '</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>');

            $mailer = new SendmailMailer();
            $mailer->send($mail);

            $this->flashMessage('<ul><li><strong>' . $this->translate('Your registration has been successfully completed') . '</strong></li><li>' . $this->translate('Please check your Email for your user acccount activation') . '</li><li>' . $this->translate('If you have not received the Email yet, please also check your SPAM folder') . '</li></ul>', "Success");
//var_dump($values);
        //} catch (\Exception $ex) {
            //$this->flashMessage($ex->getMessage(), "Error");
            //$is_error = TRUE;
        //}
        if (!$is_error)
            $this->redirect("LandingPage:default");
    }
}
