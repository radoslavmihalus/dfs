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

        if (isset($_GET['activated'])) {
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

    public function beforeRender() {
        if ($this->logged_in_id > 0) {
            $user = $this->database->table("tbl_user")->where("id=?", $this->logged_in_id)->fetch();
            $profile_id = $user->active_profile_id;

            if ($profile_id > 0) {
                $type = \DataModel::getProfileType($profile_id);
                switch ($type) {
                    case 1:
                        $this->redirect("kennel:kennel_profile_home");
                        break;
                    case 2:
                        $this->redirect("owner:owner_profile_home");
                        break;
                    case 3:
                        $this->redirect("handler:handler_profile_home");
                        break;
                    default :
                        $this->redirect("user:user_create_profile_switcher");
                        break;
                }
            }
        }
        parent::beforeRender();
    }

    /*     * ******************* view default ******************** */

    public function renderDefault() {
        
    }

    /*     * ******************* component factories ******************** */

    /**
     * Edit form factory.
     * @return Form
     */
}
