<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DataModel {

    private $database;

    function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    function sendPrivateMessage($from_user_id, $from_profile_id, $to_user_id, $to_profile_id, $message) {
        $data_group['from_user_id'] = $from_user_id;

        $data_group['from_profile_id'] = $from_profile_id;
        $data_group['to_user_id'] = $to_user_id;
        $data_group['to_profile_id'] = $to_profile_id;
        $data_group['message'] = $message;
        $data_group['unreaded'] = 1;
        $data_group['active_from'] = 1;
        $data_group['active_to'] = 1;

        $cnt = $this->database->table("tbl_messages_groups")->where("from_user_id=? AND to_user_id=? AND from_profile_id=? AND to_profile_id=?", $from_user_id, $to_user_id, $from_profile_id, $to_profile_id)->count();

        if ($cnt > 0)
            $this->database->table("tbl_messages_groups")->where("from_user_id=? AND to_user_id=? AND from_profile_id=? AND to_profile_id=?", $from_user_id, $to_user_id, $from_profile_id, $to_profile_id)->update($data_group);
        else
            $this->database->table("tbl_messages_groups")->insert($data_group);

        $data_group['to_user_id'] = $from_user_id;
        $data_group['to_profile_id'] = $from_profile_id;
        $data_group['from_user_id'] = $to_user_id;
        $data_group['from_profile_id'] = $to_profile_id;
        $data_group['message'] = $message;
        $data_group['unreaded'] = 0;
        $data_group['active_from'] = 1;
        $data_group['active_to'] = 1;

        $cnt = $this->database->table("tbl_messages_groups")->where("from_user_id=? AND to_user_id=? AND from_profile_id=? AND to_profile_id=?", $to_user_id, $from_user_id, $to_profile_id, $from_profile_id)->count();

        if ($cnt > 0)
            $this->database->table("tbl_messages_groups")->where("from_user_id=? AND to_user_id=? AND from_profile_id=? AND to_profile_id=?", $to_user_id, $from_user_id, $to_profile_id, $from_profile_id)->update($data_group);
        else
            $this->database->table("tbl_messages_groups")->insert($data_group);

        $data['message'] = $message;

        $data['from_user_id'] = $from_user_id;
        $data['from_profile_id'] = $from_profile_id;
        $data['to_user_id'] = $to_user_id;
        $data['to_profile_id'] = $to_profile_id;
        $data['unreaded'] = 1;
        $data['active_from'] = 1;
        $data['active_to'] = 1;

        $this->database->table("tbl_messages")->insert($data);
    }

    function getField($form_name, $element_name) {
        $fields = $this->database->query("SELECT * FROM form_fields WHERE form_name=? AND element_name=?", $form_name, $element_name);

        $return = "";

        foreach ($fields as $field) {
            $return = $field->field_name;
        }
        return $return;
    }

    function getFieldReverse($form_name, $field_name) {
        $fields = $this->database->query("SELECT * FROM form_fields WHERE form_name=? AND field_name=?", $form_name, $field_name);

        $return = "";

        foreach ($fields as $field) {
            $return = $field->element_name;
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

    function assignFieldsReverse($valuesArray, $form) {
        $return = array();

        foreach ($valuesArray as $key => $value) {
            $field = $this->getFieldReverse($form, $key);
            if (strlen($field) > 0)
                $return[$field] = $value;
        }

        return $return;
    }

    /*     * *
     * @img = file upload control
     */

    function processImage($img) {

        $return = $img;

        return $return;
    }

    /**
     * 
     * @param type $id
     * @return recordset of timeline rows
     */
    function getTimeline($id = 0, $limit1 = 0, $limit2 = 9) {
        $rows = NULL;

//        $table = "tmp_" . rand(0, 10);
//        $this->database->query("DROP TABLE IF EXISTS $table");
//        if ($id == 0)
//            $this->database->query("CREATE TABLE $table SELECT tbl_timeline.*, (IF(tbl_timeline.profile_id>=300000000,(SELECT owner_profile_picture FROM tbl_userowner WHERE id=tbl_timeline.profile_id), (SELECT kennel_profile_picture FROM tbl_userkennel WHERE tbl_userkennel.id=tbl_timeline.profile_id))) as timeline_profile_image, (IF(tbl_timeline.profile_id>=300000000,(SELECT concat(tbl_user.name,' ',tbl_user.surname) as timeline_name FROM tbl_user WHERE tbl_user.id=(SELECT user_id FROM tbl_userowner WHERE id=tbl_timeline.profile_id)), (SELECT kennel_name FROM tbl_userkennel WHERE tbl_userkennel.id=tbl_timeline.profile_id))) as timeline_name FROM tbl_timeline order by `date` DESC LIMIT 5");
//        else
//            $this->database->query("CREATE TABLE $table SELECT tbl_timeline.*, (IF(tbl_timeline.profile_id>=300000000,(SELECT owner_profile_picture FROM tbl_userowner WHERE id=tbl_timeline.profile_id), (SELECT kennel_profile_picture FROM tbl_userkennel WHERE tbl_userkennel.id=tbl_timeline.profile_id))) as timeline_profile_image, (IF(tbl_timeline.profile_id>=300000000,(SELECT concat(tbl_user.name,' ',tbl_user.surname) as timeline_name FROM tbl_user WHERE tbl_user.id=(SELECT user_id FROM tbl_userowner WHERE id=tbl_timeline.profile_id)), (SELECT kennel_name FROM tbl_userkennel WHERE tbl_userkennel.id=tbl_timeline.profile_id))) as timeline_name FROM tbl_timeline where profile_id = ? order by `date` DESC LIMIT 5", $id);
//        $this->database->query("ALTER TABLE `$table` ADD PRIMARY KEY (`id`)");
//        $this->database->query("ALTER TABLE `$table` CHANGE `id` `id` BIGINT( 20 ) NOT NULL AUTO_INCREMENT");

        if ($id == 0)
            $rows = $this->database->table("tbl_timeline")->order("date DESC")->limit($limit1, $limit2)->fetchAll();
        else
            $rows = $this->database->table("tbl_timeline")->where("profile_id=?", $id)->order("date DESC")->limit($limit1, $limit2)->fetchAll();

        return $rows;
    }

    function getTimelineCount($id = 0) {
        $count = 0;

//        $table = "tmp_" . rand(0, 10);
//        $this->database->query("DROP TABLE IF EXISTS $table");

        if ($id == 0)
            $count = $this->database->table("tbl_timeline")->count();
        else
            $count = $this->database->table("tbl_timeline")->where("profile_id=?", $id)->count();

        return $count;
    }

    function getTimelineComments($id = 0) {
        $rows = NULL;

        $rows = $this->database->table("tbl_comments")->where("timeline_id = ?", $id)->fetchAll();

        return $rows;
    }

    public function setParents($dogName, $fatherName, $motherName) {
        $rows = $this->database->table("tbl_pedigree")->where("dog_name=?", $dogName)->count();

        $data = array();

        $data['dog_name'] = $dogName;
        $data['father_name'] = $fatherName;
        $data['mother_name'] = $motherName;

        if ($rows > 0)
            $this->database->table("tbl_pedigree")->where("dog_name=?", $dogName)->update($data);
        else
            $this->database->table("tbl_pedigree")->insert($data);
    }

    static function haveDogProfile($dog_name) {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];

        $rows = $database->table("tbl_dogs")->where("dog_name=?", $dog_name)->count();

        if ($rows > 0)
            return TRUE;
        else
            return FALSE;
    }

    static function getDogProfileByName($dog_name) {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];

        $row = $database->table("tbl_dogs")->where("dog_name=?", $dog_name)->fetch();

        return $row;
    }

    static function haveHandlerProfile($handler_name) {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];

        $full_name = explode(" ", $handler_name);

        if ($full_name[0] == NULL)
            $full_name[0] = "";

        if ($full_name[1] == NULL)
            $full_name[1] = "";

        $id = "0";

        $rows = $database->table("tbl_user")->where("name=?", $full_name[0])->where("surname=?", $full_name[1])->fetchAll();

        foreach ($rows as $row) {
            $count = $database->table("tbl_userhandler")->where("user_id=?", $row->id)->count();

            if ($count > 0)
                $id .= "," . $row->id;
        }

        if ($id != "0")
            return TRUE;
        else
            return FALSE;
    }

    static function getHandlerProfileByName($handler_name) {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];

        $full_name = explode(" ", $handler_name);

        if ($full_name[0] == NULL)
            $full_name[0] = "";

        if ($full_name[1] == NULL)
            $full_name[1] = "";

        $id = 0;

        $rows = $database->table("tbl_user")->where("name=?", $full_name[0])->where("surname=?", $full_name[1])->fetchAll();

        foreach ($rows as $row) {
            $count = $database->table("tbl_userhandler")->where("user_id=?", $row->id)->count();

            if ($count > 0)
                $id = $row->id;
        }

        $row = $database->table("tbl_userhandler")->where("user_id=?", $id)->fetch();

        return $row;
    }

    static function getMotherName($dogName) {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];
        $return = "";

        if ($dogName == NULL)
            $dogName = "";

        $row = $database->table("tbl_pedigree")->where("dog_name=?", $dogName)->fetch();

        if ($row->id > 0) {
            $return = $row->mother_name;
        }

        return $return;
    }

    static function hasProfile($user_id) {
        $database = $GLOBALS['database'];

        $cnt1 = $database->table("tbl_userkennel")->where("user_id=?", $user_id)->count();
        $cnt2 = $database->table("tbl_userowner")->where("user_id=?", $user_id)->count();
        $cnt3 = $database->table("tbl_userhandler")->where("user_id=?", $user_id)->count();

        $cnt = $cnt1 + $cnt2 + $cnt3;

        if ($cnt > 0)
            return TRUE;
        else
            return FALSE;
    }

    static function getFatherName($dogName) {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];
        $return = "";

        if ($dogName == NULL)
            $dogName = "";

        $row = $database->table("tbl_pedigree")->where("dog_name=?", $dogName)->fetch();

        if ($row->id > 0) {
            $return = $row->father_name;
        }

        return $return;
    }

    static function getProfileImage($id = 0) {
        //require_once 'www/inc/config_ajax.php';

        try {
            $image = "";

            $database = $GLOBALS['database'];
            //$database = getContext();

            if ($id >= 100000000 && $id < 200000000) {
                $image = "www/img/avatar.jpg";
            } elseif ($id >= 200000000 && $id < 300000000) {
// kennel 200000000
// kennel_profile_picture
                $row = $database->table("tbl_userkennel")->where("id=?", $id)->fetch();
                $image = $row->kennel_profile_picture;
            } elseif ($id >= 300000000 && $id < 400000000) {
// owner 300000000
// owner_profile_picture
                $row = $database->table("tbl_userowner")->where("id=?", $id)->fetch();
                $image = $row->owner_profile_picture;
            } elseif ($id >= 400000000 && $id < 500000000) {
// handler 400000000
// handler_profile_picture
                $row = $database->table("tbl_userhandler")->where("id=?", $id)->fetch();
                $image = $row->handler_profile_picture;
            } elseif ($id >= 500000000 && $id < 600000000) {
// dog 500000000
// handler_profile_picture
                $row = $database->table("tbl_dogs")->where("id=?", $id)->fetch();
                $image = DataModel::getProfileImage($row->profile_id);
            } elseif ($id >= 600000000 && $id < 700000000) {
// puppy 600000000
// handler_profile_picture
                $row = $database->table("tbl_puppies")->where("id=?", $id)->fetch();
                $image = DataModel::getProfileImage($row->profile_id);
            } else {
                $image = "www/img/avatar.jpg";
            }
        } catch (\Exception $ex) {
            $image = "www/img/avatar.jpg";
        }
        return $image;
    }

    static function getProfileName($id = 0) {
//        require_once 'www/inc/config_ajax.php';

        try {
            $name = "";

//            $database = getContext();
            $database = $GLOBALS['database'];

            if ($id >= 100000000 && $id < 200000000) {
                $row = $database->table("tbl_user")->where("id=?", $id)->fetch();
                $name = $row->name . " " . $row->surname;
            } elseif ($id >= 200000000 && $id < 300000000) {
// kennel 200000000
// kennel_profile_picture
                $row = $database->table("tbl_userkennel")->where("id=?", $id)->fetch();
                $name = $row->kennel_name;
            } elseif ($id >= 300000000 && $id < 400000000) {
// owner 300000000
// owner_profile_picture
                $row = $database->table("tbl_userowner")->where("id=?", $id)->fetch();
                $user_id = $row->user_id;
                $row = $database->table("tbl_user")->where("id=?", $user_id)->fetch();
                $name = $row->name . " " . $row->surname;
            } elseif ($id >= 400000000 && $id < 500000000) {
// handler 400000000
// handler_profile_picture
                $row = $database->table("tbl_userhandler")->where("id=?", $id)->fetch();
                $user_id = $row->user_id;
                $row = $database->table("tbl_user")->where("id=?", $user_id)->fetch();
                $name = $row->name . " " . $row->surname;
            } elseif ($id >= 500000000 && $id < 600000000) {
// dog 500000000
// handler_profile_picture
                $row = $database->table("tbl_dogs")->where("id=?", $id)->fetch();
                $name = DataModel::getProfileName($row->profile_id);
            } elseif ($id >= 600000000 && $id < 700000000) {
// puppy 600000000
// handler_profile_picture
                $row = $database->table("tbl_puppies")->where("id=?", $id)->fetch();
                $name = DataModel::getProfileName($row->profile_id);
            } elseif ($id >= 9000000001 && $id < 10000000000) {
                $row = $database->table("tbl_emails")->where("id=?", $id)->fetch();
                $name = $row->email;
            } else {
                $row = $database->table("tbl_user")->where("id=?", $id)->fetch();
                $name = $row->name . " " . $row->surname;
            }
        } catch (\Exception $ex) {
            $name = "DFS user";
        }
        return $name;
    }

    static function havePuppies($profile_id) {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        if ($profile_id == NULL)
            return FALSE;
        $database = $GLOBALS['database'];

        $cnt = $database->table("tbl_puppies")->where("profile_id=?", $profile_id)->where("puppy_state=?", "ForSale")->count();

        if ($cnt > 0)
            return TRUE;
        else
            return FALSE;
    }

    static function getUserIdByProfileId($id = 0) {
//        require_once 'www/inc/config_ajax.php';

        $ret_id = 0;

//        $database = getContext();
        $database = $GLOBALS['database'];

        if ($id >= 100000000 && $id < 200000000) {
            $ret_id = $id;
        } elseif ($id >= 200000000 && $id < 300000000) {
// kennel 200000000
// kennel_profile_picture
            $row = $database->table("tbl_userkennel")->where("id=?", $id)->fetch();
            $ret_id = $row->user_id;
        } elseif ($id >= 300000000 && $id < 400000000) {
// owner 300000000
// owner_profile_picture
            $row = $database->table("tbl_userowner")->where("id=?", $id)->fetch();
            $ret_id = $row->user_id;
        } elseif ($id >= 400000000 && $id < 500000000) {
// handler 400000000
// handler_profile_picture
            $row = $database->table("tbl_userhandler")->where("id=?", $id)->fetch();
            $ret_id = $row->user_id;
        } elseif ($id >= 500000000 && $id < 600000000) {
// dog
            $row = $database->table("tbl_dogs")->where("id=?", $id)->fetch();
            $ret_id = $row->user_id;
        } elseif ($id >= 600000000 && $id < 700000000) {
// puppy
            $row = $database->table("tbl_puppies")->where("id=?", $id)->fetch();
            $ret_id = $row->user_id;
        } else {
            $ret_id = 0;
        }

        return $ret_id;
    }

    static function getProfileType($id = 0) {
        $ret_id = 0;
        if ($id >= 100000000 && $id < 200000000) {
            $ret_id = 0;
        } elseif ($id >= 200000000 && $id < 300000000) {
// kennel 200000000
// kennel_profile_picture
            $ret_id = 1;
        } elseif ($id >= 300000000 && $id < 400000000) {
// owner 300000000
// owner_profile_picture
            $ret_id = 2;
        } else {
// handler 400000000
// handler_profile_picture
            $ret_id = 3;
        }

        return $ret_id;
    }

    static function getProfileState($id = 0) {
//        require_once 'www/inc/config_ajax.php';

        try {
            $state = "";

//            $database = getContext();
            $database = $GLOBALS['database'];

            if ($id >= 100000000 && $id < 200000000) {
                $row = $database->table("tbl_user")->where("id=?", $id)->fetch();
                $state = $row->state;
            } elseif ($id >= 200000000 && $id < 300000000) {
// kennel 200000000
// kennel_profile_picture
                $row = $database->table("tbl_userkennel")->where("id=?", $id)->fetch();
                $user_id = $row->user_id;
                $row = $database->table("tbl_user")->where("id=?", $user_id)->fetch();
                $state = $row->state;
            } elseif ($id >= 300000000 && $id < 400000000) {
// owner 300000000
// owner_profile_picture
                $row = $database->table("tbl_userowner")->where("id=?", $id)->fetch();
                $user_id = $row->user_id;
                $row = $database->table("tbl_user")->where("id=?", $user_id)->fetch();
                $state = $row->state;
            } else {
// handler 400000000
// handler_profile_picture
                $row = $database->table("tbl_userhandler")->where("id=?", $id)->fetch();
                $user_id = $row->user_id;
                $row = $database->table("tbl_user")->where("id=?", $user_id)->fetch();
                $state = $row->state;
            }
        } catch (\Exception $ex) {
            $state = "N/A";
        }
        return $state;
    }

    static function getPlannedLitterById($id = 0) {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];

        $row = $database->table("tbl_planned_litters")->where("id=?", $id)->fetch();

        return $row;
    }

    /*
     * get breed by mother in planned litter
     * 
     * id of planned litter
     * 
     * returns dog object
     * 
     */

    static function getPlannedLitterMother($id = 0) {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];

        $row = $database->table("tbl_planned_litters")->where("id=?", $id)->fetch();
        $row = $database->table("tbl_dogs")->where("dog_name=?", $row->bitch_name)->fetch();

        return $row;
    }

//counter functions

    static function getRegistrationsCount() {
        $database = $GLOBALS['database'];

        return $database->table("tbl_user")->where("active=?", 1)->count();
    }

    static function getKennelsCount() {
        $database = $GLOBALS['database'];

        return $database->table("tbl_userkennel")->count();
    }

    static function getOwnersCount() {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];

        return $database->table("tbl_userowner")->count();
    }

    static function getHandlersCount() {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];

        return $database->table("tbl_userhandler")->count();
    }

    static function getDogsCount() {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];

        return $database->table("tbl_dogs")->count();
    }

    static function getMattingDogsCount() {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];

        return $database->table("tbl_dogs")->where("offer_for_mating=1")->count();
    }

    static function getPlannedLittersCount() {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];

        return $database->table("tbl_planned_litters")->count();
    }

//counter functions
//dog counters functions

    static function getChampionshipsCount($dog_id) {
        $database = $GLOBALS['database'];

        return $database->table("tbl_dogs_championship")->where("dog_id=?", $dog_id)->count();
    }

    static function getShowsCount($dog_id) {
        $database = $GLOBALS['database'];

        return $database->table("tbl_dogs_shows")->where("dog_id=?", $dog_id)->count();
    }

    static function getWorkexamsCount($dog_id) {
        $database = $GLOBALS['database'];

        return $database->table("tbl_dogs_workexams")->where("dog_id=?", $dog_id)->count();
    }

    static function getHealthCount($dog_id) {
        $database = $GLOBALS['database'];

        return $database->table("tbl_dogs_health")->where("dog_id=?", $dog_id)->count();
    }

    static function getMatingsCount($dog_id) {
        $database = $GLOBALS['database'];

        return $database->table("tbl_dogs_matings")->where("dog_id=?", $dog_id)->count();
    }

    static function getDogsForSaleCount() {
        $database = $GLOBALS['database'];

        return $database->table("tbl_dogs")->where("offer_for_sell=1")->count();
    }

    static function getCoownersCount($dog_id) {
        $database = $GLOBALS['database'];

        return $database->table("tbl_dogs_coowners")->where("dog_id=?", $dog_id)->count();
    }

    static function getPhotosCount($profile_id = 0) {
        $database = $GLOBALS['database'];

        if ($profile_id > 0)
            return $database->table("tbl_photos")->where("profile_id=?", $profile_id)->count();
        else {
            $filter_ids = array();
            $ids = $database->table("tbl_user")->select("id")->where("premium_expiry_date >= DATE(now())")->fetchAll();
            foreach ($ids as $id) {
                $filter_ids[] = $id->id;
            }

            $count = $database->table("tbl_photos")->where("user_id IN ?", $filter_ids)->count();

            return $count;
        }
    }

    static function getVideosCount($profile_id = 0) {
        $database = $GLOBALS['database'];

        if ($profile_id > 0)
            return $database->table("tbl_videos")->where("profile_id=?", $profile_id)->count();
        else {
            $filter_ids = array();
            $ids = $database->table("tbl_user")->select("id")->where("premium_expiry_date >= DATE(now())")->fetchAll();
            foreach ($ids as $id) {
                $filter_ids[] = $id->id;
            }

            $count = $database->table("tbl_videos")->where("user_id IN ?", $filter_ids)->count();

            return $count;
        }
    }

//dog counters functions


    function addTimelineComment($user_id, $profile_id, $timeline_id, $comment) {
        $data['user_id'] = $user_id;
        $data['profile_id'] = $profile_id;
        $data['timeline_id'] = $timeline_id;
        $data['comment'] = $comment;

        $row = $this->database->table("tbl_timeline")->where("id=?", $timeline_id)->fetch();
        $data['event_id'] = $row->event_id;

        $notify_profile_id = $row->profile_id;

        if ($notify_profile_id >= 200000000 && $notify_profile_id < 300000000) {
            $row = $this->database->table("tbl_userkennel")->where("id=?", $notify_profile_id)->fetch();
            $notify_user_id = $row->user_id;
        } elseif ($notify_profile_id >= 300000000 && $notify_profile_id < 400000000) {
            $row = $this->database->table("tbl_userowner")->where("id=?", $notify_profile_id)->fetch();
            $notify_user_id = $row->user_id;
        } else {
            $row = $this->database->table("tbl_userhandler")->where("id=?", $notify_profile_id)->fetch();
            $notify_user_id = $row->user_id;
        }

        if ($notify_user_id > 0)
            $notify_rows = $this->database->query("SELECT DISTINCT user_id, profile_id FROM tbl_comments WHERE timeline_id = $timeline_id AND user_id != $notify_user_id")->fetchAll();
        else
            $notify_rows = $this->database->query("SELECT DISTINCT user_id, profile_id FROM tbl_comments WHERE timeline_id = $timeline_id")->fetchAll();

        if ($user_id != $notify_user_id) {
            $notify = array();
            $notify['notify_user_id'] = $notify_user_id;
            $notify['notify_profile_id'] = $notify_profile_id;
            $notify['user_id'] = $user_id;
            $notify['profile_id'] = $profile_id;
            $notify['timeline_id'] = $timeline_id;
            $notify['comment'] = $comment;
            $notify['type'] = "comment";
            $this->database->table("tbl_notify")->insert($notify);
        }

        foreach ($notify_rows as $row) {
            $notify = array();
            $notify['notify_user_id'] = $row->user_id;
            $notify['notify_profile_id'] = $row->profile_id;
            $notify['user_id'] = $user_id;
            $notify['profile_id'] = $profile_id;
            $notify['timeline_id'] = $timeline_id;
            $notify['comment'] = $comment;
            $notify['type'] = "comment";
            $this->database->table("tbl_notify")->insert($notify);
        }

        $this->database->table("tbl_comments")->insert($data);
    }

    function addEventComment($user_id, $profile_id, $event_id, $comment) {
        $data['user_id'] = $user_id;
        $data['profile_id'] = $profile_id;
        $data['event_id'] = $event_id;
        $data['comment'] = $comment;

        $count = $this->database->table("tbl_timeline")->where("event_id=?", $event_id)->count();

        if ($count > 0) {
            $row = $this->database->table("tbl_timeline")->where("event_id=?", $event_id)->fetch();
            $data['timeline_id'] = $row->id;

            $notify_profile_id = $row->profile_id;

            if ($notify_profile_id >= 200000000 && $notify_profile_id < 300000000) {
                $row = $this->database->table("tbl_userkennel")->where("id=?", $notify_profile_id)->fetch();
                $notify_user_id = $row->user_id;
            } elseif ($notify_profile_id >= 300000000 && $notify_profile_id < 400000000) {
                $row = $this->database->table("tbl_userowner")->where("id=?", $notify_profile_id)->fetch();
                $notify_user_id = $row->user_id;
            } else {
                $row = $this->database->table("tbl_userhandler")->where("id=?", $notify_profile_id)->fetch();
                $notify_user_id = $row->user_id;
            }
        } else {
            $data['timeline_id'] = 0;
        }

        $timeline_id = $data['timeline_id'];

        if ($timeline_id > 0) {
            $notify_rows = $this->database->query("SELECT DISTINCT user_id, profile_id FROM tbl_comments WHERE timeline_id = $timeline_id AND user_id != $notify_user_id AND type='comment'")->fetchAll();

            $notify = array();
            $notify['notify_user_id'] = $notify_user_id;
            $notify['notify_profile_id'] = $notify_profile_id;
            $notify['user_id'] = $user_id;
            $notify['profile_id'] = $profile_id;
            $notify['timeline_id'] = $timeline_id;
            $notify['comment'] = $comment;
            $notify['type'] = "comment";

            $this->database->table("tbl_notify")->insert($notify);

            foreach ($notify_rows as $row) {
                $notify = array();
                $notify['notify_user_id'] = $row->user_id;
                $notify['notify_profile_id'] = $row->profile_id;
                $notify['user_id'] = $user_id;
                $notify['profile_id'] = $profile_id;
                $notify['timeline_id'] = $timeline_id;
                $notify['comment'] = $comment;
                $notify['type'] = "comment";
                $this->database->table("tbl_notify")->insert($notify);
            }
        }

        $this->database->table("tbl_comments")->insert($data);
    }

    /**
     * 
     * @param type $profile_id
     * @param type $event_id
     * @param type $event_type
     * @param type $description
     * @param type $event_image
     * @return bigint id of inserted timeline item
     */
    function addToTimeline($profile_id, $event_id, $event_type, $description = NULL, $event_image = NULL, $event_video = NULL) {
        /**
         * event_types :
         * 
         * 1 - create profile
         * 2 - update profile
         * 3 - change profile image
         * 4 - change cover image
         * 5 - add award
         * 6 - update award
         * 7 - planned litter
         * 8 - add certificate
         * 9 - update certificate
         * 10 - add photo
         * 11 - add show
         * 12 - add dog
         * 13 - add puppy
         * 14 - championship
         * 15 - video
         */
        $data = array();

        $data['profile_id'] = $profile_id;
        $data['event_id'] = $event_id;
        $data['event_type'] = $event_type;
        $data['event_description'] = $description;
        $data['event_image'] = $event_image;
        $data['event_video'] = $event_video;

        $this->database->table("tbl_timeline")->insert($data);

        $id = $this->database->getInsertId();

        return $id;
    }

    /**
     * Function delete all timeline items assigned to the event (add and update records)
     * 
     * @param type $event_id - id of event
     */
    function deleteFromTimelineByEvent($event_id) {
        $this->database->table("tbl_timeline")->where("event_id=?", $event_id)->delete();
    }

    /**
     * Function delete single item from timeline based on timeline item ID
     * 
     * 
     * @param type $id - id of timeline item
     */
    static function deleteFromTimelineByItem($id) {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];

        $database->table("tbl_timeline")->where("id=?", $id)->delete();
    }

    static function getTimelineLikesCount($timeline_id = 0, $event_id = 0) {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];

        if ($timeline_id != 0)
            $count = $database->table("tbl_likes")->where("timeline_id=?", $timeline_id)->count();
        elseif ($event_id != 0)
            $count = $database->table("tbl_likes")->where("event_id=?", $event_id)->count();
        else
            $count = 0;

        return $count;
    }

    static function getTimelineCommentsCount($timeline_id = 0, $event_id = 0) {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];

        if ($timeline_id != 0)
            $count = $database->table("tbl_comments")->where("timeline_id=?", $timeline_id)->count();
        elseif ($event_id != 0)
            $count = $database->table("tbl_comments")->where("event_id=?", $event_id)->count();
        else
            $count = 0;

        return $count;
    }

//    	$this->template->cajc = 0;
//	$this->template->jbob = 0;
//	$this->template->jbog = 0;
//	$this->template->jbis = 0;
//	$this->template->cac = 0;
//	$this->template->cacib = 0;
//	$this->template->bos = 0;
//	$this->template->bob = 0;
//	$this->template->bog = 0;
//	$this->template->bis = 0;


    static function getDogTitles($dog_id) {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];

        $cnt_array = array();
        try {
            $cnt_array['CAJC'] = $database->table("tbl_dogs_shows")->where("dog_id=?", $dog_id)->where("CAJC=1")->count();
            $cnt_array['JBOB'] = $database->table("tbl_dogs_shows")->where("dog_id=?", $dog_id)->where("JBOB=1")->count();
            $cnt_array['JBOG'] = $database->table("tbl_dogs_shows")->where("dog_id=?", $dog_id)->where("JBOG1=1")->count();
            $cnt_array['JBIS'] = $database->table("tbl_dogs_shows")->where("dog_id=?", $dog_id)->where("JBIS1=1")->count();
            $cnt_array['CAC'] = $database->table("tbl_dogs_shows")->where("dog_id=?", $dog_id)->where("CAC=1")->count();
            $cnt_array['CACIB'] = $database->table("tbl_dogs_shows")->where("dog_id=?", $dog_id)->where("CACIB=1")->count();
            $cnt_array['BOS'] = $database->table("tbl_dogs_shows")->where("dog_id=?", $dog_id)->where("BOS=1")->count();
            $cnt_array['BOB'] = $database->table("tbl_dogs_shows")->where("dog_id=?", $dog_id)->where("BOB=1")->count();
            $cnt_array['BOG'] = $database->table("tbl_dogs_shows")->where("dog_id=?", $dog_id)->where("BOG1=1")->count();
            $cnt_array['BIS'] = $database->table("tbl_dogs_shows")->where("dog_id=?", $dog_id)->where("BIS1=1")->count();
        } catch (\Exception $ex) {
            $cnt_array['CAJC'] = 0;
            $cnt_array['JBOB'] = 0;
            $cnt_array['JBOG'] = 0;
            $cnt_array['JBIS'] = 0;
            $cnt_array['CAC'] = 0;
            $cnt_array['CACIB'] = 0;
            $cnt_array['BOS'] = 0;
            $cnt_array['BOB'] = 0;
            $cnt_array['BOG'] = 0;
            $cnt_array['BIS'] = 0;
        }
        return $cnt_array;
    }

    static function getHandlerTitles($handler_id) {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];

        $cnt_array = array();
        try {
            $cnt_array['CAJC'] = $database->table("tbl_handler_shows")->where("handler_id=?", $handler_id)->where("CAJC=1")->count();
            $cnt_array['JBOB'] = $database->table("tbl_handler_shows")->where("handler_id=?", $handler_id)->where("JBOB=1")->count();
            $cnt_array['JBOG'] = $database->table("tbl_handler_shows")->where("handler_id=?", $handler_id)->where("JBOG1=1")->count();
            $cnt_array['JBIS'] = $database->table("tbl_handler_shows")->where("handler_id=?", $handler_id)->where("JBIS1=1")->count();
            $cnt_array['CAC'] = $database->table("tbl_handler_shows")->where("handler_id=?", $handler_id)->where("CAC=1")->count();
            $cnt_array['CACIB'] = $database->table("tbl_handler_shows")->where("handler_id=?", $handler_id)->where("CACIB=1")->count();
            $cnt_array['BOS'] = $database->table("tbl_handler_shows")->where("handler_id=?", $handler_id)->where("BOS=1")->count();
            $cnt_array['BOB'] = $database->table("tbl_handler_shows")->where("handler_id=?", $handler_id)->where("BOB=1")->count();
            $cnt_array['BOG'] = $database->table("tbl_handler_shows")->where("handler_id=?", $handler_id)->where("BOG1=1")->count();
            $cnt_array['BIS'] = $database->table("tbl_handler_shows")->where("handler_id=?", $handler_id)->where("BIS1=1")->count();
        } catch (\Exception $ex) {
            $cnt_array['CAJC'] = 0;
            $cnt_array['JBOB'] = 0;
            $cnt_array['JBOG'] = 0;
            $cnt_array['JBIS'] = 0;
            $cnt_array['CAC'] = 0;
            $cnt_array['CACIB'] = 0;
            $cnt_array['BOS'] = 0;
            $cnt_array['BOB'] = 0;
            $cnt_array['BOG'] = 0;
            $cnt_array['BIS'] = 0;
        }
        return $cnt_array;
    }

    static function getPhotoDescription($id) {
        try {
//            require_once 'www/inc/config_ajax.php';
//            $database = getContext();
            $database = $GLOBALS['database'];

            $row = $database->table("tbl_photos")->where("id=?", $id)->fetch();

            return $row->description;
        } catch (\Exception $ex) {
            return '';
        }
    }

    static function getVideoRow($id) {
        try {
            $database = $GLOBALS['database'];
            $row = $database->table("tbl_videos")->where("id=?", $id)->fetch();
            return $row;
        } catch (\Exception $ex) {
            return array();
        }
    }

    static function getVideoDescription($id) {
        try {
//            require_once 'www/inc/config_ajax.php';
//            $database = getContext();
            $database = $GLOBALS['database'];

            $row = $database->table("tbl_videos")->where("id=?", $id)->fetch();

            return $row->description;
        } catch (\Exception $ex) {
            return '';
        }
    }

    static function getPhotoImage($id) {
        try {
//            require_once 'www/inc/config_ajax.php';
//            $database = getContext();
            $database = $GLOBALS['database'];

            $row = $database->table("tbl_photos")->where("id=?", $id)->fetch();

            return $row->image;
        } catch (\Exception $ex) {
            return '';
        }
    }

    static function getProfileLinkUrl($profile_id, $generated = FALSE, $with_id = FALSE) {
        if ($generated) {
            switch ($profile_id) {
                case ($profile_id >= 200000000 && $profile_id < 300000000):
                    return "kennel-profile" . ($with_id ? "?id=$profile_id" : "");
                    break;
                case ($profile_id >= 300000000 && $profile_id < 400000000):
                    return "owner-profile" . ($with_id ? "?id=$profile_id" : "");
                    break;
                case ($profile_id >= 400000000 && $profile_id < 500000000):
                    return "handler-profile" . ($with_id ? "?id=$profile_id" : "");
                    break;
                case ($profile_id >= 500000000 && $profile_id < 600000000):
                    return "dog?id=$profile_id";
                    break;
                case ($profile_id >= 600000000 && $profile_id < 700000000):
                    return "puppy-profile?id=$profile_id";
                    break;
                default :
                    return "";
                    break;
            }
        } else {
            switch ($profile_id) {
                case ($profile_id >= 200000000 && $profile_id < 300000000):
                    return "kennel:kennel_profile_home";
                    break;
                case ($profile_id >= 300000000 && $profile_id < 400000000):
                    return "owner:owner_profile_home";
                    break;
                case ($profile_id >= 400000000 && $profile_id < 500000000):
                    return "handler:handler_profile_home";
                    break;
                case ($profile_id >= 500000000 && $profile_id < 600000000):
                    return "dog:dog_profile_home";
                    break;
                case ($profile_id >= 600000000 && $profile_id < 700000000):
                    return "puppy:puppy_description";
                    break;
                default :
                    return "";
                    break;
            }
        }
    }

    static function getProfileLinkUrlPhotoGallery($profile_id) {
        switch ($profile_id) {
            case ($profile_id >= 200000000 && $profile_id < 300000000):
                return "kennel:kennel_photogallery";
                break;
            case ($profile_id >= 300000000 && $profile_id < 400000000):
                return "owner:owner_photogallery";
                break;
            case ($profile_id >= 400000000 && $profile_id < 500000000):
                return "handler:handler_photogallery";
                break;
            case ($profile_id >= 500000000 && $profile_id < 600000000):
                return "dog:dog_photogallery";
                break;
            case ($profile_id >= 600000000 && $profile_id < 700000000):
                return "puppy:puppy_photogallery";
                break;
            default :
                return "";
                break;
        }
    }

    static function getProfileLinkUrlVideoGallery($profile_id) {
        switch ($profile_id) {
            case ($profile_id >= 200000000 && $profile_id < 300000000):
                return "kennel:kennel_videogallery";
                break;
            case ($profile_id >= 300000000 && $profile_id < 400000000):
                return "owner:owner_videogallery";
                break;
            case ($profile_id >= 400000000 && $profile_id < 500000000):
                return "handler:handler_videogallery";
                break;
            case ($profile_id >= 500000000 && $profile_id < 600000000):
                return "dog:dog_videogallery";
                break;
            case ($profile_id >= 600000000 && $profile_id < 700000000):
                return "puppy:puppy_videogallery";
                break;
            default :
                return "";
                break;
        }
    }

    static function getGalleryProfileLinkUrl($profile_id, $generated = FALSE) {
        if ($generated) {
            
        } else {
            switch ($profile_id) {
                case ($profile_id >= 200000000 && $profile_id < 300000000):
                    return "kennel:kennel_photogallery";
                    break;
                case ($profile_id >= 300000000 && $profile_id < 400000000):
                    return "owner:owner_photogallery";
                    break;
                case ($profile_id >= 400000000 && $profile_id < 500000000):
                    return "handler:handler_photogallery";
                    break;
                case ($profile_id >= 500000000 && $profile_id < 600000000):
                    return "dog:dog_photogallery";
                    break;
                case ($profile_id >= 600000000 && $profile_id < 700000000):
                    return "puppy:puppy_photogallery";
                    break;
                default :
                    return "";
                    break;
            }
        }
    }

    static function getVideoGalleryProfileLinkUrl($profile_id, $generated = FALSE) {
        if ($generated) {
            
        } else {
            switch ($profile_id) {
                case ($profile_id >= 200000000 && $profile_id < 300000000):
                    return "kennel:kennel_videogallery";
                    break;
                case ($profile_id >= 300000000 && $profile_id < 400000000):
                    return "owner:owner_videogallery";
                    break;
                case ($profile_id >= 400000000 && $profile_id < 500000000):
                    return "handler:handler_videogallery";
                    break;
                case ($profile_id >= 500000000 && $profile_id < 600000000):
                    return "dog:dog_videogallery";
                    break;
                case ($profile_id >= 600000000 && $profile_id < 700000000):
                    return "puppy:puppy_videogallery";
                    break;
                default :
                    return "";
                    break;
            }
        }
    }

    static function getDogsProfileLinkUrl($profile_id, $generated = FALSE) {
        if ($generated) {
            
        } else {
            switch ($profile_id) {
                case ($profile_id >= 200000000 && $profile_id < 300000000):
                    return "kennel:kennel_dog_list";
                    break;
                case ($profile_id >= 300000000 && $profile_id < 400000000):
                    return "owner:owner_dog_list";
                    break;
                default :
                    return "";
                    break;
            }
        }
    }

    static function getUserProfilesCount($user_id) {
        try {
//            require_once 'www/inc/config_ajax.php';

            $profiles = 0;

//            $database = getContext();
            $database = $GLOBALS['database'];

            $profiles = $profiles + $database->table("tbl_userkennel")->where("user_id=?", $user_id)->count();
            $profiles = $profiles + $database->table("tbl_userhandler")->where("user_id=?", $user_id)->count();
            $profiles = $profiles + $database->table("tbl_userowner")->where("user_id=?", $user_id)->count();

            return $profiles;
        } catch (\Exception $ex) {
            return 0;
        }
    }

    static function isBIS($dog_id) {
        try {
//            require_once 'www/inc/config_ajax.php';

            $titles = \DataModel::getDogTitles($dog_id);
            if ($titles['JBIS'] || $titles['BIS'])
                return TRUE;
            else
                return FALSE;
        } catch (\Exception $ex) {
            return FALSE;
        }
    }

    static function getBISCount() {
        try {
//            require_once 'www/inc/config_ajax.php';
//            $database = getContext();
            $database = $GLOBALS['database'];

            $count = $database->table("tbl_dogs_shows")->where("BIS1=? OR JBIS1=?", 1, 1)->group("dog_id")->count();

            return $count;
        } catch (\Exception $ex) {
            return 0;
        }
    }

    static function getPuppiesForSaleCount() {
        try {
//            require_once 'www/inc/config_ajax.php';
//            $database = getContext();
            $database = $GLOBALS['database'];

            $count = $database->table("tbl_puppies")->where("puppy_state=?", "ForSale")->count();

            return $count;
        } catch (\Exception $ex) {
            return 0;
        }
    }

    static function getPuppiesSoldCount() {
        try {
//            require_once 'www/inc/config_ajax.php';
//            $database = getContext();
            $database = $GLOBALS['database'];

            $count = $database->table("tbl_puppies")->where("puppy_state=?", "Sold")->count();

            return $count;
        } catch (\Exception $ex) {
            return 0;
        }
    }

    public static function getPermission($id, $user_id, $type) {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];

        try {

            $user = $database->table("tbl_user")->where("id=?", $user_id)->fetch();

            $profile_id = $user->active_profile_id;

            switch ($type) {
                case 1: // kennel
                    if ($id == $profile_id)
                        return TRUE;
                    else
                        return FALSE;
                    break;
                case 2: // owner
                    if ($id == $profile_id)
                        return TRUE;
                    else
                        return FALSE;
                    break;
                case 3: // handler
                    if ($id == $profile_id)
                        return TRUE;
                    else
                        return FALSE;
                    break;
                case 4: //dog
                    $row = $database->table("tbl_dogs")->where("id=?", $id)->fetch();
                    if ($row->profile_id == $profile_id)
                        return TRUE;
                    else
                        return FALSE;
                    break;
                case 5: //puppy
                    $row = $database->table("tbl_puppies")->where("id=?", $id)->fetch();
                    if ($row->profile_id == $profile_id)
                        return TRUE;
                    else
                        return FALSE;
                    break;
                case 6: //photo
                    $row = $database->table("tbl_photos")->where("id=?", $id)->fetch();
                    $user = $database->table("tbl_user")->where("id=?", $row->user_id)->fetch();
                    if ($user->active_profile_id == $profile_id)
                        return TRUE;
                    else
                        return FALSE;
                    break;
                case 7: //timeline
                    $row = $database->table("tbl_timeline")->where("id=?", $id)->fetch();
                    if ($row->profile_id == $profile_id)
                        return TRUE;
                    else {
                        $row_dog_count = $database->table("tbl_dogs")->where("id=?", $row->profile_id)->count();
                        if ($row_dog_count > 0) {
                            $row_dog = $database->table("tbl_dogs")->where("id=?", $row->profile_id)->fetch();
                            if ($profile_id == $row_dog->profile_id)
                                return TRUE;
                            else
                                return FALSE;
                        } else
                            return FALSE;
                    }
                    break;
                case 8: //timeline comment
                    $row = $database->table("tbl_comments")->where("id=?", $id)->fetch();
                    if ($row->profile_id == $profile_id)
                        return TRUE;
                    else {
                        $comm = $database->table("tbl_timeline")->where("id=?", $row->timeline_id)->fetch();
                        if ($comm->profile_id == $profile_id)
                            return TRUE;
                        else
                            return FALSE;
                    }
                    break;
                case 9: //video
                    $row = $database->table("tbl_videos")->where("id=?", $id)->fetch();
                    $user = $database->table("tbl_user")->where("id=?", $row->user_id)->fetch();
                    if ($user->active_profile_id == $profile_id)
                        return TRUE;
                    else
                        return FALSE;
                    break;
            }
        } catch (\Exception $ex) {
            
        }
    }

    public static function getPremium($user_id) {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();

        if ($user_id == NULL)
            return FALSE;

        $database = $GLOBALS['database'];

        $cnt = $database->table("tbl_user")->where("id=? AND premium_expiry_date >= now()", $user_id)->count();

        if ($cnt > 0)
            return TRUE;
        else
            return FALSE;
    }

    public static function getPremiumExpiryDate($user_id) {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
        $database = $GLOBALS['database'];

        $row = $database->table("tbl_user")->where("id=?", $user_id)->fetch();

        $date = date("d.m.Y", strtotime($row->premium_expiry_date));

        return $date;
    }

    public static function premiumNotified($user_id) {
        // no action
        return false;
        // for notifications please remove commented commands bellow
        $database = $GLOBALS['database'];


        try {
            $userdata = $database->table("tbl_user")->where("id=?", $user_id)->fetch();
            $ped = date("Ymd", strtotime($userdata->premium_expiry_date));
            $now = date("Ymd");
            if ($ped > $now)
                return TRUE;
        } catch (\Exception $ex) {
            
        }

        $database->query("CREATE TABLE IF NOT EXISTS tbl_user_promoted(user_id BIGINT NOT NULL)");

        $count = $database->table("tbl_user_promoted")->where("user_id = ?", $user_id)->count();

        if ($count > 0)
            return TRUE;
        else {
            $data = array();
            $data['user_id'] = $user_id;
            $database->table("tbl_user_promoted")->insert($data);
            return FALSE;
        }
    }

    static function getRowForComments($id) {
        $row = array();
        try {
            $database = $GLOBALS['database'];
            switch ($id) {
                case ($id >= 2800000000 && $id < 3000000000):
                    $row = $database->table("tbl_photos")->where("id=?", $id)->fetch();
                    break;
                case ($id >= 3000000000 && $id < 3100000000):
                    $row = $database->table("tbl_videos")->where("id=?", $id)->fetch();
                    break;
            }
        } catch (\Exception $ex) {
            
        }
        return $row;
    }

// share tags

    static function getURL() {
        $url = "https://" . $_SERVER['HTTP_HOST'];
        return $url;
    }

    static function azbuka2latin($s) {
        return strtr($s, array(
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'jo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'jj', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'kh', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'eh', 'ю' => 'ju', 'я' => 'ja',
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'JO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I', 'Й' => 'JJ', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'KH', 'Ц' => 'C', 'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SHH', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'EH', 'Ю' => 'JU', 'Я' => 'JA',
        ));
    }

    static function getShareTags($lang, $id, $alt_id = 0) {
//        $lang = $GLOBALS['lang'];
        $translator = new App\Presenters\DFSTranslator($lang);
        $database = $GLOBALS['database'];

        $title = "DOGFORSHOW";
        $site_title = "DOGFORSHOW";
        $keywords = "DOGFORSHOW";
        $description = "";
        $image = "";
        $url = DataModel::getShareUrl($lang, $id, $alt_id);

        switch ($id) {
            case ($id >= 200000000 && $id < 300000000):
                // kennel 200000000
                $row = $database->table("tbl_userkennel")->where("id=?", $id)->fetch();
                $title = mb_strtoupper($row->kennel_name) . " - " . $translator->translate("Kennel");

                $i = 0;
                $breeds = "";
                $type = array();
                $type['type'] = 'breed';
                $breed_rows = $database->table("link_kennel_breed")->where("kennel_id=?", $row->id)->fetchAll();
                foreach ($breed_rows as $breed_row) {
                    if ($i == 0)
                        $breeds .= DataModel::azbuka2latin($translator->translate($breed_row->breed_name, $type));
                    else
                        $breeds .= "," . DataModel::azbuka2latin($translator->translate($breed_row->breed_name, $type));
                    $i++;
                }

                $site_title = $breeds . " - " . DataModel::azbuka2latin($translator->translate("Kennels")) . " | " . mb_strtoupper(DataModel::azbuka2latin($row->kennel_name));
                $keywords = $breeds . "," . DataModel::azbuka2latin($translator->translate("Kennels")) . "," . DataModel::azbuka2latin($translator->translate("Kennel")) . "," . mb_strtoupper(DataModel::azbuka2latin($row->kennel_name));
                $description = $row->kennel_description;
                $image = DataModel::getURL() . "/" . $row->kennel_profile_picture;
                break;
            case ($id >= 300000000 && $id < 400000000):
                // owner 300000000
                $row = $database->table("tbl_userowner")->where("id=?", $id)->fetch();
                $description = $row->owner_description;
                $image = DataModel::getURL() . "/" . $row->owner_profile_picture;
                $user_id = $row->user_id;
                $row = $database->table("tbl_user")->where("id=?", $user_id)->fetch();
                $title = mb_strtoupper($row->name . " " . $row->surname) . " - " . $translator->translate("Owner of purebred dog");
                $site_title = DataModel::azbuka2latin($translator->translate("Owner of purebred dog")) . " - " . mb_strtoupper(DataModel::azbuka2latin($row->name) . " " . DataModel::azbuka2latin($row->surname));
                $keywords = DataModel::azbuka2latin($translator->translate("Owner of purebred dog")) . "," . mb_strtoupper(DataModel::azbuka2latin($row->name) . " " . DataModel::azbuka2latin($row->surname));
                break;
            case ($id >= 400000000 && $id < 500000000):
                // handler 400000000
                $row_handler = $database->table("tbl_userhandler")->where("id=?", $id)->fetch();
                $description = $row_handler->handler_description;
                $image = DataModel::getURL() . "/" . $row_handler->handler_profile_picture;
                $user_id = $row_handler->user_id;
                $row = $database->table("tbl_user")->where("id=?", $user_id)->fetch();
                $title = mb_strtoupper($row->name . " " . $row->surname) . " - " . $translator->translate("Handler");
                $site_title = DataModel::azbuka2latin($translator->translate("Handler")) . " - " . mb_strtoupper(DataModel::azbuka2latin($row->name) . " " . DataModel::azbuka2latin($row->surname));

                $i = 0;
                $breeds = "";

                $type = array();
                $type['type'] = 'breed';

                $breed_rows = $database->table("tbl_handler_breed")->where("handler_id=?", $row_handler->id)->fetchAll();

                foreach ($breed_rows as $breed_row) {
                    if ($i == 0)
                        $breeds .= DataModel::azbuka2latin($translator->translate($breed_row->breed_name, $type));
                    else
                        $breeds .= "," . DataModel::azbuka2latin($translator->translate($breed_row->breed_name, $type));
                    $i++;
                }

                $keywords = $breeds . "," . DataModel::azbuka2latin($translator->translate("Handler")) . "," . mb_strtoupper(DataModel::azbuka2latin($row->name) . " " . DataModel::azbuka2latin($row->surname));
                break;
            case ($id >= 500000000 && $id < 600000000):
                // dog 500000000
                $row = $database->table("tbl_dogs")->where("id=?", $id)->fetch();
                $title = mb_strtoupper($row->dog_name);
                $type = array();
                $type['type'] = 'breed';
                $site_title = DataModel::azbuka2latin($translator->translate($row->breed_name, $type)) . " - " . mb_strtoupper(DataModel::azbuka2latin($row->dog_name));
                $keywords = DataModel::azbuka2latin($translator->translate($row->breed_name, $type)) . "," . mb_strtoupper(DataModel::azbuka2latin($row->dog_name));
                $description = $translator->translate($row->breed_name, $type) . " | " . mb_strtoupper($translator->translate($row->dog_gender)) . " | " . mb_strtoupper($translator->translate($row->country));
                $image = DataModel::getURL() . "/" . $row->dog_image;
                break;
            case ($id >= 600000000 && $id < 700000000):
                // puppy 600000000
                $row = $database->table("tbl_puppies")->where("id=?", $id)->fetch();
                $title = mb_strtoupper($translator->translate($row->puppy_state)) . " - " . mb_strtoupper($row->puppy_name);
                $type = array();
                $type['type'] = 'breed';

                $site_title = DataModel::azbuka2latin($translator->translate($row->breed_name, $type)) . " - " . DataModel::azbuka2latin($translator->translate("Puppies for sale")) . " | " . mb_strtoupper(DataModel::azbuka2latin($row->puppy_name));
                $keywords = DataModel::azbuka2latin($translator->translate($row->breed_name, $type)) . "," . DataModel::azbuka2latin($translator->translate("Puppies for sale")) . "," . mb_strtoupper(DataModel::azbuka2latin($row->puppy_name));

                $description = $translator->translate($row->breed_name, $type) . " | " . mb_strtoupper($translator->translate($row->puppy_gender)) . " | " . mb_strtoupper($translator->translate($row->country)) . " | " . $row->puppy_description;
                $image = DataModel::getURL() . "/" . $row->puppy_photo;
                break;
            case ($id >= 800000000 && $id < 900000000):
                // dog show 800000000
                $row = $database->table("tbl_dogs_shows")->where("id=?", $id)->fetch();
                $dog = $database->table("tbl_dogs")->where("id=?", $row->dog_id)->fetch();

                $title = mb_strtoupper(date("d.m.Y", strtotime($row->show_date)) . " - " . $row->show_name . " - " . $translator->translate($row->show_country));

                $results = "";

                if ($row->VP1 == 1)
                    $results .= "VP1,";
                if ($row->VP2 == 1)
                    $results .= "VP2,";
                if ($row->VP3 == 1)
                    $results .= "VP3,";
                if ($row->VP == 1)
                    $results .= "VP,";
                if ($row->BestMinorPuppy1 == 1)
                    $results .= "Best minor puppy 1,";
                if ($row->BestMinorPuppy2 == 1)
                    $results .= "Best minor puppy 2,";
                if ($row->BestMinorPuppy3 == 1)
                    $results .= "Best minor puppy 3,";
                if ($row->BestPuppy1 == 1)
                    $results .= "Best puppy male & female 1,";
                if ($row->BestPuppy2 == 1)
                    $results .= "Best puppy male & female 2,";
                if ($row->BestPuppy3 == 1)
                    $results .= "Best puppy male & female 3,";
                if ($row->EXC1 == 1)
                    $results .= "EXC1,";
                if ($row->EXC2 == 1)
                    $results .= "EXC2,";
                if ($row->EXC3 == 1)
                    $results .= "EXC3,";
                if ($row->EXC4 == 1)
                    $results .= "EXC4,";
                if ($row->VG1 == 1)
                    $results .= "VG1,";
                if ($row->VG2 == 1)
                    $results .= "VG2,";
                if ($row->VG3 == 1)
                    $results .= "VG3,";
                if ($row->VG4 == 1)
                    $results .= "VG4,";
                if ($row->CAJC == 1)
                    $results .= "CAJC,";
                if ($row->JBOB == 1)
                    $results .= "JBOB,";
                if ($row->CAC == 1)
                    $results .= "CAC,";
                if ($row->RESCAC == 1)
                    $results .= "RESCAC,";
                if ($row->CACIB == 1)
                    $results .= "CACIB,";
                if ($row->RESCACIB == 1)
                    $results .= "RESCACIB,";
                if ($row->BOB == 1)
                    $results .= "BOB,";
                if ($row->BOS == 1)
                    $results .= "BOS,";
                if ($row->JBOG1 == 1)
                    $results .= "JBOG1,";
                if ($row->JBOG2 == 1)
                    $results .= "JBOG2,";
                if ($row->JBOG3 == 1)
                    $results .= "JBOG3,";
                if ($row->JBIS1 == 1)
                    $results .= "JBIS1,";
                if ($row->JBIS2 == 1)
                    $results .= "JBIS2,";
                if ($row->JBIS3 == 1)
                    $results .= "JBIS3,";
                if ($row->BOG1 == 1)
                    $results .= "BOG1,";
                if ($row->BOG2 == 1)
                    $results .= "BOG2,";
                if ($row->BOG3 == 1)
                    $results .= "BOG3,";
                if ($row->BIS1 == 1)
                    $results .= "BIS1,";
                if ($row->BIS2 == 1)
                    $results .= "BIS2,";
                if ($row->BIS3 == 1)
                    $results .= "BIS3,";

                $results .= $row->other_title;

                $description = mb_strtoupper($dog->dog_name) . " - " . $translator->translate("Class") . ": " . $translator->translate($row->show_class) . " - " . $results . " - " . $translator->translate("Judge") . ": " . $row->judge_name;
                $image = DataModel::getURL() . "/" . $row->show_image;
                break;
            case ($id >= 2600000000 && $id < 2700000000):
                // handler show 2600000000
                $row = $database->table("tbl_handler_shows")->where("id=?", $id)->fetch();
                $row_group = $database->table("tbl_handler_show_groups")->where("id=?", $row->show_id)->fetch();

                $title = mb_strtoupper(date("d.m.Y", strtotime($row_group->show_date)) . " - " . $row_group->show_name . " - " . $translator->translate($row_group->show_country));

                $results = "";

                if ($row->VP1 == 1)
                    $results .= "VP1,";
                if ($row->VP2 == 1)
                    $results .= "VP2,";
                if ($row->VP3 == 1)
                    $results .= "VP3,";
                if ($row->VP == 1)
                    $results .= "VP,";
                if ($row->BestMinorPuppy1 == 1)
                    $results .= "Best minor puppy 1,";
                if ($row->BestMinorPuppy2 == 1)
                    $results .= "Best minor puppy 2,";
                if ($row->BestMinorPuppy3 == 1)
                    $results .= "Best minor puppy 3,";
                if ($row->BestPuppy1 == 1)
                    $results .= "Best puppy male & female 1,";
                if ($row->BestPuppy2 == 1)
                    $results .= "Best puppy male & female 2,";
                if ($row->BestPuppy3 == 1)
                    $results .= "Best puppy male & female 3,";
                if ($row->EXC1 == 1)
                    $results .= "EXC1,";
                if ($row->EXC2 == 1)
                    $results .= "EXC2,";
                if ($row->EXC3 == 1)
                    $results .= "EXC3,";
                if ($row->EXC4 == 1)
                    $results .= "EXC4,";
                if ($row->VG1 == 1)
                    $results .= "VG1,";
                if ($row->VG2 == 1)
                    $results .= "VG2,";
                if ($row->VG3 == 1)
                    $results .= "VG3,";
                if ($row->VG4 == 1)
                    $results .= "VG4,";
                if ($row->CAJC == 1)
                    $results .= "CAJC,";
                if ($row->JBOB == 1)
                    $results .= "JBOB,";
                if ($row->CAC == 1)
                    $results .= "CAC,";
                if ($row->RESCAC == 1)
                    $results .= "RESCAC,";
                if ($row->CACIB == 1)
                    $results .= "CACIB,";
                if ($row->RESCACIB == 1)
                    $results .= "RESCACIB,";
                if ($row->BOB == 1)
                    $results .= "BOB,";
                if ($row->BOS == 1)
                    $results .= "BOS,";
                if ($row->JBOG1 == 1)
                    $results .= "JBOG1,";
                if ($row->JBOG2 == 1)
                    $results .= "JBOG2,";
                if ($row->JBOG3 == 1)
                    $results .= "JBOG3,";
                if ($row->JBIS1 == 1)
                    $results .= "JBIS1,";
                if ($row->JBIS2 == 1)
                    $results .= "JBIS2,";
                if ($row->JBIS3 == 1)
                    $results .= "JBIS3,";
                if ($row->BOG1 == 1)
                    $results .= "BOG1,";
                if ($row->BOG2 == 1)
                    $results .= "BOG2,";
                if ($row->BOG3 == 1)
                    $results .= "BOG3,";
                if ($row->BIS1 == 1)
                    $results .= "BIS1,";
                if ($row->BIS2 == 1)
                    $results .= "BIS2,";
                if ($row->BIS3 == 1)
                    $results .= "BIS3,";

                $results .= $row->other_title;

                $description = mb_strtoupper($row->dog_name) . " - " . $translator->translate("Class") . ": " . $translator->translate($row->show_class) . " - " . $results . " - " . $translator->translate("Judge") . ": " . $row->judge_name;
                $image = DataModel::getURL() . "/" . $row->show_image;
                break;
            case ($id >= 700000000 && $id < 800000000):
                // planned litter 700000000
                $row = $database->table("tbl_planned_litters")->where("id=?", $id)->fetch();
                $title = $translator->translate("Planned litter") . " - " . $row->month . "/" . $row->year;
                $description = mb_strtoupper($row->dog_name) . " X " . mb_strtoupper($row->bitch_name) . " - " . mb_strtoupper($row->bitch_breed);
                $image = DataModel::getURL() . "/" . $row->bitch_image;
                break;
            default :
                return "";
                break;
        }

        $return = array();

        $return['title'] = $title;
        $return['site_title'] = $site_title;
        $return['keywords'] = $keywords;
        $return['description'] = $description;
        $return['image'] = $image;
        $return['url'] = $url;

        return $return;
    }

    static function getShareTagsGlobal($lang, $presenter, $action, $url) {
        try {
            $translator = new App\Presenters\DFSTranslator($lang);
            //$database = new Nette\Database\Context($conn);
            $database = $GLOBALS['database'];

            if ($lang == NULL)
                $lang = "en";

            $database->query("CREATE TABLE IF NOT EXISTS tbl_global_router(`id` BIGINT NOT NULL AUTO_INCREMENT, `presenter` VARCHAR(250) DEFAULT NULL, `action` VARCHAR(250) DEFAULT NULL, `title` VARCHAR(250) DEFAULT NULL, `description` MEDIUMTEXT DEFAULT NULL, `image_url` VARCHAR(255) DEFAULT NULL, `url` VARCHAR(255) DEFAULT NULL, `lang` VARCHAR(25) DEFAULT NULL, PRIMARY KEY(`id`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

            $count = $database->table("tbl_global_router")->where("presenter=?", $presenter)->where("action=?", $action)->where("lang=?", $lang)->count();

            $return = array();

            if ($count > 0) {
                $row = $database->table("tbl_global_router")->where("presenter=?", $presenter)->where("action=?", $action)->where("lang=?", $lang)->fetch();
                $return['title'] = $row->title;
                $return['description'] = $row->description;
                $return['image'] = $row->image_url;
                $return['url'] = $row->url;
                $return['site_title'] = DataModel::azbuka2latin($row->site_title);
                $return['keywords'] = $row->keywords;
            } else {
                $data = array();
                $data['presenter'] = $presenter;
                $data['action'] = $action;
                $data['url'] = $url;
                $data['title'] = $presenter . '-' . $action;
                $data['site_title'] = $presenter . '-' . $action;
                $data['keywords'] = "";
                $data['description'] = $presenter . '-' . $action;
                $data['lang'] = $lang;
                $database->table("tbl_global_router")->insert($data);

                $row = $database->table("tbl_global_router")->where("presenter=?", $presenter)->where("action=?", $action)->where("lang=?", $lang)->fetch();

                $return['title'] = $row->title;
                $return['description'] = $row->description;
                $return['image'] = $row->image_url;
                $return['url'] = $row->url;
                $return['site_title'] = DataModel::azbuka2latin($row->site_title);
                $return['keywords'] = $row->keywords;
            }

            return $return;
        } catch (\Exception $ex) {
            $return = array();
            $return['title'] = 'DOGFORSHOW';
            $return['site_title'] = 'DOGFORSHOW';
            $return['keywords'] = '';
            $return['description'] = 'DOGFORSHOW';
            $return['image'] = '';
            $return['url'] = '';
            return $return;
        }
    }

    static function getShareUrl($lang, $id, $alt_id = 0, $encode = FALSE) {
        //$lang = $GLOBALS['lang'];
        $url = DataModel::getURL();
        $return = "";
        switch ($id) {
            case ($id >= 200000000 && $id < 300000000):
                // kennel 200000000
                $return = "$url/kennel-profile?id=$id&lang=$lang";
                break;
            case ($id >= 300000000 && $id < 400000000):
                // owner 300000000
                $return = "$url/owner-profile?id=$id&lang=$lang";
                break;
            case ($id >= 400000000 && $id < 500000000):
                // handler 400000000
                $return = "$url/handler-profile?id=$id&lang=$lang";
                break;
            case ($id >= 500000000 && $id < 600000000):
                // dog 500000000
                $return = "$url/dog?id=$id&lang=$lang";
                break;
            case ($id >= 600000000 && $id < 700000000):
                // puppy 600000000
                $return = "$url/puppy-profile?id=$id&lang=$lang";
                break;
            case ($id >= 800000000 && $id < 900000000):
                // dog show 800000000
                $return = "$url/dog-show-list?id=$alt_id&dog_id=$alt_id&show=$id&lang=$lang#showid_$id";
                break;
            case ($id >= 2600000000 && $id < 2700000000):
                // handler show 2600000000
                $return = "$url/handler-show-list?id=$alt_id&show=$id&lang=$lang#showid_$id";
                break;
            case ($id >= 700000000 && $id < 800000000):
                // planned litter 700000000
                $return = "$url/kennel-planned-litter-list?id=$alt_id&litter=$id&lang=$lang#litterid_$id";
                break;
            default :
                $return = "";
                break;
        }

        if ($encode)
            return urlencode($return);
        else
            return $return;
    }

    static function getShareType($id = 0) {
        $ret_id = 0;
        if ($id >= 100000000 && $id < 200000000) {
            // user 100000000
            $ret_id = 0;
        } elseif ($id >= 200000000 && $id < 300000000) {
            // kennel 200000000
            $ret_id = 1;
        } elseif ($id >= 300000000 && $id < 400000000) {
            // owner 300000000
            $ret_id = 2;
        } elseif ($id >= 400000000 && $id < 500000000) {
            // handler 400000000
            $ret_id = 3;
        } elseif ($id >= 500000000 && $id < 600000000) {
            // dog 500000000
            $ret_id = 4;
        } elseif ($id >= 600000000 && $id < 700000000) {
            // puppy 600000000
            $ret_id = 5;
        } elseif ($id >= 800000000 && $id < 900000000) {
            // dog show 800000000
            $ret_id = 6;
        } elseif ($id >= 2600000000 && $id < 2700000000) {
            // handler show 2600000000
            $ret_id = 7;
        } elseif ($id >= 700000000 && $id < 800000000) {
            // planned litter 700000000
            $ret_id = 8;
        }

        return $ret_id;
    }

}
