<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class funpagePresenter extends BasePresenter {

    public $image_path = "http://dfsadmin.btcloud.sk/app/uploads/";

    protected function startup() {
        parent::startup();
    }

    public function actionArticle($id) {
        $article = $this->database->table("tbl_articles")->where("id=?", $id)->fetch();

        $views_count = $article->views_count + 1;

        $data = array();
        $data['views_count'] = $views_count;

        $this->database->table("tbl_articles")->where("id=?", $article->id)->update($data);

        $this->template->article = $article;

        $similar_articles = $this->database->table("tbl_articles")->where("group_id=?", $article->group_id)->where("active=?",1)->where("id NOT IN(?)", $article->id)->order("rand()")->limit(4)->fetchAll();

        $this->template->similar_articles = $similar_articles;
    }

    public function actionArticle_list($group_id) {
        $articles = $this->database->table("tbl_articles")->where("group_id=?", $group_id)->where("active=?",1)->order("posting_date DESC")->fetchAll();
        $this->template->category_id = $group_id;
        $this->template->articles = $articles;
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

    public function getCategoryName($category_id = 0) {
        $group = $this->database->table("tbl_articles_groups")->where("id=?", $category_id)->fetch();

        return $group->group_name;
    }

    public function getParentCategoryName($category_id = 0) {
        $group = $this->database->table("tbl_articles_groups")->where("id=?", $category_id)->fetch();
        $parent_group = $this->database->table("tbl_articles_groups")->where("id=?", $group->parent_id)->fetch();

        return $parent_group->group_name;
    }

    public function getParentCategoryIcon($category_id = 0) {
        $group = $this->database->table("tbl_articles_groups")->where("id=?", $category_id)->fetch();
        $parent_group = $this->database->table("tbl_articles_groups")->where("id=?", $group->parent_id)->fetch();

        return $parent_group->icon;
    }

    public function renderFunpage_profile_home() {
        $popular_articles = $this->database->table("tbl_articles")->where("active=?",1)->order("views_count DESC")->limit(4)->fetchAll();
        $newest_articles = $this->database->table("tbl_articles")->where("active=?",1)->order("posting_date DESC")->limit(4)->fetchAll();
        
        $this->template->popular_articles = $popular_articles;
        $this->template->newest_articles = $newest_articles;
    }

    /*     * ******** renderers ************* */
}
