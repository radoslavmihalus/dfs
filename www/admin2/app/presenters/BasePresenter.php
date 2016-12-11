<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form,
    Nette\Mail\Message,
    Nette\Mail\SendmailMailer,
    Ublaboo\DataGrid;

abstract class BasePresenter extends Nette\Application\UI\Presenter {

    public $translator;
    public $database;

    /** @persistent */
    public $form_name;
    
    /** @inject
     * 
     * @var \MyDbService
     */
    public $dbService;
    
    public function __construct(\Nette\Database\Context $database) {
        parent::__construct();
        $this->database = $database;
        
        $conn = $this->database->getConnection();
                        
        if (strlen($this->form_name) > 0) {
            
        } else {
            $this->form_name = "NULL";
        }
    }

    public function checkPermissions($form_name) {
        return TRUE;
    }

    public function startup() {
        parent::startup();

        $lang = "en";
        
        if($this->getUser()->loggedIn)
            $lang = $this->getUser()->getIdentity()->lang;
        
        $this->translator = new Translator($this->database, $lang);
        $this->template->setTranslator($this->translator);
        
        if ($this->getPresenter()->name != "login" && $this->getPresenter()->name != "display") {
            if (!$this->getUser()->loggedIn)
                $this->redirect("login:login");
        }

        $menu_items = $this->database->table("blueticket_menu")->order("ordering ASC")->fetchAll();

        $this->template->menu_items = $menu_items;
        $this->template->username = $this->getUser()->getIdentity()->username;
    }

    public function handleGetDate() {
        echo date("d.m.Y");
        $this->terminate();
    }

    public function handleGetTime() {
        echo date("H:i:s");
        $this->terminate();
    }

    function translate($message) {
        if ($this->getUser()->loggedIn)
            return $this->translator->translate($message);
        else
            return $this->translator->translate($message);
    }

    function handleLogout() {
        $this->getUser()->logout(TRUE);
        $this->form_name = "NULL";
        $this->redirect("this");
    }

    public function handleInstallx() {
        exit;

        echo '<br/><br/><br/><br/><pre>';

        echo '</pre>';

        $types_numeric = ["INT", "TINYINT", "SMALLINT", "MEDIUMINT", "BIGINT", "FLOAT", "DOUBLE", "DECIMAL"];
        $types_dates = ["DATE", "DATETIME", "TIMESTAMP", "TIME", "YEAR"];
        $types_strings = ["CHAR", "VARCHAR", "BLOB", "TEXT", "TINYBLOB", "TINYTEXT", "MEDIUMBLOB", "MEDIUMTEXT", "LONGBLOB", "LONGTEXT", "ENUM"];
        $custom_types = ["FILEUPLOAD", "FK_RELATION", "IMAGEUPLOAD", "RELATION", "SUBSELECT"];

        $this->database->query("DROP TABLE IF EXISTS blueticket_forms");
        $this->database->query("DROP TABLE IF EXISTS blueticket_forms_meta");
        $this->database->query("DROP TABLE IF EXISTS blueticket_forms_fields");
        $this->database->query("DROP TABLE IF EXISTS blueticket_forms_fields_meta");
        $this->database->query("DROP TABLE IF EXISTS blueticket_forms_fields_types");
        $this->database->query("DROP TABLE IF EXISTS blueticket_nested_forms");

        $this->database->query("CREATE TABLE IF NOT EXISTS blueticket_forms"
                . "(id BIGINT AUTO_INCREMENT NOT NULL,"
                . "form_name VARCHAR(255) NULL,"
                . "table_name VARCHAR(255) NULL,"
                . "caption VARCHAR(255) NULL,"
                . "default_tab VARCHAR(255) NULL,"
                . "default_where MEDIUMTEXT NULL,"
                . "default_order_by MEDIUMTEXT NULL,"
                . "search_pattern_before VARCHAR(255) NULL DEFAULT '%',"
                . "search_pattern_after VARCHAR(255) NULL DEFAULT '%',"
                . "allow_view TINYINT(1) DEFAULT 1,"
                . "allow_add TINYINT(1) DEFAULT 1,"
                . "allow_edit TINYINT(1) DEFAULT 1,"
                . "allow_delete TINYINT(1) DEFAULT 1,"
                . "allow_print TINYINT(1) DEFAULT 1,"
                . "allow_xls TINYINT(1) DEFAULT 1,"
                . "allow_csv TINYINT(1) DEFAULT 1,"
                . "allow_list TINYINT(1) DEFAULT 1,"
                . "allow_limit_list TINYINT(1) DEFAULT 1,"
                . "allow_numbers TINYINT(1) DEFAULT 1,"
                . "allow_pagination TINYINT(1) DEFAULT 1,"
                . "allow_sort TINYINT(1) DEFAULT 1,"
                . "allow_title TINYINT(1) DEFAULT 1,"
                . "allow_search TINYINT(1) DEFAULT 1,"
                . "PRIMARY KEY (id))");

        $this->database->query("CREATE TABLE IF NOT EXISTS blueticket_forms_meta"
                . "(id BIGINT AUTO_INCREMENT NOT NULL,"
                . "form_id BIGINT NULL,"
                . "meta_key VARCHAR(50) NULL,"
                . "meta_value MEDIUMTEXT NULL,"
                . "KEY `meta_key_idx` (`meta_key`),"
                . "PRIMARY KEY (id))");

        $this->database->query("CREATE TABLE IF NOT EXISTS blueticket_forms_fields"
                . "(id BIGINT AUTO_INCREMENT NOT NULL,"
                . "form_id BIGINT NULL,"
                . "field_order BIGINT NULL, "
                . "field_name VARCHAR(100) NULL, "
                . "field_type VARCHAR(100) NULL,"
                . "field_size VARCHAR(100) NULL,"
                . "caption VARCHAR(255) NULL,"
                . "field_list TINYINT(1) DEFAULT 1,"
                . "field_read TINYINT(1) DEFAULT 1,"
                . "field_update TINYINT(1) DEFAULT 1,"
                . "field_search TINYINT(1) DEFAULT 1,"
                . "field_noeditor TINYINT(1) DEFAULT 1,"
                . "field_sum TINYINT(1) DEFAULT 0,"
                . "field_style MEDIUMTEXT NULL,"
                . "field_subselect MEDIUMTEXT NULL,"
                . "relation_target_table VARCHAR(255) NULL,"
                . "relation_target_id VARCHAR(255) NULL,"
                . "relation_target_name MEDIUMTEXT NULL,"
                . "relation_where MEDIUMTEXT NULL,"
                . "relation_order_by MEDIUMTEXT NULL,"
                . "relation_multi TINYINT(1) DEFAULT 0,"
                . "relation_concat_separator VARCHAR(50) NULL,"
                . "relation_tree MEDIUMTEXT NULL,"
                . "relation_depend_field VARCHAR(255) NULL,"
                . "relation_depend_on VARCHAR(255) NULL,"
                . "fk_relation_label VARCHAR(255) NULL,"
                . "fk_relation_field VARCHAR(255) NULL,"
                . "fk_relation_fk_table VARCHAR(255) NULL,"
                . "fk_relation_in_fk_field VARCHAR(255) NULL,"
                . "fk_relation_out_fk_field VARCHAR(255) NULL,"
                . "fk_relation_rel_tbl VARCHAR(255) NULL,"
                . "fk_relation_rel_field VARCHAR(255) NULL,"
                . "fk_relation_rel_name MEDIUMTEXT NULL,"
                . "fk_relation_rel_where MEDIUMTEXT NULL,"
                . "fk_relation_rel_orderby MEDIUMTEXT NULL,"
                . "fk_relation_rel_concat_separator VARCHAR(50) NULL,"
                . "fk_relation_before VARCHAR(50) NULL,"
                . "fk_relation_add_data MEDIUMTEXT NULL,"
                . "PRIMARY KEY (id))");

        $this->database->query("CREATE TABLE IF NOT EXISTS blueticket_forms_fields_meta"
                . "(id BIGINT AUTO_INCREMENT NOT NULL,"
                . "field_id BIGINT NULL,"
                . "meta_key VARCHAR(50) NULL,"
                . "meta_value MEDIUMTEXT NULL,"
                . "KEY `meta_key_idx` (`meta_key`),"
                . "PRIMARY KEY (id))");

        $this->database->query("CREATE TABLE IF NOT EXISTS blueticket_forms_fields_types"
                . "(id BIGINT AUTO_INCREMENT NOT NULL,"
                . "name VARCHAR(50) NULL,"
                . "subtype VARCHAR(50) NULL,"
                . "PRIMARY KEY (id))");

        $this->database->query("CREATE TABLE IF NOT EXISTS blueticket_nested_forms"
                . "(id BIGINT AUTO_INCREMENT NOT NULL,"
                . "form_id BIGINT NULL,"
                . "nested_form_id BIGINT NULL,"
                . "form_field_name VARCHAR(100) NULL,"
                . "nested_form_field_name VARCHAR(100) NULL,"
                . "PRIMARY KEY (id))");

        foreach ($types_numeric as $type) {
            $data = array();
            $data['name'] = $type;
            $data['subtype'] = 'NUMERIC';
            $this->database->table("blueticket_forms_fields_types")->insert($data);
        }

        foreach ($types_dates as $type) {
            $data = array();
            $data['name'] = $type;
            $data['subtype'] = 'DATES';
            $this->database->table("blueticket_forms_fields_types")->insert($data);
        }

        foreach ($types_strings as $type) {
            $data = array();
            $data['name'] = $type;
            $data['subtype'] = 'STRINGS';
            $this->database->table("blueticket_forms_fields_types")->insert($data);
        }

        foreach ($custom_types as $type) {
            $data = array();
            $data['name'] = $type;
            $data['subtype'] = 'CUSTOM';
            $this->database->table("blueticket_forms_fields_types")->insert($data);
        }

        $tables = $this->database->getStructure()->getTables();

        $blueticket_forms_id = 0;
        $blueticket_forms_fields_id = 0;
        $blueticket_nested_forms_id = 0;
        $blueticket_forms_fields_meta_id = 0;
        $blueticket_forms_meta_id = 0;

        foreach ($tables as $table) {
            $table_name = $table['name'];

            $data = array();
            $data['form_name'] = $table_name;
            $data['table_name'] = $table_name;
            $data['caption'] = $table_name;
            $data['default_tab'] = $table_name;

            $form_id = 0;
            $this->database->table("blueticket_forms")->insert($data);
            $form = $this->database->table("blueticket_forms")->where("form_name=?", $table_name)->fetch();
            $form_id = $form->id;

            $columns = $this->database->getStructure()->getColumns($table_name);

            foreach ($columns as $column) {
                $column_name = $column['name'];

                $data = array();
                $data['form_id'] = $form_id;
                $data['field_name'] = $column_name;
                $data['field_type'] = $column['nativetype'];
                $data['caption'] = $column_name;

                if ($table_name == "blueticket_forms_fields" && $column_name == "field_type") {
                    $data['field_type'] = "RELATION";
                    $data['relation_target_table'] = "blueticket_forms_fields_types";
                    $data['relation_target_id'] = "name";
                    $data['relation_target_name'] = "name";
                }

                $this->database->table("blueticket_forms_fields")->insert($data);
            }

            if ($table_name == "blueticket_forms")
                $blueticket_forms_id = $form_id;

            if ($table_name == "blueticket_forms_fields")
                $blueticket_forms_fields_id = $form_id;

            if ($table_name == "blueticket_nested_forms")
                $blueticket_nested_forms_id = $form_id;

            if ($table_name == "blueticket_forms_meta")
                $blueticket_forms_meta_id = $form_id;

            if ($table_name == "blueticket_forms_fields_meta")
                $blueticket_forms_fields_meta_id = $form_id;

            if ($blueticket_forms_fields_id > 0 && $blueticket_forms_id > 0 && $blueticket_nested_forms_id > 0 && $blueticket_forms_meta_id > 0 && $blueticket_forms_fields_meta_id > 0) {
                $data = array();
                $data['form_id'] = $blueticket_forms_id;
                $data['nested_form_id'] = $blueticket_forms_fields_id;
                $data['form_field_name'] = "id";
                $data['nested_form_field_name'] = "form_id";
                $this->database->table("blueticket_nested_forms")->insert($data);

                $data = array();
                $data['form_id'] = $blueticket_forms_id;
                $data['nested_form_id'] = $blueticket_forms_meta_id;
                $data['form_field_name'] = "id";
                $data['nested_form_field_name'] = "form_id";
                $this->database->table("blueticket_nested_forms")->insert($data);

                $data = array();
                $data['form_id'] = $blueticket_forms_id;
                $data['nested_form_id'] = $blueticket_nested_forms_id;
                $data['form_field_name'] = "id";
                $data['nested_form_field_name'] = "form_id";
                $this->database->table("blueticket_nested_forms")->insert($data);

                $data = array();
                $data['form_id'] = $blueticket_forms_fields_id;
                $data['nested_form_id'] = $blueticket_forms_fields_meta_id;
                $data['form_field_name'] = "id";
                $data['nested_form_field_name'] = "field_id";
                $this->database->table("blueticket_nested_forms")->insert($data);

                $blueticket_forms_fields_id = 0;
                $blueticket_forms_id = 0;
                $blueticket_nested_forms_id = 0;
                $blueticket_forms_fields_meta_id = 0;
                $blueticket_forms_meta_id = 0;
            }
        }

        $this->database->query("UPDATE blueticket_forms_fields SET field_order = id");
    }

    protected function createComponentItemsGrid() {
        $grid = new \itemsGrid($this->database, $this->getUser(), $this->form_name, $this->dbService);
        return $grid;
    }

}

class Translator implements Nette\Localization\ITranslator {

    private $database;
    public $lang;

    public function __construct(Nette\Database\Context $database, $lang) {
        $this->lang = $lang;
        $this->database = $database;

        $this->database->query("CREATE TABLE IF NOT EXISTS blueticket_translate(`id` BIGINT NOT NULL AUTO_INCREMENT, `text_to_translate` MEDIUMTEXT, `translated_text` MEDIUMTEXT, `lang` VARCHAR(20), PRIMARY KEY(`id`))");
    }

    public function translate($message, $count = NULL) {
        if (strlen($message) > 0) {
            $row = $this->database->table("blueticket_translate")->where("lang=?", $this->lang)->where("text_to_translate=?", $message)->fetch();

            if ($row)
                $message = $row->translated_text;
            else {
                $data = array();
                $data['text_to_translate'] = $message;
                $data['translated_text'] = $message;
                $data['lang'] = $this->lang;

                $this->database->table("blueticket_translate")->insert($data);
            }
        }
        return $message;
    }

}

?>