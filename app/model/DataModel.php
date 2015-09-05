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
    function getTimeline($id = 0) {
	$rows = NULL;

	$table = "tmp_" . rand(0, 10);
	$this->database->query("DROP TABLE IF EXISTS $table");

	if ($id == 0)
	    $this->database->query("CREATE TABLE $table SELECT tbl_timeline.*, (IF(tbl_timeline.profile_id>=300000000,(SELECT owner_profile_picture FROM tbl_userowner WHERE id=tbl_timeline.profile_id), (SELECT kennel_profile_picture FROM tbl_userkennel WHERE tbl_userkennel.id=tbl_timeline.profile_id))) as timeline_profile_image, (IF(tbl_timeline.profile_id>=300000000,(SELECT concat(tbl_user.name,' ',tbl_user.surname) as timeline_name FROM tbl_user WHERE tbl_user.id=(SELECT user_id FROM tbl_userowner WHERE id=tbl_timeline.profile_id)), (SELECT kennel_name FROM tbl_userkennel WHERE tbl_userkennel.id=tbl_timeline.profile_id))) as timeline_name FROM tbl_timeline order by `date` DESC");
	else
	    $this->database->query("CREATE TABLE $table SELECT tbl_timeline.*, (IF(tbl_timeline.profile_id>=300000000,(SELECT owner_profile_picture FROM tbl_userowner WHERE id=tbl_timeline.profile_id), (SELECT kennel_profile_picture FROM tbl_userkennel WHERE tbl_userkennel.id=tbl_timeline.profile_id))) as timeline_profile_image, (IF(tbl_timeline.profile_id>=300000000,(SELECT concat(tbl_user.name,' ',tbl_user.surname) as timeline_name FROM tbl_user WHERE tbl_user.id=(SELECT user_id FROM tbl_userowner WHERE id=tbl_timeline.profile_id)), (SELECT kennel_name FROM tbl_userkennel WHERE tbl_userkennel.id=tbl_timeline.profile_id))) as timeline_name FROM tbl_timeline where profile_id = ? order by `date` DESC", $id);

	$this->database->query("ALTER TABLE `$table` ADD PRIMARY KEY (`id`)");
	$this->database->query("ALTER TABLE `$table` CHANGE `id` `id` BIGINT( 20 ) NOT NULL AUTO_INCREMENT");

	$rows = $this->database->table($table)->fetchAll();

	return $rows;
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
	require_once 'www/inc/config_ajax.php';
	$database = getContext();

	$rows = $database->table("tbl_dogs")->where("dog_name=?", $dog_name)->count();

	if ($rows > 0)
	    return TRUE;
	else
	    return FALSE;
    }

    static function getDogProfileByName($dog_name) {
	require_once 'www/inc/config_ajax.php';
	$database = getContext();

	$row = $database->table("tbl_dogs")->where("dog_name=?", $dog_name)->fetch();

	return $row;
    }

    static function getMotherName($dogName) {
	require_once 'www/inc/config_ajax.php';
	$database = getContext();
	$return = "";

	if ($dogName == NULL)
	    $dogName = "";

	$row = $database->table("tbl_pedigree")->where("dog_name=?", $dogName)->fetch();

	if ($row->id > 0) {
	    $return = $row->mother_name;
	}

	return $return;
    }

    static function getFatherName($dogName) {
	require_once 'www/inc/config_ajax.php';
	$database = getContext();
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
	require_once 'www/inc/config_ajax.php';

	$image = "";

	$database = getContext();

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
	} else {
	    // handler 400000000
	    // handler_profile_picture
	    $row = $database->table("tbl_userhandler")->where("id=?", $id)->fetch();
	    $image = $row->handler_profile_picture;
	}

	return $image;
    }

    static function getProfileName($id = 0) {
	require_once 'www/inc/config_ajax.php';

	$name = "";

	$database = getContext();

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
	} else {
	    // handler 400000000
	    // handler_profile_picture
	    $row = $database->table("tbl_userhandler")->where("id=?", $id)->fetch();
	    $user_id = $row->user_id;
	    $row = $database->table("tbl_user")->where("id=?", $user_id)->fetch();
	    $name = $row->name . " " . $row->surname;
	}

	return $name;
    }

    static function getUserIdByProfileId($id = 0) {
	require_once 'www/inc/config_ajax.php';

	$ret_id = 0;

	$database = getContext();

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
	} else {
	    // handler 400000000
	    // handler_profile_picture
	    $row = $database->table("tbl_userhandler")->where("id=?", $id)->fetch();
	    $ret_id = $row->user_id;
	}

	return $ret_id;
    }

    static function getProfileState($id = 0) {
	require_once 'www/inc/config_ajax.php';

	$state = "";

	$database = getContext();

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

	return $state;
    }

    static function getPlannedLitterById($id = 0) {
	require_once 'www/inc/config_ajax.php';

	$database = getContext();

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
	require_once 'www/inc/config_ajax.php';

	$database = getContext();

	$row = $database->table("tbl_planned_litters")->where("id=?", $id)->fetch();
	$row = $database->table("tbl_dogs")->where("dog_name=?", $row->bitch_name)->fetch();
	
	return $row;
    }

    //counter functions

    static function getKennelsCount() {
	require_once 'www/inc/config_ajax.php';

	$database = getContext();

	return $database->table("tbl_userkennel")->count();
    }

    static function getOwnersCount() {
	require_once 'www/inc/config_ajax.php';

	$database = getContext();

	return $database->table("tbl_userowner")->count();
    }

    static function getHandlersCount() {
	require_once 'www/inc/config_ajax.php';

	$database = getContext();

	return $database->table("tbl_userhandler")->count();
    }

    static function getDogsCount() {
	require_once 'www/inc/config_ajax.php';

	$database = getContext();

	return $database->table("tbl_dogs")->count();
    }

    static function getMattingDogsCount() {
	require_once 'www/inc/config_ajax.php';

	$database = getContext();

	return $database->table("tbl_dogs")->where("offer_for_mating=1")->count();
    }

    static function getPlannedLittersCount() {
	require_once 'www/inc/config_ajax.php';

	$database = getContext();

	return $database->table("tbl_planned_litters")->count();
    }

    //counter functions


    function addTimelineComment($user_id, $profile_id, $timeline_id, $comment) {
	$data['user_id'] = $user_id;
	$data['profile_id'] = $profile_id;
	$data['timeline_id'] = $timeline_id;
	$data['comment'] = $comment;

	$row = $this->database->table("tbl_timeline")->where("id=?", $timeline_id)->fetch();
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
    function addToTimeline($profile_id, $event_id, $event_type, $description = NULL, $event_image = NULL) {
	/**
	 * event_types :
	 * 
	 * 1 - create profile
	 * 2 - update profile
	 * 3 - kennel change profile image
	 * 4 - kennel change cover image
	 * 5 - kennel add award
	 * 6 - kennel update award
	 * 7 - planned litter
	 * 
	 */
	$data = array();

	$data['profile_id'] = $profile_id;
	$data['event_id'] = $event_id;
	$data['event_type'] = $event_type;
	$data['event_description'] = $description;
	$data['event_image'] = $event_image;

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
	require_once 'www/inc/config_ajax.php';

	$database = getContext();

	$database->table("tbl_timeline")->where("id=?", $id)->delete();
    }
    
    static function getTimelineLikesCount($id)
    {
	require_once 'www/inc/config_ajax.php';

	$database = getContext();

	$count = $database->table("tbl_likes")->where("timeline_id=?", $id)->count();
	
	return $count;
    }
}
