<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class userPresenter extends BasePresenter {

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

        try {
            $mysection = $this->getSession('userdata');
            $myid = $mysection->id;
            $userdata = $this->database->table("tbl_user")->where("id = ?", $myid);

            foreach ($userdata as $user) {
                $this->template->fullname = $user->name . ' ' . $user->surname;
                $this->template->profile_type = 'Spectator';
                $this->template->profile_type_icon = 'fa fa-eye'; //handler - glyphicons glyphicons-shirt ... owner - fa fa-user
                $this->template->logged_in_id = $myid;
            }
        } catch (\Exception $ex) {
            $this->template->logged_in_id = 0;
        }
    }

    /*     * ******************* view default ******************** */

    public function renderDefault() {
//predanie argumentov //$this->template->albums = $this->albums->findAll()->order('artist')->order('title');
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
    protected function createComponentUserEditAccount() {

        $yt = date('Y');
        $years = array();

        $years[] = "Year";

        for ($i = $yt; $i > ($yt - 100); $i--) {
            $years[$i] = $i;
        }

        $mysection = $this->getSession('userdata');
        $myid = $mysection->id;
        $userdata = $this->database->table("tbl_user")->where("id = ?", $myid);

        foreach ($userdata as $user) {
            $name = $user->name;
            $surname = $user->surname;
            $email = $user->email;
            $address = $user->address;
            $city = $user->city;
            $zip = $user->zip;
            $phone = $user->phone;
            $year_of_birth = $user->year_of_birth;
        }

        $form = new Form();
        $form->addText('txtName')
                ->setRequired('Please enter.')->setValue($name);
        $form->addText('txtSurname')
                ->setRequired('Please enter.')->setValue($surname);
        $form->addText('txtEmail')
                ->setRequired('Please enter.')->setDisabled()->setValue($email);
        $form->addText('txtAddress')->setValue($address);
        $form->addText('txtTown')->setValue($city);
        $form->addText('txtZip')->setValue($zip);
        $form->addText('txtPhoneNumber')->setValue($phone);
        $form->addSelect('ddlYear')->setItems($years)->setValue($year_of_birth);

        $form->addSubmit('submit')
                ->onClick[] = array($this, 'editUserSucceeded');

        return $form;
//
//		$form->addProtection();
//		return $form;
    }

    public function editUserSucceeded($button) {
        $values = $button->getForm()->getValues();
        $values = $this->assignFields($values, 'frmEditUser');

        $mysection = $this->getSession('userdata');
        $myid = $mysection->id;

        $userdata = $this->database->table("tbl_user")->where("id = ?", $myid)->update($values);

        $this->flashMessage("User updated successfully", "Success");
        $this->redirect('user:user_edit_account');

//		$values = $button->getForm()->getValues();
//		$id = (int) $this->getParameter('id');
//		if ($id) {
//			$this->albums->findById($id)->update($values);
//			$this->flashMessage('The album has been updated.');
//		} else {
//			$this->albums->insert($values);
//			$this->flashMessage('The album has been added.');
//		}
//		$this->redirect('default');
    }

    /**
     * Delete form factory.
     * @return Form
     */
    protected function createComponentUserEditPassword() {
        $form = new Form();
        $form->addText('txtOldPassword')->setValue("")
                ->setRequired('Please enter.');
        $form->addText('txtNewPassword')->setValue("")
                ->setRequired('Please enter.');
        $form->addText('txtConfirmPassword')->setValue("")
                ->setRequired('Please enter.');
        $form->addSubmit('submit')
                ->onClick[] = array($this, 'editPasswordSucceeded');

        return $form;
    }

    public function editPasswordSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $mysection = $this->getSession('userdata');
            $myid = $mysection->id;

            $userdata = $this->database->table("tbl_user")->where("id = ?", $myid);
            $pass = "";

            foreach ($userdata as $user) {
                $pass = $user->password;
            }

            if($values['txtOldPassword']!=$pass)
                throw new \ErrorException("You have entered wrong old password.");
            
            if ($values['txtNewPassword'] != $values['txtConfirmPassword'])
                throw new \ErrorException("Password and confirm password does not match.");

            $values = $this->assignFields($values, 'frmEditPassword');

            $userdata = $this->database->table("tbl_user")->where("id = ?", $myid)->update($values);

            $this->flashMessage("Password changed successfully. Please log in with your new password.", "Success");
            $this->redirect('LandingPage:default');
        } catch (\ErrorException $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
            $this->redirect('user:user_edit_account');
        }
    }

    public function deleteFormSucceeded() {
//		$this->albums->findById($this->getParameter('id'))->delete();
//		$this->flashMessage('Album has been deleted.');
//		$this->redirect('default');
    }

    public function formCancelled() {
        $this->redirect('default');
    }

}
