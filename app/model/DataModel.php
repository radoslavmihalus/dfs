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

    function addTimelineComment($user_id, $profile_id, $timeline_id, $comment) {
        $data['user_id'] = $user_id;
        $data['profile_id'] = $profile_id;
        $data['timeline_id'] = $timeline_id;
        $data['comment'] = $comment;

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
    function deleteFromTimelineByItem($id) {
        $this->database->table("tbl_timeline")->where("id=?", $id)->delete();
    }

}
