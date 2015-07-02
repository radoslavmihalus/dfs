<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class kennelPresenter extends BasePresenter {

    /** @var Model\AlbumRepository */
//private $albums;
//    public function __construct() {
//        
//    }
    private $database;
    private $logged_in_id;
    private $data_model;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
        $this->data_model = new \DataModel($database);
    }

    protected function startup() {
        parent::startup();
        try {
            $mysection = $this->getSession('userdata');
            $myid = $mysection->id;
            $this->logged_in_id = $myid;
            $userdata = $this->database->table("tbl_user")->where("id = ?", $myid);

            foreach ($userdata as $user) {
                $this->template->fullname = $user->name . ' ' . $user->surname;
                $this->template->profile_type = 'Kennel';
                $this->template->profile_type_icon = 'fa fa-home'; //handler - glyphicons glyphicons-shirt ... owner - fa fa-user
                $this->template->logged_in_id = $myid;
            }
        } catch (\Exception $ex) {
            $this->logged_in_id = 0;
        }

        $result = $this->database->table("tbl_breeds");

        $i = 0;

        $dditems = "";

        foreach ($result as $row) {
            if ($i == 0)
                $dditems .= $row->BreedName;
            else
                $dditems .= "," . $row->BreedName;

            $i++;
        }

        //echo $dditems;

        $this->template->dd_breeds_items = $dditems;
    }

    /*     * ******************* view default ******************** */

    public function renderKennel_list() {
        $rows = $this->database->query("SELECT tbl_userkennel.*, tbl_user.state FROM tbl_userkennel INNER JOIN tbl_user ON tbl_user.id = tbl_userkennel.user_id")->fetchAll();

        $this->template->result = $rows;
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
    //Create profile

    protected function createComponentKennelCreateProfile() {

        $form = new Form();
        $form->addText('txtKennelName');
        $form->addText('txtKennelFciNumber');
        $form->addUpload('txtKennelProfilePicture');
        $form->addText('txtKennelWebsite');
        $form->addTextArea('txtKennelDescription');
        $form->addText('hidddlBreedList');
        $form->addSubmit('btnSubmit', 'Create profile')->onClick[] = array($this, 'frmCreateProfileSucceeded');

        return $form;
    }

    public function frmCreateProfileSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $form = $button->getForm();

            $img = $form['txtKennelProfilePicture']->getValue();

            //var_dump($values['txtKennelProfilePicture']);

            $target_path = "uploads/";

            $ext = '';

            $ext = explode('.', $img->name);

            $length = count($ext);

            $ext = $ext[$length - 1];

            switch ($ext) {
                case 'gif':
                    $ext = 'gif';
                    break;
                case 'jpeg':
                    $ext = 'jpg';
                    break;
                case 'jpg':
                    $ext = 'jpg';
                    break;
                case 'png':
                    $ext = 'png';
                    break;
                default :
                    throw new \Exception("Only .gif / .jpeg / .jpg / .png extensions are allowed", "1");
                    break;
            }

            $filename = \KennelUpdateModel::generateRandomString() . ".$ext";

            $img->move("$target_path/$filename");

            $values['txtKennelProfilePicture'] = "$target_path/$filename";

            $values = $this->data_model->assignFields($values, 'frmKennelCreateProfile');
            $values['user_id'] = $this->logged_in_id;

            $this->database->table("tbl_userkennel")->insert($values);
            $profileid = $this->database->getInsertId();

            $this->redirectUrl("kennel-profile");
            exit;
        } catch (\Exception $exc) {
            $this->flashMessage($exc->getMessage());
        }


        //var_dump($values);
    }

    //Update profile

    protected function createComponentKennelEditProfile() {
        $data = $this->database->table("tbl_userkennel")->where("user_id=?", $this->logged_in_id);

        $data = $this->data_model->assignFieldsReverse($data, "frmKennelCreateProfile");

        var_dump($data);

        $form = new Form();

        $form->addText('txtKennelName');
        $form->addText('txtKennelFciNumber');
        $form->addText('txtKennelWebsite');
        $form->addTextArea('txtKennelDescription');
        $form->addText('hidddlBreedList');
        $form->addSubmit('btnSubmit', 'Create profile')->onClick[] = array($this, 'frmCreateProfileSucceeded');

        $form->setValues($data, TRUE);

        return $form;
    }

}
