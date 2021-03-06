<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form,
    Nette\Mail\Message,
    Nette\Mail\SendmailMailer;

class LandingPagePresenter extends BasePresenter {

//private $database;
//    public function __construct(Nette\Database\Context $database) {
//        $this->database = $database;
//        $this->translator = new DFSTranslator();
//    }

    protected function startup() {
        parent::startup();

        if (isset($_GET['activated'])) {
            
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

//        if ($this->logged_in_id > 0) {
//            if (\DataModel::getUserProfilesCount($this->logged_in_id) > 0) {
//                if ($this->logged_in_profile_id > 0) {
//                    $type = \DataModel::getProfileType($this->logged_in_profile_id);
//                    switch ($type) {
//                        case 1:
//                            $this->redirect("kennel:kennel_profile_home");
//                            break;
//                        case 2:
//                            $this->redirect("owner:owner_profile_home");
//                            break;
//                        case 3:
//                            $this->redirect("handler:handler_profile_home");
//                            break;
//                        default :
//                            $this->redirect("user:user_create_profile_switcher");
//                            break;
//                    }
////                        $this->redirect("timeline:timeline_wall", array("lang" => $this->lang));
//                } else {
//                    $this->redirect("user:user_create_profile_switcher", array("lang" => $this->lang));
//                }
//            }
//            $this->redirect("user:user_create_profile_switcher_new", array("lang" => $this->lang));
//        }
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

    public function actionDefault($lang = "en") {
        try {
            $mysection = $this->getSession('language');
            $mysection->lang = $_GET['lang'];
        } catch (\Exception $ex) {
            
        }
    }

    public function renderDefault() {
        $query = "SELECT * FROM (
    (SELECT id, kennel_create_date as create_date FROM tbl_userkennel ORDER BY kennel_create_date DESC LIMIT 0,3)
    UNION ALL
    (SELECT id, owner_create_date as create_date FROM tbl_userowner ORDER BY owner_create_date DESC LIMIT 0,3)
    UNION ALL
    (SELECT id, handler_create_date as create_date FROM tbl_userhandler ORDER BY handler_create_date DESC LIMIT 0,3)
) AS foo ORDER BY create_date DESC LIMIT 0,3";
        $profiles = $this->database->query($query)->fetchAll();
        $dogs = $this->database->table("tbl_dogs")->order("id DESC")->limit(3)->fetchAll();
        $puppies = $this->database->table("tbl_puppies")->order("id DESC")->limit(3)->fetchAll();

        $photos = $this->database->table("tbl_photos")->limit(12)->order("id DESC")->fetchAll();
        $videos = $this->database->table("tbl_videos")->limit(12)->order("id DESC")->fetchAll();


        $this->template->profiles = $profiles;
        $this->template->dogs = $dogs;
        $this->template->puppies = $puppies;
        $this->template->photos = $photos;
        $this->template->videos = $videos;
    }
    
    public function renderLp() {
        $query = "SELECT * FROM (
    (SELECT id, kennel_create_date as create_date FROM tbl_userkennel ORDER BY kennel_create_date DESC LIMIT 0,3)
    UNION ALL
    (SELECT id, owner_create_date as create_date FROM tbl_userowner ORDER BY owner_create_date DESC LIMIT 0,3)
    UNION ALL
    (SELECT id, handler_create_date as create_date FROM tbl_userhandler ORDER BY handler_create_date DESC LIMIT 0,3)
) AS foo ORDER BY create_date DESC LIMIT 0,3";
        $profiles = $this->database->query($query)->fetchAll();
        $dogs = $this->database->table("tbl_dogs")->order("id DESC")->limit(3)->fetchAll();
        $puppies = $this->database->table("tbl_puppies")->order("id DESC")->limit(3)->fetchAll();

        $photos = $this->database->table("tbl_photos")->limit(12)->order("id DESC")->fetchAll();
        $videos = $this->database->table("tbl_videos")->limit(12)->order("id DESC")->fetchAll();


        $this->template->profiles = $profiles;
        $this->template->dogs = $dogs;
        $this->template->puppies = $puppies;
        $this->template->photos = $photos;
        $this->template->videos = $videos;
    }

    /*     * ******************* component factories ******************** */

    /**
     * Edit form factory.
     * @return Form
     */
}
