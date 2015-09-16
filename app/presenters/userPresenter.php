<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class userPresenter extends BasePresenter {

    //private $database;

    public function __construct(Nette\Database\Context $database) {
	$this->database = $database;
	$this->translator = new DFSTranslator();
    }

    protected function startup() {
	parent::startup();
    }

    public function renderUser_create_profile_switcher() {
	switch ($this->profile_type) {
	    case 1:
		$this->template->active_profile_kennel = true;
		$this->template->active_profile_owner = false;
		$this->template->active_profile_handler = false;
		break;
	    case 2:
		$this->template->active_profile_kennel = false;
		$this->template->active_profile_owner = true;
		$this->template->active_profile_handler = false;
		break;
	    case 3:
		$this->template->active_profile_kennel = false;
		$this->template->active_profile_owner = false;
		$this->template->active_profile_handler = true;
		break;
	    default :
		$this->template->active_profile_kennel = false;
		$this->template->active_profile_owner = false;
		$this->template->active_profile_handler = false;
		break;
	}
    }

    /*     * ******************* component factories ******************** */

    /**
     * Edit form factory.
     * @return Form
     */
    protected function createComponentUserEditAccount() {
	$lang = "en";

	try {
	    $section = $this->getSession('language');
	    if (strlen($section->lang) > 1)
		$lang = strtolower($section->lang);
	} catch (Exception $ex) {
	    $lang = "en";
	}
	$result = $this->database->table("lk_countries")->order("CountryName_$lang");
	$countries = array();

	$langs = array();

	$langs['cz'] = 'cz';
	$langs['de'] = 'de';
	$langs['en'] = 'en';
	$langs['hu'] = 'hu';
	$langs['sk'] = 'sk';

	foreach ($result as $row) {
	    $countries[$row->CountryName_en] = $row->CountryName_en;
	}

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
	    $country = $user->state;
	    $lang = $user->lang;
	}

	$form = new Form();
	$form->addText('txtName')
		->setRequired('Required field')->setValue($name);
	$form->addText('txtSurname')
		->setRequired('Required field')->setValue($surname);
	$form->addText('txtEmail')
		->setRequired('Required field')->setDisabled()->setValue($email);
	$form->addSelect('ddlCountries')->setItems($countries)->setPrompt("Please select")->setValue($country)->setRequired('Required field');
	$form->addSelect('ddlLanguage')->setItems($langs)->setPrompt("Please select")->setValue($lang)->setRequired('Required field');
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
    }

    /**
     * Delete form factory.
     * @return Form
     */
    protected function createComponentUserEditPassword() {
	$form = new Form();
	$form->addText('txtOldPassword')->setValue("")
		->setRequired('Required field');
	$form->addText('txtNewPassword')->setValue("")
		->setRequired('Required field');
	$form->addText('txtConfirmPassword')->setValue("")
		->setRequired('Required field');
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

	    if ($values['txtOldPassword'] != $pass)
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

}
