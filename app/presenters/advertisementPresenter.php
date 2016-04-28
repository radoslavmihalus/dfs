<?php

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;

class advertisementPresenter extends BasePresenter {

    private $advertisement_profile_id;
    private $advertisement_id;

    protected function startup() {
        parent::startup();
    }

    /*     * ******************* view default ******************** */

    public function beforeRender() {
        parent::beforeRender();
    }

    protected function createComponentFormAddAdvertisement() {
        $form = new Form();

        return $form;
    }

}
