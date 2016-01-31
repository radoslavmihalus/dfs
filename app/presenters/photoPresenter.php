<?php


namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class photoPresenter extends BasePresenter {

    /** @var Model\AlbumRepository */
//private $albums;
//    public function __construct() {
//        
//    }
//    private $database;
    private $photo_profile_id;
    private $photo_id;

    protected function startup() {
        parent::startup();
    }

    /*     * ******************* view default ******************** */

    public function beforeRender() {
        parent::beforeRender();
    }
    
    public function renderPhoto_list() {
        $filter_ids = array();
        $ids = $this->database->table("tbl_user")->select("id")->where("premium_expiry_date >= DATE(now())")->fetchAll();
        foreach ($ids as $id) {
            $filter_ids[] = $id->id;
        }

        $count = $this->database->table("tbl_photos")->where("user_id IN ?", $filter_ids)->count();
        
        $this->paginator->getPaginator()->setItemCount($count);
        $this->paginator->getPaginator()->setItemsPerPage(24);

        $rows = $this->database->table("tbl_photos")->where("user_id IN ?", $filter_ids)->limit($this->paginator->getPaginator()->getLength(), $this->paginator->getPaginator()->getOffset())->order("id DESC")->fetchAll();

        $this->template->photos = $rows;
    }

    public function actionPhoto_add($profile_id) {
        if (!\DataModel::getPremium($this->logged_in_id)) {
            $cnt = $this->database->table("tbl_photos")->where("profile_id=?", $profile_id)->count();

            if ($cnt > 4) {
                $this->redirect("user:user_premium");
                $this->terminate();
            }
        }

        $this->photo_profile_id = $profile_id;
    }

    public function actionPhoto_edit($id) {
        $this->photo_id = $id;
        $photo = $this->database->table("tbl_photos")->where("id=?", $id)->fetch();
        $this->photo_profile_id = $photo->profile_id;
    }

    protected function createComponentFormAddPhoto() {
        $form = new Form();

        $form->addText("txtPhotoName")->setRequired($this->translate("Required field"));
        $form->addText("txtPhoto")->setRequired($this->translate("Required field"));
        $form->addSubmit('btnSubmit', 'Add')->onClick[] = array($this, 'frmAddPhotoSucceeded');

        return $form;
    }

    protected function createComponentFormEditPhoto() {
        $form = new Form();

        $photo = $this->database->table("tbl_photos")->where("id=?", $this->photo_id)->fetch();

        $form->addText("txtPhotoName")->setRequired($this->translate("Required field"))->setValue($photo->description);
        $form->addText("txtPhoto")->setRequired($this->translate("Required field"))->setValue($photo->image);
        $form->addSubmit('btnSubmit', 'Edit')->onClick[] = array($this, 'frmEditPhotoSucceeded');

        return $form;
    }

    public function frmAddPhotoSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $user_id = \DataModel::getUserIdByProfileId($this->photo_profile_id);

            $data['profile_id'] = $this->photo_profile_id;
            $data['user_id'] = $user_id;
            $data['image'] = $values->txtPhoto;
            $data['description'] = $values->txtPhotoName;

            $this->database->table("tbl_photos")->insert($data);
            $this->photo_id = $this->database->getInsertId();
            $this->data_model->addToTimeline($this->photo_profile_id, $this->photo_id, 10, $data['description'], $data['image']);
        } catch (\Exception $ex) {
            
        }
        $this->redirect(\DataModel::getGalleryProfileLinkUrl($this->photo_profile_id), array(id => $this->photo_profile_id));
    }

    public function frmEditPhotoSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $data['image'] = $values->txtPhoto;
            $data['description'] = $values->txtPhotoName;

            $this->database->table("tbl_photos")->where("id=?", $this->photo_id)->update($data);

            //$photo = $this->database->table("tbl_photos")->where("id=?", $this->photo_id)->fetch();
        } catch (\Exception $ex) {
            
        }
        $this->redirect(\DataModel::getGalleryProfileLinkUrl($this->photo_profile_id), array(id => $this->photo_profile_id));
    }

}
