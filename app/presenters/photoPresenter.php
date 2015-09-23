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

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
        $this->data_model = new \DataModel($database);
        $this->translator = new DFSTranslator();
    }

    protected function startup() {
        parent::startup();
    }

    /*     * ******************* view default ******************** */

    public function beforeRender() {
        parent::beforeRender();
    }

    public function actionPhoto_add($profile_id) {
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
    }

    public function frmEditPhotoSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $data['image'] = $values->txtPhoto;
            $data['description'] = $values->txtPhotoName;

            $this->database->table("tbl_photos")->where("id=?", $this->photo_id)->update($data);
        } catch (\Exception $ex) {
            
        }
    }

}
