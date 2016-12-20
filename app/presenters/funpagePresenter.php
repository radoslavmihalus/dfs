<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class funpagePresenter extends BasePresenter {

    protected function startup() {
        parent::startup();
    }

    /**
     * 
     * Render methods
     * 
     */
    public function beforeRender() {
        parent::beforeRender();

        $query = "SELECT * FROM (
    (SELECT id, kennel_create_date as create_date FROM tbl_userkennel ORDER BY kennel_create_date DESC LIMIT 0,3)
    UNION ALL
    (SELECT id, owner_create_date as create_date FROM tbl_userowner ORDER BY owner_create_date DESC LIMIT 0,3)
    UNION ALL
    (SELECT id, handler_create_date as create_date FROM tbl_userhandler ORDER BY handler_create_date DESC LIMIT 0,3)
) AS foo ORDER BY create_date DESC LIMIT 0,3";
        $profiles = $this->database->query($query)->fetchAll();
        $dogs = $this->database->table("tbl_dogs")->order("id DESC")->limit(3)->fetchAll();
        $puppies = $this->database->table("tbl_puppies")->order("id DESC")->limit(3)->fetchAll();

        $photos = $this->database->table("tbl_photos")->limit(6)->order("id DESC")->fetchAll();
        $videos = $this->database->table("tbl_videos")->limit(6)->order("id DESC")->fetchAll();

        $groups = $this->database->table("tbl_articles_groups")->where("active=?", 1)->where("parent_id=?", 0)->fetchAll();

        $this->template->groups = $groups;
        $this->template->profiles = $profiles;
        $this->template->dogs = $dogs;
        $this->template->puppies = $puppies;
        $this->template->photos = $photos;
        $this->template->videos = $videos;
    }

    public function renderFunpage_profile_home() {
        
    }

    /*     * ******** renderers ************* */
}
