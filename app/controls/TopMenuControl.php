<?php

use Nette\Application\UI;

class TopMenuControl extends UI\Control {

    public $profile_id;
    public $logged_in_id;
    public $database;
    public $translator;
    public $notifyCount = 0;

    public $oldNotifyCount = 0;
    public $notifications;

    public function __construct(Nette\Database\Context $database, $profile_id, $logged_in_id, $translator) {
        parent::__construct();
        $this->profile_id = $profile_id;
        $this->logged_in_id = $logged_in_id;
        $this->database = $database;
        $this->translator = $translator;
    }

    public function render() {
        $this->template->setFile(__DIR__ . "/TopMenuControl.latte");
        $this->template->setTranslator($this->translator);
        $this->template->logged_in_id = $this->logged_in_id;
        $this->template->notifyCount = $this->notifyCount;
        $this->template->notifications = $this->notifications;
        $this->template->render();
    }

    public function handleNewMessagesCount() {
        try {
            if ($this->logged_in_profile_id > 0)
                $messages_count = $this->database->table('tbl_messages_groups')->where("to_profile_id = ? AND unreaded = 1", $this->profile_id)->count();
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
            $notify_count = $this->database->table('tbl_notify')->where("notify_user_id = ? AND unreaded = 1", $this->logged_in_id)->count();
            $this->notifyCount = $notify_count;

            $notifications = $this->database->table("tbl_notify")->where("notify_user_id=?", $this->logged_in_id)->order("notify_datetime DESC")->limit(3)->fetchAll();

            $this->notifications = $notifications;
        } catch (\Exception $ex) {
            $this->notifyCount = 0;
        }

        if ($this->presenter->isAjax()) {
            $this->redrawControl("badge");
            $this->redrawControl("notifications_list");
        } else {
            $this->redirect("this");
        }
    }

    public function handleClearNotify() {
        $user_id = $this->logged_in_id;
        $this->database->query("UPDATE tbl_notify SET unreaded = 0 WHERE notify_user_id = $user_id");

        if ($this->presenter->isAjax()) {
            $this->notifyCount = 0;
            $this->oldNotifyCount = 0;
            $this->redrawControl("badge");
        }
    }

    public function handleClearMessages($limit = 3) {
        $user_id = $this->logged_in_id;

        $messages_rows = $this->database->table("tbl_messages_groups")->where("to_profile_id=?", $this->logged_in_profile_id)->order("message_datetime DESC")->limit($limit)->fetchAll();

        $result = '<li role="presentation" class="dropdown-header text-uppercase" style="border-bottom: whitesmoke 1px solid;padding:10px;">' . $this->translator->translate("Messages") . '</li>';

        foreach ($messages_rows as $message) {
            if ($message->from_profile_id > 0)
                $profile_id = $message->from_profile_id;
            else
                $profile_id = $message->from_user_id;

            if (\DataModel::getPremium($this->logged_in_id)) {
                $result .= '<li role="presentation">';
                $result .= '<a role="menuitem" tabindex="-1" href="message-compose?profile_id=' . $profile_id . '">';
                $result .= '<img class="user-block-thumb" src="' . \DataModel::getProfileImage($profile_id) . '"/>';
                $result .= '<span class="notification-item-header text-uppercase">' . \DataModel::getProfileName($profile_id) . '</span>';
                $result .= '<span class="notification-item-event-time">' . date("d.m.Y", strtotime($message->message_datetime)) . '&nbsp;&nbsp;' . date("H:i:s", strtotime($message->message_datetime)) . '</span>';
                $result .= '<span class="notification-item-event">' . mb_strimwidth($message->message, 0, 8, "...") . '</span>';
                $result .= '</a>';
                $result .= '</li>';
            } else {
                $result .= '<li role="presentation">';
                $result .= '<a role="menuitem" tabindex="-1" href="message-compose?profile_id=' . $profile_id . '">';
                $result .= '<img class="user-block-thumb" src="' . \DataModel::getProfileImage($profile_id) . '"/>';
                $result .= '<span class="notification-item-header text-uppercase">' . mb_strimwidth(\DataModel::getProfileName($profile_id), 0, 0, "...") . '</span>';
                $result .= '<span class="notification-item-event-time">' . date("d.m.Y", strtotime($message->message_datetime)) . '&nbsp;&nbsp;' . date("H:i:s", strtotime($message->message_datetime)) . '</span>';
                $result .= '<span class="notification-item-event">' . mb_strimwidth($message->message, 0, 8, "...") . '</span>';
                $result .= '</a>';
                $result .= '</li>';
            }
        }

        $result .= '<li role = "presentation" class="messages_list_item">
        <a class = "dropdown-footer" href = "message-list">
        ' . $this->translator->translate("View all") . '&nbsp;&nbsp;<i class = "fa fa-angle-double-right"></i>
        </a>
        </li>';

        $this->database->query("UPDATE tbl_messages_groups SET unreaded = 0 WHERE to_user_id = $user_id");
        $this->database->query("UPDATE tbl_messages SET unreaded = 0 WHERE to_user_id = $user_id");

        echo $result;
        $this->terminate();
    }

    public function handleMessageCheck($profile_id = 0) {
        if ($profile_id > 0) {

            if (($profile_id >= 100000000 && $profile_id < 200000000) || ($profile_id >= 9000000001 && $profile_id < 10000000000))
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

}
