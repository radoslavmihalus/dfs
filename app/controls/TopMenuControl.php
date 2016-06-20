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
    public $logged_in_profile_id;

    public function __construct(Nette\Database\Context $database, $profile_id, $logged_in_id, $translator, $logged_in_profile_id) {
        parent::__construct();
        $this->profile_id = $profile_id;
        $this->logged_in_id = $logged_in_id;
        $this->database = $database;
        $this->translator = $translator;
        $this->logged_in_profile_id = $logged_in_profile_id;
    }

    public function render() {
        $this->template->setFile(__DIR__ . "/TopMenuControl.latte");
        $this->template->setTranslator($this->translator);
        $this->template->logged_in_id = $this->logged_in_id;
        $this->template->notifyCount = $this->notifyCount;
        $this->template->notifications = $this->notifications;
        $messages_rows = $this->database->table("tbl_messages_groups")->where("to_profile_id=?", $this->logged_in_profile_id)->order("message_datetime DESC")->limit(3)->fetchAll();
        $this->template->messages_rows = $messages_rows;
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

}
