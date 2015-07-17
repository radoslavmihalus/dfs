<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class kennelPresenter extends BasePresenter {

    /** @var Model\AlbumRepository */
//private $albums;
//    public function __construct() {
//        
//    }
//    private $database;
    private $logged_in_kennel_id;
    private $award_id;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
        $this->data_model = new \DataModel($database);
        $this->translator = new DFSTranslator();
    }

    protected function startup() {
        parent::startup();
        try {
            $kennel_data = $this->database->table("tbl_userkennel")->where("user_id=?", $this->logged_in_id)->fetch();
            $this->logged_in_kennel_id = $kennel_data->id;
        } catch (\Exception $ex) {
            
        }

        $result = $this->database->table("tbl_breeds");

        $i = 0;

        $dditems = "";

        foreach ($result as $row) {
            if ($i == 0)
                $dditems .= $row->BreedName;
            else
                $dditems .= "," . $row->BreedName;

            $i++;
        }

//echo $dditems;

        $this->template->dd_breeds_items = $dditems;
    }

    /*     * ******************* view default ******************** */

    public function renderKennel_list() {
        $rows = $this->database->query("SELECT tbl_userkennel.*, tbl_user.state, FALSE as have_puppies FROM tbl_userkennel INNER JOIN tbl_user ON tbl_user.id = tbl_userkennel.user_id")->fetchAll();

        $this->template->result = $rows;
    }

    public function renderKennel_awards_list($id = 0) {
        $this->renderKennel_profile_home($id);
        if ($id == 0)
            $id = $this->logged_in_kennel_id;

        $result_awards = $this->database->table("link_kennel_awards")->where("kennel_id=?", $id)->order("kennel_award_date DESC")->fetchAll();

        $this->template->result_awards = $result_awards;
    }

    public function renderKennel_profile_home($id = 0) {
        if ($id == 0) {
            $id = $this->logged_in_kennel_id;

            $profile_data['active_profile_id'] = $id;
            $profile_data['active_profile_type'] = 1;
            $this->database->table("tbl_user")->where("id=?", $this->logged_in_id)->update($profile_data);
            parent::startup();
        }

        $row = $this->database->query("SELECT tbl_userkennel.*, tbl_user.state FROM tbl_userkennel INNER JOIN tbl_user ON tbl_user.id = tbl_userkennel.user_id WHERE tbl_userkennel.id=?", $id)->fetch();

        $have_puppies = FALSE;

        $profile_image = $row->kennel_profile_picture;
        $logged_in_profile_id = $row->id;
        $name = $row->kennel_name;
        if (strlen($row->kennel_background_image) > 2) {
            $have_background_image = TRUE;
            $background_image = $row->kennel_background_image;
        } else
            $have_background_image = FALSE;
        $state = $row->state;

        $this->template->have_puppies = $have_puppies;
        $this->template->profile_image = $profile_image;
        $this->template->logged_in_profile_id = $logged_in_profile_id;
        $this->template->kennel_name = $name;
        $this->template->have_background_image = $have_background_image;
        $this->template->background_image = $background_image;
        $this->template->state = $state;

        $this->renderKennel_description_home($id);
    }

    public function renderKennel_description_home($id = 0) {
//        $row = $this->database->query("SELECT tbl_userkennel.*, link_kennel_breed.breed_name FROM tbl_userkennel INNER JOIN link_kennel_breed ON link_kennel_breed.kennel_id = tbl_userkennel.id WHERE tbl_userkennel.id=?", $id)->fetch();
        $row = $this->database->query("SELECT tbl_userkennel.* FROM tbl_userkennel WHERE tbl_userkennel.id=?", $id)->fetch();

        $have_puppies = FALSE;

        $kennel_fci_number = $row->kennel_fci_number;
        $logged_in_profile_id = $row->id;
        $kennel_description = $row->kennel_description;
        $kennel_website = $row->kennel_website;

        $this->template->kennel_fci_number = $kennel_fci_number;
        $this->template->kennel_description = $kennel_description;
        $this->template->kennel_website = $kennel_website;

        $breeds = $this->database->query("SELECT link_kennel_breed.breed_name FROM link_kennel_breed WHERE kennel_id=?", $row->id)->fetchAll();

        $this->template->breeds = $breeds;
    }

    public function actionKennel_awards_edit($id) {
        $this->award_id = $id;
    }

    /*     * ******************* views add & edit ******************** */

    public function renderDelete($id = 0) {
//		$this->template->album = $this->albums->findById($id);
//		if (!$this->template->album) {
//			$this->error('Record not found');
//		}
    }

    /*     * ******************* component factories ******************** */

    /**
     * Edit form factory.
     * @return Form
     */
//Create profile

    protected function createComponentKennelCreateProfile() {

        $form = new Form();
        $form->addText('txtKennelName')->setRequired();
        $form->addText('txtKennelFciNumber');
        $form->addUpload('txtKennelProfilePicture')->setRequired();
        $form->addText('txtKennelWebsite');
        $form->addTextArea('txtKennelDescription');
        $form->addText('ddlBreedList')->setRequired();
        $form->addSubmit('btnSubmit', 'Create profile')->onClick[] = array($this, 'frmCreateProfileSucceeded');

        return $form;
    }

    public function frmCreateProfileSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $breeds = $values['ddlBreedList'];

            $form = $button->getForm();

            $img = $form['txtKennelProfilePicture']->getValue();

//var_dump($values['txtKennelProfilePicture']);

            $target_path = "uploads/";

            $ext = '';

            $ext = explode('.', $img->name);

            $length = count($ext);

            $ext = $ext[$length - 1];

            switch ($ext) {
                case 'gif':
                    $ext = 'gif';
                    break;
                case 'jpeg':
                    $ext = 'jpg';
                    break;
                case 'jpg':
                    $ext = 'jpg';
                    break;
                case 'png':
                    $ext = 'png';
                    break;
                default :
                    throw new \ErrorException("Only .gif / .jpeg / .jpg / .png extensions are allowed", "1");
                    break;
            }

            $filename = \KennelUpdateModel::generateRandomString() . ".$ext";

            $img->move("$target_path/$filename");

            $values['txtKennelProfilePicture'] = "$target_path/$filename";

            $values = $this->data_model->assignFields($values, 'frmKennelCreateProfile');
            $values['user_id'] = $this->logged_in_id;

            $this->database->table("tbl_userkennel")->insert($values);
            $id = $this->database->getInsertId();

            $breeds = explode(",", $breeds);

            foreach ($breeds as $breed) {
                $this->database->query("INSERT INTO link_kennel_breed(kennel_id, breed_name) VALUES(?,?)", $id, $breed);
            }

            $this->flashMessage("Your kennel profile has been successfully created.", "Success");
            $this->redirect("kennel:kennel_profile_home", $id);
        } catch (\ErrorException $exc) {
            $this->flashMessage($exc->getMessage(), "Error");
        }


//var_dump($values);
    }

//Update profile

    protected function createComponentKennelEditProfile() {
        $data = $this->database->table("tbl_userkennel")->where("user_id=?", $this->logged_in_id)->fetch();

        $form = new Form();

        $breed_rows = $this->database->query("SELECT link_kennel_breed.breed_name FROM link_kennel_breed WHERE kennel_id=?", $data->id)->fetchAll();

        $breeds = "";
        $i = 0;
        foreach ($breed_rows as $row) {
            if ($i == 0)
                $breeds .= $row->breed_name;
            else
                $breeds .= "," . $row->breed_name;

            $i++;
        }

        $form->addText('txtKennelName')->setValue($data->kennel_name)->setRequired();
        $form->addText('txtKennelFciNumber')->setValue($data->kennel_fci_number);
        $form->addText('txtKennelWebsite')->setValue($data->kennel_website);
        $form->addTextArea('txtKennelDescription')->setValue($data->kennel_description);
        $form->addText("ddlBreedList")->setValue($breeds)->setRequired();
        $this->template->breeds = $breeds;
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditProfileSucceeded');

        return $form;
    }

    public function frmEditProfileSucceeded($button) {
        try {
            $values = $button->getForm()->getValues();

            $breeds = $values['ddlBreedList'];

            $values = $this->data_model->assignFields($values, 'frmKennelEditProfile');

            var_dump($values);

            $this->database->table("tbl_userkennel")->where("user_id = ?", $this->logged_in_id)->update($values);

            $row = $this->database->table("tbl_userkennel")->where("user_id = ?", $this->logged_in_id)->fetch();

            $id = $row->id;

            $this->database->table("link_kennel_breed")->where("kennel_id=?", $id)->delete();

            $breeds = explode(",", $breeds);

            foreach ($breeds as $breed) {
                $this->database->query("INSERT INTO link_kennel_breed(kennel_id, breed_name) VALUES(?,?)", $id, $breed);
            }

            $this->flashMessage("Your kennel profile has been successfully updated.", "Success");
            $this->redirect("kennel:kennel_profile_home", $id);
        } catch (\ErrorException $exc) {
            $this->flashMessage($exc->getMessage(), "Error");
        }
    }

    protected function createComponentKennelEditProfileCoverImage() {
        $form = new Form();

        $form->addUpload('txtKennelCoverPhoto')->setRequired();
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditProfileCoverImageSuccess');

        return $form;
    }

    protected function createComponentKennelEditProfileImage() {
        $form = new Form();

        $form->addUpload('txtKennelProfilePicture')->setRequired();
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditProfileImageSuccess');

        return $form;
    }

    public function frmEditProfileImageSuccess($button) {
        $values = $button->getForm()->getValues();

        $img = $values['txtKennelProfilePicture'];

        $target_path = "uploads/";

        $ext = '';

        $ext = explode('.', $img->name);

        $length = count($ext);

        $ext = $ext[$length - 1];

        switch ($ext) {
            case 'gif':
                $ext = 'gif';
                break;
            case 'jpeg':
                $ext = 'jpg';
                break;
            case 'jpg':
                $ext = 'jpg';
                break;
            case 'png':
                $ext = 'png';
                break;
            default :
                throw new \ErrorException("Only .gif / .jpeg / .jpg / .png extensions are allowed", "1");
                break;
        }

        $filename = \KennelUpdateModel::generateRandomString() . ".$ext";

        $img->move("$target_path/$filename");

        $values['txtKennelProfilePicture'] = "$target_path/$filename";

        $values = $this->data_model->assignFields($values, 'frmEditProfileImage');
        $values['user_id'] = $this->logged_in_id;

        $mysection = $this->getSession('userdata');
        $myid = $mysection->id;

        $userdata = $this->database->table("tbl_userkennel")->where("user_id = ?", $myid)->update($values);
    }

    public function frmEditProfileCoverImageSuccess($button) {
        $values = $button->getForm()->getValues();

        $img = $values['txtKennelCoverPhoto'];

        $target_path = "uploads/";

        $ext = '';

        $ext = explode('.', $img->name);

        $length = count($ext);

        $ext = $ext[$length - 1];

        switch ($ext) {
            case 'gif':
                $ext = 'gif';
                break;
            case 'jpeg':
                $ext = 'jpg';
                break;
            case 'jpg':
                $ext = 'jpg';
                break;
            case 'png':
                $ext = 'png';
                break;
            default :
                throw new \ErrorException("Only .gif / .jpeg / .jpg / .png extensions are allowed", "1");
                break;
        }

        $filename = \KennelUpdateModel::generateRandomString() . ".$ext";

        $img->move("$target_path/$filename");

        $values['txtKennelCoverPhoto'] = "$target_path/$filename";

        $values = $this->data_model->assignFields($values, 'frmEditProfileCoverImage');
        $values['user_id'] = $this->logged_in_id;

        $mysection = $this->getSession('userdata');
        $myid = $mysection->id;

        $userdata = $this->database->table("tbl_userkennel")->where("user_id = ?", $myid)->update($values);
    }

    protected function createComponentFrmAddAward() {
        $form = new Form();

        $form->addText("ddlDate")->setRequired();
        $form->addText("txtAwardName")->setRequired();
        $form->addUpload("txtAwardPicture");
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmAddAwardSuccess');

        return $form;
    }

    protected function createComponentFrmEditAward() {

        $parid = $this->award_id;

        $row = $this->database->table("link_kennel_awards")->where("id = ?", $parid)->fetch();

        $form = new Form();

        $time = strtotime($row->kennel_award_date);
        $date = date('d.m.Y', $time);

        $form->addText("ddlDate")->setRequired()->setValue($date);
        $form->addText("txtAwardName")->setRequired()->setValue($row->kennel_award_title);
        $form->addUpload("txtAwardPicture");
        $form->addHidden("hidAwardId")->setValue($row->id);
        $form->addSubmit('btnSubmit')->onClick[] = array($this, 'frmEditAwardSuccess');

        return $form;
    }

    public function frmAddAwardSuccess($button) {
        try {
            $values = $button->getForm()->getValues();

            $form = $button->getForm();

            $img = $form['txtAwardPicture']->getValue();
            $target_path = "uploads/";

            $ext = '';

            $ext = explode('.', $img->name);

            $length = count($ext);

            $ext = $ext[$length - 1];

            switch ($ext) {
                case 'gif':
                    $ext = 'gif';
                    break;
                case 'jpeg':
                    $ext = 'jpg';
                    break;
                case 'jpg':
                    $ext = 'jpg';
                    break;
                case 'png':
                    $ext = 'png';
                    break;
                default :
                    throw new \ErrorException("Only .gif / .jpeg / .jpg / .png extensions are allowed", "1");
                    break;
            }

            $filename = \KennelUpdateModel::generateRandomString() . ".$ext";

            $img->move("$target_path/$filename");

            $values['txtAwardPicture'] = "$target_path/$filename";


            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values = $this->data_model->assignFields($values, 'frmAddAward');
            $values['kennel_id'] = $this->logged_in_kennel_id;

            $this->database->table("link_kennel_awards")->insert($values);
            $id = $this->database->getInsertId();

            $this->flashMessage("Your kennel award has been successfully created.", "Success");
            $this->redirect("kennel:kennel_awards_list", $id);
        } catch (\ErrorException $exc) {
            $this->flashMessage($exc->getMessage(), "Error");
        }
    }

    public function frmEditAwardSuccess($button) {
        try {
            $values = $button->getForm()->getValues();

            $id = $this->award_id;

            $form = $button->getForm();

            $img = $form['txtAwardPicture']->getValue();

            if (strlen($img) > 0) {
                $target_path = "uploads/";

                $ext = '';

                $ext = explode('.', $img->name);

                $length = count($ext);

                $ext = $ext[$length - 1];

                switch ($ext) {
                    case 'gif':
                        $ext = 'gif';
                        break;
                    case 'jpeg':
                        $ext = 'jpg';
                        break;
                    case 'jpg':
                        $ext = 'jpg';
                        break;
                    case 'png':
                        $ext = 'png';
                        break;
                    default :
                        throw new \ErrorException("Only .gif / .jpeg / .jpg / .png extensions are allowed", "1");
                        break;
                }

                $filename = \KennelUpdateModel::generateRandomString() . ".$ext";

                $img->move("$target_path/$filename");

                $values['txtAwardPicture'] = "$target_path/$filename";
            }

            $time = strtotime($values['ddlDate']);
            $values['ddlDate'] = date('Y-m-d', $time);

            $values = $this->data_model->assignFields($values, 'frmEditAward');
            //$values['kennel_id'] = $this->logged_in_kennel_id;

            $this->database->table("link_kennel_awards")->where("id = ?", $id)->update($values);

            $this->flashMessage("Your kennel award has been successfully updated.", "Success");
            $this->redirect("kennel:kennel_awards_list");
        } catch (\ErrorException $exc) {
            $this->flashMessage($exc->getMessage(), "Error");
        }
    }

}
