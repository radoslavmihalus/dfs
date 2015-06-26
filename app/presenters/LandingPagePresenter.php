<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form,
    Nette\Mail\Message,
    Nette\Mail\SendmailMailer;

class LandingPagePresenter extends BasePresenter {

    private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    function getField($form_name, $element_name) {
        $fields = $this->database->query("SELECT * FROM form_fields WHERE form_name=? AND element_name=?", $form_name, $element_name);

        $return = "";

        foreach ($fields as $field) {
            $return = $field->field_name;
        }
        return $return;
    }

    function assignFields($valuesArray, $form) {
        $return = array();

        foreach ($valuesArray as $key => $value) {
            $field = $this->getField($form, $key);
            if (strlen($field) > 0)
                $return[$field] = $value;
        }

        return $return;
    }

    protected function startup() {
        parent::startup();
    }

    /*     * ******************* view default ******************** */

    public function renderDefault() {
        
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

                $this->flashMessage("Your message was been successfully sent. We will contact you as soon as possible.");
            }
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
    }

    protected function createComponentFrmSignIn() {
        $result = $this->database->table("lk_countries")->order("CountryName_sk");
        $items = array();

        foreach ($result as $row) {
            $items[$row->CountryName_en] = $row->CountryName_en;
        }

        $form = new Form();
        $form->addText("txtName")->setRequired();
        $form->addText("txtSurname")->setRequired();
        $form->addText("txtEmail")->setRequired();
        $form->addText("hidddlCountries")->setRequired();
        $form->addSelect("ddlCountries")->setItems($items);
        $form->addPassword("txtPassword")->setRequired();
        $form->addPassword("txtConfirmPassword")->setRequired();
        $form->addSubmit('btnSignIn', 'Register')->onClick[] = array($this, 'frmSignInSucceeded');
        return $form;
    }

    protected function createComponentFrmLogIn() {
        $form = new Form();
        $form->addText("txtEmail");
        $form->addPassword("txtPassword");
        $form->addCheckbox("chkRemember");
        $form->addSubmit('btnLogin', 'Login')->onClick[] = array($this, 'frmLogInSucceeded');
        return $form;
    }

    public function frmSignInSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();


            $exception = '<ul>';

            if ($values['txtPassword'] != $values['txtConfirmPassword']) {
                $exception .= "<li>Password and confirm password does not match</li>";
            }

            $values = $this->assignFields($values, 'frmSignIn');

            if (preg_match('/[0-9]+/', $values['name']) || preg_match('/[0-9]+/', $values['surname'])) {
                $exception .= "<li>Fields Name and Surname cannot contains digits</li>";
            }

            $exception .= '</ul>';

            if ($exception != '<ul></ul>')
                throw new \Exception($exception);

            $this->database->table("tbl_user")->insert($values);
            $userid = $this->database->getInsertId();

            $mail = new Message();
            $mail->setFrom('DOGFORSHOW <info@dogforshow.com>')
                    ->addTo($values['email'])
                    ->setSubject('Welcome to DOGFORSHOW')
                    ->setHtmlBody('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Welcome to DOGFORSHOW</title>
        <style type="text/css">
        body {margin: 0; padding: 0; min-width: 100%!important;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;background-color:#8C8067;}
        .content {width: 90%;margin-top:10px;padding:20px; max-width: 600px;}  
		.content p {font-size:15px;}
		.footer {width: 90%;margin-top:10px;padding:20px; max-width: 600px;color:white;} 
		.footer p {font-size:12px;}
		h1 {font-size:23px;color:#8C8067;font-family: "Roboto Condensed", sans-serif;}
		a.activationlink:active {text-decoration:none;padding: 10px 16px;font-size: 18px;line-height: 1.3333333;border-radius: 6px;white-space: nowrap;vertical-align: middle;cursor: pointer;font-family: "Roboto Condensed", sans-serif;background-color: #c12e2a;color:white;text-transform:uppercase;}
		a.activationlink:link {text-decoration:none;padding: 10px 16px;font-size: 18px;line-height: 1.3333333;border-radius: 6px;white-space: nowrap;vertical-align: middle;cursor: pointer;font-family: "Roboto Condensed", sans-serif;background-color: #c12e2a;color:white;text-transform:uppercase;}
		a.activationlink:visited {text-decoration:none;padding: 10px 16px;font-size: 18px;line-height: 1.3333333;border-radius: 6px;white-space: nowrap;vertical-align: middle;cursor: pointer;font-family: "Roboto Condensed", sans-serif;background-color: #c12e2a;color:white;text-transform:uppercase;}
		a.activationlink:hover {text-decoration:none;padding: 10px 16px;font-size: 18px;line-height: 1.3333333;border-radius: 6px;white-space: nowrap;vertical-align: middle;cursor: pointer;font-family: "Roboto Condensed", sans-serif;background-color: #c12e2a;color:white;text-transform:uppercase;}
        </style>
		<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300" rel="stylesheet" type="text/css">
    </head>
    <body bgcolor="#f6f8f1">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <table class="content" bgcolor="white" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td align="center" style="border-bottom:#8C8067 1px solid">
                                <h1>Hello <strong>' . $values['name'] . '</strong></h1>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <p>Thank you for your registration to DOGFORSHOW. Please activate your account by clicking on the following link - ACTIVATE ACCOUNT.</p>
                            </td>
                        </tr>
						<tr>
                            <td align="center">
                                <p><a href="http://dfs.fsofts.eu" class="activationlink">Activate account</a></p>
                            </td>
                        </tr>
                    </table>
					<table class="footer" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td align="center">
                                <p>This email was automatically sent by DOGFORSHOW system. Please do not reply on it.</p>
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

            $this->flashMessage('<ul><li><strong>Your registration has been successfully completed</strong></li><li>Please check your Email for your user acccount activation</li><li>If you have not received the Email yet, please also check your SPAM folder</li></ul>', "Success");
            //var_dump($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
    }

    public function frmLogInSucceeded($button) {
        $values = $button->getForm()->getValues();

        $result = $this->database->query("SELECT * FROM tbl_user WHERE email=? AND password=?", $values['txtEmail'], $values['txtPassword']);

        $id = 0;

        $user_section = $this->getSession('userdata');

        foreach ($result as $row) {
            $id = $row->id;
            $user_section->name = $row->name;
            $user_section->surname = $row->surname;
            $user_section->id = $row->id;
        }

        if ($id == 0) {
            $this->flashMessage("Wrong username or password.", "Warning");
        } else {
            $this->redirect("user:user_create_profile_switcher");
        }
    }

    /**
     * Delete form factory.
     * @return Form
     */
    protected function createComponentDeleteForm() {
        
    }

    public function deleteFormSucceeded() {
        
    }

    public function formCancelled() {
        $this->redirect('default');
    }

}
