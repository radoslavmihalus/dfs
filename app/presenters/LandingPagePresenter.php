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

        $this->template->states = $this->database->table("lk_countries")->order("CountryName_sk");
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
            $this->flashMessage($ex->getMessage());
        }
    }

    protected function createComponentFrmSignIn() {
        $form = new Form();
        $form->addText("txtName");
        $form->addText("txtSurname");
        $form->addText("txtEmail");
        $form->addText("hidddlCountries");
        $form->addPassword("txtPassword");
        $form->addPassword("txtConfirmPassword");
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
            $mail->setFrom('Franta <dfs@fsofts.eu>')
                    ->addTo($values['email'])
                    ->setSubject('Potvrdenie registracie')
                    ->setBody("Hello " . $values['name'] . " " . $values['surname'] . "\r\n\r\nYour password is: " . $values['password']);

            $mailer = new SendmailMailer();
            $mailer->send($mail);

            $this->flashMessage('User created successfully.');
            //var_dump($values);
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage());
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
            $this->flashMessage("Wrong username or password.");
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
