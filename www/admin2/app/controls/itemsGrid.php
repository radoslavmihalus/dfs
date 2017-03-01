<?php

use Nette\Application\UI;

class itemsGrid extends UI\Control {

    public $user;
    public $database;
    public $form_name;
    public $dbService;

    public function __construct(\Nette\Database\Context $database, \Nette\Security\User $user, $form_name, $myDbService) {
        $this->database = $database;
        $this->user = $user;
        $this->form_name = $form_name;

        $this->dbService = $myDbService;
    }

    public function render() {
        if ($this->form_name != 'NULL') {
            $this->template->setFile(__DIR__ . "/itemsGrid.latte");
            $this->template->itemsGrid = $this->returnGrid();
            $this->template->render();
        }
    }

    public function handleRefresh() {
        if ($this->presenter->isAjax())
            $this->redrawControl();
    }

    public function getTranslatedText($par_Text) {
        return $this->presenter->translator->translate($par_Text);
        //return $par_Text;
    }

    public function returnGrid(blueticket_forms $par_parent = NULL, $nested_id = 0) {
        $i = 0;

        if ($par_parent == NULL)
            $form = $this->database->table("blueticket_forms")->where("form_name=?", $this->form_name)->fetch();
        else {
            $nested_form = $this->database->table("blueticket_nested_forms")->where("id=?", $nested_id)->fetch();
            $form = $this->database->table("blueticket_forms")->where("id=?", $nested_form->nested_form_id)->fetch();
        }

        if ($par_parent == NULL) {
            $grid = blueticket_forms::get_instance();
            $grid->connection($this->dbService->user, $this->dbService->pass, $this->dbService->dbname, $this->dbService->host);
        } else {
            $grid = $par_parent->nested_table($form->caption, $nested_form->form_field_name, $form->table_name, $nested_form->nested_form_field_name);
            $grid->connection($this->dbService->user, $this->dbService->pass, $this->dbService->dbname, $this->dbService->host);
        }

        $grid instanceof blueticket_forms;

        $grid->language($this->presenter->translator->lang);

        $grid->table($form->table_name);
        $grid->table_name($this->presenter->translate($form->caption));

        if (strlen($form->default_tab) > 0)
            $grid->default_tab($this->presenter->translate($form->caption));

        if (strlen($form->default_where) > 0) {
            try {
                $user_id = $this->presenter->getUser()->getId();
            } catch (\Exception $ex) {
                $user_id = 0;
            }
            try {
                $group_id = $this->presenter->getUser()->getIdentity()->group_id;
            } catch (\Exception $ex) {
                $group_id = 0;
            }
            $grid->where(str_replace('{$group_id}', $group_id, str_replace('{$user_id}', $user_id, str_replace('{$lang}', $this->presenter->translator->lang, $form->default_where))));
            $grid->where(str_replace('{$lang}', $this->presenter->translator->lang, $form->default_where));
            $grid->where(str_replace('{$lang}', $this->presenter->translator->lang, $form->default_where));
        }

        if (strlen($form->default_order_by) > 0) {
            $order_by = explode("|", $form->default_order_by);
            if (count($order_by) > 1)
                $grid->order_by($order_by[0], $order_by[1]);
            else
                $grid->order_by($form->default_order_by);
        }

        if ($form->allow_view == 0)
            $grid->unset_view();

        if ($form->allow_add == 0)
            $grid->unset_add();

        if ($form->allow_edit == 0)
            $grid->unset_edit();

        if ($form->allow_delete == 0)
            $grid->unset_remove();

        if ($form->allow_print == 0)
            $grid->unset_print();

        if ($form->allow_xls == 0)
            $grid->unset_xls();

        if ($form->allow_csv == 0)
            $grid->unset_csv();

        if ($form->allow_xls == 0)
            $grid->unset_xls();

        if ($form->allow_search == 0)
            $grid->unset_search();

        if ($form->allow_list == 0)
            $grid->unset_list();

        if ($form->allow_limit_list == 0)
            $grid->unset_limitlist();

        if ($form->allow_numbers == 0)
            $grid->unset_numbers();

        if ($form->allow_pagination == 0)
            $grid->unset_pagination();

        if ($form->allow_sort == 0)
            $grid->unset_sortable();

        if ($form->allow_title == 0)
            $grid->unset_title();

        if ($form->allow_duplicate == 1)
            $grid->duplicate_button();

        $grid->search_pattern($form->search_pattern_before, $form->search_pattern_after);

        $fields = $this->database->table("blueticket_forms_fields")->where("form_id=?", $form->id)->where("field_list=?", 1)->order("field_order ASC")->fetchAll();

        $columns = "";
        $i = 0;

//        echo "<pre>";
//        print_r($fields);
//        echo '</pre>';

        foreach ($fields as $field) {
            if ($i > 0)
                $columns .= "," . str_replace('{$lang}', $this->presenter->translator->lang, $field->field_name);
            else
                $columns = str_replace('{$lang}', $this->presenter->translator->lang, $field->field_name);

            $i++;
        }

        $grid->columns($columns);

        $fields = $this->database->table("blueticket_forms_fields")->where("form_id=?", $form->id)->where("field_read=?", 1)->order("field_order ASC")->fetchAll();

        $columns = "";
        $i = 0;

        foreach ($fields as $field) {
            if ($i > 0)
                $columns .= "," . str_replace('{$lang}', $this->presenter->translator->lang, $field->field_name);
            else
                $columns = str_replace('{$lang}', $this->presenter->translator->lang, $field->field_name);

            $i++;
        }

        $grid->fields($columns);


        // disabled fields for update
        $fields = $this->database->table("blueticket_forms_fields")->where("form_id=?", $form->id)->where("field_update=?", 0)->order("field_order ASC")->fetchAll();

        $columns = "";
        $i = 0;

        foreach ($fields as $field) {
            if ($i > 0)
                $columns .= "," . str_replace('{$lang}', $this->presenter->translator->lang, $field->field_name);
            else
                $columns = str_replace('{$lang}', $this->presenter->translator->lang, $field->field_name);

            $i++;
        }

        if (strlen($columns) > 0)
            $grid->disabled($columns);


        // no editor
        $fields = $this->database->table("blueticket_forms_fields")->where("form_id=?", $form->id)->where("field_noeditor=?", 1)->order("field_order ASC")->fetchAll();

        $columns = "";
        $i = 0;

        foreach ($fields as $field) {
            if ($i > 0)
                $columns .= "," . str_replace('{$lang}', $this->presenter->translator->lang, $field->field_name);
            else
                $columns = str_replace('{$lang}', $this->presenter->translator->lang, $field->field_name);

            $i++;
        }

        if (strlen($columns) > 0)
            $grid->no_editor($columns);

        // sum fields
        $fields = $this->database->table("blueticket_forms_fields")->where("form_id=?", $form->id)->where("field_sum=?", 1)->order("field_order ASC")->fetchAll();

        $columns = "";
        $i = 0;

        foreach ($fields as $field) {
            if ($i > 0)
                $columns .= "," . str_replace('{$lang}', $this->presenter->translator->lang, $field->field_name);
            else
                $columns = str_replace('{$lang}', $this->presenter->translator->lang, $field->field_name);

            $i++;
        }

        if (strlen($columns) > 0)
            $grid->sum($columns);

        //upload fields
        $fields = $this->database->table("blueticket_forms_fields")->where("form_id=?", $form->id)->where("field_type=?", "FILEUPLOAD")->order("field_order ASC")->fetchAll();

        $columns = "";
        $i = 0;

        foreach ($fields as $field) {
            if ($i > 0)
                $columns .= "," . str_replace('{$lang}', $this->presenter->translator->lang, $field->field_name);
            else
                $columns = str_replace('{$lang}', $this->presenter->translator->lang, $field->field_name);

            $i++;
        }

        if (strlen($columns) > 0)
            $grid->change_type($columns, "file");

        //image fields
        $fields = $this->database->table("blueticket_forms_fields")->where("form_id=?", $form->id)->where("field_type=?", "IMAGEUPLOAD")->order("field_order ASC")->fetchAll();

        $columns = "";
        $i = 0;

        foreach ($fields as $field) {
            if ($i > 0)
                $columns .= "," . str_replace('{$lang}', $this->presenter->translator->lang, $field->field_name);
            else
                $columns = str_replace('{$lang}', $this->presenter->translator->lang, $field->field_name);

            $i++;
        }

        if (strlen($columns) > 0)
            $grid->change_type($columns, "image", '', array('manual_crop' => FALSE));

        // search fields
        $fields = $this->database->table("blueticket_forms_fields")->where("form_id=?", $form->id)->where("field_search=?", 1)->order("field_order ASC")->fetchAll();

        $columns = "";
        $i = 0;

        foreach ($fields as $field) {
            if ($i > 0)
                $columns .= "," . str_replace('{$lang}', $this->presenter->translator->lang, $field->field_name);
            else
                $columns = str_replace('{$lang}', $this->presenter->translator->lang, $field->field_name);

            $i++;
        }

        if (strlen($columns) > 0)
            $grid->search_columns($columns);


        // relation section
        // relation ( field, target_table, target_id, target_name, where_array, order_by, multi, concat_separator, tree, depend_field, depend_on )
        //field - main table relation field, that will be replases; data will be written in this field
        //target_table - related (target) table, options for dropdown will be get from here
        //target_id - row id from target table, will be writen into field
        //target_name - field, that will be displayed as name of dropdown option. This can be array of few fields.
        //where - (optional) - allows to specify selection items from the target_table, see where(). Default is null.
        //order_by - (optional) - order by condition (eg. 'username desc'). Default is by target_name.
        //multi - (optional, boolean) - can change dropdown to multiselect (items will be saved separated by comma). Default is false.
        //concat_separator - (optional) - take effect only when target_name is array. Default is ' '.
        //tree - (optional) - array, sets tree rendering of dropdown list. Options: 1. array('primary_key'=>'some_id_field_name','parent_key'=>'some_field_name') - primary and parent key field name, will be created pk tree. 2. array('left_key'=>'some_field_name','level_key'=>'some_field_name') - left key and level field names, will be created nested sets tree.
        //depend_field - field from current table, options will be extracted based on parent field value ( like country_id column in cities table)
        //depend_on - field, thats will be parent to current dropdown.
        //You can use {field_tags} in 'where' parameter to get variable from current row

        $fields = $this->database->table("blueticket_forms_fields")->where("form_id=?", $form->id)->where("field_type=?", "RELATION")->order("field_order ASC")->fetchAll();

        foreach ($fields as $field) {
            $target_name = explode("|", $field->relation_target_name);

            if (count($target_name) > 1) {
                
            } else
                $target_name = $field->relation_target_name;

            $grid->relation(str_replace('{$lang}', $this->presenter->translator->lang, $field->field_name), str_replace('{$lang}', $this->presenter->translator->lang, $field->relation_target_table), str_replace('{$lang}', $this->presenter->translator->lang, $field->relation_target_id), $target_name, $field->relation_where, $field->relation_order_by, '', ' - ', '', $field->relation_depend_field, $field->relation_depend_on);
        }

        //
        //fk_relation(label, field, fk_table, in_fk_field, out_fk_field, rel_tbl, rel_field, rel_name, rel_where, rel_orderby, rel_concat_separator, before, add_data ) - allows to create, manage and display many-to-many connections. The syntax is similar to relation().
        //label - Displaing field label (mus be unique, used as alias)
        //field - connection field from current table
        //fk_table - connection table
        //in_fk_field - field, connected with main table
        //out_fk_field - field, connected with relation table
        //rel_tbl - relation table
        //rel_field - connection field from relation table
        //rel_name - field, that will be displayed as name of dropdown option. This can be array of few fields.
        //rel_where - (optional) - allows to specify selection items from the target_table, see where(). Default is null.
        //rel_orderby - (optional) - order by condition (eg. 'username desc'). Default is by rel_name.
        //rel_concat_separator - (optional) - take effect only when rel_name is array. Default is ' '.
        //before - (optional) - if selected, field will be inserted before this field (by default - in the end)
        //add_data (array) - (optional) - additional inserting data
        //
        // relation section
        // subselect section

        $fields = $this->database->table("blueticket_forms_fields")->where("form_id=?", $form->id)->where("field_type=?", "SUBSELECT")->order("field_order ASC")->fetchAll();

        foreach ($fields as $field) {
            $grid->subselect(str_replace('{$lang}', $this->presenter->translator->lang, $field->field_name), str_replace('{$lang}', $this->presenter->translator->lang, $field->field_subselect));
        }

        $metas = $this->database->table("blueticket_forms_meta")->where("form_id=?", $form->id)->order("ordering")->fetchAll();

        foreach ($metas as $meta) {
            switch ($meta->meta_key) {
                case "highlight":
                    list($columns, $operator, $value, $color) = explode("|", $meta->meta_value);
                    $grid->highlight($columns, $operator, $value, $color);
                    break;
                case "highlight_row":
                    list($columns, $operator, $value, $color) = explode("|", $meta->meta_value);
                    $grid->highlight_row($columns, $operator, $value, $color);
                    break;
                case "column_class":
                    list($columns, $class) = explode("|", $meta->meta_value);
                    $grid->column_class($columns, $class);
                    break;
                case "column_pattern":
                    list($columns, $pattern) = explode("|", $meta->meta_value);
                    $grid->column_pattern($columns, $pattern);
                    break;
            }
        }

        // subselect section
        // sum and format solution
        // sum and format solution
        // labels
        $fields = $this->database->table("blueticket_forms_fields")->where("form_id=?", $form->id)->order("field_order ASC")->fetchAll();

        foreach ($fields as $field) {
            $grid->label($field->field_name, $this->presenter->translate($field->caption));
        }

        $nested_tables = $this->database->table("blueticket_nested_forms")->where("form_id=?", $form->id)->fetchAll();

        foreach ($nested_tables as $nested_table) {
            $grid_id = rand(1000, 9999);

            $nested_form = $this->database->table("blueticket_forms")->where("id=?", $nested_table->nested_form_id)->fetch();

            ${'mygrid' . $grid_id} = $this->returnGrid($grid, $nested_table->id);
        }

        $grid->buttons_position('left');

        if ($par_parent == NULL)
            return $grid->render();
        else
            return $grid;
    }

    public function help() {
//1. Basic configuration and quick start
//Upload the folder with application to your local or remote server (by default, it is called "blueticket_forms"). No matter how it will be named later, and where it will be located.
//
//Important: Do not rename anything in the application folder!
//
//Now you need to configure the default connection to the database and set the URL to the application folder.
//
//The configuration file is located in the application folder and is called blueticket_forms_config.php. This file contains all the basic settings, most of which you can change directly in the application initialization. More information about this you can read in the following sections of this documentation.
//
//class blueticket_forms_config{
//    // default connection
//    public static $dbname = 'dbname';
//    public static $dbuser = 'dbuser';
//    public static $dbpass = 'dbpass';
//    public static $dbhost = 'localhost';
//    ....
//// more settings here... :)
//When everything is set up, you can try to include the main application file, and create a new instance of the application.
// 
//
//include('real_path/blueticket_forms/blueticket_forms.php');
//$blueticket_forms = blueticket_forms::get_instance();
//$blueticket_forms->table('my_table');
//echo $blueticket_forms->render();
//That's it. If done correctly, you should see your table.
//
//Note: If you start  with blank file, your result code must look like this
//
//< ?php
//    include('blueticket_forms/blueticket_forms.php');
//    $blueticket_forms = blueticket_forms::get_instance();
//    $blueticket_forms->table('your_table');
//? >
//<!DOCTYPE HTML>
//<html>
//<head>
//    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
//    <title>Some page title</title>
//</head>
// 
//<body>
// 
//< ?php
//    echo $blueticket_forms->render();
//? >
// 
//</body>
//</html>
//I highly recommend to use UTF-8 in your projects. This will save you from a lot of problems with the encoding and localizations.
//
//2. Advanced Configuration
//The configuration file contains  default settings, you can customize the behavior blueticket_forms to your taste. The configuration file is well commented, you should not have any problems with the editing.
//
//3. Main features of the application.
//blueticket_forms – is a simple-usage but powerfull Create-Read-Update-Delete (CRUD) generator application for PHP and MySQL. The application offers you many ways to work with your data and scaffolding, while remaining very easy to use even for non-programmers. Content management becomes simple and flexible, hours of saved time, minutes to implement. You can use it as plain php library or with your favorite framework and cms.
//
//blueticket_forms implements Singleton pattern, so it can be initialized in any part of the script as desired. It will not appear on the performance, because you will always work with a single original object blueticket_forms. You can pre-set parameters and output data in different parts of your script: in different functions, classes, or even in different files. This way, you can create custom settings for your specific set blueticket_forms (first, read the configuration file, most of the default settings can be done there).
//
//blueticket_forms implements multi-instance system, which allows a single page load multiple instances blueticket_forms and work with multiple tables simultaneously. Regardless on how many copies, blueticket_forms open only one connection to your database, which is also significantly improves performance gains.
//
//You can connect every instance to different database and work not only with different tables on the page, but also with multiple databases even on one page.
//
//The application uses a fast ajax interface for all of your actions, you do not need to wait for page reloading and loading unneeded modules, you get access to the data almost immediately.
//
//blueticket_forms uses native php session. For each request, each instance is generating unique validation key that becomes invalid immediately after usage, which ensures a secure, as well as ease and independence ajax-side of the application. Also you can use experimental alternative session, but for this you need mcrypt and memcache(d) modules installed on your server.
//
//blueticket_forms supports all popular types of MySQL fields. Also, you can control the display of your fields, establish simple validation rules. blueticket_forms enables working with visual editor for text fields, date- and time-picker for date fields, automatically generates a drop-down lists for the fields of ENUM and SET. blueticket_forms will generate interactive google map for POINT type.
//
//You can use any text editor for textarea field. blueticket_forms has preinstalled configs for TinyMCE and CKEditor.
//
//blueticket_forms supports file and image uploading, unlimited thumbs creation and resizing. Blob storage is also available.
//
//blueticket_forms provides control over your data. You can change the data directly to the entry through the callback function, and get the data immediately after writing to the database (eg for password hashing or creation (updating) data in other tables. You can create callbacks for most general actions.
//
//You can completely change the look blueticket_forms, editing just one small css file. You can easy create your own themes or just different screens (templates) for some actions in same template.
//
//blueticket_forms supports localization via ini files, so you can easy create your unique language file.
//
//4. The main methods and loading blueticket_forms
//get_instance () - returns the main object blueticket_forms. This is a static method and can be called anywhere, indefinitely.
//
//$blueticket_forms = blueticket_forms::get_instance();
//You can create multiple instances of blueticket_forms on one page (for example, to work with multiple tables):
//
//$blueticket_forms1 = blueticket_forms::get_instance();
//$blueticket_forms2 = blueticket_forms::get_instance();
//Next, for each instance you can use different methods.
//
//If you want to get the same instance in different functions/file (for expample, in controller an view), you must specify instance name. Calling an instance by name you will always get the same instance. Example:
//
//// controller.php
//$blueticket_forms = blueticket_forms::get_instance('MyInstance');
//$blueticket_forms->table('users'); 
//// view.php
//$blueticket_forms = blueticket_forms::get_instance('MyInstance');
//$echo blueticket_forms->render(); 
// 
//
//table ( table_name ) - sets the table from which data will be loaded. Takes the name of the table in the first parameter. This method is mandatory.
//
//$blueticket_forms->table('my_table');
//You can also load a table from another database.
//
//Most of methods requiring table, try to define this first of all.
//
//blueticket_forms needs at least one primary or unique field in your table. If not, you will get an error. The best practice is to use primary autoincrement column in every table. This was done to prevent losing of your data. blueticket_forms can't work with complex (combined) primary index.
// 
//
//connection ( username, password, remote_table, [localhost], [utf-8] ) - creates a connection for the current instance blueticket_forms. Takes a user name, password, table, host, and the connection character. Host and encoding optional and defaults to 'localhost' and 'utf-8', respectively.
//
//$blueticket_forms2->connection('username','password','remote_table','localhost','utf-8');
//This method is rewriting connection settings from configuration file for current instance
// 
//
//language( lang_code ) - sets interface language in first parameter, default is 'en'
//
//$blueticket_forms->language('en'); // will load en.ini lang file from languages folder
//The best way is set language in configuration file. Use this method only if you really need dynamic language switching.
//set_lang( lang_var, translate ) - allows you to replace existing translate in current instance.
//
//Note: the best way is to customize lang file. Do not create new variables with set_lang(), put them in language file.
// 
//
//render () - displays your data. While this method is not called, blueticket_forms takes no action, the database is not connected, this saving system resources (especially critical for large data).
//
//$out = $blueticket_forms->render();
//// some code...
//echo $out;
//// or
//echo $blueticket_forms->render();
//// or
//echo $blueticket_forms;
//You can start blueticket_forms not only from grid (by default), and always from create, edit or details screen:
//
//$blueticket_forms->render('create'); // add entry screen
//$blueticket_forms->render('edit', 12); // edit entry screen, '12' - primary key
//$blueticket_forms->render('view', 85); // view entry screen, '85' - primary key
//Remember that the render () method must be called last, it just returns the data for output, and all the methods declared after (for the current instance) will not be applied.
//5. Compatibility and plug-ins.
//Configuration tricks
//
//You can rewrite config settings from 'scripts' and 'editor' sections directly on your page. This will be affected on all instances on page. You can use it when you need dynamically change some parameter from that sections.
//Example:
//
//blueticket_forms_config::$some_parameter = 'some value';
//You must write this after you included blueticket_forms.php file and before render() method. All parameters and description you can find in configuration file (blueticket_forms_config.php)
//
// 
//
//load_css() - Static method. Allow you to load blueticket_forms's css files at you custom place. By default blueticket_forms loads styles before instance output
//
//echo blueticket_forms::load_css();
// 
//
//load_js() - Static method. Allow you to load blueticket_forms's javascript files and scripts at you custom place. By default blueticket_forms loads javascript after instance output
//
//echo blueticket_forms::load_js();
// 
//
//Bootstrap, jQuery and javascript conflicts
//
//If your template already uses jquery or jqueryui or bootstrap, you must turn off them in configuration file.
//
//Note, all blueticket_forms's scripts must be loaded after jQuery. If your jQuery loads in the bottom of page, you must call  < ?php echo blueticket_forms::load_js() ? > in the bottom of page after jQuery and < ?php echo blueticket_forms::load_css() ? > in top (the best in <head></head>).
//
//If blueticket_forms's content rendered before output in template, set  $manual_load parameter in TRUE in configuration file. This will prevent automatic loading scripts and styles.
//
// 
//
//Troubles with session
//
//Many frameworks and cms can destoy native php session on reload. blueticket_forms  generates Security key error to any action. If this was happenned, you can try to use alternative session (you need memcache(d) and mcrypt modules on your server).
//
//Also you will get an error when session name was changed from default. And you can try to customize $sess_name or $dynamic_session parameters in configuration.
//
//If you have deep integration with your framework or cms (this mean, the blueticket_forms's ajax file (uri) is a part of your system), you can use special functions to synhronize blueticket_forms's session with yours. Codegniter example:
//
//Ajax controller:
//
//class Ajax extends CI_Controller{
//    public function __construct(){
//        parent::__construct();
//    }
//    public function index(){
//        include(FCPATH.'/blueticket_forms/blueticket_forms.php');
//        blueticket_forms::import_session($this->session->userdata('blueticket_forms_sess'));
//        blueticket_forms::get_requested_instance();
//        $this->session->set_userdata(array('blueticket_forms_sess'=>blueticket_forms::export_session()));
//    }
//} 
//Some content controller:
//
//class Ajax extends CI_Controller{
//    public function __construct(){
//        parent::__construct();
//    }
//    public function orders(){
//        include(FCPATH.'/blueticket_forms/blueticket_forms.php');
//        $blueticket_forms = blueticket_forms::get_instance();
//        $blueticket_forms->table('orders');
//        $data['content'] = $blueticket_forms->render();
//        $this->load->view('some_content', $data);
//        
//        // blueticket_forms::export_session() will destroy all blueticket_forms's instances
//        $this->session->set_userdata(array('blueticket_forms_sess'=>blueticket_forms::export_session()));
//    }
//} 
// 
//
// 
//
// 
//
//6. Select Data.
//where ( fields, value ) - sets the condition of choice.
//Multiple calls are united all the conditions with the operator 'AND'.
//Option 1: Accept the input field and value. The field should be indicated by a sign of comparison. Value will be automatically quoted.
//
//$blueticket_forms->where('catid =', 5);
//$blueticket_forms->where('created >', $last_visit);
//// or
//$blueticket_forms->where('catid =', 5)->where('created >', $last_visit);
//Option 2: Accepts associations are an array of field-value. The field should be indicated by a sign of comparison. Value will be automatically quoted.
//
//$cond = array('catid =' => 5, 'created >' => $last_visit);
//$blueticket_forms->where($cond);
//Please note: all the conditions in array will be merged with the operator 'AND'.
//Option 3: Accepts custom line environment, you must specify the name of the table in front of each field, to avoid any conflict in relationships with other tables. You also have to take care of yourself on preparing values.
//
//$blueticket_forms->where("content.catid = 5 AND content.created > '{$last_visit}'");
//// or
//$blueticket_forms->where("", "content.catid = 5 AND content.created > '{$last_visit}'"); // 1.5 compat.
//Alternative usage
//
//// using OR glue
//$blueticket_forms->where('catid', 5);
//$blueticket_forms->or_where('created >', $last_visit);
// 
//// using IN and NOT IN
//$blueticket_forms->where('catid', array('5','7','8'); // `catid` IN ('5','7','8')
//$blueticket_forms->where('catid !', array('5','7','8'); // `catid` NOT IN ('5','7','8')
// 
//
//or_where() - the same as where() method, but multiple calls will be united with operator 'OR'
//
// 
//
//no_quotes( fields ) - The method allows to cancel the automatic shielding values, so you can use the functions in mysql query. Affects on where expressions and pass_var () method. Takes comma-separated fieldnames or array of fieldnames in first parameter.
//
//$blueticket_forms->no_quotes('created');
//$blueticket_forms->pass_var('created','now()');
////or
//$blueticket_forms->where('created !=','null');
// 
//
//relation ( field, target_table,target_id, target_name, where, order_by, multi, concat_separator, tree, depend_field, depend_on ) - binds the current table with a list of the other table. Takes as input the name of the field in the current table, the name of the linked table, the link field, the title field , the selection condition for the linked table (optional).
//
//$blueticket_forms->relation('catid','categories','cid','category_name',array('published' => 1));
////or
//$blueticket_forms->relation('catid','categories','cid','category_name','categories.published = 1');
//Since 1.5.4 relation() has additional parameters:
//
//relation ( field, target_table, target_id, target_name, where_array, order_by, multi, concat_separator, tree, depend_field, depend_on )
//
//field - main table relation field, that will be replases; data will be written in this field
//target_table - related (target) table, options for dropdown will be get from here
//target_id - row id from target table, will be writen into field
//target_name - field, that will be displayed as name of dropdown option. This can be array of few fields.
//where - (optional) - allows to specify selection items from the target_table, see where(). Default is null.
//order_by - (optional) - order by condition (eg. 'username desc'). Default is by target_name.
//multi - (optional, boolean) - can change dropdown to multiselect (items will be saved separated by comma). Default is false.
//concat_separator - (optional) - take effect only when target_name is array. Default is ' '.
//tree - (optional) - array, sets tree rendering of dropdown list. Options: 1. array('primary_key'=>'some_id_field_name','parent_key'=>'some_field_name') - primary and parent key field name, will be created pk tree. 2. array('left_key'=>'some_field_name','level_key'=>'some_field_name') - left key and level field names, will be created nested sets tree.
//depend_field - field from current table, options will be extracted based on parent field value ( like country_id column in cities table)
//depend_on - field, thats will be parent to current dropdown.
//You can use {field_tags} in 'where' parameter to get variable from current row
// 
//
//fk_relation(label, field, fk_table, in_fk_field, out_fk_field, rel_tbl, rel_field, rel_name, rel_where, rel_orderby, rel_concat_separator, before, add_data ) - allows to create, manage and display many-to-many connections. The syntax is similar to relation().
//
//label - Displaing field label (mus be unique, used as alias)
//field - connection field from current table
//fk_table - connection table
//in_fk_field - field, connected with main table
//out_fk_field - field, connected with relation table
//rel_tbl - relation table
//rel_field - connection field from relation table
//rel_name - field, that will be displayed as name of dropdown option. This can be array of few fields.
//rel_where - (optional) - allows to specify selection items from the target_table, see where(). Default is null.
//rel_orderby - (optional) - order by condition (eg. 'username desc'). Default is by rel_name.
//rel_concat_separator - (optional) - take effect only when rel_name is array. Default is ' '.
//before - (optional) - if selected, field will be inserted before this field (by default - in the end)
//add_data (array) - (optional) - additional inserting data
//Structure of connections:
//
//table
//|- field  --|
//            |
//            |    fk_table
//            |--  |- in_fk_field
//                 |- out_fk_field  --|
//                                    |
//                                    |    rel_table
//                                    |--  |- rel_field
// 
//
//nested_table ( inst_name, connect_field, nested_table, nested_connect_field ) - takes instance name in first parameter, main field in second parameter, nested table in third and connection field from nested table in 4th.
//
//Nested tables are using for easy editing of related records in other tables, such as the order and the goods in the order (see demo).
//
//You can specify one nested table for each field of your main table. You can set options for nested tables as well as you do for the main table. Method nested_table () creates an instance of a nested table, access to which can be obtained through the field name (specified in the first parameter of the method nested_table ()), only add to it the prefix nested_.
//
//$blueticket_forms->table('orders'); // main table
//$products_list = $blueticket_forms->nested_table('products_list','orderNumber','orderdetails','orderNumber'); // nested table
//$products_list->unset_add(); // nested table instance access
// 
//
//search_pattern( '%', '%' ) - allows to define search pattern for grid search. Method replaces default param ($search_pattern) from configuration.
//
// 
//
//Table joining
//
//blueticket_forms provide table joining and manipulating with a few tables in one box. You can use extended field syntax, when you type field name (column name or alias) as table and field with dot separator (sample: $blueticket_forms->change_type('order.total', 'price');). You no need to use this when you not use table joining.
//
//join( field, joined_table, join_on_field [, alias] [, not_insert] )
//
//field - field from current table to join; joined_table - table, that is joined; join_on_field - joining on this column from joined table; alias - (optional) - need to use when you join one tabes more than one times.
//
//not_insert - allows to disable inserting and deleting rows from joined table.
//
//$blueticket_forms->table('users');
//$blueticket_forms->join('id','profiles','user_id'); // join users and profiles on users.id = profiles.user_id
// 
//// now join 'profiles' and 'tokens' tables
//$blueticket_forms->join('profiles.token_id','tokens','id'); // on profile.token_id = tokens.id
// 
//// simple actions with fields: default and joined
//$blueticket_forms->column('username','email','profile.city','tokens.created');
//join uses INNER JOIN, thats mean in all tables must be present joined rows. join connects only one row from table, joined on fields must be unique. When joined rows in not unique blueticket_forms will be worked incorrect.
// 
//
//Custom SQL
//
//query( sql_query ) - custom sql query. This method allow you to use custom sql query and display read-only datagrid.
//
//$blueticket_forms = blueticket_forms::get_instance();
//$blueticket_forms->query('SELECT * FROM users WHERE age > 25');
//echo $blueticket_forms->render();
// 
//
// 
//
//7. Overview table.
//columns ( columns, reverse ) - sets the columns that you want to see in the review table. Takes a string, separated by commas, or an array of values. The second optional parameter causes the function to do the opposite, ie hides the selected columns. Takes tru / false, default false.
//
//$blueticket_forms->columns('name,email,city');
////or
//$blueticket_forms->columns(array('name','email','city'));
// 
//// hide columns
//$blueticket_forms->columns('name,email,city', true);
// 
//
//order_by ( name, direction ) - sets the initial sorting of the table, take the field and sort order. By default - in ascending order ('asc').
//
//$blueticket_forms->order_by('name','desc');
// 
//
//label ( fieldname, your_label ) - Allows you to specify the name of your columns and fields, takes the field and the field name or an array.
//
//$blueticket_forms->label('name','Your Name');
////or
//$blueticket_forms->label(array('name' => 'Your Name'));
// 
//
//column_name( fieldname, your_label ) - the same as label(), but affects only on columns in grid.
//
// 
//
//show_primary_ai_column ( bool ) - takes true / false, setting the display of primary auto-increment columns in the overview table.
//
//$blueticket_forms->show_primary_ai_column(true);
// 
//
//limit ( int ) - sets the initial limit for display tables, takes an integer in the first argument. The value set by this function is always available in the list to select the number of lines per page.
//
//$blueticket_forms->limit(25);
// 
//
//limit_list ( string_or_array ) - specifies a list of values ​​for the limits list. Takes an array of values, or string. Option 'all' lift a moderate amount of a result (display all rows).
//
//$blueticket_forms->limit_list('5,10,15,all');
////or
//$blueticket_forms->limit_list(array('5','10','15','all'));
// 
//
//table_name ( name, tooltip, tooltip_icon ) - Changes the name of the table in the title, takes a string as the first parameter, tooltip text in second parameter (optional) and tooltip icon name in 3rd (optional)
//
//See 'default' theme icons
//
//$blueticket_forms->table_name('My custom table!');
//$blueticket_forms->table_name('My custom table!', 'Some tooltip text');
//$blueticket_forms->table_name('My custom table!', 'Some tooltip text','icon-leaf');
// 
//
//unset_add( true ) - hides add button from list view.
//
//$blueticket_forms->unset_add();
// 
//
//unset_edit( true ) - hide edit button from list view.
//
//$blueticket_forms->unset_edit();
// 
//
//unset_view( true ) - hides view button from list view.
//
//$blueticket_forms->unset_view();
// 
//
//unset_remove( true ) - hide remove button from list view.
//
//$blueticket_forms->unset_remove();
// 
//
//unset_csv( true ) - hides csv-export button from list view.
//
//$blueticket_forms->unset_csv();
// 
//
//unset_search( true ) - hides search feature.
//
//$blueticket_forms->unset_search();
// 
//
//unset_print( true ) - hides printout feature.
//
//$blueticket_forms->unset_print();
// 
//
//unset_title( true ) - hides table title.
//
//$blueticket_forms->unset_title();
// 
//
//unset_numbers( true ) - hides rows numbers.
//
//$blueticket_forms->unset_numbers();
// 
//
//unset_pagination( true ) - hides pagination
//
//$blueticket_forms->unset_pagination();
// 
//
//unset_limitlist( true ) - hides list with limits buttons or dropdown
//
//$blueticket_forms->unset_limitlist();
// 
//
//unset_sortable( true ) - makes columns unsortable
//
//$blueticket_forms->unset_sortable();
// 
//
//unset_list( true ) - turn of grid view. Only details can be viewed or edited. Don't forget to set view parameter in render() method.
//
//$blueticket_forms->unset_list();
// 
//
//unset_view(), unset_edit(), unset_remove(), duplicate_button() - this methods can get additional condition parameters (with {field_tags})
//$blueticket_forms->unset_edit(true,'username','=','admin'); // 'admin' row can't be editable
// 
//
//remove_confirm( true ) - removes confirmation window on remove action. Takes true / false in the first parameter.
//
//$blueticket_forms->remove_confirm(false);
// 
//
//start_minimized ( true ) - start blueticket_forms instance minimized. Takes true / false in the first parameter.
//
//$blueticket_forms->start_minimized(true);
// 
//
//benchmark ( true ) - displays information about the performance in the lower right corner of the blueticket_forms window. Takes true / false in the first parameter.
//
//$blueticket_forms->benchmark(true);
// 
//
//column_cut ( int, [fields] ) - sets the maximum number of characters to be displayed in columns. Takes an integer value in the first parameter. In the second parameter you can define target field(s)
//
//$blueticket_forms->column_cut(30); // all columns
//$blueticket_forms->column_cut(30,'title,description'); // separate columns
// 
//
//duplicate_button ( true ) - show duplicate button. You can duplicate only the records in those tables that have auto-incremental primary field, and have no other unique indexes. Otherwise you will get an error.
//
//$blueticket_forms->duplicate_button();
// 
//
//links_label( label ) - creates label for links in grid view. Takes new label in first parameter
//
//$blueticket_forms->links_label('home url');
//// or
//$blueticket_forms->links_label('<i class="icon-home"></i>'); // bootstrap icon for bootstrap theme
// 
//
//emails_label( label ) - creates label for links in grid view. Takes new label in first parameter
//
//$blueticket_forms->emails_label('Contact email');
// 
//
//sum ( columns, classname, custom_data ) - calculates sum for columns and shows result row in the bottom of table. Calculates sum of the entire list, regardless of pagination. Takes columns list in first parameter, optional classname in second, and optional custom text pattern in third.
//
//$blueticket_forms->sum('price,fee,quantity');
////or
//$blueticket_forms->sum(array('price','fee','quantity'));
////or
//$blueticket_forms->sum('price','align-center','Total price is {value}'); // use {value} tag to get sum value in pattern
// 
//
//button( link, title, icon, classname, array_of_attributes, condition_array ) - adds custom link in grid, like edit or remove. You can define url in first parameter (required), name (optional) in 2nd, icon(optional) in 3rd, class attribute (optional) in 4th, additional button attributes (assoc array) as 5th.
//
//For icon field you must use predefined classes, this is Icon glyphs for bootstrap theme (e.g. icon-glass, icon-music...). Also see 'default' theme icons for default theme.
//
//$blueticket_forms->button('http://example.com');
//$blueticket_forms->button('http://example.com','My Title','icon-link','',array('target'=>'_blank'));
// 
//// {column_tags} usage:
//$blueticket_forms->button('http://example.com/{user_id}/?token={user_token}');
//You can use buttons with text labels. See $button_labels parameter in configuration file
//Also button() supports simple condition in 6th parameter. Condition value supports {field_tags}. Example:
//
//// show button whith link from 'link' field when 'link' field is not empty
//$blueticket_forms->button('{link}','userlink','link','','',array('link','!=','')); 
// 
//
//highlight( field, operator, value, color, classname ) - adds background color or class attribute for grid cell based on user's condition.
//
//$blueticket_forms->highlight('orderNumber','=','10101','red');
//$blueticket_forms->highlight('orderNumber','>=','10113','#87FF6C');
//$blueticket_forms->highlight('city','=','Madrid','','main-city'); // you can define class attribute
//Also you can get value from current row using {field_tag}
//
//$blueticket_forms->highlight('sum', '>', '{profit}', 'red');
// 
//
//highlight_row( field, operator, value, color, classname ) - the same as highlight(), but full row will be highlighted
//
// 
//
//column_class( column(s), classname ) -  adds class atribute to column(s).
//
//$blueticket_forms->column_class('price,sum,count', 'align-center');
//Predefined classes: align-left, align-right, align-center, font-bold, font-italic, text-underline
//
// 
//
//subselect( column_name, query, before_column ) - select to other table with parameters. This will create new column and inserts it after last column in table, or before colum defined in 3rd parameter
//
////subselect
//$blueticket_forms->subselect('Order total','SELECT SUM(priceEach) FROM orderdetails WHERE orderNumber = {orderNumber}'); // insert as last column
//$blueticket_forms->subselect('Products count','SELECT COUNT(*) FROM orderdetails WHERE orderNumber = {orderNumber}','status'); // insert this column before 'status' column
// 
//// you can use order() and change_type() for this columns;
//$blueticket_forms->change_type('Order total','price','',array('prefix'=>'$'));
//$blueticket_forms->order_by('Products count');
//Also you can operate with fields only in current row
//
//$blueticket_forms->subselect('Sum','{price}*{qty}');
// 
//
//modal( field(s), icon ) - shows cell info in modal. See 'default' theme icons
//
//$blueticket_forms->modal('customerName,customerDescription);
//$blueticket_forms->modal('customerName', 'icon-user');
//$blueticket_forms->modal(array('customerName'=>'icon-user'));
// 
//
//column_pattern(column_name, pattern_code)  - replaces default column cell output by custom pattern. Pattern can contain {field_tags} and {value} tag (value of current column)
//
//$blueticket_forms->column_pattern('username','My name is {value}');
//Differense between {value} and {username} (see example): {username} will return raw value from current cell, but {value} will return full output if your field has some extra features (like image or formatted price)
//
// 
//
//field_tooltip( field(s), tooltip_text  [, icon ] ) - creates tooltip icon for field label in create/edit/view mode. See 'default' theme icons
//
//$blueticket_forms->field_tooltip('productName','Enter product name here');
// 
//
//column_tooltip( column(s), tooltip_text  [, icon ] ) - creates tooltip icon for column label in create/edit/view mode. See 'default' theme icons
//
//$blueticket_forms->field_tooltip('productName','Enter product name here');
// 
//
//search_columns( [ column(s) ] [, default_column ] ) - defines column list for search and default search column
//
//$blueticket_forms->search_columns('productVendor,quantityInStock,buyPrice','quantityInStock');
// 
//
//buttons_position( position ) - changes position of grid buttons. Can be 'left', 'right' or 'none'. 'None' option will hide buttons, their features will be available (unlike of unset_ methods). Default is 'right' and can be changed in configuration file.
//
//$blueticket_forms->buttons_position('left');
// 
//
//hide_button( button_name(s) ) - hides system or your custom button ( defined with render_button() method ). This not disables button feature (unlike of unset_ methods).
//
//$blueticket_forms->hide_button('save_return');
//Default system buttons are: view, edit, remove, duplicate, add, csv, print, save_new, save_edit, save_return, return.
//
// 
//
//column_width( column(s), width ) - sets width of blueticket_forms columns manualy.
//
//$blueticket_forms->column_width('description','65%');
//$blueticket_forms->column_width('first_name,last_name','100px'); 
// 
//
// 
//
// 
//
//8. Create / Edit
//fields ( field(s), reverse, tab_name, mode ) - the table fields that you want to see when you edit or create entries. Takes a string, separated by commas, or an array of values. The second optional parameter causes the function to do the opposite, ie hides the selected fields. Takes tru / false, default false.
//
//$blueticket_forms->fields('name,email,city');
////or
//$blueticket_forms->fields(array('name','email','city'));
//// hide fields
//$blueticket_forms->fields('name,email,city', true);
//You can create tabs for some fields, just set tab name in 3rd parameter:
//
//$blueticket_forms->fields('username,email', false, 'Account info');
//$blueticket_forms->fields('country,city,sex,age', false, 'Personal');
//Also you can use different columns for different actions (create, edit, view), set action in 4th parameter:
//
//$blueticket_forms->fields('first_name,last_name,country', false, false, 'view');
//You can play with combination of this parameters. Tabs is unaviable if second parameter is true.
//
// 
//
//show_primary_ai_field () - takes true / false, setting the display of primary auto-increment field when editing the entry.
//
//$blueticket_forms->show_primary_ai_field(true);
//Primary auto-increment field will be always disabled.
//
// 
//
//readonly ( field(s), mode ) - Sets the selected fields attribute 'readonly'. Takes a string, separated by commas, or an array of values. Second paremeter sets mode (create, edit), default is all.
//
//$blueticket_forms->readonly('name,email,city');
////or
//$blueticket_forms->readonly(array('name','email','city'));
// 
//
//disabled ( field(s), mode ) - Sets the selected fields attribute 'disabled'. Takes a string, separated by commas, or an array of values. Second paremeter sets mode (create, edit), default is all.
//
//$blueticket_forms->disabled('name,email,city');
////or
//$blueticket_forms->disabled(array('name','email','city'));
// 
//// separate screens
//$blueticket_forms->disabled('email','edit');
// 
//
//readonly_on_create (), readonly_on_edit (), disabled_on_create (), disabled_on_edit () - do the same thing as the methods above, but allow you to separate the creation and editing. This methods are deprecated and will be deleted.
//
// 
//
//no_editor ( field(s) ) - allows you to load a text box without an editor (it has an effect when editor is loaded). Takes a string, separated by commas, or an array of values.
//
//$blueticket_forms->no_editor('name,email,city');
////or
//$blueticket_forms->no_editor(array('name','email','city'));
// 
//
//change_type ( field(s), type, default, params_or_attr ) - Allows you to change the visual representation of the field. Takes the name of the field, a new type, default value, and an additional parameter (a set of values ​​for lists or the length of the field for the text boxes). Available field types: bool, int, float, text, textarea, texteditor, date, datetime, timestamp, time, year, select, multiselect, password, hidden, file, image, point.
//
//$blueticket_forms->change_type('last_visit','timestamp');
//$blueticket_forms->change_type('nickname','text','',20);
//$blueticket_forms->change_type('email','multiselect','email2@ex.com','email1@ex.com,email2@ex.com,email3@ex.com,email4@ex.com,email5@ex.com');
//See more about change_type () in Field types section.
//
//Hidden type will add hidden input in form. Use fields() and pass_var() metods to hide fields and put custom data in your table if you need to preserve your data (pass_var will not add any input).
//
// 
//
//pass_var ( field, value, mode ) - Allows you to record a variable or data directly in the database, bypassing the add / edit form. The field may not be present in the field, edit field will not affect your data. Function takes the name of the field in the first parameter, and your data, or variable in the second. Optional third parameter is available that allows you to clearly define where you want to paste the data - when creating or editing.
//
//$blueticket_forms->pass_var('user_id', $user_id);
//$blueticket_forms->pass_var('created', date('Y-m-d H:i:s'), 'create');
//$blueticket_forms->pass_var('was_edited', 'Yes, it was!', 'edit');
// 
////using field from current row
//$blueticket_forms->pass_var('modified', '{last_action}');
// 
//
//pass_default( field, value ) - pass default value into field, takes the name of the field and default  value, or array in first parameter.
//
//$blueticket_forms->pass_default('name','Joe');
////or
//$blueticket_forms->pass_default(array('name' => 'Joe', 'city' => 'Boston'));
// 
//
//condition ( field, operator, value, method, parameter(s) ) - allows you to make some changes based on the data in the form. Takes field in first parameter, operator in second, value in 3rd, in the fourth - the method that is executed when triggered conditions, and in the fifth - the parameter passed to the method. Supported methods: readonly(), readonly_on_create(), readonly_on_edit(), disabled(), disabled_on_create(), disabled_on_edit(), no_editor(), validation_required(), validation_pattern(). Supported operators: =, >, <, >=, <=, !=, ^=, $=, ~=.
//
//$blueticket_forms->condition('access','<','5','disabled','password,email,username');
//// if access < 5 than make password, email and username not editable
//// or
//$blueticket_forms->condition('access','<','5','validation_pattern',array('username','[0-9A-Za-z]+'));
//^= - starts with, $= - ends with, ~= - contains.
//
// 
//
//validation_required ( field(s), chars ) - a simple rule that takes the name of the field and the number of characters (default - 1) or an array.
//
//$blueticket_forms->validation_required('name');
//$blueticket_forms->validation_required('city',3);
////or
//$blueticket_forms->validation_required(array('name' => 1, 'city' => 3));
// 
// 
//
//validation_pattern ( field(s), pattren ) - uses a simple validation pattern to selected fields. Takes the field name and the name of the pattern or array. Available patterns: email, alpha, alpha_numeric, alpha_dash, numeric, integer, decimal, natural. Also you can use your own regular expression in second parameter.
//
//$blueticket_forms->validation_pattern('name', 'alpha');
//$blueticket_forms->validation_pattern('email', 'email');
////or
//$blueticket_forms->validation_pattern(array('name' => 'alpha', 'email' => 'email'));
//// or
//$blueticket_forms->validation_pattern('username', '[a-zA-Z]{3,14}');
// 
//
//alert( email_field, cc, subject, body, link ), alert_edit(...), alert_creale(...) - sends emails when data was changed: on create, update or both. Takes email from entry (you must define column in first parameter) and carbon copy list (if defined) from second parameter(can be comma-separated string or array). You must define subject in 3rd and email body in 4th parameter. You can define additional link for email in 5th parameter (optional).
//
//In message body you can use simple tags to retrive some values from row, just write column name in {}.
//
//$blueticket_forms->alert('email','admin@example.com','Password changed','Your new password is {password}');
//$blueticket_forms->alert_create('email','','Email Testing','Hello!!!!!');
// 
//
//mass_alert(), mass_alert_edit(), mass_alert_create() - the same like alert(), but it send message to all emails from selected table.
//
//mass_alert(email_table,email_column,email_where,subject,message,link,curent_param,param_value)
//
//$blueticket_forms->mass_alert('user','email','subscribe = 1','Email test','Hello!');
// 
//
//page_call(url, data_array, param, param_value, method), page_call_create(...), page_call_edit(...) - sends http query to another file/page. This method not receive any data. It only sends request when row was added or changed.
//
//You can define any data into data_array, including {field_tags}, this data will be received in target page like $_GET or $_POST array. If param is defined, method will run only if field value from current row (param) will be equal to param_value. Method defines type of request (get or post), default is get.
//
//$blueticket_forms->page_call('http://mysite/admin/mytarget.php', array('id'=>'{user_id}','text'=>'User {user_name} here!'));
//If your site using authorization, you can try to send browser cookie with request. This featue is experimental and can be turn on from configuration file. BE CAREFUL: DON'T USE IT FOR REQUESTS TO EXTERNAL SITES!!!
// 
//
//set_attr( field(s), array attr ) - allows to set custom attributes for fields in edit form. field(s) - form field(s), attr - assoc array with attributes.
//
//$blueticket_forms->set_attr('user',array('id'=>'user','data-role'=>'admin'));
// 
//
// 
//
// 
//
//9. Field types
//Function change_type () a little difficult to understand, because it uses a specific syntax, which varies depending on the task. Let's try to beat these tasks for conventional groups.
//
//The first three parameters are always the same. They take the name of the field, the desired type of field and default value. The third and the fourth parameter is not required. If you do not specify them, ​​will be loaded values by default.
//
//4th parameter - array with type-parameters and/or html attributes. You can use custom html attributes in most of types.
//
//1. Text fields.
//
//This group includes the following types of fields: text, int, float, hidden.
//
//For these types the function of the default value in the third parameter, and the maximum number of characters in the fourth parameter (exclude hidden).
//
//$blueticket_forms->change_type('user_code', 'int', '000', 10); // v1.5 legacy
//$blueticket_forms->change_type('user_code', 'int', '000', array('maxlength'=>10)); // v1.6
//Use fields() and pass_var() metods to hide fields and put custom data in your table.
//
//2. Multi-line text fields.
//
//This group includes the following types of fields: textarea, texteditor.
//
//This types no need any additional parameters.
//
//$blueticket_forms->change_type('user_desc', 'textarea');
//3. Date fields.
//
//This group includes the following types of fields: date, datetime, time, year, timestamp.
//
//These types of fields will only accept the default value in the third parameter.
//
//$blueticket_forms->change_type('created', 'datetime', '2012-10-22 07:01:33');
//Date range can be used with date type:
//
//$blueticket_forms->change_type('created', 'date', '', array('range_end'=>'end_date')); // this is start date field and it points to end date field
//$blueticket_forms->change_type('created', 'date', '', array('range_start'=>'start_date')); // this is end of range date and it points to the start date range date
//This will create relation between two date fields.
//
//4. Lists.
//
//This group includes the following types of fields: select, multiselect, radio, checkboxes
//
//These types of fields are set to default in the third argument, and a list of available values, separated by commas, in the second parameter. multiselect can contain several values ​​by default.
//
//$blueticket_forms->change_type('adm_email','select','email2@ex.com','email1@ex.com,email2@ex.com,email3@ex.com,email4@ex.com,email5@ex.com');
//$blueticket_forms->change_type('fav_color','multiselect','black,white','red,blue,yellow,green,black,white');
// 
//// v1.6 new syntax
//$blueticket_forms->change_type('fav_color','multiselect','black,white', array('values'=>'red,blue,yellow,green,black,white'));
//You  can show optgroups in dropdowns. Just us multidimensional array:
//
//$blueticket_forms->change_type('country','select','',array('values'=>array('Europe'=>array('UK'=>'United Kindom','FR'=>'France'),'Asia'=>array('RU'=>'Russia','CH'=>'China'))));
// 
//
//5. Password.
//
//This group includes the following types of fields: password.
//
//Takes the type of hashing in the third parameter (e.g. md5 or sha1 or sha256... , leave blank if you do not want to use hashing) and the maximum number of characters in the fourth. The peculiarity of this field is that it does not load the values ​​and does not store the null value (not allowing you to change the previous one to null). This is due to the fact that passwords are usually encrypted or hashed before being stored in the database.
//
//$blueticket_forms->change_type('user_key', 'password', '', 32);
//$blueticket_forms->change_type('user_pass', 'password', 'sha256', 8);
//// attributes example
//$blueticket_forms->change_type('user_pass', 'password', 'md5', array('maxlength'=>10,'placeholder'=>'enter password'));
//6. Upload.
//
//This group includes the following types of fields: file, image.
//
//Takes the path to the upload folder (must exist and be writable) in the third parameter and configuration array in the fourth.
//
//For all uploaded files blueticket_forms creates a unique name to avoid overwriting, but you can cancel the renaming. In this case, the file name will be brought to the alpha-numeric pattern.
//
//$blueticket_forms->change_type('attach', 'file', '', array('not_rename'=>true));
//You can resize the uploaded image, and crop them at different proportions.
//
//$blueticket_forms->change_type('photo','image','',array('width'=>300)); // resize main image
//$blueticket_forms->change_type('photo','image','',array('width'=>300, 'height'=>300, 'crop'=>true)); // auto-crop
//$blueticket_forms->change_type('photo','image','',array('manual_crop'=>true)); // crop it as you want
//You can create a preview picture for your image to be stored in that same folder, and a marker will differ at the end of the name.  You can also specify the size of thumbnails, resize method and subfolder.
//
//Note: 'Manual crop' will crop thumbnails in same proportion as main image
//You can add any number of thumbs, you must create subarray in thumbs array  for each thumbnail
//
//$blueticket_forms->change_type('photo','image','',array(
//    'thumbs'=>array(
//        array('width'=> 50, 'marker'=>'_small'),
//        array('width'=> 100, 'marker'=>'_middle'),
//        array('width' => 150, 'folder' => 'thumbs' // using 'thumbs' subfolder
//    )
//));
//You can save your image as a binary string in the database. For this field in your database must be of type BLOB, MEDIUMBLOB or LONGBLOB. Thumbnail creation in this case is not available. If you do not know how to extract data from these fields, it is better use the normal load.
//
//$blueticket_forms->change_type('photo','image','',array('blob'=>true));
//Uploads parameters:
//
//Files:
//
//not_rename - (true/false) - disables auto-renaming of uploaded files
//text - (string) - display custom file name
//path - relative or absolute path to uploads folder
//blob - (true/false) - saves image as binary string in database blob field
//filename - (string) - name of downloadable file
//url - (string) -real url to upload folder (optional, if you want to use real links)
//Images:
//
//not_rename - (true/false) - disables auto-renaming of uploaded files
//path - relative or absolute path to uploads folder
//width, height - (integer) - sets dimensions for image, if both is not set image will not been resized
//crop - (true/false) - image will be cropped (if not set, image will be saved with saving proportions). Both width and height required
//manual_crop - (true/false) -  Allows to crop image manually
//ratio - (float) - cropped area ratio (uses with manual_crop)
//watermark - (string) - relative or absolute path to watermark image
//watermark_position - (array) - array with two elements (left,top), sets watermark offsets in persents (example: array(95,5) - right top corner)
//blob - (true/false) - saves image as binary string in database blob field. Thumbnails creation is not available.
//grid_thumb - (int) - number of thumb, which will be displayed in grid. If not set, original image will be displayed.
//detail_thumb - (int) - number of thumb, which will be displayed in detail view/create/edit . If not set, original image will be displayed.
//url - (string) -real url to upload folder (optional, if you want to use real links)
//thumbs - array of thumb arrays:
//width, height, crop, watermark, watermark_position - see parent
//marker - (string) - thumbnail marker (if you not set marker or folder, the main image will be replaced with thumbnail)
//folder - (string) - thumbnail subfolder, relative to uploads folder (if you not set marker or folder, the main image will be replaced with thumbnail)
//All paths are always relative to blueticket_forms's folder
//7. Price
//
//This group includes the following types of fields: price.
//
//Takes default value in third parameter and array of parameters in 4th.
//
//$blueticket_forms->change_type('amount', 'price', '5', array('prefix'=>'$'));
//Parameters:
//
//max - (integer) - maximal length of text field (create/update), default is 10
//decimals - (integer) - cout of decimals, default is 2
//separator - (string) - thousands separator, default is comma (list view)
//prefix - (string) - prefix for list view
//suffix - (string) - suffix for list view
//point - (string) - decimal point for list view
//8. Remote images
//
//This group includes the following types of fields: remote_image.
//
//Takes default value in 3rd parameter and link part in 4th (e.g. if your field contains only file name, not full url).
//
//$blueticket_forms->change_type('avatar', 'remote_image');
//// or
//$blueticket_forms->change_type('avatar', 'remote_image', '', 'http://my-img-host.net/my-folder/');
//// 1.6
//$blueticket_forms->change_type('avatar', 'remote_image', '', array('link'=>'http://my-img-host.net/my-folder/'));
// 
//
//9. Locations and maps
//
//This group includes the following types of fields: point.
//
//This automatically works with 'POINT' mysql field type. In text field type coordinates will be saved as string separated with comma. 4th parameter gets array with map settings, also you can define them in configuration file to use by default.
//
//$blueticket_forms->change_type('my_location','point','39.909736,-6.679687',array('text'=>'Your are here'));
//Parameters:
//
//width - (integer) - width of map
//height - (integer) - height of map
//zoom - (integer) - map zoom
//text - (string) - text in info window
//search_text - (string) - placeholder for search field
//search - (true/false) - show search field
//coords - (true/false) - show coordinates field
// 
//
// 
//
//10. Data manipulation
//blueticket_forms use loadable libraries for data manipulation. You can use static functions in the classes, methods, objects, or simply a set of procedural functions. You need to specify the path to your library functions, and blueticket_forms it connects itself, when in fact will need. blueticket_forms will call own functions.php file when path is not defined. blueticket_forms instance will be always available in your function as last parameter.
//
//callable - is callable parameter, if you want to call method from class, you must use an array, e.g. array('class', 'method'). For procedural function just set function name.
// 
//
//$postdata - the object, which represented blueticket_forms's form data sent to server side. It has three methods:
//
//$postdata->get( field ) - returns value of a field or FALSE if field is not exist
//$postdata->set( field, value ) - sets new value in a field or creates new field in $postdata. Returns nothing. You no need to use unlock_field() method anymore.
//$postdata->to_array() - returns all data in array.
//$postdata->del( field ) - removes field from dataset. Be careful, this can make errors in application.
// 
//
//before_insert (callable, path) - allows you to prepare the data before inserting it into the database. Takes an callable in first parameter and the library path in second.  Your function should take postdata object in the first parameter, blueticket_forms's instance in second and no need to return anything.
//
//// function in functions.php
//function hash_password($postdata, $blueticket_forms){
//    $postdata->set('password', sha1( $postdata->get('password') ));
//}
//// creating action
//$blueticket_forms->before_insert('hash_password'); // automatic call of functions.php
////or
//$blueticket_forms->before_insert('hash_password', 'functions.php'); // manualy load
// 
//
//before_update (callable, path) - allows you to prepare the data before updating the records in the database. Takes a callable as the first parameter and the library path in second. Your function should take an array of data in the first parameter and the same return. As well as optionally the primary key in the second parameter.
//
//// function in functions.php
//function hash_password($postdata, $primary, $blueticket_forms){
//    $postdata->set('password', sha1( $postdata->get('password') ));
//}
//// creating action
//$blueticket_forms->before_update('hash_password');
// 
//
//after_insert (callable, path), after_update (callable, path) - allow you to pass data and primary key after upgrading to the custom function. The syntax is the same as in before_update (), except that the function is not obliged to return something.
//
// 
//
//before_remove (callable, path), after_remove (callable, path) - sends to user-defined function only the primary key record to be deleted in the first parameter. The syntax is the same as in previous examples. User-defined function is not obliged to return something.
//
//// function in functions.php
//function delete_user_data($primary, $blueticket_forms){
//    $db = blueticket_forms_db::get_instance();
//    $db->query('DELETE FROM gallery WHERE user_id = ' . $db->escape($primary));
//}
//// creating action
//$blueticket_forms->before_remove('delete_user_data');
// 
//
//column_callback (column, callable, path) - allows you to define custom layer for your column data.
//
//$blueticket_forms->column_callback('name','add_user_icon');
//functions.php:
//
//< ?php
//function add_user_icon($value, $fieldname, $primary_key, $row, $blueticket_forms)
//{
//   return '<i class="icon-user"></i>' . $value;
//}
//? >
//$row - full current row.
//
// 
//
//field_callback (field, callable, path) - allows you to define custom layer for your edit field.
//
//$blueticket_forms->field_callback('name','nice_input');
//functions.php:
//< ?php
//function nice_input($value, $field, $priimary_key, $list, $blueticket_forms)
//{
//   return '<div class="input-prepend input-append">' 
//        . '<span class="add-on">$</span>'
//        . '<input type="text" name="'.$blueticket_forms->fieldname_encode($fieldname).'" value="'.$value.'" class="blueticket_forms-input" />'
//        . '<span class="add-on">.00</span>'
//        . '</div>';
//}
//? >
//$list - all fields data
//
//fieldname_encode() - this encodes field name in compatible format.
//
//You can use data-required and data-pattern attributes, and unique class.
//
//Important: you need to use blueticket_forms-input class for your custom inputs to make its usable by blueticket_forms.
//
// 
//
//replace_insert(callable, path), replase_update(...), replace_remove(...) - replaces standsrt blueticket_forms actions (insert, update, remove) by custom function. Each of this methods passes in the the target function its parameters.
//
//Target function for replace_remove()
//
//function remove_replacer($primary_key, $blueticket_forms){ ... }
//Target function for replace_insert()
//
//function insert_replacer($postdata, $blueticket_forms){ ... }
//Target function for replace_update()
//
//function update_replacer($postdata, $primary_key, $blueticket_forms){ ... }
//$blueticket_forms - blueticket_forms current instance object.
//
//replace_insert() and replace_update() methods must return value of primary key!
// 
//
//call_update( postdata, primary_key )
//
//You can call blueticket_forms update method in your replace_insert(), replase_update(), replace_remove() target functions:
//
//$blueticket_forms->call_update($postdata, $primary_key);
// 
//
//Upload callbacks
//
//before_upload(callable, path) - runs when files was sent to a server, but not processed yet.
//
//after_upload(callable, path) - file was uploaded and moved to deinstanation folder (but not resized yet, if image).
//
//after_resize(callable, path) - file was already resized.  Available only for images.
//
//Callback function example:
//
//function file_callback($field,$filename,$file_path,$config,$blueticket_forms){
//    ...
//}
//$field - full field name (table and culumn with dot separator)
//$filename - name of the file (not available for before_upload())
//$file_path - full file path with file name (not available for before_upload())
//$config - array with parameters from change_type() method (4th parameter).
//$blueticket_forms - blueticket_forms instance
// 
//
//Other callbacks
//
//before_list(callable, path) - can run before grid will be displayed.
//
//// function in functions.php
//function before_list_callback($grid_data, $blueticket_forms){
//    print_r($grid_data);
//}
// 
//
//before_create(callable, path) , before_edit(...), before_view(...) - can run before details view will be displayed.
//
//// function in functions.php (before edit/view)
//function before_details_callback($row_data, $primary, $blueticket_forms){
//     echo $row_data->get('username'); // like 'postdata'
//}
//// function in functions.php (before create, there is no primary)
//function before_details_callback($row_data, $blueticket_forms){
//     echo $row_data->get('username'); // like 'postdata'
//}
// 
//
//Database instanse
//
//In all external files you can use blueticket_forms database instanse:
//
//$db = blueticket_forms_db::get_instance();
//$db->query(...) // executes query, returns count of affected rows
//$db->result(); // loads results as list of arrays
//$db->row(); // loads one result row as associative array
//$var = $db->escape($var); // escapes variable, ads single quotes
//$db->insert_id(); // returns last insert id
//Control file type with upload callback (quick sample):
//
//$blueticket_forms->after_upload('after_upload_example');
//functions.php:
//
//function after_upload_example($field, $file_name, $file_path, $params, $blueticket_forms){
//    $ext = trim(strtolower(strrchr($file_name, '.')), '.');
//    if($ext != 'pdf' && $field == 'uploads.simple_upload'){ // you can use other check-in
//        unlink($file_path);
//        $blueticket_forms->set_exception('simple_upload','This is not PDF','error');
//    }
//}
// 
//
//Additional variables
//
//This methods allow you to send custom data in blueticket_forms's templates or in calback functions.
//
//set_var( var_name, value ) - set user variable
//
//get_var( var_name ) - get user variable
//
//unset_var( var_name ) - unset user variable
//
// 
//
//Interactive ajax callbacks
//
//You can easy create some actions with callback on server side in blueticket_forms's grid (see example)
//
//First you must create callback (like other callbacks) with method 'create action()'.
//
//create_action( action_name, callable, [path] ) - action_name - name of your action, callable - name of your callback (function or method), path (optional) - path to your file with function, default is 'functions.php'.
//
//$blueticket_forms->create_action('my_action','my_function'); 
//Than, create function in your functions.php (or you can use other file)
//
//function my_functions($blueticket_forms){
//    // some manipulations
//} 
//Finally, create button or link (or any) with specific class and data attributes. Simpliest button will be:
//
//<button class="blueticket_forms-action" data-task="action" data-action="my_action">GO!</button> 
//This is required. You can define any other data attributes and all of them will be sent with action. To receive them in callback function you must call get() method with your attribute name in parameter (without data- prefix):
//
//function my_functions($blueticket_forms){
//    $myvalue = $blueticket_forms->get('myvalue'); // data-myvalue attr.
//    // some manipulations
//}  
// 
//
//Returning errors from callback function
//
//You can do you own validation or something more in any callback function during saving and return user back to form.
//
//set_exception( [fields] , [text], [message_type] ) - fields - highlighted fields in form, text - error message, message_type - type of error message (error, note, success, info), just css class for message box, default is 'error'.
// All arguments is optional.
//
//// function in functions.php
//function hash_password($postdata, $primary, $blueticket_forms){
//    $pass = $postdata->get('password');
//    if(preg_match('/[a-zA-Z]+/u',$pass) && preg_match('/[0-9]+/u',$pass)){
//        $postdata->set('password', sha1( $pass ) );    
//    }
//    else{
//        $blueticket_forms->set_exception('password','Your password is too simple.');
//    }
//}
// 
//
// 
//
//11. Themes guide
//You can create you own themes and customize standart themes in very simple way.
//
//Theme structure and files
//
//blueticket_forms's theme has 5 required files:
//
//blueticket_forms_container.php
//blueticket_forms_list_view.php
//blueticket_forms_detail_view.php
//blueticket_forms.ini
//blueticket_forms.css
//blueticket_forms_container.php - this file is static container for ajax side of blueticket_forms.  It can be non-styled, but all blueticket_forms's event are delegated to this container. I not recommend to change something in this file.
//
//blueticket_forms_list_view.php - grid rendering.
//
//blueticket_forms_detail_view.php - rendering of create/edit/view screen
//
//blueticket_forms.ini - List of class names of core html elements, which cannot be changed in theme files.
//
//blueticket_forms.css - theme styles.
//
//All this files will be loaded automatically.
//
// 
//
//Global variables in templates
//
//$mode - shows current action. It can be list, create, edit, view.
//
// 
//
//Standart render methods
//
//Some of render methods can accept tag paremeter. It can be a simple string ('div','h1' etc) or array (array('tag'=>'div')). In array you can add any other html attributes (array('tag'=>'a','href'=>'http://example.com')).
//csv_button( classname, icon ) - render csv export button
//
//print_button( classname, icon ) - render print button button
//
//add_button( classname, icon ) - render Add button button
//
//render_limitlist( buttons ) - render dropdown list or buttons with available rows per page. buttons = true - enable buttons instead of dropdown, default is false.
//
//render_pagination( numbers, offsets ) - pagination; numbers - count of pagination buttons (default is 10); offsets -  first and last buttons offsets (default is 2)
//
//render_search() - search form
//
//render_button( name, task, mode_after_task, classname, icon, primary_key ) - sender system action button.
//
//render_benchmark( tag ) - shows benchmark info. Recomended to put it in the end of template.
//
//render_grid_head( row_tag, item_tag, arrows_array ) - return grid heading. Arrorws array contains arrows for ordered column. Default is array('asc' => '&uarr; ', 'desc' => '&darr; ')
//
//render_grid_body( row_tag, item_tag ) - main grid rendering
//
//render_grid_footer( row_tag, item_tag ) - renders grid footer if available ( eg sum row)
//
//render_fields_list( mode, container, row, label, field, tabs_container, tabs_menu_container, tabs_menu_row, tabs_menu_link, tabs_content_container, tabs_pane ) - big method, creates details row grid and tabs. Default values: ($mode, $container = 'table', $row = 'tr', $label = 'td', $field = 'td', $tabs_block = 'div', $tabs_head = 'ul', $tabs_row = 'li', $tabs_link = 'a', $tabs_content = 'div', $tabs_pane = 'div'). $mode parameter is required.
//
//render_table_name( mode, tag, minimized ) - render table heading with table tooltip and toggle arrow. minimized - used only in container file.
//
// 
//
//Sending custom variables in template
//
//set_var( var_name, value ) - set user variable
//
//get_var( var_name ) - get user variable
//
//unset_var( var_name ) - unset user variable
//
//In theme files current instance can be accessed as $this, e.g. $this->get_var('my_var');
// 
//
//Relocating template files
//
//load_view( task, file ) - this method allows you to replace default view file by your custom by task for current instance.
//
//$blueticket_forms->load_view('create','my_custom_create_form.php'); 
//Your custom theme files must be in your theme folder.
//
// 
//
//Creating non-standart rendering
//
//$this->result_list - array of arrays with full result from database (grid). You can use it to create your own grid rendering.
//
//$this->result_row - array with full result form database (create/edit/view).
//
//$this->fields_output - array with rendered fields, exept hidden and additional fields. Every element contains:
//
//label - field name, generated by blueticket_forms or defined by label() method
//name - full field name, used by blueticket_forms.
//value - raw value from database
//field - already rendered form field by blueticket_forms.
//$this->hidden_fields_output - array of rendered hidden fields
//
// 
//
// 
//
//12. Date and time formats
//PHP date format
//
//Link: http://www.php.net/manual/en/function.date.php
//
//The format of the outputted date string. See the formatting options below. There are also several predefined date constants that may be used instead, so for example DATE_RSS contains the format string 'D, d M Y H:i:s'.
//
//The following characters are recognized in the format parameter string
//format character	Description	Example returned values
//Day	---	---
//d	Day of the month, 2 digits with leading zeros	01 to 31
//D	A textual representation of a day, three letters	Mon through Sun
//j	Day of the month without leading zeros	1 to 31
//l (lowercase 'L')	A full textual representation of the day of the week	Sunday through Saturday
//N	ISO-8601 numeric representation of the day of the week (added in PHP 5.1.0)	1 (for Monday) through 7 (for Sunday)
//S	English ordinal suffix for the day of the month, 2 characters	st, nd, rd or th. Works well with j
//w	Numeric representation of the day of the week	0 (for Sunday) through 6 (for Saturday)
//z	The day of the year (starting from 0)	0 through 365
//Week	---	---
//W	ISO-8601 week number of year, weeks starting on Monday (added in PHP 4.1.0)	Example: 42 (the 42nd week in the year)
//Month	---	---
//F	A full textual representation of a month, such as January or March	January through December
//m	Numeric representation of a month, with leading zeros	01 through 12
//M	A short textual representation of a month, three letters	Jan through Dec
//n	Numeric representation of a month, without leading zeros	1 through 12
//t	Number of days in the given month	28 through 31
//Year	---	---
//L	Whether it's a leap year	1 if it is a leap year, 0 otherwise.
//o	ISO-8601 year number. This has the same value as Y, except that if the ISO week number (W) belongs to the previous or next year, that year is used instead. (added in PHP 5.1.0)	Examples: 1999 or 2003
//Y	A full numeric representation of a year, 4 digits	Examples: 1999 or 2003
//y	A two digit representation of a year	Examples: 99 or 03
//Time	---	---
//a	Lowercase Ante meridiem and Post meridiem	am or pm
//A	Uppercase Ante meridiem and Post meridiem	AM or PM
//B	Swatch Internet time	000 through 999
//g	12-hour format of an hour without leading zeros	1 through 12
//G	24-hour format of an hour without leading zeros	0 through 23
//h	12-hour format of an hour with leading zeros	01 through 12
//H	24-hour format of an hour with leading zeros	00 through 23
//i	Minutes with leading zeros	00 to 59
//s	Seconds, with leading zeros	00 through 59
//u	Microseconds (added in PHP 5.2.2). Note that date() will always generate 000000 since it takes an integer parameter, whereas DateTime::format() does support microseconds.	Example: 654321
//Timezone	---	---
//e	Timezone identifier (added in PHP 5.1.0)	Examples: UTC, GMT, Atlantic/Azores
//I (capital i)	Whether or not the date is in daylight saving time	1 if Daylight Saving Time, 0 otherwise.
//O	Difference to Greenwich time (GMT) in hours	Example: +0200
//P	Difference to Greenwich time (GMT) with colon between hours and minutes (added in PHP 5.1.3)	Example: +02:00
//T	Timezone abbreviation	Examples: EST, MDT ...
//Z	Timezone offset in seconds. The offset for timezones west of UTC is always negative, and for those east of UTC is always positive.	-43200 through 50400
//Full Date/Time	---	---
//c	ISO 8601 date (added in PHP 5)	2004-02-12T15:19:21+00:00
//r	» RFC 2822 formatted date	Example: Thu, 21 Dec 2000 16:01:07 +0200
//U	Seconds since the Unix Epoch (January 1 1970 00:00:00 GMT)	See also time()
// 
//
//jQuery UI date format
//
//Link: http://api.jqueryui.com/datepicker/#utility-formatDate
//
//Link: http://trentrichardson.com/examples/timepicker/
//
//Format a date into a string value with a specified format.
//
//The format can be combinations of the following:
//
//d - day of month (no leading zero)
//dd - day of month (two digit)
//o - day of the year (no leading zeros)
//oo - day of the year (three digit)
//D - day name short
//DD - day name long
//m - month of year (no leading zero)
//mm - month of year (two digit)
//M - month name short
//MM - month name long
//y - year (two digit)
//yy - year (four digit)
//@ - Unix timestamp (ms since 01/01/1970)
//! - Windows ticks (100ns since 01/01/0001)
//'...' - literal text
//'' - single quote
//anything else - literal text
//There are also a number of predefined standard date formats available from $.datepicker:
//
//ATOM - 'yy-mm-dd' (Same as RFC 3339/ISO 8601)
//COOKIE - 'D, dd M yy'
//ISO_8601 - 'yy-mm-dd'
//RFC_822 - 'D, d M y' (See RFC 822)
//RFC_850 - 'DD, dd-M-y' (See RFC 850)
//RFC_1036 - 'D, d M y' (See RFC 1036)
//RFC_1123 - 'D, d M yy' (See RFC 1123)
//RFC_2822 - 'D, d M yy' (See RFC 2822)
//RSS - 'D, d M y' (Same as RFC 822)
//TICKS - '!'
//TIMESTAMP - '@'
//W3C - 'yy-mm-dd' (Same as ISO 8601)
//Time format
//
//H - Hour with no leading 0 (24 hour)
//HH - Hour with leading 0 (24 hour)
//h - Hour with no leading 0 (12 hour)
//hh - Hour with leading 0 (12 hour)
//m - Minute with no leading 0
//mm - Minute with leading 0
//s - Second with no leading 0
//ss - Second with leading 0
//l - Milliseconds always with leading 0
//c - Microseconds always with leading 0
//t - a or p for AM/PM
//T - A or P for AM/PM
//tt - am or pm for AM/PM
//TT - AM or PM for AM/PM
//z - Timezone as defined by timezoneList
//Z - Timezone in Iso 8601 format (+04:45)
//'...' - Literal text (Uses single quotes)
// 
//
//13. Migrate from 1.5
//V.1.5 and 1.6 have a good compatibility, but not at all. All in short form. Description for separate methods you can find in this documentation.
//
//Changed methods:
//
//change_type()  - now it reqires array of attributes in last parameter for any form element (previous syntax saved). 3rd parameter  is always default value for any type (even file and image). 4th parameter for image changes structure.
//relation() - you can use {field_tags} in 'where'(5th), an set order in 6th.
//where() - can receive custom condition  in 1st or in 2nd parameter
//button() - 5th and 6th parameters totaly changed. No any url parametes there (you can create any url in first param). 5th - array with button html attributes, 6th - condition array.
//all before_*/after_* callbacks - first parameter was removed. If you need to load function from class, you can use array('class','method').
//'date', 'datetime' and 'time' types changed data format. This affects only on callbacks ($postdata) and pass_var(). This mean that date or time will be sent in timestamp.
//Removed methods:
//
//All of this you can find in configuration file.
//
//disable_jquery()
//disable_jquery_ui()
//scripts_url()
//jquery_no_conflict()
//sess_expire()
//tinymce_folder_url()
//tinymce_init_url()
//force_tinymce()
//primary()
//Deprecated methods:
//
//This will be removed soon. Saved only for compatibility with v1.5
//
//readonly_on_create()
//disabled_on_create()
//readonly_on_edit()
//disabled_on_edit()
//alert_create()
//alert_edit()
//mass_alert_create()
//mass_alert_edit()
//page_call_create()
//page_call_edit()
// 
//
// 
//
    }

}

?>