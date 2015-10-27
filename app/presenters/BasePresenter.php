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
    public $logged_in_profile_id;
    public $data_model;
    public $current_user_id;
    public $receiver_user_id;
    public $receiver_profile_id;
    public $paginator;
    public $page_title;
    public $lang_session;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
        $this->data_model = new \DataModel($database);

        $this->paginator = new Nette\Extras\Addons\VisualPaginator();

        $GLOBALS['database'] = $database;

        try {
            $mysection = $this->getSession('language');
            $mysection->lang = "en";
        } catch (\Exception $ex) {
            
        }
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
        $GLOBALS['database'] = $this->database;

        $this->translator = new DFSTranslator();

        try {
            $mysection = $this->getSession('language');
            $this->translator->lang = $mysection->lang;
        } catch (\Exception $ex) {
            $mylang = "en";

            if (isset($_GET['lang']))
                $mylang = $_GET['lang'];

            $this->translator->lang = $mylang;

            try {
                $mysection = $this->getSession('language');
                $mysection->lang = $mylang;
            } catch (\Exception $ex) {
                
            }
        }

        $this->template->setTranslator($this->translator);
        $this->template->lang = $this->translator->lang;

        try {
            $mysection = $this->getSession('userdata');
            $myid = $mysection->id;
            $this->logged_in_id = $myid;
            $this->current_user_id = $myid;
            $userdata = $this->database->table("tbl_user")->where("id = ?", $myid)->fetch();
            $mysection->lang = $userdata->lang;

            $section = $this->getSession('language');
            $section->lang = $userdata->lang;


            if (strlen($mysection->lang) < 2)
                $mysection->lang = "en";

            $this->translator->lang = $mysection->lang;

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
            $this->template->lang = $mysection->lang;


            $this->template->profile_type_id = $userdata->active_profile_type;
            $this->template->profile_id = $profile_id;
            $this->template->active_profile_id = $this->profile_id;

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

            $user_row = $this->database->table("tbl_user")->where("id=?", $this->logged_in_id)->fetch();
            $this->logged_in_profile_id = $user_row->active_profile_id;
            $this->template->logged_in_profile_id = $this->logged_in_profile_id;
        } catch (\Exception $ex) {
            $this->template->logged_in_id = 0;
            $this->logged_in_id = 0;
            $this->logged_in_profile_id = 0;
            $this->template->has_kennel_profile = false;
            $this->template->has_user_profile = false;
            $this->template->has_handler_profile = false;

            $this->page_title = "DOGFORSHOW";
            $this->template->page_title = $this->page_title;
        }

//        $this->template->users_messages = $this->getMessagesUsersList();
//        $this->template->messages_rows = $this->database->table("tbl_messages_groups")->order("message_datetime DESC")->fetchAll();
    }

    public function createComponentVp() {
        return $this->paginator;
    }

    public function renderUser_message_compose($profile_id = 0) {
//$this->template->users_messages = $this->getMessagesUsersList();
//$this->template->messages_rows = $this->database->table("tbl_messages")->order("message_datetime ASC")->fetchAll();

        $this->template->message_profile_id = $profile_id;
    }

    public function renderUser_message_list() {
        $messages_rows = $this->database->table("tbl_messages_groups")->where("to_profile_id=?", $this->logged_in_profile_id)->order("message_datetime DESC")->fetchAll();

        $this->template->users_messages = $messages_rows;
    }

    public function actionUser_message_compose($profile_id) {
        $id = \DataModel::getUserIdByProfileId($profile_id);
        $this->receiver_user_id = $id;
        $this->receiver_profile_id = $profile_id;
    }

    function translate($message) {
        return $this->translator->translate($message);
    }

    protected function createComponentFrmSignIn() {
        $lang = "en";

        try {
            $section = $this->getSession('language');
            if (strlen($section->lang) > 1)
                $lang = strtolower($section->lang);
        } catch (\Exception $ex) {
            $lang = "en";
        }

        $result = $this->database->table("lk_countries")->order("CountryName_$lang");
        $items = array();

//$items["0"] = "Please select state ...";
        foreach ($result as $row) {
            $items[$row->CountryName_en] = $this->translate($row->CountryName_en);
        }

        $form = new Form();
        $form->addText("txtName")->setRequired($this->translate("Required field"));
        $form->addText("txtSurname")->setRequired($this->translate("Required field"));
        $form->addText("txtEmail")->setRequired($this->translate("Required field"));
//	$form->addText("hidddlCountries")->setRequired();
        $form->addSelect("hidddlCountries")->setItems($items)->setPrompt($this->translate("Please select state..."))->setRequired($this->translate("Required field"));
        $form->addPassword("txtPassword")->setRequired($this->translate("Required field"));
        $form->addPassword("txtConfirmPassword")->setRequired($this->translate("Required field"));
        $form->addSubmit('btnSignIn', 'Sign in')->onClick[] = array($this, 'frmSignInSucceeded');
        return $form;
    }

    public function handleOfferForSale($id = 0) {
        $id = $_GET['id'];
        $row = $this->database->table("tbl_dogs")->where("id=?", $id)->fetch();
        if ($row->user_id == $this->logged_in_id) {
//$this->database->table("tbl_dogs")->where("dog_id=?", $id)->delete();
            if ($row->offer_for_sell == 1)
                $data['offer_for_sell'] = 0;
            else
                $data['offer_for_sell'] = 1;

            if (\DataModel::getPremium($row->user_id))
                $this->database->table("tbl_dogs")->where("id=?", $id)->update($data);
        }
        $this->redirect("dog:dog_championschip_list", array("id" => $row->id));
    }

    public function handleOfferForStud($id = 0) {
        $id = $_GET['id'];
        $row = $this->database->table("tbl_dogs")->where("id=?", $id)->fetch();
        if ($row->user_id == $this->logged_in_id) {
//$this->database->table("tbl_dogs")->where("dog_id=?", $id)->delete();

            if ($row->offer_for_mating == 1)
                $data['offer_for_mating'] = 0;
            else
                $data['offer_for_mating'] = 1;

            if (\DataModel::getPremium($row->user_id))
                $this->database->table("tbl_dogs")->where("id=?", $id)->update($data);
        }
        $this->redirect("dog:dog_championschip_list", array("id" => $row->id));
    }

    public function handleChangeLang($lang) {
        try {
            if (isset($_GET['lang']))
                $lang = $_GET['lang'];
            $mysection = $this->getSession('language');
            $lang = strtolower($lang);
            $mysection->lang = $lang;
        } catch (\Exception $ex) {
            if (isset($_GET['lang']))
                $this->translator->lang = $_GET['lang'];
        }
        $this->redirect("LandingPage:default", array("lang" => $lang));
    }

    public function handleLike($timeline_id = 0, $event_id = 0) {
        $timeline = $this->database->table("tbl_timeline")->where("id=?", $timeline_id)->fetch();
        if ($timeline_id != 0)
            $count = $this->database->table("tbl_likes")->where("timeline_id=?", $timeline_id)->where("user_id=?", $this->logged_in_id)->where("profile_id=?", $this->profile_id)->count();
        elseif ($event_id != 0)
            $count = $this->database->table("tbl_likes")->where("event_id=?", $event_id)->where("user_id=?", $this->logged_in_id)->where("profile_id=?", $this->profile_id)->count();
        else {
            $this->terminate();
        }

        if ($count > 0)
            $this->database->table("tbl_likes")->where("timeline_id=?", $timeline_id)->where("user_id=?", $this->logged_in_id)->where("profile_id=?", $this->profile_id)->delete();
        else {
            $data['timeline_id'] = $timeline_id;
            $data['event_id'] = $timeline->event_id;
            $data['user_id'] = $this->logged_in_id;
            $data['profile_id'] = $this->profile_id;
            $this->database->table("tbl_likes")->insert($data);

            $timeline = $this->database->table("tbl_timeline")->where("id=?", $timeline_id)->fetch();

            $notify['notify_user_id'] = \DataModel::getUserIdByProfileId($timeline->profile_id);
            $notify['notify_profile_id'] = $timeline->profile_id;
            $notify['user_id'] = $this->logged_in_id;
            $notify['profile_id'] = $this->profile_id;
            $notify['timeline_id'] = $timeline_id;
            $notify['comment'] = "";
            $notify['type'] = "like";

            $this->database->table("tbl_notify")->insert($notify);
        }

        echo \DataModel::getTimelineLikesCount($timeline_id, $event_id);
        $this->terminate();
    }

    public function handleImport() {
//\ImportModel::importProfiles();
//$this->terminate();
    }

    public function handleHasLiked($timeline_id = 0, $event_id = 0) {
        try {
            if ($timeline_id != 0)
                $count = $this->database->table("tbl_likes")->where("timeline_id=?", $timeline_id)->where("user_id=?", $this->logged_in_id)->where("profile_id=?", $this->profile_id)->count();
            elseif ($event_id > 0)
                $count = $this->database->table("tbl_likes")->where("event_id=?", $event_id)->where("user_id=?", $this->logged_in_id)->where("profile_id=?", $this->profile_id)->count();
            else {
                echo 0;
                $this->terminate();
            }
            echo $count;
        } catch (\Exception $ex) {
            echo 0;
        }
        $this->terminate();
    }

    public function handleLikesList($timeline_id = 0, $event_id = 0) {
        try {

            if ($timeline_id != 0)
                $rows = $this->database->table("tbl_likes")->where("timeline_id=?", $timeline_id)->order("like_datetime DESC")->fetchAll();
            elseif ($event_id > 0)
                $rows = $this->database->table("tbl_likes")->where("event_id=?", $event_id)->order("like_datetime DESC")->fetchAll();
            else {
                echo "";
                $this->terminate();
            }
        } catch (\Exception $ex) {
            echo '';
            $this->terminate();
        }

        $return = '<div class="container-fluid" style="padding:5px 0px 5px 0px">';
        foreach ($rows as $row) {
            $datetime = strtotime($row->like_datetime);
            $date = date('d.m.Y', $datetime);
            $time = date('H:i:s', $datetime);
            $return .= '<div style="padding:5px 0px 5px 0px;border-top:#EDEBE4 1px solid;" class="col-lg-12 col-md-12 col-xs-12">';
            $return .= '<img src="' . \DataModel::getProfileImage($row->profile_id) . '" class="user-block-thumb">';
            $url = \DataModel::getProfileLinkUrl($row->profile_id, TRUE) . "?id=" . $row->profile_id;
            $return .= '<span class="notification-item-header text-uppercase"><a href="' . $url . '" style="color:#a5987f;">' . \DataModel::getProfileName($row->profile_id) . '</a></span>';
            $return .= '<span class="notification-item-event-time">' . $date . '|&nbsp;' . $time . '</span>';
            $return.='<span style="color:black" class="notification-item-event"></span>';
            $return .= '</div>';
        }
        $return .= '</div>';

        echo $return;

        $this->terminate();
    }

    public function handleNewMessagesCount() {
        try {
            if ($this->logged_in_profile_id > 0)
                $messages_count = $this->database->table('tbl_messages_groups')->where("to_profile_id = ? AND unreaded = 1", $this->logged_in_profile_id)->count();
            else
                $messages_count = $this->database->table('tbl_messages_groups')->where("to_user_id = ? AND unreaded = 1", $this->logged_in_id)->count();
            echo $messages_count;
        } catch (\Exception $ex) {
            echo 0;
        }
        $this->terminate();
    }

    public function handleNewNotifyCount() {
        try {
            $messages_count = $this->database->table('tbl_notify')->where("notify_user_id = ? AND unreaded = 1", $this->logged_in_id)->count();
            echo $messages_count;
        } catch (\Exception $ex) {
            echo 0;
        }
        $this->terminate();
    }

    public function handleClearNotify($limit = 3) {
        $user_id = $this->logged_in_id;

        if ($limit > 0)
            $rows = $this->database->table("tbl_notify")->where("notify_user_id=?", $user_id)->order("notify_datetime DESC")->limit($limit)->fetchAll();
        else
            $rows = $this->database->table("tbl_notify")->where("notify_user_id=?", $user_id)->order("notify_datetime DESC")->fetchAll();

        $notify = '<li role="presentation" class="dropdown-header text-uppercase" style="border-bottom: whitesmoke 1px solid;padding:10px;">' . $this->translator->translate("Notifications") . '</li>';

        foreach ($rows as $row) {
            $notify .= '<li role="presentation" class="notify_item">
                            <a role="menuitem" tabindex="-1" href="' . \DataModel::getProfileLinkUrl($row->notify_profile_id, TRUE) . '#timelineid' . $row->timeline_id . '">
                                <img class="user-block-thumb" src="' . \DataModel::getProfileImage($row->profile_id) . '"/>
                                <span class="notification-item-header text-uppercase">' . \DataModel::getProfileName($row->profile_id) . '</span>';
            if ($row->type == 'comment')
                $notify .= '<span class="notification-item-event"><i class="fa fa-comment"></i>&nbsp;&nbsp;' . $this->translate('comment your post') . '</span>';
            elseif ($row->type == 'like')
                $notify .= '<span class="notification-item-event"><i class="fa fa-thumbs-up"></i>&nbsp;&nbsp;' . $this->translate('like your post') . '</span>';
            $notify .= '</a></li>';
        }

        $notify .= '<li role="presentation" class="notify_item"><a class="dropdown-footer" href="notification-list">' . $this->translate("View all") . '&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></a></li>';

        $this->database->query("UPDATE tbl_notify SET unreaded = 0 WHERE notify_user_id = $user_id");

        echo $notify;
        $this->terminate();
    }

    public function handleClearMessages($limit = 3) {
        $user_id = $this->logged_in_id;

        $messages_rows = $this->database->table("tbl_messages_groups")->where("to_profile_id=?", $this->logged_in_profile_id)->limit($limit)->fetchAll();

        $result = '<li role="presentation" class="dropdown-header text-uppercase" style="border-bottom: whitesmoke 1px solid;padding:10px;">' . $this->translator->translate("Messages") . '</li>';

        foreach ($messages_rows as $message) {
            if ($message->from_profile_id > 0)
                $profile_id = $message->from_profile_id;
            else
                $profile_id = $message->from_user_id;

            $result .= '<li role="presentation">';
            $result .= '<a role="menuitem" tabindex="-1" href="message-compose?profile_id=' . $profile_id . '">';
            $result .= '<img class="user-block-thumb" src="' . \DataModel::getProfileImage($profile_id) . '"/>';
            $result .= '<span class="notification-item-header text-uppercase">' . \DataModel::getProfileName($profile_id) . '</span>';
            $result .= '<span class="notification-item-event-time">' . date("d.m.Y", strtotime($message->message_datetime)) . '&nbsp;&nbsp;' . date("H:i:s", strtotime($message->message_datetime)) . '</span>';
            $result .= '<span class="notification-item-event">' . $message->message . '</span>';
            $result .= '</a>';
            $result .= '</li>';
        }

        $result .= '<li role = "presentation" class="messages_list_item">
        <a class = "dropdown-footer" href = "message-list">
        ' . $this->translator->translate("View all") . '&nbsp;&nbsp;<i class = "fa fa-angle-double-right"></i>
        </a>
        </li>';

        $this->database->query("UPDATE tbl_messages_groups SET unreaded = 0 WHERE to_user_id = $user_id");

        echo $result;
        $this->terminate();
    }

    public function handleMessageCheck($profile_id = 0) {
        if ($profile_id > 0) {

            if ($profile_id >= 100000000 && $profile_id < 200000000)
                if ($this->logged_in_profile_id > 0)
                    $messages_rows = $this->database->table('tbl_messages')->where("(from_user_id = ? AND to_profile_id=?) OR (from_profile_id=? AND to_user_id=?)", $profile_id, $this->logged_in_profile_id, $this->logged_in_profile_id, $profile_id)->order("id ASC")->fetchAll();
                else
                    $messages_rows = $this->database->table('tbl_messages')->where("(from_user_id = ? AND to_user_id=?) OR (from_user_id=? AND to_user_id=?)", $profile_id, $this->logged_in_id, $this->logged_in_id, $profile_id)->order("id DESC")->order("id ASC")->fetchAll();
            else
                $messages_rows = $this->database->table('tbl_messages')->where("(from_profile_id = ? AND to_profile_id=?) OR (from_profile_id=? AND to_profile_id=?)", $profile_id, $this->logged_in_profile_id, $this->logged_in_profile_id, $profile_id)->order("id ASC")->fetchAll();

            $data = "";

            foreach ($messages_rows as $row) {
                $data .= '<div style = "display:block;float:left;width:100%;padding: 10px 0px 10px 0px;">';

                if ($row->from_profile_id > 0) {
                    $profile_image = \DataModel::getProfileImage($row->from_profile_id);
                    $profile_name = \DataModel::getProfileName($row->from_profile_id);
                    $profile_id = $row->from_profile_id;
                } else {
                    $profile_image = \DataModel::getProfileImage($row->from_user_id);
                    $profile_name = \DataModel::getProfileName($row->from_user_id);
                    $profile_id = 0;
                }
                $data .= '<img class = "user-block-thumb" src = "' . $profile_image . '"/>';
                if ($profile_id > 0)
                    $data .= '<a href = "' . \DataModel::getProfileLinkUrl($profile_id, TRUE) . '?id=' . $profile_id . '"><span class = "notification-item-header text-uppercase">' . $profile_name . '</span></a>';
                else
                    $data .= '<a href = "#"><span class = "notification-item-header text-uppercase">' . $profile_name . '</span></a>';
                $data .= '<span class = "notification-item-event-time">' . date('d.m.Y', strtotime($row->message_datetime)) . '&nbsp;
        &nbsp;
        ' . date('H:i:s', strtotime($row->message_datetime)) . '</span>';
                $data .= '<span class = "notification-item-event" style = "color:black">' . nl2br($row->message) . '</span></div>';
            }

            echo $data;
            $this->terminate();
//$this->invalidateControl("areaMessages");
        } else {
            echo '';
            $this->terminate();
        }
    }

    public function handleTimelineRemove($id = 0) {
        if (isset($_GET['id']))
            $id = $_GET['id'];
        \DataModel::deleteFromTimelineByItem($id);
        $this->redirect("this", array(id => $this->profile_id));
    }

    public function handleTimelineRemoveComment($id = 0) {
        if (isset($_GET['id']))
            $id = $_GET['id'];

        $this->database->table("tbl_comments")->where("id=?", $id)->fetch();

//        if (\DataModel::getPermission($id, $this->logged_in_profile_id, 8))
        $this->database->table("tbl_comments")->where("id=?", $id)->delete();

        $this->redirect("this", array(id => $this->profile_id));
    }

    public function handleDeletePhoto($id) {
        $photo = $this->database->table("tbl_photos")->where("id=?", $id)->fetch();

        $profile_id = $photo->profile_id;

        if ($photo->user_id == $this->logged_in_id) {
            $this->database->table("tbl_photos")->where("id=?", $id)->delete();
        }

        $this->redirect(\DataModel::getGalleryProfileLinkUrl($profile_id), array("id" => $profile_id));
    }

    public function handleDeleteProfile($id) {
        $type = \DataModel::getProfileType($id);
        $error = true;

        switch ($type) {
            case 0:
                $profile = $this->database->table("tbl_user")->where("id=?", $id)->fetch();
                if ($profile->id == $this->logged_in_id) {
                    $error = FALSE;
                    $this->database->table("tbl_user")->where("id=?", $id)->delete();
                    $this->database->table("tbl_dogs")->where("user_id=?", $id)->delete();

                    $profiles = $this->database->table("tbl_userkennel")->where("user_id=?", $id)->fetchAll();
                    foreach ($profiles as $prof) {
                        $this->database->table("tbl_timeline")->where("profile_id=?", $prof->id)->delete();
                    }

                    $profiles = $this->database->table("tbl_userowner")->where("user_id=?", $id)->fetchAll();
                    foreach ($profiles as $prof) {
                        $this->database->table("tbl_timeline")->where("profile_id=?", $prof->id)->delete();
                    }

                    $profiles = $this->database->table("tbl_userhandler")->where("user_id=?", $id)->fetchAll();
                    foreach ($profiles as $prof) {
                        $this->database->table("tbl_timeline")->where("profile_id=?", $prof->id)->delete();
                    }

                    $this->database->table("tbl_userkennel")->where("user_id=?", $id)->delete();
                    $this->database->table("tbl_userowner")->where("user_id=?", $id)->delete();
                    $this->database->table("tbl_userhandler")->where("user_id=?", $id)->delete();

                    $this->handleLogout();
                }
                break;
            case 1:
                $profile = $this->database->table("tbl_userkennel")->where("id=?", $id)->fetch();
                if ($profile->user_id == $this->logged_in_id) {
                    $error = FALSE;
                    $data = array();
                    $data['active_profile_id'] = 0;
                    $data['active_profile_type'] = 0;
                    $this->database->table("tbl_user")->where("id=?", $profile->user_id)->update($data);
                    $this->database->table("tbl_dogs")->where("profile_id=?", $id)->delete();
                    $this->database->table("tbl_userkennel")->where("id=?", $id)->delete();
                    $this->database->table("tbl_timeline")->where("profile_id=?", $id)->delete();
                    $this->database->table("tbl_notify")->where("profile_id=?", $id)->delete();
                }
                break;
            case 2:
                $profile = $this->database->table("tbl_userowner")->where("id=?", $id)->fetch();
                if ($profile->user_id == $this->logged_in_id) {
                    $error = FALSE;
                    $data = array();
                    $data['active_profile_id'] = 0;
                    $data['active_profile_type'] = 0;
                    $this->database->table("tbl_user")->where("id=?", $profile->user_id)->update($data);
                    $this->database->table("tbl_dogs")->where("profile_id=?", $id)->delete();
                    $this->database->table("tbl_userowner")->where("id=?", $id)->delete();
                    $this->database->table("tbl_timeline")->where("profile_id=?", $id)->delete();
                    $this->database->table("tbl_notify")->where("profile_id=?", $id)->delete();
                }
                break;
            case 3:
                $profile = $this->database->table("tbl_userhandler")->where("id=?", $id)->fetch();
                if ($profile->user_id == $this->logged_in_id) {
                    $error = FALSE;
                    $data = array();
                    $data['active_profile_id'] = 0;
                    $data['active_profile_type'] = 0;
                    $this->database->table("tbl_user")->where("id=?", $profile->user_id)->update($data);
                    $this->database->table("tbl_userhandler")->where("id=?", $id)->delete();
                    $this->database->table("tbl_timeline")->where("profile_id=?", $id)->delete();
                    $this->database->table("tbl_notify")->where("profile_id=?", $id)->delete();
                }
                break;
        }

        $this->redirect("user:user_create_profile_switcher");
    }

    public function handleLogout() {
        $this->session->destroy();
        $this->flashMessage($this->translate("You have been successsfully logged out"), "Info");
        $this->redirect("LandingPage:default");
    }

    public function handleLogoutChangePassword() {
        $this->session->destroy();
        $this->flashMessage($this->translate("Password changed successfully. Please log in with your new password."), "Success");
        $this->redirect("LandingPage:default");
    }

    public function handleGetDogImage($name) {
        if (\DataModel::haveDogProfile($name)) {
            $dog = $this->database->table("tbl_dogs")->where("dog_name=?", $name)->fetch();
            echo $dog->dog_image;
        } else {
            echo '';
        }
        $this->terminate();
    }

    public function handleGetDogBreed($name) {
        if (\DataModel::haveDogProfile($name)) {
            $dog = $this->database->table("tbl_dogs")->where("dog_name=?", $name)->fetch();
            echo $dog->breed_name;
        } else {
            echo '';
        }
        $this->terminate();
    }

    public function handleGetDogState($name) {
        if (\DataModel::haveDogProfile($name)) {
            $dog = $this->database->table("tbl_dogs")->where("dog_name=?", $name)->fetch();
            echo $dog->country;
        } else {
            echo '';
        }
        $this->terminate();
    }

    public function TrustPay($amt = 50, $pay = 2) {
        if (isset($_GET['amt']))
            $amt = $_GET['amt'];

        if (isset($_GET['pay']))
            $pay = $_GET['pay'];

        $rand = rand(10000000, 99999999);

        try {
            $data = array();
            $data['user_id'] = $this->logged_in_id;
            $data['transaction'] = $rand;
            $data['amount'] = $amt;
            $data['type'] = $pay;
            $this->database->table("tbl_payments")->insert($data);
        } catch (\Exception $ex) {
            
        }

        $TrustpayUrl = "https://ib.trustpay.eu/mapi/pay.aspx";

        $TrustpayUrlCard = "https://ib.trustpay.eu/mapi/cardpayments.aspx";

        $TrustpayUrlPaysafe = "https://ib.trustpay.eu/mapi/paysafecard.aspx";

        $TrustpayAID = "2107843189";

        $TrustpaySecret = "tba6CtpBwlYLwT3fotM6jPmsD48pkYZb";

        $current_user = $this->logged_in_id;

        $key = $TrustpaySecret;
        $aid = $TrustpayAID;
        $amt = $amt;
        $cur = "EUR";
        $ref = $rand . '|' . $current_user . '|' . $amt;
        $cnt = 1;

        $sig = $aid . $amt . $cur . $ref;

        $TrustpaySign = strtoupper(hash_hmac('sha256', pack('A*', $sig), pack('A*', $key)));

        $sig = $TrustpaySign;

        switch ($pay) {
            case 1: // wire transfer
                $this->redirectUrl($TrustpayUrl . '?AID=' . $aid . '&AMT=' . $amt . '&CUR=' . $cur . '&REF=' . $ref . '&SIG=' . $sig . '&CNT=' . $cnt);
                break;
            case 2: // karta
                $this->redirectUrl($TrustpayUrlCard . '?AID=' . $aid . '&AMT=' . $amt . '&CUR=' . $cur . '&REF=' . $ref . '&SIG=' . $sig);
                break;
        }
    }

    public function actionPayment() {
        try {
            if (isset($_GET['RES']) && $_GET['RES'] == 0) {
                if (isset($_GET['REF']))
                    $REF = $_GET['REF'];

                $REF = explode("|", $REF);

                $transaction_id = $REF[0];
                $user_id = $REF[1];
                $amount = $REF[2];

                $user = $this->database->table("tbl_user")->where("id=?", $user_id)->fetch();

                $expiry = $user->premium_expiry_date;
                $curdate = date("Y-m-d");

                if ($expiry > $curdate) {
                    if ($amount == 35)
                        $end = date("Y-m-d", strtotime(date("Y-m-d", strtotime($expiry)) . " + 6 months"));
                    else
                        $end = date("Y-m-d", strtotime(date("Y-m-d", strtotime($expiry)) . " + 1 years"));
                }else {
                    if ($amount == 35)
                        $end = date('Y-m-d', strtotime('+6 months'));
                    else
                        $end = date('Y-m-d', strtotime('+1 years'));
                }

                $data['premium_expiry_date'] = $end;

                $this->database->table("tbl_user")->where("id=?", $user_id)->update($data);


// invoice - superfaktura

                $sf = new \invoice();

                if ($amount == 35)
                    $response = $sf->hookNewOrder($transaction_id, $user->name . " " . $user->surname, $user->address, $user->city, $user->zip, "", $user->phone, "DOGFORSHOW - " . $this->translate("Premium account activation"), $this->translate("6 MONTHS"), "1", $amount);
                else
                    $response = $sf->hookNewOrder($transaction_id, $user->name . " " . $user->surname, $user->address, $user->city, $user->zip, "", $user->phone, "DOGFORSHOW - " . $this->translate("Premium account activation"), $this->translate("12 months"), "1", $amount);

                $id = $response->data->Invoice->id;
                $token = $response->data->Invoice->token;

                try {
                    $lang = $user->lang;
                } catch (\Exception $ex) {
                    $lang = "en";
                }

                switch ($lang) {
                    case 'sk':
                        $invlang = 'slo';
                        break;
                    case 'cz':
                        $invlang = 'cze';
                        break;
                    default :
                        $invlang = 'eng';
                        break;
                }

                $mail = new Message();
                $mail->setFrom('DOGFORSHOW <info@dogforshow.com>')
                        ->setSubject("DOGFORSHOW - " . $this->translate("Premium account activation"))
                        ->addTo($user->email)
                        ->setHtmlBody($this->translate("You can download your invoice here") . ":<br/><br/>" . "https://moja.superfaktura.sk/$invlang/invoices/pdf/$id/token:$token");

                $mailer = new SendmailMailer();
                $mailer->send($mail);

                try {
                    $data['status'] = 1;
                    $this->database->table("tbl_payments")->where("transaction=?", $transaction_id)->where("user_id=?", $user->id)->update($data);
                } catch (\Exception $ex) {
                    
                }

                $this->flashMessage($this->translate("Your premium account has been successfully activated."), "Success");
            } else {
                $this->flashMessage($this->translate("Your premium account has not been activated."), "Warning");
            }
        } catch (\Exception $ex) {
            $this->flashMessage($this->translate("Your premium account has not been activated."), "Warning");
        }
        $this->redirect("default");
    }

    protected function createComponentFrmLogIn() {
        $form = new Form();
        $form->addText("txtEmail")->setRequired($this->translate("Required field"));
        $form->addPassword("txtPassword")->setRequired($this->translate("Required field"));
        $form->addCheckbox("chkRemember");
        $form->addSubmit('btnLogin', 'Login')->onClick[] = array($this, 'frmLogInSucceeded');
        return $form;
    }

    protected function createComponentFormSendMessage() {
        $form = new Form();
        $form->getElementPrototype()->class('ajax');
        $form->addText("txtMessageCompose")->setRequired($this->translate("Required field"))->setDefaultValue("");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmSendMessageSucceeded');

        return $form;
    }

//    public function handleMessageSend($profile_id, $message) {
//        
//        $user_id = \DataModel::getUserIdByProfileId($profile_id);
//
//        $this->receiver_user_id = $user_id;
//        $this->receiver_profile_id = $profile_id;
//        
//        $message = $txtMessageCompose;
//
//        if (strlen($message) > 23) {
//            $message = substr($message, 0, 20) . '...';
//        }
//
//        if ($this->profile_id > 0) {
//            if ($this->profile_id == $this->logged_in_id)
//                $this->profile_id = 0;
//        } else
//            $this->profile_id = 0;
//
//        if ($this->receiver_profile_id > 0) {
//            if ($this->receiver_profile_id == $this->receiver_user_id)
//                $this->receiver_profile_id = 0;
//        } else
//            $this->receiver_profile_id = 0;
//
//        $data_group['from_user_id'] = $this->logged_in_id;
//
//        $data_group['from_profile_id'] = $this->profile_id;
//        $data_group['to_user_id'] = $this->receiver_user_id;
//        $data_group['to_profile_id'] = $this->receiver_profile_id;
//        $data_group['message'] = $message;
//        $data_group['unreaded'] = 1;
//        $data_group['active_from'] = 1;
//        $data_group['active_to'] = 1;
//
//        $cnt = $this->database->table("tbl_messages_groups")->where("from_user_id=? AND to_user_id=? AND from_profile_id=? AND to_profile_id=?", $this->logged_in_id, $this->receiver_user_id, $this->profile_id, $this->receiver_profile_id)->count();
//
//        if ($cnt > 0)
//            $this->database->table("tbl_messages_groups")->where("from_user_id=? AND to_user_id=? AND from_profile_id=? AND to_profile_id=?", $this->logged_in_id, $this->receiver_user_id, $this->profile_id, $this->receiver_profile_id)->update($data_group);
//        else
//            $this->database->table("tbl_messages_groups")->insert($data_group);
//
//        $data_group['to_user_id'] = $this->logged_in_id;
//        $data_group['to_profile_id'] = $this->profile_id;
//        $data_group['from_user_id'] = $this->receiver_user_id;
//        $data_group['from_profile_id'] = $this->receiver_profile_id;
//        $data_group['message'] = $message;
//        $data_group['unreaded'] = 0;
//        $data_group['active_from'] = 1;
//        $data_group['active_to'] = 1;
//
//        $cnt = $this->database->table("tbl_messages_groups")->where("from_user_id=? AND to_user_id=? AND from_profile_id=? AND to_profile_id=?", $this->receiver_user_id, $this->logged_in_id, $this->receiver_profile_id, $this->profile_id)->count();
//
//        if ($cnt > 0)
//            $this->database->table("tbl_messages_groups")->where("from_user_id=? AND to_user_id=? AND from_profile_id=? AND to_profile_id=?", $this->receiver_user_id, $this->logged_in_id, $this->receiver_profile_id, $this->profile_id)->update($data_group);
//        else
//            $this->database->table("tbl_messages_groups")->insert($data_group);
//
//        $data['message'] = $values['txtMessageCompose'];
//
//        $data['from_user_id'] = $this->logged_in_id;
//        $data['from_profile_id'] = $this->profile_id;
//        $data['to_user_id'] = $this->receiver_user_id;
//        $data['to_profile_id'] = $this->receiver_profile_id;
//        $data['unreaded'] = 1;
//        $data['active_from'] = 1;
//        $data['active_to'] = 1;
//
//        $this->database->table("tbl_messages")->insert($data);
//
//        //$this->payload->message = "Ok";
//
//        $this->sendPayload();
//    }

    public function frmSendMessageSucceeded($button) {
        $values = $button->getForm()->getValues();

        $message = $values['txtMessageCompose'];

        if (strlen($message) > 23) {
            $message = substr($message, 0, 20) . '...';
        }

        if ($this->profile_id > 0) {
            if ($this->profile_id == $this->logged_in_id)
                $this->profile_id = 0;
        } else
            $this->profile_id = 0;

        if ($this->receiver_profile_id > 0) {
            if ($this->receiver_profile_id == $this->receiver_user_id)
                $this->receiver_profile_id = 0;
        } else
            $this->receiver_profile_id = 0;

        $data_group['from_user_id'] = $this->logged_in_id;

        $data_group['from_profile_id'] = $this->profile_id;
        $data_group['to_user_id'] = $this->receiver_user_id;
        $data_group['to_profile_id'] = $this->receiver_profile_id;
        $data_group['message'] = $message;
        $data_group['unreaded'] = 1;
        $data_group['active_from'] = 1;
        $data_group['active_to'] = 1;

        $cnt = $this->database->table("tbl_messages_groups")->where("from_user_id=? AND to_user_id=? AND from_profile_id=? AND to_profile_id=?", $this->logged_in_id, $this->receiver_user_id, $this->profile_id, $this->receiver_profile_id)->count();

        if ($cnt > 0)
            $this->database->table("tbl_messages_groups")->where("from_user_id=? AND to_user_id=? AND from_profile_id=? AND to_profile_id=?", $this->logged_in_id, $this->receiver_user_id, $this->profile_id, $this->receiver_profile_id)->update($data_group);
        else
            $this->database->table("tbl_messages_groups")->insert($data_group);

        $data_group['to_user_id'] = $this->logged_in_id;
        $data_group['to_profile_id'] = $this->profile_id;
        $data_group['from_user_id'] = $this->receiver_user_id;
        $data_group['from_profile_id'] = $this->receiver_profile_id;
        $data_group['message'] = $message;
        $data_group['unreaded'] = 0;
        $data_group['active_from'] = 1;
        $data_group['active_to'] = 1;

        $cnt = $this->database->table("tbl_messages_groups")->where("from_user_id=? AND to_user_id=? AND from_profile_id=? AND to_profile_id=?", $this->receiver_user_id, $this->logged_in_id, $this->receiver_profile_id, $this->profile_id)->count();

        if ($cnt > 0)
            $this->database->table("tbl_messages_groups")->where("from_user_id=? AND to_user_id=? AND from_profile_id=? AND to_profile_id=?", $this->receiver_user_id, $this->logged_in_id, $this->receiver_profile_id, $this->profile_id)->update($data_group);
        else
            $this->database->table("tbl_messages_groups")->insert($data_group);

        $data['message'] = $values['txtMessageCompose'];

        $data['from_user_id'] = $this->logged_in_id;
        $data['from_profile_id'] = $this->profile_id;
        $data['to_user_id'] = $this->receiver_user_id;
        $data['to_profile_id'] = $this->receiver_profile_id;
        $data['unreaded'] = 1;
        $data['active_from'] = 1;
        $data['active_to'] = 1;

        $this->database->table("tbl_messages")->insert($data);

        if ($this->isAjax()) {
            $this->redrawControl();
        }
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
            $user_section->lang = $row->lang;
            $activated = $row->active;
            $profile_id = $row->active_profile_id;
        }

        if ($id == 0) {
            $cnt = $this->database->table("tbl_user")->where("email=?", $values['txtEmail'])->where("password LIKE ?", "gnrtx%")->count();

            if ($cnt > 0) {
                $mail = new Message();
                $mail->setFrom('DOGFORSHOW <info@dogforshow.com>')
                        ->setSubject($this->translate("Forgot password"))
                        ->addTo($values['txtEmail'])
                        ->setHtmlBody($this->getLostPasswordBody($values['txtEmail']));

                $mailer = new SendmailMailer();
                $mailer->send($mail);

                $this->flashMessage($this->translate("Your password has been successfully sent to your e-mail"), "Success");
            } else {
                $this->flashMessage($this->translate("Wrong username or password."), "Warning");
            }
        } else {
            if ($activated == 0) {
                $this->flashMessage($this->translate("Your user account has not been activated yet. Please activate it by clicking on the link, which was been sent in your registration email. You can resend it by clicking on folowing link") . "<br/><br/><p class=\"text-center\"><a href=\"?resend_al=$id\" class=\"btn btn-danger btn-xl\"><i class=\"fa fa-envelope\"></i>&nbsp;&nbsp;" . $this->translate("Resend registration email") . "</a></p>", "Warning");
            } else {
                $cnt = 0; //$this->database->table("tbl_user")->where("email=?", $values['txtEmail'])->where("password LIKE ?", "gnrtx%")->count();

                if ($cnt > 0) {
                    $this->redirect("user:user_edit_account");
                } else {
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
                    } else {
                        $this->redirect("user:user_create_profile_switcher");
                    }
                }
            }
        }
    }

    protected function createComponentCommentTimeline() {
        return new Nette\Application\UI\Multiplier(function () {
            $form = new Form();
            $form->getElementPrototype()->class('ajax');
            $form->addHidden("snippet_id");
            $form->addText("comment")->setRequired();
            $form->addSubmit('btnSubmit')->onClick[] = array($this, 'commentSucceeded');
            return $form;
        });
    }

    public function commentSucceeded($button) {
        $values = $button->getForm()->getValues();

        $this->data_model->addTimelineComment($this->logged_in_id, $this->profile_id, $values['snippet_id'], $values['comment']);

        if ($this->isAjax()) {
            $this->redrawControl();
        } else {
            $this->redirect('this');
        }
    }

    protected function createComponentForgotPassword() {
        $form = new Form();
        $form->addText("txtEmail")->setRequired($this->translate("Required field"));
        $form->addSubmit('btnForgotPassword')->onClick[] = array($this, 'ForgotPasswordSucceeded');
        return $form;
    }

    public function getLostPasswordBody($email) {
        $data = $this->database->table("tbl_user")->where("email=?", $email)->fetch();

        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns = "http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8" />
        <title>Welcome to DOGFORSHOW</title>
        </head>
        <body bgcolor = "#f6f8f1" style = "margin: 0; padding: 0; min-width: 100%!important;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;background-color:#8C8067;" >
        <table width = "100%" border = "0" cellpadding = "0" cellspacing = "0">
        <tr>
        <td>
        <table style = "padding-bottom:20px; margin-top:10px; width: 90%; max-width: 600px;" class = "content" bgcolor = "white" align = "center" cellpadding = "10" cellspacing = "0" border = "0">
        <tr>
        <td align = "center" style = "border-bottom:#8C8067 1px solid">
        <h1 style = "font-size:23px;color:#8C8067;">' . $this->translate('Hello') . ' ' . $data->name . '</h1>
        </td>
        </tr>
        <tr>
        <td>
        <ul style = "list-style-type: none">
        <li>' . $this->translate('Email') . ': <strong>' . $data->email . '</strong></li>
        <li>' . $this->translate('Password') . ': <strong>' . $data->password . '</strong></li>
        </ul>
        </td>
        </tr>
        <tr>
        <td align = "center">
        <p style = "font-size:15px;"><a href = "http://www.dogforshow.com" style = "padding:10px; color:#FFFFFF; background-color: #c12e2a; text-decoration: none; text-transform: uppercase; font-weight: bold;">' . $this->translate('Login to your account') . '</a></p>
        </td>
        </tr>
        </table>
        <table style = "margin-top: 10px; width: 90%; max-width: 600px;color:white;" align = "center" cellpadding = "10" cellspacing = "0" border = "0">
        <tr>
        <td align = "center">
        <p style = "font-size:12px;">' . $this->translate('This email was automatically sent by DOGFORSHOW system. Please dont reply on this email') . '</p>
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
                $this->flashMessage($this->translate("User with this e-mail, is not in our database"), "Warning");
                throw new \ErrorException();
            }

            $mail = new Message();
            $mail->setFrom('DOGFORSHOW <info@dogforshow.com>')
                    ->setSubject($this->translate("Forgot password"))
                    ->addTo($values['txtEmail'])
                    ->setHtmlBody($this->getLostPasswordBody($values['txtEmail']));


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
        <html xmlns = "http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8" />
        <title>Welcome to DOGFORSHOW</title>
        </head>
        <body bgcolor = "#f6f8f1" style = "margin: 0; padding: 0; min-width: 100%!important;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;background-color:#8C8067;" >
        <table width = "100%" border = "0" cellpadding = "0" cellspacing = "0">
        <tr>
        <td>
        <table style = "padding-bottom:20px; margin-top:10px; width: 90%; max-width: 600px;" class = "content" bgcolor = "white" align = "center" cellpadding = "10" cellspacing = "0" border = "0">
        <tr>
        <td align = "center" style = "border-bottom:#8C8067 1px solid">
        <h1 style = "font-size:23px;color:#8C8067;">' . $this->translate("Hello") . ' ' . $name . '</h1>
        </td>
        </tr>
        <tr>
        <td>
        <p style = "font-size:15px;">' . $this->translate('Thank you for your registration to DOGFORSHOW. Please activate your account by clicking on the following link') . '</p>
        </td>
        </tr>
        <tr>
        <td align = "center">
        <p style = "font-size:15px;"><a href = "http://www.dogforshow.com/www/templates/scripts/activation.php?alink=' . $id . '" style = "padding:10px; color:#FFFFFF; background-color: #c12e2a; text-decoration: none; text-transform: uppercase; font-weight: bold;">' . $this->translate('Activate account') . '</a></p>
        </td>
        </tr>
        </table>
        <table style = "margin-top: 10px; width: 90%; max-width: 600px;color:white;" align = "center" cellpadding = "10" cellspacing = "0" border = "0">
        <tr>
        <td align = "center">
        <p style = "font-size:12px;">' . $this->translate('This email was automatically sent by DOGFORSHOW system. Please dont reply on this email') . '</p>
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

//	    if ($values['hidddlCountries'] == "0")
//		$exception .= "<li>" . $this->translate("Please select state") . "</li>";

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
                    $mysection = $this->getSession('language');
                    if (strlen($mysection->lang) > 1)
                        $values['lang'] = $mysection->lang;
                    else
                        $values['lang'] = 'en';
                } catch (\Exception $ex) {
                    $values['lang'] = 'en';
                }
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

    protected function createComponentFrmContactForm() {
        $form = new Form();

        $name = "";
        $surname = "";
        $email = "";


        if ($this->logged_in_id > 0) {
            try {
                $user = $this->database->table("tbl_user")->where("id=?", $this->logged_in_id)->fetch();
                $name = $user->name;
                $surname = $user->surname;
                $email = $user->email;
            } catch (\Exception $ex) {
                
            }
        }

        $form->addText('txtName')->setValue($name)->setRequired($this->translate("Required field"));
        $form->addText('txtSurname')->setValue($surname)->setRequired($this->translate("Required field"));
        $form->addText('txtEmail')->setValue($email)->setRequired($this->translate("Required field"));
        $form->addTextArea('txtMessage')->setRequired($this->translate("Required field"));
        $form->addSubmit('btnSubmit', 'Send')->onClick[] = array($this, 'frmContactFormSucceeded');

        return $form;
    }

    public function frmContactFormSucceeded($button) {
        $values = $button->getForm()->getValues();

        try {
            if ($this->logged_in_id > 0)
                $recaptcha = "123456789012345";
            else
                $recaptcha = $_POST['g-recaptcha-response'];


            if (strlen($recaptcha) > 10) {
                $mail = new Message();

//if ($values['txtVerify'] != 2) {
//    throw new \Exception("CAPTCHA is not valid.");
//} else {
                $mail->setFrom($values['txtName'] . ' ' . $values['txtSurname'] . ' <' . $values['txtEmail'] . '>') //$values['txtEmail']) //DOGFORSHOW <info@dogforshow.com>
                        ->addTo('info@dogforshow.com')
                        ->addTo('radoslav.mihalus@gmail.com')
                        ->setSubject('DOGFORSHOW - Contact Form')
                        ->setHtmlBody('Name: ' . $values['txtName'] . '<br/>Surname: ' . $values['txtSurname'] . '<br/>Email: ' . $values['txtEmail'] . '<br/><br/>Message:<br/>' . $values['txtMessage'])
                        ->setContentType('text/html')
                        ->setEncoding('UTF-8');

//var_dump($mail);

                $mailer = new SendmailMailer();
                $mailer->send($mail);

                $this->flashMessage($this->translate("Your message has been successfully sent. We will contact you as soon as possible."), "Info");
            } else {
                $this->flashMessage($this->translate("Your message has not been sent. Verification is required."), "Info");
            }
//}
        } catch (\Exception $ex) {
            $this->flashMessage($ex->getMessage(), "Error");
        }
    }

    protected function createComponentUserEditAccountPremium() {
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
        $langs['de'] = 'de';
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
                ->setDisabled()->setValue($name);
        $form->addText('txtSurname')
                ->setDisabled()->setValue($surname);
        $form->addText('txtEmail')
                ->setDisabled()->setValue($email);
        $form->addSelect('ddlCountries')->setItems($countries)->setPrompt($this->translate("Please select"))->setValue($country)->setRequired('Required field');
        $form->addSelect('ddlLanguage')->setItems($langs)->setPrompt($this->translate("Please select"))->setValue($lang)->setRequired('Required field');
        $form->addText('txtAddress')->setValue($address);
        $form->addText('txtTown')->setValue($city);
        $form->addText('txtZip')->setValue($zip);
        $form->addText('txtPhoneNumber')->setValue($phone);
        $form->addSelect('ddlYear')->setItems($years)->setValue($year_of_birth);

        $form->addSubmit('submitCard', "Card")
                ->onClick[] = array($this, 'editUserCardSucceeded');
        $form->addSubmit('submitTransfer', "Transfer")
                ->onClick[] = array($this, 'editUserTransferSucceeded');

        return $form;
//
//		$form->addProtection();
//		return $form;
    }

    public function editUserCardSucceeded($button) {
        $values = $button->getForm()->getValues();
        $values = $this->assignFields($values, 'frmEditUser');

        $mysection = $this->getSession('userdata');
        $myid = $mysection->id;

        $userdata = $this->database->table("tbl_user")->where("id = ?", $myid)->update($values);

        $this->TrustPay($this->amt, 2);
    }

    public function editUserTransferSucceeded($button) {
        $values = $button->getForm()->getValues();
        $values = $this->assignFields($values, 'frmEditUser');

        $mysection = $this->getSession('userdata');
        $myid = $mysection->id;

        $userdata = $this->database->table("tbl_user")->where("id = ?", $myid)->update($values);

        $this->TrustPay($this->amt, 1);
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
    public $lang;

    public function __construct($lang = "en") { //Nette\Database\Context $database) {
        $this->lang = $lang;
        $this->database = $GLOBALS['database'];
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
                switch ($this->lang) {
                    case "en":
                        $message = $row->translated_text_en;
                        break;
                    case "cz":
                        $message = $row->translated_text_cz;
                        break;
                    case "de":
                        $message = $row->translated_text_de;
                        break;
                    case "sk":
                        $message = $row->translated_text_sk;
                        break;
                    case "ru":
                        $message = $row->translated_text_ru;
                        break;
                    case "hu":
                        $message = $row->translated_text_hu;
                        break;
                    default :
                        $message = $row->translated_text_en;
                        break;
                }
            }

            if ($id == 0) {
                $values = array();
                $values["text_to_translate"] = $message;
                $values["translated_text_en"] = $message;
                $values["translated_text_cz"] = $message;
                $values["translated_text_sk"] = $message;
                $values["translated_text_hu"] = $message;
                $values["translated_text_ru"] = $message;
                $values["translated_text_de"] = $message;
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