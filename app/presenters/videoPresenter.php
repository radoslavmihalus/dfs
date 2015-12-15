<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class videoPresenter extends BasePresenter {

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

    public function actionVideo_add($profile_id) {
        if (!\DataModel::getPremium($this->logged_in_id)) {
            $cnt = $this->database->table("tbl_videos")->where("profile_id=?", $profile_id)->count();

            if ($cnt > -1) {
                $this->redirect("user:user_premium");
                $this->terminate();
            }
        }

        $this->photo_profile_id = $profile_id;
    }

    public function actionVideo_edit($id) {
        $this->photo_id = $id;
        $photo = $this->database->table("tbl_videos")->where("id=?", $id)->fetch();
        $this->photo_profile_id = $photo->profile_id;
    }

    protected function createComponentFormAddVideo() {
        $form = new Form();

        $form->addText("txtVideoName")->setRequired($this->translate("Required field"));
        $form->addText("txtVideo")->setRequired($this->translate("Required field"));
        $form->addSubmit('btnSubmit', 'Add')->onClick[] = array($this, 'frmAddVideoSucceeded');

        return $form;
    }

    protected function createComponentFormEditVideo() {
        $form = new Form();

        $photo = $this->database->table("tbl_videos")->where("id=?", $this->photo_id)->fetch();

        $form->addText("txtVideoName")->setRequired($this->translate("Required field"))->setValue($photo->description);
        $form->addText("txtVideo")->setRequired($this->translate("Required field"))->setValue($photo->video);
        $form->addSubmit('btnSubmit', 'Edit')->onClick[] = array($this, 'frmEditVideoSucceeded');

        return $form;
    }

    public function frmAddVideoSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $user_id = \DataModel::getUserIdByProfileId($this->photo_profile_id);

            $url = $values->txtVideo;
            
            if (strpos($url, 'youtu.be') !== false) {
                $my_array_of_vars = explode("/", $url);
                $url = $my_array_of_vars[count($my_array_of_vars) - 1];
            } else {
                parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
                $url = $my_array_of_vars['v'];
            }

            $data['profile_id'] = $this->photo_profile_id;
            $data['user_id'] = $user_id;
            $data['image'] = "http://img.youtube.com/vi/$url/0.jpg";
            $data['video'] = $values->txtVideo;
            $data['youtube'] = $url;
            $data['description'] = $values->txtVideoName;

            $this->database->table("tbl_videos")->insert($data);
            $this->photo_id = $this->database->getInsertId();
            $this->data_model->addToTimeline($this->photo_profile_id, $this->photo_id, 15, $data['description'], $data['image'], $data['video']);
        } catch (\Exception $ex) {
            
        }
        $this->redirect(\DataModel::getVideoGalleryProfileLinkUrl($this->photo_profile_id), array(id => $this->photo_profile_id));
    }

    public function frmEditVideoSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $url = $values->txtVideo;
            
            if (strpos($url, 'youtu.be') !== false) {
                $my_array_of_vars = explode("/", $url);
                $url = $my_array_of_vars[count($my_array_of_vars) - 1];
            } else {
                parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
                $url = $my_array_of_vars['v'];
            }


            $data['image'] = "http://img.youtube.com/vi/$url/0.jpg";
            $data['video'] = $values->txtVideo;
            $data['youtube'] = $url;
            $data['description'] = $values->txtVideoName;

            $this->database->table("tbl_videos")->where("id=?", $this->photo_id)->update($data);

            //$photo = $this->database->table("tbl_photos")->where("id=?", $this->photo_id)->fetch();
        } catch (\Exception $ex) {
            
        }
        $this->redirect(\DataModel::getVideoGalleryProfileLinkUrl($this->photo_profile_id), array(id => $this->photo_profile_id));
    }

}
