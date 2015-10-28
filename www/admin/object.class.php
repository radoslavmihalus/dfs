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

    function generateUsers() {
        $form = blueticket_forms::get_instance();

        //$form= new blueticket_forms();

        $form->table("tbl_user");
        $form->table_name("Users");
        $form->default_tab("Users");
        $form->columns("registration_date, active, full_name, email, state, lang, premium_expiry_date, kennels, owners, handlers, dogs");

        $form->label("premium_expiry_date", "PED");

        $form->order_by('id', 'DESC');

        $form->subselect('full_name', "concat({name},' ',{surname})");
        $form->subselect('kennels', 'SELECT COUNT(*) FROM tbl_userkennel WHERE user_id = {id}');
        $form->subselect('owners', 'SELECT COUNT(*) FROM tbl_userowner WHERE user_id = {id}');
        $form->subselect('handlers', 'SELECT COUNT(*) FROM tbl_userhandler WHERE user_id = {id}');
        $form->subselect('dogs', 'SELECT COUNT(*) FROM tbl_dogs WHERE user_id = {id}');

        $form->highlight_row('active', '=', 0, '#FFD6D6');
        $form->highlight('kennels', '>', 0, '#B4E274');
        $form->highlight('kennels', '=', 0, '#EDEBE4');
        $form->highlight('owners', '>', 0, '#B4E274');
        $form->highlight('owners', '=', 0, '#EDEBE4');
        $form->highlight('handlers', '>', 0, '#B4E274');
        $form->highlight('handlers', '=', 0, '#EDEBE4');
        $form->highlight('dogs', '>', 0, '#B4E274');
        $form->highlight('dogs', '=', 0, '#EDEBE4');

        $form->sum('active,kennels,owners,handlers,dogs');

        $form->label("kennels", "Ken");
        $form->label("handlers", "Han");
        $form->label("owners", "Own");
        $form->label("dogs", "Dog");

        $this->generateKennels($form);
        $this->generateOwners($form);
        $this->generateHandlers($form);
        $this->generateDogs($form);
        $this->generatePayments($form);

        return $form->render();
    }

    function generateKennels($form = NULL) {
        if ($form != NULL) {
            $kennel = $form->nested_table($this->getTranslatedText("Kennels"), "id", "tbl_userkennel", "user_id");
            $kennel->table_name("Kennels");
            $kennel->order_by('id', 'DESC');
            $kennel->columns("kennel_create_date, id, user_id, kennel_name, full_name, email, lang, state, dogs");
            $kennel->subselect("full_name", "SELECT concat(name,' ',surname) FROM tbl_user WHERE id={user_id}");
            $kennel->subselect("email", "SELECT email FROM tbl_user WHERE id={user_id}");
            $kennel->subselect("lang", "SELECT lang FROM tbl_user WHERE id={user_id}");
            $kennel->subselect("state", "SELECT state FROM tbl_user WHERE id={user_id}");
            $kennel->subselect("dogs", "SELECT COUNT(*) FROM tbl_dogs WHERE profile_id={id}");
            $kennel->column_pattern('kennel_name', '<a target="_blank" href="http://www.dogforshow.com/kennel-profile?id={id}">{kennel_name}</a>');
            $kennel->no_editor('kennel_description');
            $kennel->highlight('dogs', '>', 0, '#B4E274');
            $kennel->sum('dogs');
        } else {
            $kennel = blueticket_forms::get_instance();
            $kennel->table("tbl_userkennel");
            $kennel->table_name("Kennels");
            $kennel->default_tab("Kennels");
            $kennel->order_by('id', 'DESC');
            $kennel->columns("kennel_create_date, id, user_id, kennel_name, full_name, email, lang, state, dogs");
            $kennel->subselect("full_name", "SELECT concat(name,' ',surname) FROM tbl_user WHERE id={user_id}");
            $kennel->subselect("email", "SELECT email FROM tbl_user WHERE id={user_id}");
            $kennel->subselect("lang", "SELECT lang FROM tbl_user WHERE id={user_id}");
            $kennel->subselect("state", "SELECT state FROM tbl_user WHERE id={user_id}");
            $kennel->subselect("dogs", "SELECT COUNT(*) FROM tbl_dogs WHERE profile_id={id}");
            $kennel->column_pattern('kennel_name', '<a target="_blank" href="http://www.dogforshow.com/kennel-profile?id={id}">{kennel_name}</a>');
            $kennel->no_editor('kennel_description');
            $kennel->highlight('dogs', '>', 0, '#B4E274');
            $kennel->sum('dogs');
            $this->generateDogsByProfile($kennel);

            return $kennel->render();
        }
    }

    function generateMessages() {
        $form = blueticket_forms::get_instance();

        $form->table("tbl_messages");
        $form->table_name("Messages");
        $form->columns("message_datetime, from, to, message, from_user_id, to_user_id, from_profile_id, to_profile_id");
        $form->subselect("from", "SELECT concat(name, ' ', surname) FROM tbl_user WHERE id={from_user_id}");
        $form->subselect("to", "SELECT concat(name, ' ', surname) FROM tbl_user WHERE id={to_user_id}");
        $form->no_editor('message');

        $form->order_by('id', 'DESC');

        return $form->render();
    }

    function generateOwners($form = NULL) {
        if ($form != NULL) {
            $owner = $form->nested_table($this->getTranslatedText("Owners"), "id", "tbl_userowner", "user_id");
            $owner->table_name("Owners");
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

            return $owner->render();
        }
    }

    function generateHandlers($form = NULL) {
        if ($form != NULL) {
            $handler = $form->nested_table($this->getTranslatedText("Handlers"), "id", "tbl_userhandler", "user_id");
            $handler->table_name("Handlers");
            $handler->order_by('id', 'DESC');
            $handler->columns("handler_create_date, id, user_id, full_name, email, state, lang");
            $handler->subselect("full_name", "SELECT concat(name,' ',surname) FROM tbl_user WHERE id={user_id}");
            $handler->subselect("email", "SELECT email FROM tbl_user WHERE id={user_id}");
            $handler->subselect("lang", "SELECT lang FROM tbl_user WHERE id={user_id}");
            $handler->subselect("state", "SELECT state FROM tbl_user WHERE id={user_id}");
            $handler->column_pattern('full_name', '<a target="_blank" href="http://www.dogforshow.com/handler-profile?id={id}">{full_name}</a>');
            $handler->no_editor('handler_description');
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

    function generatePayments($form = NULL) {
        if ($form != NULL) {
            $payment = $form->nested_table($this->getTranslatedText("Payments"), "id", "tbl_payments", "user_id");
            $payment->table_name("Payments");
            $payment->order_by('id', 'DESC');
            $payment->columns("payment_datetime, user_id, full_name, amount, type, status");
            $payment->subselect("full_name", "SELECT concat(name, ' ', surname) FROM tbl_user WHERE id={user_id}");
            $payment->highlight_row('status', '>', 0, '#B4E274');
            $payment->highlight_row('status', '=', 0, '#FFD6D6');
        } else {
            $payment = blueticket_forms::get_instance();
            $payment->table("tbl_payments");
            $payment->table_name("Payments");
            $payment->order_by('id', 'DESC');
            $payment->columns("payment_datetime, user_id, full_name, amount, type, status");
            $payment->subselect("full_name", "SELECT concat(name, ' ', surname) FROM tbl_user WHERE id={user_id}");
            $payment->highlight_row('status', '>', 0, '#B4E274');
            $payment->highlight_row('status', '=', 0, '#FFD6D6');
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

        return $timeline->render();
    }

    function generateTimelineEventsTypes() {
        $timeline = blueticket_forms::get_instance();
        $timeline->table("tbl_timeline_events_types");
        $timeline->table_name("Timeline events types");
        $timeline->order_by('id', 'ASC');
        return $timeline->render();
    }

    function generateMenu() {
        $return = '<div style="width:100%; height:50px;padding-left:5px">';

        $return .= '<a href="?report=users" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Users</a>';
        $return .= '<a href="?report=kennels" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Kennels</a>';
        $return .= '<a href="?report=owners" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Owners</a>';
        $return .= '<a href="?report=handlers" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Handlers</a>';
        $return .= '<a href="?report=dogs" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Dogs</a>';
        $return .= '<a href="?report=payments" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Payments</a>';
        $return .= '<a href="?report=messages" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Messages</a>';
        $return .= '<a href="?report=timeline" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Timeline</a>';
        $return .= '<a href="?report=timeline_events_types" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Events types</a>';
        $return .= '<a href="?report=forms" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Forms</a>';
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
