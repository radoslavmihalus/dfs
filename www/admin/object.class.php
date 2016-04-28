<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("forms/blueticket_forms.php");

class blueticket_objects {

    public $lang = 'sk';

    function __construct() {
//$this->lang = 'sk';
    }

    public function generateMainScreen() {
//        $form = new Form("form-main");
//        $button = new Element\Button("Číselníky");
//        $form->addElement($button);
//        $form->render();
    }

    public function getTranslatedText($par_Text, $par_lang = 'sk') {
        $par_lang = $this->lang;

        return $par_Text;
    }

    function generateForms() {
        $form = blueticket_forms::get_instance();

        $form->table("forms");

        $form->nested_table($this->getTranslatedText('form_fields'), 'form_name', 'form_fields', 'form_name');

        return $form->render();
    }

    function generateUsersWithoutProfile() {
        $form = blueticket_forms::get_instance();

//$form= new blueticket_forms();

        $form->table("tbl_user");
        $form->where("(SELECT COUNT(*) FROM tbl_userkennel WHERE tbl_userkennel.user_id=tbl_user.id) = 0");
        $form->where("(SELECT COUNT(*) FROM tbl_userhandler WHERE tbl_userhandler.user_id=tbl_user.id) = 0");
        $form->where("(SELECT COUNT(*) FROM tbl_userowner WHERE tbl_userowner.user_id=tbl_user.id) = 0");
        $form->where("active=1");

        $form->table_name("Users");
        $form->default_tab("Users");
        $form->columns("registration_date, active, full_name, email, state, lang, last_login, login_count, premium_expiry_date");

        $form->label("premium_expiry_date", "PED");
        $form->label("last_login", "LL");
        $form->label("login_count", "LC");

        $form->order_by('id', 'DESC');

        $form->subselect('full_name', "concat({name},' ',{surname})");

        $form->highlight_row('active', '=', 0, '#FFD6D6');
        $form->highlight('login_count', '>', 0, '#B4E274');
        $form->highlight('login_count', '=', 0, '#EDEBE4');

        $form->sum('active');

        return $form->render();
    }

    function fillMailWizzAll() {
        $btdb = blueticket_forms_db::get_instance();
        //$btdb = new blueticket_forms_db();

        $btdb->query("SELECT * FROM tbl_user WHERE active=1");
        $users = $btdb->result();

        foreach ($users as $user) {
            // set lists and fields id's by lang
            $list_id = 0;
            $name_fid = 0;
            $surname_fid = 0;
            $email_fid = 0;
            switch ($user['lang']) {
                case "en":
                    $list_id = 2;
                    $email_fid = 4;
                    $name_fid = 5;
                    $surname_fid = 6;
                    break;
                case "cz":
                    $list_id = 3;
                    $email_fid = 7;
                    $name_fid = 8;
                    $surname_fid = 9;
                    break;
                case "sk":
                    $list_id = 4;
                    $email_fid = 10;
                    $name_fid = 11;
                    $surname_fid = 12;
                    break;
                case "hu":
                    $list_id = 5;
                    $email_fid = 13;
                    $name_fid = 14;
                    $surname_fid = 15;
                    break;
                case "ru":
                    $list_id = 6;
                    $email_fid = 16;
                    $name_fid = 17;
                    $surname_fid = 18;
                    break;
            }

            $subscriber_uid = uniqid();
            $email = $user['email'];
            $name = str_replace("'", "`", $user['name']);
            $surname = str_replace("'", "`", $user['surname']);

            $ip_address = "127.0.0.1";
            $source = "web";
            $status = "confirmed";
            $date_added = date("Y-m-d H:i:s");
            $last_updated = date("Y-m-d H:i:s");

            $btdb->query("SELECT COUNT(*) as Cnt FROM mw_list_subscriber WHERE email='$email' AND list_id=$list_id");
            $row = $btdb->row();

            if ($row['Cnt'] == 0) {
                $btdb->query("INSERT INTO mw_list_subscriber(subscriber_uid, list_id, email, ip_address, source, status, date_added, last_updated) VALUES('$subscriber_uid', $list_id, '$email', '$ip_address', '$source', '$status', '$date_added', '$last_updated')");
                $subscriber_id = $btdb->insert_id();

                $btdb->query("INSERT INTO mw_list_field_value(field_id,subscriber_id, value, date_added, last_updated) VALUES ($email_fid, $subscriber_id, '$email', '$date_added', '$last_updated')");
                $btdb->query("INSERT INTO mw_list_field_value(field_id,subscriber_id, value, date_added, last_updated) VALUES ($name_fid, $subscriber_id, '$name', '$date_added', '$last_updated')");
                $btdb->query("INSERT INTO mw_list_field_value(field_id,subscriber_id, value, date_added, last_updated) VALUES ($surname_fid, $subscriber_id, '$surname', '$date_added', '$last_updated')");
            }
        }
    }
    
    function fillMailWizzProfiles() {
        $btdb = blueticket_forms_db::get_instance();
        //$btdb = new blueticket_forms_db();

        $btdb->query("SELECT * FROM tbl_user WHERE active=1 AND (id IN (SELECT user_id FROM tbl_userkennel) OR id IN (SELECT user_id FROM tbl_userowner) OR id IN (SELECT user_id FROM tbl_userhandler))");
        $users = $btdb->result();

        foreach ($users as $user) {
            // set lists and fields id's by lang
            $list_id = 0;
            $name_fid = 0;
            $surname_fid = 0;
            $email_fid = 0;
            switch ($user['lang']) {
                case "en":
                    $list_id = 11;
                    $email_fid = 31;
                    $name_fid = 32;
                    $surname_fid = 33;
                    break;
                case "cz":
                    $list_id = 10;
                    $email_fid = 28;
                    $name_fid = 29;
                    $surname_fid = 30;
                    break;
                case "sk":
                    $list_id = 9;
                    $email_fid = 25;
                    $name_fid = 26;
                    $surname_fid = 27;
                    break;
                case "hu":
                    $list_id = 8;
                    $email_fid = 22;
                    $name_fid = 23;
                    $surname_fid = 24;
                    break;
                case "ru":
                    $list_id = 7;
                    $email_fid = 19;
                    $name_fid = 20;
                    $surname_fid = 21;
                    break;
            }

            $subscriber_uid = uniqid();
            $email = $user['email'];
            $name = str_replace("'", "`", $user['name']);
            $surname = str_replace("'", "`", $user['surname']);

            $ip_address = "127.0.0.1";
            $source = "web";
            $status = "confirmed";
            $date_added = date("Y-m-d H:i:s");
            $last_updated = date("Y-m-d H:i:s");

            $btdb->query("SELECT COUNT(*) as Cnt FROM mw_list_subscriber WHERE email='$email' AND list_id=$list_id");
            $row = $btdb->row();

            if ($row['Cnt'] == 0) {
                $btdb->query("INSERT INTO mw_list_subscriber(subscriber_uid, list_id, email, ip_address, source, status, date_added, last_updated) VALUES('$subscriber_uid', $list_id, '$email', '$ip_address', '$source', '$status', '$date_added', '$last_updated')");
                $subscriber_id = $btdb->insert_id();

                $btdb->query("INSERT INTO mw_list_field_value(field_id,subscriber_id, value, date_added, last_updated) VALUES ($email_fid, $subscriber_id, '$email', '$date_added', '$last_updated')");
                $btdb->query("INSERT INTO mw_list_field_value(field_id,subscriber_id, value, date_added, last_updated) VALUES ($name_fid, $subscriber_id, '$name', '$date_added', '$last_updated')");
                $btdb->query("INSERT INTO mw_list_field_value(field_id,subscriber_id, value, date_added, last_updated) VALUES ($surname_fid, $subscriber_id, '$surname', '$date_added', '$last_updated')");
            }
        }
    }
    

    function generateUsers() {
        $form = blueticket_forms::get_instance();

//$form= new blueticket_forms();

        echo '<a href="?report=active_users" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Only active users</a>';

        $form->table("tbl_user");
        $form->table_name("Users");
        $form->default_tab("Users");
        $form->columns("registration_date, active, full_name, email, state, lang, last_login, login_count, premium_expiry_date, kennels, owners, handlers, dogs, puppies");

        $form->label("premium_expiry_date", "PED");
        $form->label("last_login", "LL");
        $form->label("login_count", "LC");

        $form->order_by('id', 'DESC');

        $form->subselect('full_name', "concat({name},' ',{surname})");
        $form->subselect('kennels', 'SELECT COUNT(*) FROM tbl_userkennel WHERE user_id = {id}');
        $form->subselect('owners', 'SELECT COUNT(*) FROM tbl_userowner WHERE user_id = {id}');
        $form->subselect('handlers', 'SELECT COUNT(*) FROM tbl_userhandler WHERE user_id = {id}');
        $form->subselect('dogs', 'SELECT COUNT(*) FROM tbl_dogs WHERE user_id = {id}');
        $form->subselect('puppies', 'SELECT COUNT(*) FROM tbl_puppies WHERE user_id = {id}');

        $form->highlight_row('active', '=', 0, '#FFD6D6');
        $form->highlight('kennels', '>', 0, '#B4E274');
        $form->highlight('kennels', '=', 0, '#EDEBE4');
        $form->highlight('owners', '>', 0, '#B4E274');
        $form->highlight('owners', '=', 0, '#EDEBE4');
        $form->highlight('handlers', '>', 0, '#B4E274');
        $form->highlight('handlers', '=', 0, '#EDEBE4');
        $form->highlight('dogs', '>', 0, '#B4E274');
        $form->highlight('dogs', '=', 0, '#EDEBE4');
        $form->highlight('puppies', '>', 0, '#B4E274');
        $form->highlight('puppies', '=', 0, '#EDEBE4');
        $form->highlight('login_count', '>', 0, '#B4E274');
        $form->highlight('login_count', '=', 0, '#EDEBE4');

        $form->sum('active,kennels,owners,handlers,dogs, puppies');

        $form->label("kennels", "Ken");
        $form->label("handlers", "Han");
        $form->label("owners", "Own");
        $form->label("dogs", "Dog");

        $this->generateKennels($form);
        $this->generateOwners($form);
        $this->generateHandlers($form);
        $this->generateDogs($form);
        $this->generatePayments($form);
        $this->generatePuppies($form);
        $this->generatePhotos($form);
        $this->generateVideos($form);
//$this->generateCommentsByUser($form);

        return $form->render();
    }

    public function generateActiveUsers() {
        $form = blueticket_forms::get_instance();
        $form_date = blueticket_forms::get_instance();

        $btdb = blueticket_forms_db::get_instance();
        $btdb->query("CREATE TABLE IF NOT EXISTS tbl_stat_dates(id BIGINT NOT NULL auto_increment, date_from DATE NOT NULL, date_to DATE NOT NULL, PRIMARY KEY(id)) ENGINE=MyISAM");
        
        $form_date->table("tbl_stat_dates");
        $form_date->table_name("Statistics period");

        $form_date->unset_add();
        $form_date->unset_remove();
        
        echo $form_date->render();
        
        echo '<a class="btn btn-lg btn-default" href="http://www.dogforshow.com/www/admin/index.php?report=active_users">Obnoviť</a>';
        
//$form= new blueticket_forms();
        
        $form->table("tbl_user");
        $form->where("active > 0");
        $form->where("DATE(registration_date) >= (SELECT MAX(date_from) FROM tbl_stat_dates) AND DATE(registration_date) <= (SELECT MAX(date_to) FROM tbl_stat_dates)");
        $form->table_name("Active users");
        $form->default_tab("Active users");
        $form->columns("registration_date, active, full_name, email, state, lang, last_login, login_count, premium_expiry_date, kennels, owners, handlers, dogs, puppies");

        $form->label("premium_expiry_date", "PED");
        $form->label("last_login", "LL");
        $form->label("login_count", "LC");

        $form->order_by('id', 'DESC');

        $form->subselect('full_name', "concat({name},' ',{surname})");
        $form->subselect('kennels', 'SELECT COUNT(*) FROM tbl_userkennel WHERE user_id = {id}');
        $form->subselect('owners', 'SELECT COUNT(*) FROM tbl_userowner WHERE user_id = {id}');
        $form->subselect('handlers', 'SELECT COUNT(*) FROM tbl_userhandler WHERE user_id = {id}');
        $form->subselect('dogs', 'SELECT COUNT(*) FROM tbl_dogs WHERE user_id = {id}');
        $form->subselect('puppies', 'SELECT COUNT(*) FROM tbl_puppies WHERE user_id = {id}');

        $form->highlight_row('active', '=', 0, '#FFD6D6');
        $form->highlight('kennels', '>', 0, '#B4E274');
        $form->highlight('kennels', '=', 0, '#EDEBE4');
        $form->highlight('owners', '>', 0, '#B4E274');
        $form->highlight('owners', '=', 0, '#EDEBE4');
        $form->highlight('handlers', '>', 0, '#B4E274');
        $form->highlight('handlers', '=', 0, '#EDEBE4');
        $form->highlight('dogs', '>', 0, '#B4E274');
        $form->highlight('dogs', '=', 0, '#EDEBE4');
        $form->highlight('puppies', '>', 0, '#B4E274');
        $form->highlight('puppies', '=', 0, '#EDEBE4');
        $form->highlight('login_count', '>', 0, '#B4E274');
        $form->highlight('login_count', '=', 0, '#EDEBE4');

        $form->sum('active,kennels,owners,handlers,dogs, puppies');

        $form->label("kennels", "Ken");
        $form->label("handlers", "Han");
        $form->label("owners", "Own");
        $form->label("dogs", "Dog");

        $this->generateKennels($form);
        $this->generateOwners($form);
        $this->generateHandlers($form);
        $this->generateDogs($form);
        $this->generatePayments($form);
        $this->generatePuppies($form);
//$this->generateCommentsByUser($form);

        return $form->render();
    }

    function generatePremiumVisits() {
        $form = blueticket_forms::get_instance();
        $form->table("tbl_user_premium_visits");
        $form->order_by('id', 'DESC');
        $form->columns("date_time, user_id, full_name");
        $form->table_name("Premium visits");

        $form->subselect("full_name", "SELECT concat(name,' ',surname) FROM tbl_user WHERE id={user_id}");

        return $form->render();
    }

    function generateKennels($form = NULL) {
        if ($form != NULL) {
            $kennel = $form->nested_table($this->getTranslatedText("Kennels"), "id", "tbl_userkennel", "user_id");
            $kennel->table_name("Kennels");
            $kennel->default_tab("Kennels");
            $kennel->order_by('id', 'DESC');
            $kennel->columns("kennel_create_date, id, user_id, kennel_name, full_name, email, lang, state, dogs, puppies");
            $kennel->subselect("full_name", "SELECT concat(name,' ',surname) FROM tbl_user WHERE id={user_id}");
            $kennel->subselect("email", "SELECT email FROM tbl_user WHERE id={user_id}");
            $kennel->subselect("lang", "SELECT lang FROM tbl_user WHERE id={user_id}");
            $kennel->subselect("state", "SELECT state FROM tbl_user WHERE id={user_id}");
            $kennel->subselect("dogs", "SELECT COUNT(*) FROM tbl_dogs WHERE profile_id={id}");
            $kennel->subselect("puppies", "SELECT COUNT(*) FROM tbl_puppies WHERE profile_id={id}");
            $kennel->column_pattern('kennel_name', '<a target="_blank" href="http://www.dogforshow.com/kennel-profile?id={id}">{kennel_name}</a>');
            $kennel->no_editor('kennel_description');
            $kennel->highlight('dogs', '>', 0, '#B4E274');
            $kennel->highlight('puppies', '>', 0, '#B4E274');
            $kennel->sum('dogs, puppies');
            $this->generateDogsByProfile($kennel);
            $this->generatePuppiesByProfile($kennel);
            $this->generateCommentsByProfile($kennel);
        } else {
            $kennel = blueticket_forms::get_instance();
            $kennel->table("tbl_userkennel");
            $kennel->table_name("Kennels");
            $kennel->default_tab("Kennels");
            $kennel->order_by('id', 'DESC');
            $kennel->columns("kennel_create_date, id, user_id, kennel_name, full_name, email, lang, state, dogs, puppies");
            $kennel->subselect("full_name", "SELECT concat(name,' ',surname) FROM tbl_user WHERE id={user_id}");
            $kennel->subselect("email", "SELECT email FROM tbl_user WHERE id={user_id}");
            $kennel->subselect("lang", "SELECT lang FROM tbl_user WHERE id={user_id}");
            $kennel->subselect("state", "SELECT state FROM tbl_user WHERE id={user_id}");
            $kennel->subselect("dogs", "SELECT COUNT(*) FROM tbl_dogs WHERE profile_id={id}");
            $kennel->subselect("puppies", "SELECT COUNT(*) FROM tbl_puppies WHERE profile_id={id}");
            $kennel->column_pattern('kennel_name', '<a target="_blank" href="http://www.dogforshow.com/kennel-profile?id={id}">{kennel_name}</a>');
            $kennel->no_editor('kennel_description');
            $kennel->highlight('dogs', '>', 0, '#B4E274');
            $kennel->highlight('puppies', '>', 0, '#B4E274');
            $kennel->sum('dogs, puppies');
            $this->generateDogsByProfile($kennel);
            $this->generatePuppiesByProfile($kennel);
            $this->generateCommentsByProfile($kennel);

            return $kennel->render();
        }
    }

    function generatePhotos($form = NULL) {
        if ($form != NULL) {
            $photos = $form->nested_table($this->getTranslatedText("Photos"), "id", "tbl_photos", "user_id");
            $photos->table_name("Photos");
            $photos->default_tab("Photos");
            $photos->order_by('id', 'DESC');
            $photos->columns("image, user_id, profile_id, full_name, description, added");
            $photos->subselect("full_name", "SELECT concat(name,' ',surname) FROM tbl_user WHERE id={user_id}");
            $photos->column_pattern('image', '<a target="_blank" href="http://www.dogforshow.com/{image}"><img src="http://www.dogforshow.com/{image}" style="width:50px; height:50px"/></a>');
            $photos->no_editor('image,description');
        } else {
            $photos = blueticket_forms::get_instance();
            $photos->table("tbl_photos");
            $photos->table_name("Photos");
            $photos->default_tab("Photos");
            $photos->order_by('id', 'DESC');
            $photos->columns("image, user_id, profile_id, full_name, description, added");
            $photos->subselect("full_name", "SELECT concat(name,' ',surname) FROM tbl_user WHERE id={user_id}");
            $photos->column_pattern('image', '<a target="_blank" href="http://www.dogforshow.com/{image}"><img src="http://www.dogforshow.com/{image}" style="width:50px; height:50px"/></a>');
            $photos->no_editor('image,description');

            return $photos->render();
        }
    }

    function generateVideos($form = NULL) {
        if ($form != NULL) {
            $photos = $form->nested_table($this->getTranslatedText("Videos"), "id", "tbl_videos", "user_id");
            $photos->table_name("Videos");
            $photos->default_tab("Videos");
            $photos->order_by('id', 'DESC');
            $photos->columns("image, user_id, profile_id, full_name, video, description, added, youtube");
            $photos->subselect("full_name", "SELECT concat(name,' ',surname) FROM tbl_user WHERE id={user_id}");
            $photos->column_pattern('image', '<a target="_blank" href="{image}"><img src="{image}" style="width:50px; height:50px"/></a>');
            $photos->column_pattern('video', '<a target="_blank" href="{video}">{video}</a>');
            $photos->no_editor('image,description,video,youtube');
        } else {
            $photos = blueticket_forms::get_instance();
            $photos->table("tbl_videos");
            $photos->table_name("Videos");
            $photos->default_tab("Videos");
            $photos->order_by('id', 'DESC');
            $photos->columns("image, user_id, profile_id, full_name, video, description, added, youtube");
            $photos->subselect("full_name", "SELECT concat(name,' ',surname) FROM tbl_user WHERE id={user_id}");
            $photos->column_pattern('image', '<a target="_blank" href="{image}"><img src="{image}" style="width:50px; height:50px"/></a>');
            $photos->column_pattern('video', '<a target="_blank" href="{video}">{video}</a>');
            $photos->no_editor('image,description,video,youtube');

            return $photos->render();
        }
    }

    function generateMessages() {
        $form = blueticket_forms::get_instance();

        $form->table("tbl_messages");
        $form->table_name("Messages");
        $form->order_by('id', 'DESC');
        $form->columns("message_datetime, from, to, message, from_user_id, to_user_id, from_profile_id, to_profile_id");
        $form->subselect("from", "SELECT concat(name, ' ', surname) FROM tbl_user WHERE id={from_user_id}");
        $form->subselect("to", "SELECT concat(name, ' ', surname) FROM tbl_user WHERE id={to_user_id}");
        $form->no_editor('message');
        return $form->render();
    }

    function generateLikes() {
        $form = blueticket_forms::get_instance();

        $form->table("tbl_likes");
        $form->table_name("Likes");
        $form->default_tab("Likes");
        $form->order_by('id', 'DESC');
        $form->columns("like_datetime, timeline_id, event_id, user_id, profile_id, full_name");
        $form->subselect("full_name", "SELECT concat(name, ' ', surname) FROM tbl_user WHERE id={user_id}");
        $form->no_editor('comment');
        $this->generateTimelineByLike($form);
        return $form->render();
    }

    function generateComments() {
        $form = blueticket_forms::get_instance();

        $form->table("tbl_comments");
        $form->table_name("Comments");
        $form->order_by('id', 'DESC');
        $form->columns("comment_date_time, timeline_id, event_id, user_id, profile_id, full_name, comment");
        $form->subselect("full_name", "SELECT concat(name, ' ', surname) FROM tbl_user WHERE id={user_id}");
        $form->no_editor('comment');
        return $form->render();
    }

    function generateCommentsByTimeline($by_form) {
        $form = $by_form->nested_table($this->getTranslatedText("Comments"), "id", "tbl_comments", "timeline_id");
        $form->table_name("Comments");
        $form->order_by('id', 'DESC');
        $form->columns("comment_date_time, timeline_id, event_id, user_id, profile_id, full_name, comment");
        $form->subselect("full_name", "SELECT concat(name, ' ', surname) FROM tbl_user WHERE id={user_id}");
        $form->no_editor('comment');
    }

    function generateCommentsByUser($by_form) {
        $form = $by_form->nested_table($this->getTranslatedText("Comments"), "id", "tbl_comments", "user_id");
        $form->table_name("Comments");
        $form->order_by('id', 'DESC');
        $form->columns("comment_date_time, timeline_id, event_id, user_id, profile_id, full_name, comment");
        $form->subselect("full_name", "SELECT concat(name, ' ', surname) FROM tbl_user WHERE id={user_id}");
        $form->no_editor('comment');
    }

    function generateCommentsByProfile($by_form) {
        $form = $by_form->nested_table($this->getTranslatedText("Comments"), "id", "tbl_comments", "profile_id");
        $form->table("tbl_comments");
        $form->table_name("Comments");
        $form->order_by('id', 'DESC');
        $form->columns("comment_date_time, timeline_id, event_id, user_id, profile_id, full_name, comment");
        $form->subselect("full_name", "SELECT concat(name, ' ', surname) FROM tbl_user WHERE id={user_id}");
        $form->no_editor('comment');
    }

    function generateOwners($form = NULL) {
        if ($form != NULL) {
            $owner = $form->nested_table($this->getTranslatedText("Owners"), "id", "tbl_userowner", "user_id");
            $owner->table_name("Owners");
            $owner->default_tab("Owners");
            $owner->order_by('id', 'DESC');
            $owner->columns("owner_create_date, id, user_id, full_name, email, lang, state, dogs");
            $owner->subselect("full_name", "SELECT concat(name,' ',surname) FROM tbl_user WHERE id={user_id}");
            $owner->subselect("email", "SELECT email FROM tbl_user WHERE id={user_id}");
            $owner->subselect("lang", "SELECT lang FROM tbl_user WHERE id={user_id}");
            $owner->subselect("state", "SELECT state FROM tbl_user WHERE id={user_id}");
            $owner->subselect("dogs", "SELECT COUNT(*) FROM tbl_dogs WHERE profile_id={id}");
            $owner->column_pattern('full_name', '<a target="_blank" href="http://www.dogforshow.com/owner-profile?id={id}">{full_name}</a>');
            $owner->no_editor('owner_description');
            $owner->highlight('dogs', '>', 0, '#B4E274');
            $owner->sum('dogs');
            $this->generateDogsByProfile($owner);
            $this->generateCommentsByProfile($owner);
        } else {
            $owner = blueticket_forms::get_instance();
            $owner->table("tbl_userowner");
            $owner->table_name("Owners");
            $owner->default_tab("Owners");
            $owner->order_by('id', 'DESC');
            $owner->columns("owner_create_date, id, user_id, full_name, email, lang, state, dogs");
            $owner->subselect("full_name", "SELECT concat(name,' ',surname) FROM tbl_user WHERE id={user_id}");
            $owner->subselect("email", "SELECT email FROM tbl_user WHERE id={user_id}");
            $owner->subselect("lang", "SELECT lang FROM tbl_user WHERE id={user_id}");
            $owner->subselect("state", "SELECT state FROM tbl_user WHERE id={user_id}");
            $owner->subselect("dogs", "SELECT COUNT(*) FROM tbl_dogs WHERE profile_id={id}");
            $owner->column_pattern('full_name', '<a target="_blank" href="http://www.dogforshow.com/owner-profile?id={id}">{full_name}</a>');
            $owner->no_editor('owner_description');
            $owner->highlight('dogs', '>', 0, '#B4E274');
            $owner->sum('dogs');
            $this->generateDogsByProfile($owner);
            $this->generateCommentsByProfile($owner);

            return $owner->render();
        }
    }

    function generateHandlers($form = NULL) {
        if ($form != NULL) {
            $handler = $form->nested_table($this->getTranslatedText("Handlers"), "id", "tbl_userhandler", "user_id");
            $handler->table_name("Handlers");
            $handler->default_tab("Handlers");
            $handler->order_by('id', 'DESC');
            $handler->columns("handler_create_date, id, user_id, full_name, email, state, lang");
            $handler->subselect("full_name", "SELECT concat(name,' ',surname) FROM tbl_user WHERE id={user_id}");
            $handler->subselect("email", "SELECT email FROM tbl_user WHERE id={user_id}");
            $handler->subselect("lang", "SELECT lang FROM tbl_user WHERE id={user_id}");
            $handler->subselect("state", "SELECT state FROM tbl_user WHERE id={user_id}");
            $handler->column_pattern('full_name', '<a target="_blank" href="http://www.dogforshow.com/handler-profile?id={id}">{full_name}</a>');
            $handler->no_editor('handler_description');
            $this->generateCommentsByProfile($handler);
        } else {
            $handler = blueticket_forms::get_instance();
            $handler->table("tbl_userhandler");
            $handler->table_name("Handlers");
            $handler->order_by('id', 'DESC');
            $handler->columns("handler_create_date, id, user_id, full_name, email, state, lang");
            $handler->subselect("full_name", "SELECT concat(name,' ',surname) FROM tbl_user WHERE id={user_id}");
            $handler->subselect("email", "SELECT email FROM tbl_user WHERE id={user_id}");
            $handler->subselect("lang", "SELECT lang FROM tbl_user WHERE id={user_id}");
            $handler->subselect("state", "SELECT state FROM tbl_user WHERE id={user_id}");
            $handler->column_pattern('full_name', '<a target="_blank" href="http://www.dogforshow.com/handler-profile?id={id}">{full_name}</a>');
            $handler->no_editor('handler_description');
            $this->generateCommentsByProfile($handler);
            return $handler->render();
        }
    }

    function generateDogs($form = NULL) {
        if ($form != NULL) {
            $dog = $form->nested_table($this->getTranslatedText("Dogs"), "id", "tbl_dogs", "user_id");
            $dog->table_name("Dogs");
            $dog->order_by('id', 'DESC');
            $dog->columns("registration_date, dog_name, country, breed_name, date_of_birth, offer_for_sell, offer_for_mating, Dog, Bitch");
            $dog->label('offer_for_sell', 'Sell');
            $dog->label('offer_for_mating', 'Mating');
            $dog->subselect('Dog', "if({dog_gender}='Dog',1,0)");
            $dog->subselect('Bitch', "if({dog_gender}='Bitch',1,0)");
            $dog->sum('offer_for_sell, offer_for_mating, Dog, Bitch');
            $dog->highlight('offer_for_sell', '>', 0, '#B4E274');
            $dog->highlight('offer_for_mating', '>', 0, '#B4E274');
            $dog->highlight('Dog', '>', 0, '#428bca');
            $dog->highlight('Bitch', '>', 0, '#FFD6D6');
            $dog->column_pattern('dog_name', '<a target="_blank" href="http://www.dogforshow.com/dog-profile?id={id}">{dog_name}</a>');
        } else {
            $dog = blueticket_forms::get_instance();
            $dog->table("tbl_dogs");
            $dog->table_name("Dogs");
            $dog->order_by('id', 'DESC');
            $dog->columns("registration_date, dog_name, owner_name, country, breed_name, date_of_birth, offer_for_sell, offer_for_mating, Dog, Bitch");
            $dog->label('offer_for_sell', 'Sell');
            $dog->label('offer_for_mating', 'Mating');
            $dog->subselect('Dog', "if({dog_gender}='Dog',1,0)");
            $dog->subselect('Bitch', "if({dog_gender}='Bitch',1,0)");
            $dog->subselect('owner_name', "SELECT concat(name, ' ', surname) from tbl_user WHERE id={user_id}");
            $dog->sum('offer_for_sell, offer_for_mating, Dog, Bitch');
            $dog->highlight('offer_for_sell', '>', 0, '#B4E274');
            $dog->highlight('offer_for_mating', '>', 0, '#B4E274');
            $dog->highlight('Dog', '>', 0, '#428bca');
            $dog->highlight('Bitch', '>', 0, '#FFD6D6');
            $dog->column_pattern('dog_name', '<a target="_blank" href="http://www.dogforshow.com/dog-profile?id={id}">{dog_name}</a>');
            return $dog->render();
        }
    }

    function generateDogsByProfile($form = NULL) {
        $dog = $form->nested_table($this->getTranslatedText("Dogs"), "id", "tbl_dogs", "profile_id");
        $dog->table_name("Dogs");
        $dog->order_by('id', 'DESC');
        $dog->columns("registration_date, dog_name, country, breed_name, date_of_birth, offer_for_sell, offer_for_mating, Dog, Bitch");
        $dog->label('offer_for_sell', 'Sell');
        $dog->label('offer_for_mating', 'Mating');
        $dog->subselect('Dog', "if({dog_gender}='Dog',1,0)");
        $dog->subselect('Bitch', "if({dog_gender}='Bitch',1,0)");
        $dog->sum('offer_for_sell, offer_for_mating, Dog, Bitch');
        $dog->highlight('offer_for_sell', '>', 0, '#B4E274');
        $dog->highlight('offer_for_mating', '>', 0, '#B4E274');
        $dog->highlight('Dog', '>', 0, '#428bca');
        $dog->highlight('Bitch', '>', 0, '#FFD6D6');
        $dog->column_pattern('dog_name', '<a target="_blank" href="http://www.dogforshow.com/dog-profile?id={id}">{dog_name}</a>');
    }

    function generatePuppies($form = NULL) {
        if ($form != NULL) {
            $dog = $form->nested_table($this->getTranslatedText("Puppies"), "id", "tbl_puppies", "user_id");
            $dog->table_name("Puppies");
            $dog->order_by('id', 'DESC');
            $dog->columns("puppy_date_time, puppy_name, owner_name, country, breed_name, date_of_birth, puppy_state, Dog, Bitch");
            $dog->label('offer_for_sell', 'Sell');
            $dog->label('offer_for_mating', 'Mating');
            $dog->subselect('Dog', "if({puppy_gender}='Dog',1,0)");
            $dog->subselect('Bitch', "if({puppy_gender}='Bitch',1,0)");
            $dog->subselect('owner_name', "SELECT concat(name, ' ', surname) from tbl_user WHERE id={user_id}");
            $dog->no_editor('puppy_description');
            $dog->sum('Dog, Bitch');
            $dog->highlight('Dog', '>', 0, '#428bca');
            $dog->highlight('Bitch', '>', 0, '#FFD6D6');
            $dog->column_pattern('puppy_name', '<a target="_blank" href="http://www.dogforshow.com/puppy-profile?id={id}">{puppy_name}</a>');
        } else {
            $dog = blueticket_forms::get_instance();
            $dog->table("tbl_puppies");
            $dog->table_name("Puppies");
            $dog->order_by('id', 'DESC');
            $dog->columns("puppy_date_time, puppy_name, owner_name, country, breed_name, date_of_birth, puppy_state, Dog, Bitch");
            $dog->label('offer_for_sell', 'Sell');
            $dog->label('offer_for_mating', 'Mating');
            $dog->subselect('Dog', "if({puppy_gender}='Dog',1,0)");
            $dog->subselect('Bitch', "if({puppy_gender}='Bitch',1,0)");
            $dog->subselect('owner_name', "SELECT concat(name, ' ', surname) from tbl_user WHERE id={user_id}");
            $dog->sum('Dog, Bitch');
            $dog->highlight('Dog', '>', 0, '#428bca');
            $dog->highlight('Bitch', '>', 0, '#FFD6D6');
            $dog->no_editor('puppy_description');
            $dog->column_pattern('puppy_name', '<a target="_blank" href="http://www.dogforshow.com/puppy-profile?id={id}">{puppy_name}</a>');
            return $dog->render();
        }
    }

    function generatePuppiesByProfile($form = NULL) {
        $dog = $form->nested_table($this->getTranslatedText("Puppies"), "id", "tbl_puppies", "profile_id");
        $dog->table_name("Puppies");
        $dog->order_by('id', 'DESC');
        $dog->columns("puppy_date_time, puppy_name, country, breed_name, date_of_birth, puppy_state, Dog, Bitch");
        $dog->label('offer_for_sell', 'Sell');
        $dog->label('offer_for_mating', 'Mating');
        $dog->subselect('Dog', "if({puppy_gender}='Dog',1,0)");
        $dog->subselect('Bitch', "if({puppy_gender}='Bitch',1,0)");
        $dog->sum('Dog, Bitch');
        $dog->highlight('Dog', '>', 0, '#428bca');
        $dog->highlight('Bitch', '>', 0, '#FFD6D6');
        $dog->no_editor('puppy_description');
        $dog->column_pattern('puppy_name', '<a target="_blank" href="http://www.dogforshow.com/puppy-profile?id={id}">{puppy_name}</a>');
    }

    function generatePayments($form = NULL, $only_active = 0) {
        if ($form != NULL) {
            $payment = $form->nested_table($this->getTranslatedText("Payments"), "id", "tbl_payments", "user_id");
            $payment->table_name("Payments");
            $payment->order_by('id', 'DESC');
            $payment->columns("payment_datetime, user_id, full_name, state, amount, authorized, type, status");
            $payment->subselect("full_name", "SELECT concat(name, ' ', surname) FROM tbl_user WHERE id={user_id}");
            $payment->subselect("state", "SELECT state FROM tbl_user WHERE id={user_id}");
            $payment->subselect("authorized", "IF({status}>0,{amount},0)");
            $payment->highlight_row('status', '>', 0, '#B4E274');
            $payment->highlight_row('status', '=', 0, '#FFD6D6');
            $payment->sum('amount,authorized');
        } else {
            echo '<a href="?report=active_payments" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Only active</a>';
            $payment = blueticket_forms::get_instance();
            $payment->table("tbl_payments");
            if ($only_active > 0)
                $payment->where("status > 0");
            $payment->table_name("Payments");
            $payment->order_by('id', 'DESC');
            $payment->columns("payment_datetime, user_id, full_name, state, amount, authorized, type, status");
            $payment->subselect("full_name", "SELECT concat(name, ' ', surname) FROM tbl_user WHERE id={user_id}");
            $payment->subselect("state", "SELECT state FROM tbl_user WHERE id={user_id}");
            $payment->subselect("authorized", "IF({status}>0,{amount},0)");
            $payment->highlight_row('status', '>', 0, '#B4E274');
            $payment->highlight_row('status', '=', 0, '#FFD6D6');
            $payment->sum('amount,authorized');
            return $payment->render();
        }
    }

    function generateTimeline() {
        $timeline = blueticket_forms::get_instance();
        $timeline->table("tbl_timeline");
        $timeline->table_name("Timeline");
        $timeline->order_by('id', 'DESC');
        $timeline->columns("date, profile_id, event_id, event_description, event_type, type");
        $timeline->subselect("type", "SELECT description FROM tbl_timeline_events_types WHERE id={event_type}");
        $timeline->no_editor('event_description, event_image');
        $this->generateCommentsByTimeline($timeline);

        return $timeline->render();
    }

    function generateTimelineByLike($form) {
        $timeline = $form->nested_table($this->getTranslatedText("Timeline"), "timeline_id", "tbl_timeline", "id");
        $timeline->table_name("Timeline");
        $timeline->order_by('id', 'DESC');
        $timeline->columns("date, profile_id, event_id, event_description, event_type, type");
        $timeline->subselect("type", "SELECT description FROM tbl_timeline_events_types WHERE id={event_type}");
        $timeline->no_editor('event_description, event_image');
        $this->generateCommentsByTimeline($timeline);
    }

    function generateTimelineEventsTypes() {
        $timeline = blueticket_forms::get_instance();
        $timeline->table("tbl_timeline_events_types");
        $timeline->table_name("Timeline events types");
        $timeline->order_by('id', 'ASC');
        return $timeline->render();
    }

    function generateTranslate() {
        $form = blueticket_forms::get_instance();

        $form->table("tbl_translate");
        $form->table_name("Translate");
        $form->default_tab("Translate");
        $form->order_by('id', 'DESC');
        $form->columns("text_to_translate, translated_text_en, translated_text_sk, translated_text_cz, translated_text_de, translated_text_hu, translated_text_ru");
        $form->no_editor('text_to_translate, translated_text_en, translated_text_sk, translated_text_cz, translated_text_de, translated_text_hu, translated_text_ru');
        return $form->render();
    }

    function generateRouter() {
        $form = blueticket_forms::get_instance();

        $form->table("tbl_global_router");
        $form->table_name("Global routing");
        $form->default_tab("Global routing");
        $form->order_by('presenter, action, lang', 'ASC');
        $form->columns("presenter, action, title, description, image_url, lang");
        $form->no_editor('presenter, action, title, description, image_url, lang');
        return $form->render();
    }

    function generateMenu() {
        $return = '<div style="width:100%; height:50px;padding-left:5px">';

        $return .= '<a href="?report=users" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Users</a>';
        $return .= '<a href="?report=users_wo_profile" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Users w/o profile</a>';
        $return .= '<a href="?report=kennels" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Kennels</a>';
        $return .= '<a href="?report=owners" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Owners</a>';
        $return .= '<a href="?report=handlers" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Handlers</a>';
        $return .= '<a href="?report=dogs" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Dogs</a>';
        $return .= '<a href="?report=puppies" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Puppies</a>';
        $return .= '<a href="?report=payments" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Payments</a>';
        $return .= '<a href="?report=premium" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Premium</a>';
        $return .= '<a href="?report=messages" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Messages</a>';
        $return .= '<a href="?report=timeline" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Timeline</a>';
        $return .= '<a href="?report=comments" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Comments</a>';
        $return .= '<a href="?report=likes" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Likes</a>';
        $return .= '<a href="?report=timeline_events_types" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Events types</a>';
        $return .= '<a href="?report=translate" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Translate</a>';
        $return .= '<a href="?report=photos" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Photos</a>';
        $return .= '<a href="?report=videos" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Videos</a>';
        $return .= '<a href="?report=router" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Router</a>';
//        $return .= '<a href="?report=forms" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Forms</a>';
//        $return .= '<a href="?report=movements" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Pohyby</a>';
//        $return .= '<a href="?report=payments" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Platby</a>';
//        $return .= '<a href="?report=partners" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Partneri</a>';
//        $return .= '<a href="?report=doctypes" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Typy dokladov</a>';
//        $return .= '<a href="?report=desks" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Rozlozenia</a>';
//        $return .= '<a href="?report=groups" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Skupiny</a>';
//        $return .= '<a href="?report=units" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Jednotky</a>';
//        $return .= '<a href="?report=trans" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Preklad</a>';
//        $return .= '<a href="?report=users" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Uzivatelia</a>';
//        $return .= '<a href="?report=logout" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Odhlásiť</a>';

        $return .= '</div>';

        $return .= '<div style="clear:both"></div>';

        return $return;
    }

}

?>
