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

    public function __construct($row, $active_profile_id, $logged_in_id, $profile_id, $data_model, Nette\Database\Context $database, $translator) {
        parent::__construct();
        $this->row = $row;
        $this->active_profile_id = $active_profile_id;
        $this->logged_in_id = $logged_in_id;
        $this->profile_id = $profile_id;
        $this->data_model = $data_model;
        $this->database = $database;
        $this->translator = $translator;

        $this->database->query("CREATE TABLE IF NOT EXISTS tbl_emails(`id` BIGINT AUTO_INCREMENT, `email` VARCHAR(250), PRIMARY KEY(`id`), KEY `emailidx` (`email`)) ENGINE=MyISAM AUTO_INCREMENT=9000000001");
    }

    public function render() {
        if ($this->presenter->action != "contact_us" && $this->presenter->action != "default") {
            $this->template->setFile(__DIR__ . "/MessageControl.latte");
        } else {
            $this->template->setFile(__DIR__ . "/EmptyTemplate.latte");
        }
        $this->template->setTranslator($this->translator);
        $this->template->row = $this->row;
        $this->template->active_profile_id = $this->active_profile_id;
        $this->template->logged_in_id = $this->logged_in_id;
        $this->template->render();
    }

    protected function createComponentFrmMessageForm() {
//        return new Nette\Application\UI\Multiplier(function () {
        $form = new UI\Form();
        //$form->getElementPrototype()->class('ajax');
        $form->addText("txtUrl");

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

    public function getMessageBody($name, $par_Name, $par_Surname, $par_Email, $par_Text, $par_URL, $isPremium) {
        if (!$isPremium) {
            $par_Name = $par_Name . mb_strimwidth(' ' . $par_Surname, 0, 3, "...");
            $par_Email = mb_strimwidth($par_Email, 0, 6, "...");
            $par_Text = mb_strimwidth($par_Text, 0, 6, "...");
        } else {
            $par_Name = $par_Name . " " . $par_Surname;
        }


        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns = "http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8" />
        <title>' . $this->translator->translate('DOGFORSHOW - you have a new message') . '</title>
        </head>
        <body bgcolor = "#f6f8f1" style = "margin: 0; padding: 0; min-width: 100%!important;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;background-color:#8C8067;" >
        <table width = "100%" border = "0" cellpadding = "0" cellspacing = "0">
        <tr>
        <td>
        <table style = "padding-bottom:20px; margin-top:10px; width: 90%; max-width: 600px;" class = "content" bgcolor = "white" align = "center" cellpadding = "10" cellspacing = "0" border = "0">
        <tr>
        <td align = "center" style = "border-bottom:#8C8067 1px solid">
        <h1 style = "font-size:23px;color:#8C8067;">' . $this->translator->translate("Hello") . ' ' . $name . '</h1>
        </td>
        </tr>
        <tr>
        <td align = "center" style = "border-bottom:#8C8067 1px solid">
        <p style = "font-size:17px;color:#8C8067;">' . $this->translator->translate("someone try to contact you") . '</p>
        </td>
        </tr>
        <tr>
        <td align = "left">
        <p style = "font-size:15px;font-weight:bold;color:#8C8067;">' . $this->translator->translate("Name") . ': <span style="color:black">' . $par_Name . '</span></p>
        <p style = "font-size:15px;font-weight:bold;color:#8C8067;">' . $this->translator->translate("Email") . ': <span style="color:black">' . $par_Email . '</span></p>
        <p style = "font-size:15px;font-weight:bold;color:#8C8067;">' . $this->translator->translate("Profile URL") . ': <span style="color:black"><a href="' . $par_URL . '">' . $par_URL . '</a></span></p>
        <p style = "font-size:15px;font-weight:bold;color:#8C8067;">' . $this->translator->translate("Message text") . ': <span style="color:black">' . $par_Text . '</span></p>
        </td>
        </tr>
        <tr>
        <td align = "center">
        <p style = "font-size:15px;"><a href = "http://www.dogforshow.com/" style = "padding:10px; color:#FFFFFF; background-color: #c12e2a; text-decoration: none; text-transform: uppercase; font-weight: bold;">' . $this->translator->translate('Read message on DOGFORSHOW') . '</a></p>
        </td>
        </tr>
        </table>
        <table style = "margin-top: 10px; width: 90%; max-width: 600px;color:white;" align = "center" cellpadding = "10" cellspacing = "0" border = "0">
        <tr>
        <td align = "center">
        <p style = "font-size:12px;">' . $this->translator->translate('This email was automatically sent by DOGFORSHOW system. Please dont reply on this email') . '</p>
        </td>
        </tr>
        </table>
        </td>
        </tr>
        </table>
        </body>
        </html>';

        return $body;
    }

    public function messageSucceeded(UI\Form $form) {
        $values = $form->values;
        $is_premium = FALSE;


        try {
            if ($this->logged_in_id > 0) {
                $recaptcha = "123456789012345";
            } else {
                $recaptcha = $_POST['g-recaptcha-response'];
                $recaptcha = "123456789012345";
            }

            $this->translator->lang = $this->row->lang;

            if (strlen($recaptcha) > 10) {

                // - check if target user have premium account
                $date = date("Ymd");
                $ped = date("Ymd", strtotime($this->row->premium_expiry_date));
                if ($ped > $date)
                    $is_premium = TRUE;
                // - check if target user have premium account
                // 
                // - check if not logged in user have stored his email in the database if not insert it
                $cnt = $this->database->table("tbl_emails")->where("email=?", $values['txtEmail'])->count();
                if ($cnt == 0) {
                    $data = array();
                    $data['email'] = $values['txtEmail'];
                    $this->database->table("tbl_emails")->insert($data);
                }
                // - check if not logged in user have stored his email in the database

                $sender = $this->database->table("tbl_emails")->where("email=?", $values['txtEmail'])->fetch();

                $mail = new Nette\Mail\Message();

                if (!$is_premium) {
                    $mail->setFrom('DOGFORSHOW <noreply@dogforshow.com>')
                            ->addTo($this->row->email)
                            ->setSubject($this->translator->translate('DOGFORSHOW - you have a new message'))
                            ->setHtmlBody($this->getMessageBody($this->row->name, $values['txtName'], $values['txtSurname'], $values['txtEmail'], $values['txtMessage'], $values['txtUrl'], $is_premium))
                            ->setContentType('text/html')
                            ->setEncoding('UTF-8');
                } else {
                    $mail->setFrom($values['txtName'] . ' ' . $values['txtSurname'] . ' <' . $values['txtEmail'] . '>')
                            ->addTo($this->row->email)
                            ->setSubject($this->translator->translate('DOGFORSHOW - you have a new message'))
                            ->setHtmlBody($this->getMessageBody($this->row->name, $values['txtName'], $values['txtSurname'], $values['txtEmail'], $values['txtMessage'], $values['txtUrl'], $is_premium))
                            ->setContentType('text/html')
                            ->setEncoding('UTF-8');
                }

                $body = $this->translator->translate("Name") . ": " . $values['txtName'] . "<br/>" .
                        $this->translator->translate("Surname") . ": " . $values['txtSurname'] . "<br/>" .
                        $this->translator->translate("Email") . ": " . $values['txtEmail'] . "<br/>" .
                        $this->translator->translate("Profile URL") . ": <a href=\"" . $values['txtUrl'] . "\">" . $values['txtUrl'] . "</a><br/>" .
                        $this->translator->translate("Message text") . ": " . $values['txtMessage'];

                $mailer = new Nette\Mail\SendmailMailer();
                $mailer->send($mail);

                $from_user_id = $this->logged_in_id;
                if ($from_user_id == 0)
                    $from_user_id = $this->active_profile_id;
                $from_profile_id = $this->active_profile_id;
                $to_user_id = $this->row->id;
                $to_profile_id = $this->profile_id;

                if ($from_user_id == 0)
                    $from_user_id = $sender->id;

                $this->data_model->sendPrivateMessage($from_user_id, $from_profile_id, $to_user_id, $to_profile_id, $body);

                $this->presenter->flashMessage($this->translator->translate("Your message has been successfully sent. We will contact you as soon as possible."), "Info");
            } else {
                $this->presenter->flashMessage($this->translator->translate("Your message has not been sent. Verification is required."), "Info");
            }
//}
        } catch (\Exception $ex) {
            $this->presenter->flashMessage($ex->getMessage(), "Error");
        }

        $this->presenter->redirect("this");
    }

}
