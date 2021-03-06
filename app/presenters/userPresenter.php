<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class userPresenter extends BasePresenter {

    //private $database;
//    public function __construct(Nette\Database\Context $database) {
//        $this->database = $database;
//        $this->translator = new DFSTranslator();
//    }

    public $amt;
    public $timeline_id;

    protected function startup() {
        parent::startup();

        $country_users = $this->database->query("SELECT `state`, ((count(*)/(SELECT count(*) FROM tbl_user))*100) as popularity FROM `tbl_user` GROUP BY `state`")->fetchAll();

        $this->template->country_users = $country_users;
    }

    public function actionUser_create_profile_switcher_new() {
        if ($this->logged_in_id > 0) {
            
        } else {
            $this->redirect("LandingPage:default", array("lang" => $this->lang));
        }
    }

    public function renderUser_notification_list() {
        $rows = $this->database->table("tbl_notify")->where("notify_user_id=?", $this->logged_in_id)->order("notify_datetime DESC")->fetchAll();

        $this->template->notifications_list = $rows;

        if ($this->timeline_id > 0)
            $this->template->timeline_id = $this->timeline_id;
        else
            $this->template->timeline_id = 0;
    }

    public function handleShowTimeline($timeline_id) {
        $this->timeline_id = $timeline_id;
        $this->template->timeline_id = $timeline_id;

        if ($this->isAjax())
            $this->redrawControl("myTimelineEvent");
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

    public function actionUser_premium() {
        if (!$this->lang) {
            $this->lang = "en";
        }
        try {
            $data = array();

            $data['user_id'] = $this->logged_in_id;
            $this->database->table("tbl_user_premium_visits")->insert($data);
        } catch (\Exception $ex) {
            
        }

        try {
            $this->createCountdown();
        } catch (\Exception $ex) {
            
        }
    }

    public function actionUser_premium_activation() {
        if (isset($_GET['amt']))
            $amt = $_GET['amt'];

        $amt = $this->getPremiumPrice();

        $this->amt = $amt;

        //handleTrustPay
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
        } catch (\Exception $ex) {
            $lang = "en";
        }
        $result = $this->database->table("lk_countries")->order("CountryName_$lang");
        $countries = array();

        $langs = array();

        $langs['cz'] = 'cz';
//        $langs['de'] = 'de';
        $langs['en'] = 'en';
        $langs['hu'] = 'hu';
        $langs['ru'] = 'ru';
        $langs['sk'] = 'sk';

        foreach ($result as $row) {
            $countries[$row->CountryName_en] = $this->translate($row->CountryName_en);
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
        $form->addSelect('ddlCountries')->setItems($countries)->setPrompt($this->translate("Please select"))->setValue($country)->setRequired('Required field');
        $form->addSelect('ddlLanguage')->setItems($langs)->setPrompt($this->translate("Please select"))->setValue($lang)->setRequired('Required field');
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

    public function createComponentFrmVoucher() {
        $form = new Form();

        $form->addText("voucher")->setRequired();
        $form->addSubmit("submit");
        $form->onSuccess[] = callback($this, "frmVoucherCompleted");

        return $form;
    }

    public function frmVoucherCompleted(Form $form) {
        $values = $form->getValues();

        if ($this->logged_in_id > 0) {
            $voucher = $this->database->table("tbl_voucher")->where("voucher=?", $values['voucher'])->where("used=?", 0)->fetch();

            if ($voucher) {
                $data = array();

                $data['user_id'] = $this->logged_in_id;
                //$data['applied'] = date("Y-m-d H:i:s");
                $data['used'] = 1;

                $user = $this->database->table("tbl_user")->where("id=?", $this->logged_in_id)->fetch();

                if ($user) {
                    $user_data = array();
                    if ($user->premium_expiry_date >= date("Y-m-d"))
                        $user_data['premium_expiry_date'] = date("Y-m-d", strtotime($user['premium_expiry_date'] . ' + ' . $voucher->days . ' days'));
                    else
                        $user_data['premium_expiry_date'] = date("Y-m-d", strtotime(date("Y-m-d") . ' + ' . $voucher->days . ' days'));

                    $this->database->table("tbl_user")->where("id=?", $this->logged_in_id)->update($user_data);
                    $this->database->table("tbl_voucher")->where("voucher=?", $values['voucher'])->update($data);

                    $this->flashMessage($this->translate("Your premium account has been successfully activated."), "Success");
                    if ($this->logged_in_profile_id > 0)
                        $this->redirect(\DataModel::getProfileLinkUrl($this->logged_in_profile_id));
                    else
                        $this->redirect("this");
                }
                else {
                    $this->flashMessage($this->translate("Invalid voucher number"), "Warning");
                    $this->redirect("this");
                }
            } else {
                $this->flashMessage($this->translate("Invalid voucher number"), "Warning");
                $this->redirect("this");
            }
        }
    }

    public function editUserSucceeded($button) {
        $values = $button->getForm()->getValues();
        $values = $this->assignFields($values, 'frmEditUser');

        $mysection = $this->getSession('userdata');
        $myid = $mysection->id;

        $userdata = $this->database->table("tbl_user")->where("id = ?", $myid)->update($values);

        $this->flashMessage($this->translate("User updated successfully"), "Success");
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

            $this->handleLogoutChangePassword();
        } catch (\ErrorException $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
            $this->redirect('user:user_edit_account');
        }
    }

}
