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

    static function getKennelsCount() {
//        require_once 'www/inc/config_ajax.php';
//        $database = getContext();
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

    static function getCoownersCount($dog_id) {
        $database = $GLOBALS['database'];

        return $database->table("tbl_dogs_coowners")->where("dog_id=?", $dog_id)->count();
    }

    static function getPhotosCount($profile_id) {
        $database = $GLOBALS['database'];

        return $database->table("tbl_photos")->where("profile_id=?", $profile_id)->count();
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


        $notify['notify_user_id'] = $notify_user_id;
        $notify['notify_profile_id'] = $notify_profile_id;
        $notify['user_id'] = $user_id;
        $notify['profile_id'] = $profile_id;
        $notify['timeline_id'] = $timeline_id;
        $notify['comment'] = $comment;
        $notify['type'] = "comment";

        $this->database->table("tbl_notify")->insert($notify);
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

    static function getProfileLinkUrl($profile_id, $generated = FALSE) {
        if ($generated) {
            switch ($profile_id) {
                case ($profile_id >= 200000000 && $profile_id < 300000000):
                    return "kennel-profile";
                    break;
                case ($profile_id >= 300000000 && $profile_id < 400000000):
                    return "owner-profile";
                    break;
                case ($profile_id >= 400000000 && $profile_id < 500000000):
                    return "handler-profile";
                    break;
                case ($profile_id >= 500000000 && $profile_id < 600000000):
                    return "dog?id=$profile_id";
                    break;
                case ($profile_id >= 600000000 && $profile_id < 700000000):
                    return "puppy-profile";
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
        $database = $GLOBALS['database'];

        $cnt = $database->table("tbl_user")->where("id=? AND premium_expiry_date >= now()", $user_id)->count();

        if ($cnt > 0)
            return TRUE;
        else
            return FALSE;
    }

    public static function premiumNotified($user_id) {
        $database = $GLOBALS['database'];

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
}
