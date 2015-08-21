<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form,
    Nette\Mail\Message,
    Nette\Mail\SendmailMailer;

require_once 'www/inc/config_ajax.php';

/**
 * Base presenter for all application presenters.
 */
//class CommentTimeline extends \Nette\Application\UI\Form {
//
//    private $id;
//
//    public function setId($id) {
//        $this->id = $id;
//    }
//
//}

abstract class BasePresenter extends Nette\Application\UI\Presenter {

    public $translator;
    public $database;
    public $profile_type;
    public $profile_id;
    public $logged_in_id;
    public $data_model;
    public $current_user_id;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
        $this->data_model = new \DataModel($database);
    }

// return field name for form element
    public function getField($form_name, $element_name) {
        $fields = $this->database->query("SELECT * FROM form_fields WHERE form_name=? AND element_name=?", $form_name, $element_name);

        $return = "";

        foreach ($fields as $field) {
            $return = $field->field_name;
        }
        return $return;
    }

// return array of db fields of form
    public function assignFields($valuesArray, $form) {
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
        $this->translator = new DFSTranslator();
        $this->template->setTranslator($this->translator);

        try {
            $mysection = $this->getSession('userdata');
            $myid = $mysection->id;
            $this->logged_in_id = $myid;
            $this->current_user_id = $myid;
            $userdata = $this->database->table("tbl_user")->where("id = ?", $myid)->fetch();

            $profile_table = "";
            $profile_id = 0;

            $profile_type_description = "User account";
            $profile_type_icon = "fa fa-eye";

            if ($userdata->active_profile_id > 0 && $userdata->active_profile_type > 0) {
                $this->profile_type = $userdata->active_profile_type;
                $this->profile_id = $userdata->active_profile_id;

                $this->template->active_profile_type = $this->profile_type;
                switch ($userdata->active_profile_type) {
                    case 1:
                        $profile_table = "tbl_userkennel";
                        $profile_type_description = "Kennel";
                        $profile_type_icon = "fa fa-home";

                        $myrow = $this->database->table("tbl_userkennel")->where("id=?", $this->profile_id)->fetch();
                        $this->template->fullname = $myrow->kennel_name;
                        $this->template->profile_home_image = $myrow->kennel_profile_picture;
                        break;
                    case 2:
                        $profile_table = "tbl_userowner";
                        $profile_type_description = "Owner";
                        $profile_type_icon = "fa fa-user";
                        $this->template->fullname = $userdata->name . ' ' . $userdata->surname;
                        $myrow = $this->database->table("tbl_userowner")->where("id=?", $this->profile_id)->fetch();
                        $this->template->profile_home_image = $myrow->owner_profile_picture;
                        break;
                    case 3:
                        $profile_table = "tbl_userhandler";
                        $profile_type_description = "Handler";
                        $profile_type_icon = "glyphicons glyphicons-shirt";
                        $this->template->fullname = $userdata->name . ' ' . $userdata->surname;
                        $myrow = $this->database->table("tbl_userhandler")->where("id=?", $this->profile_id)->fetch();
                        $this->template->profile_home_image = $myrow->handler_profile_picture;
                        break;
                }

                $profile_id = $userdata->active_profile_id;
            }

            $this->template->profile_type = $profile_type_description;
            $this->template->profile_type_icon = $profile_type_icon; //handler - glyphicons glyphicons-shirt ... owner - fa fa-user
            $this->template->logged_in_id = $myid;

            $this->template->profile_type_id = $userdata->active_profile_type;
            $this->template->profile_id = $profile_id;

            $counter = 0;
            $type_cnt = 0;

            $profile_data = $this->database->query("SELECT COUNT(*) as Cnt FROM tbl_userkennel WHERE user_id=?", $myid)->fetch();

            if ($profile_data->Cnt > 0) {
                $this->template->has_kennel_profile = true;
                $type_cnt = 1;
                $counter++;
            } else
                $this->template->has_kennel_profile = false;


            $profile_data = $this->database->query("SELECT COUNT(*) as Cnt FROM tbl_userowner WHERE user_id=?", $myid)->fetch();

            if ($profile_data->Cnt > 0) {
                $this->template->has_owner_profile = true;
                $type_cnt = 2;
                $counter++;
            } else
                $this->template->has_owner_profile = false;

            $counter = $counter + $profile_data->Cnt;

            $profile_data = $this->database->query("SELECT COUNT(*) as Cnt FROM tbl_userhandler WHERE user_id=?", $myid)->fetch();

            if ($profile_data->Cnt > 0) {
                $this->template->has_handler_profile = true;
                $type_cnt = 3;
                $counter++;
            } else
                $this->template->has_handler_profile = false;

            $counter = $counter + $profile_data->Cnt;

            if ($counter == 1) {
                $profile_data = array();

                switch ($type_cnt) {
                    case 1:
                        $data = $this->database->table("tbl_userkennel")->where("user_id=?", $myid)->fetch();
                        $profile_data['active_profile_id'] = $data->id;
                        $profile_data['active_profile_type'] = 1;
                        break;
                    case 2:
                        $data = $this->database->table("tbl_userowner")->where("user_id=?", $myid)->fetch();
                        $profile_data['active_profile_id'] = $data->id;
                        $profile_data['active_profile_type'] = 2;
                        break;
                    case 3:
                        $data = $this->database->table("tbl_userhandler")->where("user_id=?", $myid)->fetch();
                        $profile_data['active_profile_id'] = $data->id;
                        $profile_data['active_profile_type'] = 3;
                        break;
                }

                $this->database->table("tbl_user")->where("id=?", $myid)->update($profile_data);
            }
        } catch (\Exception $ex) {
            $this->template->logged_in_id = 0;
            $this->logged_in_id = 0;
            $this->template->has_kennel_profile = false;
            $this->template->has_user_profile = false;
            $this->template->has_handler_profile = false;
        }

        $this->template->users_messages = $this->getMessagesUsersList();
        $this->template->messages_rows = $this->database->table("tbl_messages")->order("message_datetime DESC")->fetchAll();
    }

    public function renderUser_message_compose() {
        $this->template->users_messages = $this->getMessagesUsersList();
        $this->template->messages_rows = $this->database->table("tbl_messages")->order("message_datetime ASC")->fetchAll();
    }

    public function getMessagesUsersList() {
        $profile_id = $this->profile_id;
        $user_id = $this->current_user_id;

        $rnd = "tmp_msg_" . rand(1, 10);

//$this->database->query("DROP TABLE IF EXISTS `$rnd`");

        try {
            $this->database->query("CREATE TABLE `$rnd` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT,
 `user_id` bigint(20) DEFAULT NULL,
 `profile_id` bigint(20) DEFAULT NULL,
 `message` mediumtext,
 `message_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8");
        } catch (\Exception $ex) {
            $this->database->query("DELETE FROM `$rnd`");
        }

        if ($user_id != NULL) {
            $users = $this->database->table("tbl_messages")->where("from_user_id = ? OR to_user_id = ?", $user_id, $user_id)->order("message_datetime DESC")->limit(5)->fetchAll();

            $myarray = array();

            foreach ($users as $user) {
                $user_array = array();
                if ($user->from_user_id != $user_id) {
                    if (!in_array($user->from_user_id, $myarray)) {
                        $user_array['user_id'] = $user->from_user_id;
                        $user_array['message_datetime'] = $user->message_datetime;
                        $user_array['message'] = $user->message;
                        $user_array['profile_id'] = $user->from_profile_id;

                        $myarray[] = $user->from_user_id;

                        $this->database->table($rnd)->insert($user_array);
                    }
                } else {
                    if (!in_array($user->to_user_id, $myarray)) {
                        $user_array['user_id'] = $user->to_user_id;
                        $user_array['message_datetime'] = $user->message_datetime;
                        $user_array['message'] = $user->message;
                        $user_array['profile_id'] = $user->to_profile_id;

                        $myarray[] = $user->to_user_id;

                        $this->database->table($rnd)->insert($user_array);
                    }
                }
            }
        }

        $user_array = $this->database->table($rnd)->fetchAll();

        return $user_array;
    }

    function translate($message) {
        return $this->translator->translate($message);
    }

    protected function createComponentFrmSignIn() {
        $result = $this->database->table("lk_countries")->order("CountryName_en");
        $items = array();

        $items["0"] = "Please select state ...";
        foreach ($result as $row) {
            $items[$row->CountryName_en] = $this->translate($row->CountryName_en);
        }

        $form = new Form();
        $form->addText("txtName");
        $form->addText("txtSurname");
        $form->addText("txtEmail");
        $form->addText("hidddlCountries");
        $form->addSelect("ddlCountries")->setItems($items);
        $form->addPassword("txtPassword");
        $form->addPassword("txtConfirmPassword");
        $form->addSubmit('btnSignIn')->onClick[] = array($this, 'frmSignInSucceeded');
        return $form;
    }

    public function handleNewMessagesCount() {
        $messages_count = $this->database->table('tbl_messages')->where("(from_user_id = ? OR to_user_id = ?) AND unreaded = 1", $this->logged_in_id, $this->logged_in_id)->count();
        echo $messages_count;
        $this->terminate();
    }

    public function handleNewNotifyCount() {
        $messages_count = $this->database->table('tbl_notify')->where("notify_user_id = ? AND unreaded = 1", $this->logged_in_id)->count();
        echo $messages_count;
        $this->terminate();
    }

    public function handleClearNotify() {
        $user_id = $this->logged_in_id;
        $this->database->query("UPDATE tbl_notify SET unreaded = 0 WHERE notify_user_id = $user_id");
    }

    public function handleClearMessages() {
        $user_id = $this->logged_in_id;
        $this->database->query("UPDATE tbl_messages SET unreaded = 0 WHERE to_user_id = $user_id");
    }

    public function handleMessageCheck() {
        $messages_rows = $this->database->table('tbl_messages')->fetchAll();

        $data = "";

        foreach ($messages_rows as $row) {
            $data .= '<div style = "display:block;float:left;width:100%;padding: 10px 0px 10px 0px;">';

            if ($row->from_profile_id > 0) {
                $profile_image = \DataModel::getProfileImage($row->from_profile_id);
                $profile_name = \DataModel::getProfileName($row->from_profile_id);
            } else {
                $profile_image = \DataModel::getProfileImage($row->from_user_id);
                $profile_name = \DataModel::getProfileName($row->from_user_id);
            }
            $data .= '<img class = "user-block-thumb" src = "' . $profile_image . '"/>';
            $data .= '<a href = "#"><span class = "notification-item-header text-uppercase">' . $profile_name . '</span></a>';
            $data .= '<span class = "notification-item-event-time">' . date('d.m.Y', strtotime($row->message_datetime)) . '&nbsp;&nbsp;' . date('H:i:s', strtotime($row->message_datetime)) . '</span>';
            $data .= '<span class = "notification-item-event" style = "color:black">' . nl2br($row->message) . '</span></div>';
        }

        echo $data;
        $this->terminate();
//$this->invalidateControl("areaMessages");
    }

    public function handleTimelineRemove($id = 0) {
        if (isset($_GET['id']))
            $id = $_GET['id'];
        \DataModel::deleteFromTimelineByItem($id);
        $this->terminate();
    }

    protected function createComponentFrmLogIn() {
        $form = new Form();
        $form->addText("txtEmail");
        $form->addPassword("txtPassword");
        $form->addCheckbox("chkRemember");
        $form->addSubmit('btnLogin', 'Login')->onClick[] = array($this, 'frmLogInSucceeded');
        return $form;
    }

    protected function createComponentFormSendMessage() {
        $form = new Form();
        $form->addText("txtMessageCompose")->setRequired();
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmSendMessageSucceeded');

        return $form;
    }

    public function frmSendMessageSucceeded($button) {
        $values = $button->getForm()->getValues();

        $data['message'] = $values['txtMessageCompose'];
        $data['from_user_id'] = $this->logged_in_id;
        $data['from_profile_id'] = $this->profile_id;
        $data['to_user_id'] = $this->logged_in_id;
        $data['to_profile_id'] = $this->profile_id;
        $data['unreaded'] = 1;
        $data['active_from'] = 1;
        $data['active_to'] = 1;

        $this->database->table("tbl_messages")->insert($data);

        $this->sendPayload();
    }

    public function frmLogInSucceeded($button) {
        $values = $button->getForm()->getValues();

        $result = $this->database->query("SELECT * FROM tbl_user WHERE email=? AND password=?", $values['txtEmail'], $values['txtPassword']);

        $id = 0;
        $activated = 0;

        $user_section = $this->getSession('userdata');

        foreach ($result as $row) {
            $id = $row->id;
            $user_section->name = $row->name;
            $user_section->surname = $row->surname;
            $user_section->id = $row->id;
            $activated = $row->active;
        }

        if ($id == 0) {
            $this->flashMessage($this->translate("Wrong username or password."), "Warning");
        } else {
            if ($activated == 0) {
                $this->flashMessage($this->translate("Your user account has not been activated yet. Please activate it by clicking on the link, which was been sent in your registration email. You can resend it by clicking on folowing link") . "<br/><br/><p class=\"text-center\"><a href=\"?resend_al=$id\" class=\"btn btn-danger btn-xl\"><i class=\"fa fa-envelope\"></i>&nbsp;&nbsp;" . $this->translate("Resend registration email") . "</a></p>", "Error");
            } else
                $this->redirect("user:user_create_profile_switcher");
        }
    }

    protected function createComponentCommentTimeline() {
        return new Nette\Application\UI\Multiplier(function () {
            $form = new Nette\Application\UI\Form();
            $form->addHidden("snippet_id");
            $form->addText("comment")->setRequired();
            $form->addSubmit('btnSubmit')->onClick[] = array($this, 'commentSucceeded');
            return $form;
        });
    }

    public function commentSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

//$row = $this->database->table("tbl_user")->where("id=?", $this->logged_in_id)->fetch();
//if ($row->active_profile_id > 0)
            $this->data_model->addTimelineComment($this->logged_in_id, $this->profile_id, $values['snippet_id'], $values['comment']);

            if ($this->presenter->isAjax()) {
                $this->redrawControl('areaComments');
//$this->redirect('this');
            }
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage());
        }
    }

    protected function createComponentForgotPassword() {
        $form = new Form();
        $form->addText("txtEmail")->setRequired();
        $form->addSubmit('btnForgotPassword')->onClick[] = array($this, 'ForgotPasswordSucceeded');
        return $form;
    }

    public function ForgotPasswordSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $data = $this->database->table("tbl_user")->where("email=?", $values['txtEmail'])->fetchAll();

            $password = '';
            $name = '';

            foreach ($data as $row) {
                $name = $row->name;
                $password = $row->password;
            }

            if ($password == '') {
                $this->flashMessage($this->translate("User with this e-mail, is not in our database"), "Error");
                throw new \ErrorException();
            }

            $mail = new Message();
            $mail->setFrom('DOGFORSHOW <info@dogforshow.com>')
                    ->setSubject($this->translate("Forgot password"))
                    ->addTo($values['txtEmail'])
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
                                <h1 style="font-size:23px;color:#8C8067;">' . $this->translate('Hello') . ' ' . $name . '</h1>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <ul style="list-style-type: none">
                                <li>' . $this->translate('Email') . ': <strong>' . $values['txtEmail'] . '</strong></li>
                                <li>' . $this->translate('Password') . ': <strong>' . $password . '</strong></li>
                                </ul>
                            </td>
                        </tr>
			<tr>
                            <td align="center">
                                <p style="font-size:15px;"><a href="http://new.dogforshow.com" style="padding:10px; color:#FFFFFF; background-color: #c12e2a; text-decoration: none; text-transform: uppercase; font-weight: bold;">' . $this->translate('Login to your account') . '</a></p>
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

            $this->flashMessage($this->translate("Your password has been successfully sent to your e-mail"), "Success");
            $this->redirect("default");
        } catch (\ErrorException $ex) {
            
        }
    }

    public function sendActivationEmail($to, $name, $userid) {
        $id = base64_encode($userid);
        $id = base64_encode($id);

        $id = urlencode($id);

        $mail = new Message();
        $mail->setFrom('DOGFORSHOW <info@dogforshow.com>')
                ->addTo($to)
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
                                <h1 style="font-size:23px;color:#8C8067;">' . $this->translate("Hello") . ' ' . $name . '</h1>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <p style="font-size:15px;">' . $this->translate('Thank you for your registration to DOGFORSHOW. Please activate your account by clicking on the following link') . '</p>
                            </td>
                        </tr>
			<tr>
                            <td align="center">
                                <p style="font-size:15px;"><a href="http://new.dogforshow.com/www/templates/scripts/activation.php?alink=' . $id . '" style="padding:10px; color:#FFFFFF; background-color: #c12e2a; text-decoration: none; text-transform: uppercase; font-weight: bold;">' . $this->translate('Activate account') . '</a></p>
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
    }

    public function frmSignInSucceeded($button) {

        try {
            $is_error = FALSE;
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

            if ($values['name'] == "" || $values['surname'] == "") {
                $exception .= "<li>" . $this->translate("Name and Surname cannot left blank") . "</li>";
            }

            if ($values['email'] == "") {
                $exception .= "<li>" . $this->translate("Email cannot left blank") . "</li>";
            }

            $exception .= '</ul>';

//echo $exception;

            if ($exception != '<ul></ul>') {
                throw new \ErrorException($exception);
                $is_error = TRUE;
            }

            if (!$is_error) {
                try {
                    $this->database->table("tbl_user")->insert($values);
                    $userid = $this->database->getInsertId();

                    $this->sendActivationEmail($values['email'], $values['name'], $userid);

                    $this->flashMessage('<ul><li><strong>' . $this->translate('Your registration has been successfully completed') . '</strong></li><li>' . $this->translate('Please check your Email for your user acccount activation') . '</li><li>' . $this->translate('If you have not received the Email yet, please also check your SPAM folder') . '</li></ul>', "Success");
//var_dump($values);
                } catch (\Exception $ex) {
                    $this->flashMessage($ex->getMessage(), "Error");
                    $is_error = TRUE;
                }

                if (!$is_error)
                    $this->redirect("LandingPage:default");
            }
        } catch (\ErrorException $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
    }

}

class DFSTranslator implements Nette\Localization\ITranslator {

    /**
     * Translates the given string.
     * @param  string   message
     * @param  int      plural count
     * @return string
     */
    private $database;

    public function __construct() { //Nette\Database\Context $database) {
        $this->database = getContext();
    }

    public function translate($message, $count = NULL) {
        $actual_link = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

//$uri = $tmpuri;
//$query = "SELECT * FROM tbl_translate where text_to_translate = '$message' AND uri = '$uri'";

        if ($message != NULL) {
            $rows = $this->database->table("tbl_translate")->where("text_to_translate = ?", $message)->fetchAll();
            $id = 0;

            foreach ($rows as $row) {
                $id = $row->id;
                $message = $row->translated_text;
            }

            if ($id == 0) {
                $values = array();
                $values["text_to_translate"] = $message;
                $values["translated_text"] = $message;
                $values["lang"] = "en";
                $values["url"] = $actual_link;
                $this->database->table("tbl_translate")->insert($values);

                $return = '*' . $message;
            } else {
                $return = $message;
            }
            return $return;
        } else {
            return $message;
        }
    }

}

?>