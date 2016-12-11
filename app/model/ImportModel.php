<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ImportModel {

    private $database;

    function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    static function importProfiles() {
        require_once 'www/inc/config_ajax.php';
        $importdb = getImportContext();
        $database = getContext();
        $data_model = new DataModel($database);

        $users = $importdb->table("wp_users")->fetchAll();

        $database->table("tbl_user")->delete();
        $database->query("ALTER TABLE tbl_user AUTO_INCREMENT=100000000");

        $database->table("tbl_userkennel")->delete();
        $database->query("ALTER TABLE tbl_userkennel AUTO_INCREMENT=200000000");

        $database->table("tbl_userowner")->delete();
        $database->query("ALTER TABLE tbl_userowner AUTO_INCREMENT=300000000");

        $database->table("tbl_userhandler")->delete();
        $database->query("ALTER TABLE tbl_userhandler AUTO_INCREMENT=400000000");

        $database->table("tbl_dogs")->delete();
        $database->query("ALTER TABLE tbl_dogs AUTO_INCREMENT=500000000");

        $database->table("link_kennel_breed")->delete();
        $database->query("ALTER TABLE link_kennel_breed AUTO_INCREMENT=1");

        $database->table("tbl_handler_breed")->delete();
        $database->query("ALTER TABLE tbl_handler_breed AUTO_INCREMENT=1");

        $database->table("tbl_planned_litters")->delete();
        $database->query("ALTER TABLE tbl_planned_litters AUTO_INCREMENT=700000000");

        $database->table("tbl_puppies")->delete();
        $database->query("ALTER TABLE tbl_puppies AUTO_INCREMENT=600000000");

        $database->table("tbl_pedigree")->delete();
        $database->query("ALTER TABLE tbl_pedigree AUTO_INCREMENT=1");

        $database->table("tbl_timeline")->delete();
        $database->query("ALTER TABLE tbl_timeline AUTO_INCREMENT=1");

        $database->table("tbl_dogs_shows")->delete();
        $database->query("ALTER TABLE tbl_dogs_shows AUTO_INCREMENT=800000000");

        $database->table("tbl_handler_shows")->delete();
        $database->query("ALTER TABLE tbl_handler_shows AUTO_INCREMENT=2400000000");

        $database->table("tbl_handler_show_groups")->delete();
        $database->query("ALTER TABLE tbl_handler_shows AUTO_INCREMENT=2600000000");

        $database->table("tbl_dogs_championship")->delete();
        $database->query("ALTER TABLE tbl_dogs_championship AUTO_INCREMENT=1000000000");

        $database->table("tbl_dogs_coowners")->delete();
        $database->query("ALTER TABLE tbl_dogs_coowners AUTO_INCREMENT=1100000000");

        $database->table("tbl_dogs_health")->delete();
        $database->query("ALTER TABLE tbl_dogs_health AUTO_INCREMENT=1200000000");

        $database->table("tbl_dogs_matings")->delete();
        $database->query("ALTER TABLE tbl_dogs_matings AUTO_INCREMENT=1400000000");

        $database->table("tbl_dogs_workexams")->delete();
        $database->query("ALTER TABLE tbl_dogs_workexams AUTO_INCREMENT=1600000000");

        $database->table("tbl_handler_awards")->delete();
        $database->query("ALTER TABLE tbl_handler_awards AUTO_INCREMENT=1800000000");

        $database->table("tbl_handler_certificates")->delete();
        $database->query("ALTER TABLE tbl_handler_awards AUTO_INCREMENT=2200000000");

        $database->table("tbl_photos")->delete();
        $database->query("ALTER TABLE tbl_photos AUTO_INCREMENT=2800000000");

        $database->table("tbl_messages")->delete();
        $database->query("ALTER TABLE tbl_messages AUTO_INCREMENT=1");

        $database->table("tbl_messages_groups")->delete();
        $database->query("ALTER TABLE tbl_messages_groups AUTO_INCREMENT=1");

        $database->table("tbl_notify")->delete();
        $database->query("ALTER TABLE tbl_notify AUTO_INCREMENT=1");

        $database->table("tbl_comments")->delete();
        $database->query("ALTER TABLE tbl_comments AUTO_INCREMENT=1");

        $database->table("tbl_likes")->delete();
        $database->query("ALTER TABLE tbl_likes AUTO_INCREMENT=1");

        foreach ($users as $user) {
            $rand = rand(10000, 99999);
            $pass = "gnrtx" . $rand;

            $related_data = $importdb->table("wp_usermeta")->where("user_id=?", $user->ID)->fetchAll();

            foreach ($related_data as $usermeta) {
                if ($usermeta->meta_key == "first_name")
                    $fname = $usermeta->meta_value;
                if ($usermeta->meta_key == "last_name")
                    $sname = $usermeta->meta_value;
                if ($usermeta->meta_key == "description")
                    $description = $usermeta->meta_value;
            }

            $description = explode("|", $description);

            $data = array();

            foreach ($description as $desc) {
                if ($desc == NULL)
                    $desc = "";
            }

            $description[2] = str_replace("http://www.dogforshow.com/", "", $description[2]);

            $data['name'] = $fname;
            $data['surname'] = $sname;
            $data['email'] = $user->user_email;
            $data['password'] = $pass;
            $data['state'] = ImportModel::getStateEn($description[7], $database);
            if ($description[0] == 3)
                $data['address'] = $description[13];
            else
                $data['address'] = $description[12];
            $data['city'] = $description[6];
            if ($description[0] == 3)
                $data['zip'] = $description[14];
            else
                $data['zip'] = $description[13];

            $data['phone'] = $description[4];
            $date_of_birth = explode(".", $description[5]);
            $data['year_of_birth'] = $date_of_birth[2];

            if ($data['address'] == NULL)
                $data['address'] = "";
            if ($data['city'] == NULL)
                $data['city'] = "";
            if ($data['zip'] == NULL)
                $data['zip'] = "";
            if ($data['phone'] == NULL)
                $data['phone'] = "";
            if ($data['year_of_birth'] == NULL)
                $data['year_of_birth'] = "";

            $data['active'] = 1;

            if ($data['state'] == "Slovakia")
                $data['lang'] = 'sk';
            elseif ($data['state'] == "Czech Republic")
                $data['lang'] = 'cz';
            else
                $data['lang'] = 'en';

            $last_user_id = $database->table("tbl_user")->insert($data)->id;
            //$last_user_id = $database->getInsertId();

            switch ($description[0]) {
                case 1:
                    $id = ImportModel::createKennelProfile($last_user_id, $description[1], $description[2], $user->user_url, $description[11], $description[10], $description[3], $database);
                    ImportModel::createDogProfiles($id, $user->ID, $database, $importdb);
                    ImportModel::createPlannedLitters($id, $user->ID, $database, $importdb);
                    $data_model->addToTimeline($id, $id, 1, $description[1], $description[2]);
                    break;
                case 2:
                    $id = ImportModel::createOwnerProfile($last_user_id, $description[2], $user->user_url, $description[11], $description[10], $database);
                    ImportModel::createDogProfiles($id, $user->ID, $database, $importdb);
                    $data_model->addToTimeline($id, $id, 1, $fname . " " . $sname, $description[2]);
                    break;
                case 3:
                    $id = ImportModel::createHandlerProfile($last_user_id, $description[12], $description[2], $user->user_url, $description[11], $description[10], $description[15], $database, $importdb);
                    $data_model->addToTimeline($id, $id, 1, $fname . " " . $sname, $description[2]);
                    break;
            }
        }

        ImportModel::createPedigrees($database, $importdb);

        return $return;
    }

    public static function getStateEn($par_state, $context) {
        if ($par_state == NULL || $par_state == "")
            return "Slovakia";

        $database = $context;

        $row = $database->table("lk_countries")->where("CountryName_sk=?", $par_state)->fetch();
        return $row->CountryName_en;
    }

    public static function createKennelProfile($user_id, $name, $image, $website, $description, $date, $breeds, $context) {
//0. TYP (1-CHS, 2-Owner, 3-Handler)
//1. Nazov CHS
//2. Obrazok profilu
//3. Plemeno
//4. Telefon
//5. datum narodenia
//6. Mesto
//7. Stat - prelozit do EN
//8. Heslo - neimportovat
//9. neimportovat
//10. datum registracie
//11. popis
//12. adresa
//13. psc
        $data = array();

        $data['user_id'] = $user_id;
        $data['kennel_name'] = $name;
        $data['kennel_profile_picture'] = $image;
        if ($website == NULL)
            $website = "";
        $data['kennel_website'] = $website;
        if ($description == NULL)
            $description = "";
        $data['kennel_description'] = $description;

        $var = $date;
        $date = str_replace('.', '-', $var);
        $date = date('Y-m-d', strtotime($date));

        $data['kennel_create_date'] = $date;

        $id = $context->table("tbl_userkennel")->insert($data)->id;

        //$id = $context->getInsertId();

        $breeds = explode("^^", $breeds);

        foreach ($breeds as $breed) {
            $breed_data = array();
            $breed_data['kennel_id'] = $id;
            $breed_data['breed_name'] = str_replace("^", "", $breed);
            $context->table("link_kennel_breed")->insert($breed_data);
        }

        return $id;
    }

    public static function createOwnerProfile($user_id, $image, $website, $description, $date, $context) {
//0. TYP (1-CHS, 2-Owner, 3-Handler)
//1. Nazov CHS
//2. Obrazok profilu
//3. Plemeno
//4. Telefon
//5. datum narodenia
//6. Mesto
//7. Stat - prelozit do EN
//8. Heslo - neimportovat
//9. neimportovat
//10. datum registracie
//11. popis
//12. adresa
//13. psc
        $data = array();

        $data['user_id'] = $user_id;
        $data['owner_profile_picture'] = $image;
        if ($website == NULL)
            $website = "";
        $data['owner_website'] = $website;
        if ($description == NULL)
            $description = "";
        $data['owner_description'] = $description;

        $var = $date;
        $date = str_replace('.', '-', $var);
        $date = date('Y-m-d', strtotime($date));

        $data['owner_create_date'] = $date;

        $id = $context->table("tbl_userowner")->insert($data)->id;

        //$id = $context->getInsertId();

        return $id;
    }

    public static function createHandlerProfile($user_id, $post_id, $image, $website, $description, $date, $breeds, $context, $importdb) {
//0. TYP (1-CHS, 2-Owner, 3-Handler)
//1. Nazov CHS
//2. Obrazok profilu
//3. Plemeno
//4. Telefon
//5. datum narodenia
//6. Mesto
//7. Stat - prelozit do EN
//8. Heslo - neimportovat
//9. neimportovat
//10. datum registracie
//11. popis
//12. handler post_id
//13. adresa
//14. psc
//15. Plemeno handler        
        $data = array();

        $data['user_id'] = $user_id;
        $data['handler_profile_picture'] = $image;
        if ($website == NULL)
            $website = "";
        $data['handler_website'] = $website;
        if ($description == NULL)
            $description = "";
        $data['handler_description'] = $description;

        $var = $date;
        $date = str_replace('.', '-', $var);
        $date = date('Y-m-d', strtotime($date));

        $data['handler_create_date'] = $date;

        $id = $context->table("tbl_userhandler")->insert($data)->id;

        //$id = $context->getInsertId();

        $breeds = explode("^^", $breeds);

        foreach ($breeds as $breed) {
            $breed_data = array();
            $breed_data['handler_id'] = $id;
            $breed_data['breed_name'] = str_replace("^", "", $breed);
            if (strlen($breed_data['breed_name']) > 1)
                $context->table("tbl_handler_breed")->insert($breed_data);
        }

        ImportModel::importHandlerShows($id, $post_id, $context, $importdb);
        ImportModel::importHandlerPhotos($id, $post_id, $context, $importdb);
        ImportModel::importHandlerAwards($id, $post_id, $context, $importdb);

        return $id;
    }

    public static function createDogProfiles($kennel_id, $old_user_id, $context, $old_context) {
        if ($kennel_id >= 200000000 && $kennel_id < 400000000) {
//            $importdb = getImportContext();
//            $database = getContext();

            $importdb = $old_context;
            $database = $context;

            $data_model = new DataModel($database);

            $dogs = $importdb->table("wp_posts")->where("post_author=?", $old_user_id)->where("post_type=?", "ac_rehome")->fetchAll();

            foreach ($dogs as $dog) {
// $post_description = mb_strtoupper($_REQUEST['vfb-txtName'], "UTF-8") . '|' . $_REQUEST['vfb-ddlBreed'] . '|' . $_REQUEST['vfb-rbSex'] . '|' . ((strlen($birthday['day']) == 1) ? '0' . $birthday['day'] : $birthday['day']) . '.' . ((strlen($birthday['month']) == 1) ? '0' . $birthday['month'] : $birthday['month']) . '.' . $birthday['year'] . '|' . Getfloat($_REQUEST['vfb-txtHeight']) . '|' . Getfloat($_REQUEST['vfb-txtWeight']) . '|' . $current_user->display_name . '|' . $_REQUEST['vfb-ddlState'] . '|' . $current_user->ID . '|' . $_REQUEST['vfb-rbOwner'] . '|' . $current_date . '|' . mb_strtoupper($_REQUEST['vfb-ddlBreedBook'], "UTF-8") . '|' . $_REQUEST['vfb-txtBreedBookID'] . '|' . $_REQUEST['vfb-rbStud'] . '|' . $f15 . '|' . $f16;

                /*                 * *
                 * description[0] - dog name
                 * description[1] - breed
                 * description[2] - sex
                 * description[3] - birthday
                 * description[4] - height
                 * description[5] - weight
                 * description[6] - neimportovat
                 * description[7] - state
                 * description[8] - neimportovat
                 * description[9] - neimportovat
                 * description[10] - registration date
                 * description[11] - Pedigree 1/2
                 * description[12] - Pedigree 2/2
                 * description[13] - offer for stud
                 * description[14] - unique id - neimportovat
                 */

                $image_thumb = $importdb->table("wp_postmeta")->where("post_id=?", $dog->ID)->where("meta_key=?", "_thumbnail_id")->fetch();
                if ($image_thumb->meta_value != NULL) {
                    $image = $importdb->table("wp_posts")->where("ID=?", $image_thumb->meta_value)->where("post_type=?", "attachment")->fetch();
                    $image_address = str_replace("http://www.dogforshow.com/wp-content/uploads", "wp-content/uploads/", $image->guid);
                } else {
                    $image_address = "";
                }

                $description = $importdb->table("wp_postmeta")->where("post_id=?", $dog->ID)->where("meta_key=?", "_post_description")->fetch();

                if ($kennel_id >= 200000000 && $kennel_id < 300000000)
                    $profile = $database->table("tbl_userkennel")->where("id=?", $kennel_id)->fetch();
                if ($kennel_id >= 300000000 && $kennel_id < 400000000)
                    $profile = $database->table("tbl_userowner")->where("id=?", $kennel_id)->fetch();

                $description = $description->meta_value;
                $description = explode("|", $description);

                if ($description[2] == 'Pes')
                    $description[2] = "Dog";
                else
                    $description[2] = "Bitch";

                $description[7] = ImportModel::getStateEn($description[7], $context);

                $var = $description[3];
                $date = str_replace('.', '-', $var);
                $date = date('Y-m-d', strtotime($date));
                $description[3] = $date;

                $var = $description[10];
                $date = str_replace('.', '-', $var);
                $date = date('Y-m-d', strtotime($date));
                $description[10] = $date;

                $description[11] = $description[11] . ' ' . $description[12];

                if (strlen($description[13]) > 2)
                    $description[13] = 1;
                else
                    $description[13] = 0;

                if (is_nan($description[4]))
                    $description[4] = 0;

                if (is_nan($description[5]))
                    $description[5] = 0;

                $data = array();
                $data['user_id'] = $profile->user_id;
                $data['profile_id'] = $kennel_id;
                $data['offer_for_mating'] = $description[13];
                $data['dog_gender'] = $description[2];
                $data['breed_name'] = $description[1];
                $data['dog_name'] = $description[0];
                $data['dog_image'] = $image_address;
                $data['dog_registration_number'] = $description[11];
                $data['date_of_birth'] = $description[3];
                $data['height'] = $description[4];
                $data['weight'] = $description[5];
                $data['country'] = $description[7];
                $data['registration_date'] = $description[10];

                $mother = "-";
                $father = "-";

                $dog_mother = $importdb->table("wp_postmeta")->where("post_id=?", $dog->ID)->where("meta_key=?", "_animal_pedigree_mom")->fetchAll();
                foreach ($dog_mother as $mom) {
                    $desc = explode("|", $mom->meta_value);

                    $mother = $desc[0];
                }

                $dog_father = $importdb->table("wp_postmeta")->where("post_id=?", $dog->ID)->where("meta_key=?", "_animal_pedigree_dad")->fetchAll();
                foreach ($dog_father as $dad) {
                    $desc = explode("|", $dad->meta_value);

                    $father = $desc[0];
                }


                $data['dog_father'] = $father;
                $data['dog_mother'] = $mother;

                if ($father != "-" && $mother != "-")
                    ImportModel::setParents($description[0], $father, $mother, $database);

                $dog_id = $database->table("tbl_dogs")->insert($data)->id;

                //$dog_id = $database->getInsertId();

                $data_model->addToTimeline($kennel_id, $dog_id, 12, $data['dog_name'], $data['dog_image']);

                ImportModel::importDogShows($dog_id, $dog->ID, $database, $importdb);
                ImportModel::importDogChampionship($dog_id, $dog->ID, $database, $importdb);
                ImportModel::importDogHealth($dog_id, $dog->ID, $database, $importdb);
                ImportModel::importDogMatings($dog_id, $dog->ID, $database, $importdb);
                ImportModel::importDogWorkexams($dog_id, $dog->ID, $database, $importdb);
                ImportModel::importDogPhotos($dog_id, $dog->ID, $database, $importdb);
            }
        }
    }

    public static function setParents($dogName, $fatherName, $motherName, $context) {
        $rows = $context->table("tbl_pedigree")->where("dog_name=?", $dogName)->count();

        $data = array();

        $data['dog_name'] = $dogName;
        $data['father_name'] = $fatherName;
        $data['mother_name'] = $motherName;

        if ($rows > 0)
            $context->table("tbl_pedigree")->where("dog_name=?", $dogName)->update($data);
        else
            $context->table("tbl_pedigree")->insert($data);
    }

    public static function createPlannedLitters($kennel_id, $old_id, $context, $old_context) {
        $importdb = $old_context;
        $database = $context;

        $data_model = new DataModel($database);

        $planned_litters = $importdb->table("wp_posts")->where("post_author = ?", $old_id)->where("post_type = ?", "ac_litter")->fetchAll();

        $kennel = $database->table("tbl_userkennel")->where("id=?", $kennel_id)->fetch();
        $kennel_breed = $database->table("link_kennel_breed")->where("kennel_id=?", $kennel_id)->fetch();
        $user = $database->table("tbl_user")->where("id=?", $kennel->user_id)->fetch();

        foreach ($planned_litters as $planned_litter) {
            $pl_detail = $importdb->table("wp_postmeta")->where("post_id = ?", $planned_litter->ID)->where("meta_key = ?", "_animal_litters")->fetch();

            $description = explode("|", $pl_detail->meta_value);

            $data = array();

            $data['kennel_id'] = $kennel_id;
            $data['name'] = $description[1];

            $var = $description[6];
            $date = str_replace('.', '-', $var);
            $year = date('Y', strtotime($date));
            $month = date('m', strtotime($date));

            $data['month'] = $month;
            $data['year'] = $year;

            $data['dog_name'] = $description[2];
            $data['dog_image'] = str_replace("http://www.dogforshow.com/", "", $description[7]);

            if (strlen($kennel_breed->breed_name) > 0)
                $data['dog_breed'] = $kennel_breed->breed_name;
            else
                $data['dog_breed'] = "";

            $data['dog_state'] = $user->state;

            $data['bitch_name'] = $description[4];
            $data['bitch_image'] = str_replace("http://www.dogforshow.com/", "", $description[8]);

            if (strlen($kennel_breed->breed_name) > 0)
                $data['bitch_breed'] = $kennel_breed->breed_name;
            else
                $data['bitch_breed'] = "";

            $data['bitch_state'] = $user->state;

            $pl_id = $database->table("tbl_planned_litters")->insert($data)->id;

            //$pl_id = $database->getInsertId();
            $old_plid = $description[9];

            $data_model->addToTimeline($kennel_id, $pl_id, 7, $data['name'] . ' - ' . $data['month'] . '/' . $data['year'] . ' - ' . $data['dog_name'] . ' X ' . $data['bitch_name'], $data['dog_image']);

            ImportModel::createPuppies($pl_id, $kennel->id, $user->id, $old_plid, $database, $importdb);
        }
    }

    public static function createPuppies($pl_id, $kennel_id, $user_id, $old_plid, $database, $importdb) {
        $puppies = $importdb->table("wp_postmeta")->where("post_id=?", $old_plid)->where("meta_key=?", "_puppy")->fetchAll();
        $planned_litter = $database->table("tbl_planned_litters")->where("id=?", $pl_id)->fetch();

        $data_model = new DataModel($database);

        foreach ($puppies as $puppy) {
            $description = explode("|", $puppy->meta_value);

            $data = array();

            $data['user_id'] = $user_id;
            $data['profile_id'] = $kennel_id;
            $data['planned_litter_id'] = $pl_id;
            $data['breed_name'] = $planned_litter->bitch_breed;

            if ($description[5] == "Pes")
                $data['puppy_gender'] = "Dog";
            else
                $data['puppy_gender'] = "Bitch";

            if ($description[9] == "Na predaj")
                $data['puppy_state'] = "ForSale";
            elseif ($description[9] == "Rezervované")
                $data['puppy_state'] = "Reserved";
            else
                $data['puppy_state'] = "Sold";

            $data['puppy_name'] = $description[2];

            ImportModel::setParents($data['puppy_name'], $planned_litter->dog_name, $planned_litter->bitch_name, $database);

            $data['puppy_photo'] = str_replace("http://www.dogforshow.com/", "", $description[10]);
            $data['puppy_description'] = $description[6];

            $data['country'] = ImportModel::getStateEn($description[4], $database);

            $var = $description[3];
            $date = str_replace('.', '-', $var);
            $date = date('Y-m-d', strtotime($date));

            $data['date_of_birth'] = $date;

            $puppy_id = $database->table("tbl_puppies")->insert($data)->id;

            //$puppy_id = $database->getInsertId();

            $data_model->addToTimeline($kennel_id, $puppy_id, 13, $data['puppy_name'], $data['puppy_photo']);
        }
    }

    public static function createPedigrees($context, $importdb) {
        $dads = $importdb->table("wp_postmeta")->where("meta_key=?", "_animal_pedigree_dad");

        foreach ($dads as $dad) {
            $description = explode("|", $dad->meta_value);

            ImportModel::setParents($description[0], $description[1], $description[8], $context);
            ImportModel::setParents($description[1], $description[2], $description[5], $context);
            ImportModel::setParents($description[2], $description[3], $description[4], $context);
            ImportModel::setParents($description[5], $description[6], $description[7], $context);
            ImportModel::setParents($description[8], $description[9], $description[12], $context);
            ImportModel::setParents($description[9], $description[10], $description[11], $context);
            ImportModel::setParents($description[12], $description[13], $description[14], $context);
        }

        $moms = $importdb->table("wp_postmeta")->where("meta_key=?", "_animal_pedigree_mom");

        foreach ($moms as $mom) {
            $description = explode("|", $mom->meta_value);

            ImportModel::setParents($description[0], $description[1], $description[8], $context);
            ImportModel::setParents($description[1], $description[2], $description[5], $context);
            ImportModel::setParents($description[2], $description[3], $description[4], $context);
            ImportModel::setParents($description[5], $description[6], $description[7], $context);
            ImportModel::setParents($description[8], $description[9], $description[12], $context);
            ImportModel::setParents($description[9], $description[10], $description[11], $context);
            ImportModel::setParents($description[12], $description[13], $description[14], $context);
        }
    }

    public static function importDogShows($dog_id, $old_id, $database, $importdb) {
        // $animal_show[0] - zoradenie
        // $animal_show[1] - Datum vystavy
        // $animal_show[2] - Druh vystavy (Oblastná,Klubová,Špeciálna CAC,Celoštátna CAC,Národná CAC,NV,Medzinárodná CACIB,Európska,Svetová) r
        // $animal_show[3] - Nazov vystavy
        // $animal_show[4] - Stat
        // $animal_show[5] - Meno rozhodcu
        // $animal_show[6] - Trieda (Mladší dorast,Dorast,Mladí,Stredná,Otvorená,Pracovná,Šampióni,Veteráni,Čestná) r
        // $animal_show[7] - Hodnotenie (VP 1,VP 2,VP 3,VP / EXC 1,EXC 2,EXC 3,EXC 4,VG 1,VG 2,VG 3,VG 4) r
        // $animal_show[8] - Ocenenia junior (CAJC,JBOB,BOB,BOS) c
        // $animal_show[9] - Junior BOG (JBOG 1,JBOG 2,JBOG 3) r
        // $animal_show[10] - Junior BIS (JBIS 1,JBIS 2,JBIS 3) r
        // $animal_show[11] - Ocenenia (CAC,RES.CAC,CACIB,RES.CACIB,BOS,BOB) c
        // $animal_show[12] - BOG (BOG 1,BOG 2,BOG 3) r
        // $animal_show[13] - BIS (BIS 1,BIS 2,BIS 3) r
        // $animal_show[14] - Ine ocenenenia
        // $animal_show[15] - obrazok
        // $animal_show[16] - random ID
        // $animal_show[17] - Puppy BIS (Best puppy male & female 1,Best puppy male & female 2,Best puppy male & female 3) r
        // $animal_show[18] - Minor puppy BIS (Best Minor puppy 1,Best Minor puppy 2,Best Minor puppy 3) r
        //$database = $importdb = getContext();

        $shows = $importdb->table("wp_postmeta")->where("post_id=?", $old_id)->where("meta_key=?", "_animal_shows")->fetchAll();
        $dog = $database->table("tbl_dogs")->where("id=?", $dog_id)->fetch();

        $data_model = new DataModel($database);

        $count = 0;

        foreach ($shows as $show) {
            $description = explode("|", $show->meta_value);
            $data = array();

            $data['dog_id'] = $dog_id;

            $var = $description[1];
            $date = str_replace('.', '-', $var);
            $date = date('Y-m-d', strtotime($date));

            $data['show_date'] = $date;

            if ($description[2] == "Oblastná")
                $description[2] = "Regional";
            if ($description[2] == "Klubová")
                $description[2] = "Club";
            if ($description[2] == "Špeciálna CAC")
                $description[2] = "SpecialCAC";
            if ($description[2] == "Celoštátna CAC")
                $description[2] = "NationalCAC";
            if ($description[2] == "Národná CAC,NV")
                $description[2] = "NationalCACNW";
            if ($description[2] == "Medzinárodná CACIB")
                $description[2] = "InternationalCACIB";
            if ($description[2] == "Európska")
                $description[2] = "EuropeanShow";
            if ($description[2] == "Svetová")
                $description[2] = "WorldShow";


            $data['show_type'] = $description[2];
            $data['show_name'] = $description[3];
            $data['show_country'] = ImportModel::getStateEn($description[4], $database);
            $data['judge_name'] = $description[5];

            if ($description[6] == "Mladší dorast")
                $description[6] = "MinorPuppy";
            if ($description[6] == "Dorast")
                $description[6] = "Puppy";
            if ($description[6] == "Mladí")
                $description[6] = "Junior";
            if ($description[6] == "Stredná")
                $description[6] = "Intermediate";
            if ($description[6] == "Otvorená")
                $description[6] = "Open";
            if ($description[6] == "Pracovná")
                $description[6] = "Working";
            if ($description[6] == "Šampióni")
                $description[6] = "Champions";
            if ($description[6] == "Veteráni")
                $description[6] = "Veteran";
            if ($description[6] == "Čestná")
                $description[6] = "Honor";

            $data['show_class'] = $description[6];

            $description[7] = strtoupper(str_replace(" ", "", $description[7]));
            if (strlen($description[7]) > 1)
                $data[$description[7]] = 1;


            $titles = explode(",", $description[8]);

            foreach ($titles as $title) {
                $title = str_replace(" ", "", $title);
                $title = str_replace("^", "", $title);
                $title = str_replace(".", "", $title);

                if (strlen($title) > 1)
                    $data[$title] = 1;
            }

            $titles = explode(",", $description[9]);

            foreach ($titles as $title) {
                $title = str_replace(" ", "", $title);
                $title = str_replace("^", "", $title);
                $title = str_replace(".", "", $title);

                if (strlen($title) > 1)
                    $data[$title] = 1;
            }

            $titles = explode(",", $description[10]);

            foreach ($titles as $title) {
                $title = str_replace(" ", "", $title);
                $title = str_replace("^", "", $title);
                $title = str_replace(".", "", $title);

                if (strlen($title) > 1)
                    $data[$title] = 1;
            }

            $titles = explode(",", $description[11]);

            foreach ($titles as $title) {
                $title = str_replace(" ", "", $title);
                $title = str_replace("^", "", $title);
                $title = str_replace(".", "", $title);

                if (strlen($title) > 1)
                    $data[$title] = 1;
            }

            $titles = explode(",", $description[12]);

            foreach ($titles as $title) {
                $title = str_replace(" ", "", $title);
                $title = str_replace("^", "", $title);
                $title = str_replace(".", "", $title);

                if (strlen($title) > 1)
                    $data[$title] = 1;
            }

            $titles = explode(",", $description[13]);

            foreach ($titles as $title) {
                $title = str_replace(" ", "", $title);
                $title = str_replace("^", "", $title);
                $title = str_replace(".", "", $title);

                if (strlen($title) > 1)
                    $data[$title] = 1;
            }

            $data['other_title'] = $description[14];
            $data['show_image'] = str_replace("http://www.dogforshow.com/", "", $description[15]);

            if ($description[17] == "Best puppy male & female 1")
                $description[17] = "BestPuppy1";
            if ($description[17] == "Best puppy male & female 2")
                $description[17] = "BestPuppy2";
            if ($description[17] == "Best puppy male & female 3")
                $description[17] = "BestPuppy3";

            if (strlen($description[17]) > 2)
                $data[$description[17]] = 1;

            if ($description[18] == "Best Minor puppy 1")
                $description[18] = "BestMinorPuppy1";
            if ($description[18] == "Best Minor puppy 2")
                $description[18] = "BestMinorPuppy2";
            if ($description[18] == "Best Minor puppy 3")
                $description[18] = "BestMinorPuppy3";

            if (strlen($description[18]) > 2)
                $data[$description[18]] = 1;


            try {
                $id = $database->table("tbl_dogs_shows")->insert($data)->id;

                //$id = $database->getInsertId();

                $data_model->addToTimeline($dog->kennel_id, $id, 11, $data['show_date'] . ' - ' . $data['show_name'], $data['show_image']);
            } catch (\Exception $ex) {
                $count++;
            }
        }

        if ($count > 0)
            echo $count . '<br/>';
    }

    public static function importHandlerShows($handler_id, $old_id, $database, $importdb) {
        // $animal_show[0] - zoradenie
        // $animal_show[1] - Datum vystavy
        // $animal_show[2] - Druh vystavy (Oblastná,Klubová,Špeciálna CAC,Celoštátna CAC,Národná CAC,NV,Medzinárodná CACIB,Európska,Svetová) r
        // $animal_show[3] - Nazov vystavy
        // $animal_show[4] - Stat
        // $animal_show[5] - Meno rozhodcu
        // $animal_show[6] - Trieda (Mladší dorast,Dorast,Mladí,Stredná,Otvorená,Pracovná,Šampióni,Veteráni,Čestná) r
        // $animal_show[7] - Hodnotenie (VP 1,VP 2,VP 3,VP / EXC 1,EXC 2,EXC 3,EXC 4,VG 1,VG 2,VG 3,VG 4) r
        // $animal_show[8] - Ocenenia junior (CAJC,JBOB,BOB,BOS) c
        // $animal_show[9] - Junior BOG (JBOG 1,JBOG 2,JBOG 3) r
        // $animal_show[10] - Junior BIS (JBIS 1,JBIS 2,JBIS 3) r
        // $animal_show[11] - Ocenenia (CAC,RES.CAC,CACIB,RES.CACIB,BOS,BOB) c
        // $animal_show[12] - BOG (BOG 1,BOG 2,BOG 3) r
        // $animal_show[13] - BIS (BIS 1,BIS 2,BIS 3) r
        // $animal_show[14] - Ine ocenenenia
        // $animal_show[15] - obrazok
        // $animal_show[16] - random ID
        // $animal_show[17] - Puppy BIS (Best puppy male & female 1,Best puppy male & female 2,Best puppy male & female 3) r
        // $animal_show[18] - Minor puppy BIS (Best Minor puppy 1,Best Minor puppy 2,Best Minor puppy 3) r
        //$database = $importdb = getContext();

        $shows = $importdb->table("wp_postmeta")->where("post_id=?", $old_id)->where("meta_key=?", "_animal_shows")->fetchAll();
        $data_model = new DataModel($database);

        $count = 0;

        foreach ($shows as $show) {
            $description = explode("|", $show->meta_value);
            $data = array();
            $data_group = array();

            $data['handler_id'] = $handler_id;
            $data_group['handler_id'] = $handler_id;

            $var = $description[1];
            $date = str_replace('.', '-', $var);
            $date = date('Y-m-d', strtotime($date));

            $data['show_date'] = $date;
            $data_group['show_date'] = $date;

            if ($description[2] == "Oblastná")
                $description[2] = "Regional";
            if ($description[2] == "Klubová")
                $description[2] = "Club";
            if ($description[2] == "Špeciálna CAC")
                $description[2] = "SpecialCAC";
            if ($description[2] == "Celoštátna CAC")
                $description[2] = "NationalCAC";
            if ($description[2] == "Národná CAC,NV")
                $description[2] = "NationalCACNW";
            if ($description[2] == "Medzinárodná CACIB")
                $description[2] = "InternationalCACIB";
            if ($description[2] == "Európska")
                $description[2] = "EuropeanShow";
            if ($description[2] == "Svetová")
                $description[2] = "WorldShow";


            $data_group['show_type'] = $description[2];
            $data_group['show_name'] = $description[3];
            $data_group['show_country'] = ImportModel::getStateEn($description[4], $database);
            $data['judge_name'] = $description[5];
            $data['dog_name'] = "-";

            if ($description[6] == "Mladší dorast")
                $description[6] = "MinorPuppy";
            if ($description[6] == "Dorast")
                $description[6] = "Puppy";
            if ($description[6] == "Mladí")
                $description[6] = "Junior";
            if ($description[6] == "Stredná")
                $description[6] = "Intermediate";
            if ($description[6] == "Otvorená")
                $description[6] = "Open";
            if ($description[6] == "Pracovná")
                $description[6] = "Working";
            if ($description[6] == "Šampióni")
                $description[6] = "Champions";
            if ($description[6] == "Veteráni")
                $description[6] = "Veteran";
            if ($description[6] == "Čestná")
                $description[6] = "Honor";

            $data['show_class'] = $description[6];

            $description[7] = strtoupper(str_replace(" ", "", $description[7]));
            if (strlen($description[7]) > 1)
                $data[$description[7]] = 1;


            $titles = explode(",", $description[8]);

            foreach ($titles as $title) {
                $title = str_replace(" ", "", $title);
                $title = str_replace("^", "", $title);
                $title = str_replace(".", "", $title);

                if (strlen($title) > 1)
                    $data[$title] = 1;
            }

            $titles = explode(",", $description[9]);

            foreach ($titles as $title) {
                $title = str_replace(" ", "", $title);
                $title = str_replace("^", "", $title);
                $title = str_replace(".", "", $title);

                if (strlen($title) > 1)
                    $data[$title] = 1;
            }

            $titles = explode(",", $description[10]);

            foreach ($titles as $title) {
                $title = str_replace(" ", "", $title);
                $title = str_replace("^", "", $title);
                $title = str_replace(".", "", $title);

                if (strlen($title) > 1)
                    $data[$title] = 1;
            }

            $titles = explode(",", $description[11]);

            foreach ($titles as $title) {
                $title = str_replace(" ", "", $title);
                $title = str_replace("^", "", $title);
                $title = str_replace(".", "", $title);

                if (strlen($title) > 1)
                    $data[$title] = 1;
            }

            $titles = explode(",", $description[12]);

            foreach ($titles as $title) {
                $title = str_replace(" ", "", $title);
                $title = str_replace("^", "", $title);
                $title = str_replace(".", "", $title);

                if (strlen($title) > 1)
                    $data[$title] = 1;
            }

            $titles = explode(",", $description[13]);

            foreach ($titles as $title) {
                $title = str_replace(" ", "", $title);
                $title = str_replace("^", "", $title);
                $title = str_replace(".", "", $title);

                if (strlen($title) > 1)
                    $data[$title] = 1;
            }

            $data['other_title'] = $description[14];
            $data['show_image'] = str_replace("http://www.dogforshow.com/", "", $description[15]);

            if ($description[17] == "Best puppy male & female 1")
                $description[17] = "BestPuppy1";
            if ($description[17] == "Best puppy male & female 2")
                $description[17] = "BestPuppy2";
            if ($description[17] == "Best puppy male & female 3")
                $description[17] = "BestPuppy3";

            if (strlen($description[17]) > 2)
                $data[$description[17]] = 1;

            if ($description[18] == "Best Minor puppy 1")
                $description[18] = "BestMinorPuppy1";
            if ($description[18] == "Best Minor puppy 2")
                $description[18] = "BestMinorPuppy2";
            if ($description[18] == "Best Minor puppy 3")
                $description[18] = "BestMinorPuppy3";

            if (strlen($description[18]) > 2)
                $data[$description[18]] = 1;


            try {
                $id = $database->table("tbl_handler_show_groups")->insert($data_group)->id;
                //$id = $database->getInsertId();
                $data['show_id'] = $id;
                $id = $database->table("tbl_handler_shows")->insert($data)->id;

                //$id = $database->getInsertId();

                $data_model->addToTimeline($handler_id, $id, 11, $data_group['show_date'] . ' - ' . $data_group['show_name'], $data['show_image']);
            } catch (\Exception $ex) {
                $count++;
            }
        }

        if ($count > 0)
            echo "h - " . $count . '<br/>';
    }

    public static function importDogChampionship($dog_id, $old_id, $database, $importdb) {
        $rows = $importdb->table("wp_postmeta")->where("post_id=?", $old_id)->where("meta_key=?", "_animal_titles")->fetchAll();

        $dog = $database->table("tbl_dogs")->where("id=?", $dog_id)->fetch();

        $data_model = new DataModel($database);

        foreach ($rows as $row) {
            $description = explode("|", $row->meta_value);

            $var = $description[4];
            $date = str_replace('.', '-', $var);
            $date = date('Y-m-d', strtotime($date));

            $data = array();
            $data['dog_id'] = $dog_id;
            $data['date'] = $date;
            $data['description'] = $description[1];
            $data['image'] = str_replace("http://www.dogforshow.com/", "", $description[2]);

            try {
                $id = $database->table("tbl_dogs_championship")->insert($data)->id;
                //$id = $database->getInsertId();

                $data_model->addToTimeline($dog->kennel_id, $id, 5, $data['description'], $data['image']);
            } catch (\Exception $ex) {
                
            }
        }
    }

    public static function importDogHealth($dog_id, $old_id, $database, $importdb) {
        $rows = $importdb->table("wp_postmeta")->where("post_id=?", $old_id)->where("meta_key=?", "_animal_healths")->fetchAll();

        foreach ($rows as $row) {
            $description = explode("|", $row->meta_value);

            $var = $description[4];
            $date = str_replace('.', '-', $var);
            $date = date('Y-m-d', strtotime($date));

            $data = array();
            $data['dog_id'] = $dog_id;
            $data['date'] = $date;
            $data['description'] = $description[1];
            $data['image'] = str_replace("http://www.dogforshow.com/", "", $description[2]);

            try {
                $database->table("tbl_dogs_health")->insert($data);
            } catch (\Exception $ex) {
                
            }
        }
    }

    public static function importDogMatings($dog_id, $old_id, $database, $importdb) {
        $rows = $importdb->table("wp_postmeta")->where("post_id=?", $old_id)->where("meta_key=?", "_animal_studs")->fetchAll();

        foreach ($rows as $row) {
            $description = explode("|", $row->meta_value);

            $var = $description[1];
            $date = str_replace('.', '-', $var);
            $date = date('Y-m-d', strtotime($date));

            $data = array();
            $data['dog_id'] = $dog_id;
            $data['date'] = $date;
            $data['description'] = $description[2];
            $data['image'] = str_replace("http://www.dogforshow.com/", "", $description[3]);

            try {
                $database->table("tbl_dogs_matings")->insert($data);
            } catch (\Exception $ex) {
                
            }
        }
    }

    public static function importDogWorkexams($dog_id, $old_id, $database, $importdb) {
        $rows = $importdb->table("wp_postmeta")->where("post_id=?", $old_id)->where("meta_key=?", "_animal_workexams")->fetchAll();

        foreach ($rows as $row) {
            $description = explode("|", $row->meta_value);

            $var = $description[5];
            $date = str_replace('.', '-', $var);
            $date = date('Y-m-d', strtotime($date));

            $data = array();
            $data['dog_id'] = $dog_id;
            $data['date'] = $date;
            $data['description'] = $description[1];
            $data['image'] = str_replace("http://www.dogforshow.com/", "", $description[3]);

            try {
                $database->table("tbl_dogs_workexams")->insert($data);
            } catch (\Exception $ex) {
                
            }
        }
    }

    public static function importDogPhotos($dog_id, $old_id, $database, $importdb) {
        $rows = $importdb->table("wp_postmeta")->where("post_id=?", $old_id)->where("meta_key=?", "_animal_photos")->fetchAll();
        $dog = $database->table("tbl_dogs")->where("id=?", $dog_id)->fetch();

        $data_model = new DataModel($database);

        foreach ($rows as $row) {
            $description = explode("|", $row->meta_value);

            $data = array();
            $data['user_id'] = $dog->user_id;
            $data['profile_id'] = $dog_id;
            $data['description'] = $description[0];
            $data['image'] = str_replace("http://www.dogforshow.com/", "", $description[1]);

            try {
                $id = $database->table("tbl_photos")->insert($data)->id;
                //$id = $database->getInsertId();

                $data_model->addToTimeline($dog->profile_id, $id, 10, $data['description'], $data['image']);
            } catch (\Exception $ex) {
                
            }
        }
    }

    public static function importHandlerPhotos($handler_id, $old_id, $database, $importdb) {
        $rows = $importdb->table("wp_postmeta")->where("post_id=?", $old_id)->where("meta_key=?", "_animal_photos")->fetchAll();
        $data_model = new DataModel($database);

        foreach ($rows as $row) {
            $description = explode("|", $row->meta_value);

            $handler = $database->table("tbl_userhandler")->where("id=?", $handler_id)->fetch();

            $data = array();
            $data['user_id'] = $handler->user_id;
            $data['profile_id'] = $handler_id;
            $data['description'] = $description[0];
            $data['image'] = str_replace("http://www.dogforshow.com/", "", $description[1]);

            try {
                $id = $database->table("tbl_photos")->insert($data)->id;
                //$id = $database->getInsertId();

                $data_model->addToTimeline($handler_id, $id, 10, $data['description'], $data['image']);
            } catch (\Exception $ex) {
                
            }
        }
    }

    public static function importHandlerAwards($handler_id, $old_id, $database, $importdb) {
        $rows = $importdb->table("wp_postmeta")->where("post_id=?", $old_id)->where("meta_key=?", "_animal_titles")->fetchAll();
        $data_model = new DataModel($database);

        foreach ($rows as $row) {
            $description = explode("|", $row->meta_value);

            $var = $description[4];
            $date = str_replace('.', '-', $var);
            $date = date('Y-m-d', strtotime($date));

            $data = array();
            $data['handler_id'] = $handler_id;
            $data['date'] = $date;
            $data['description'] = $description[1];
            $data['image'] = str_replace("http://www.dogforshow.com/", "", $description[2]);

            try {
                $id = $database->table("tbl_handler_awards")->insert($data)->id;
                //$id = $database->getInsertId();

                $data_model->addToTimeline($handler_id, $id, 5, $data['description'], $data['image']);
            } catch (\Exception $ex) {
                
            }
        }
    }

}
