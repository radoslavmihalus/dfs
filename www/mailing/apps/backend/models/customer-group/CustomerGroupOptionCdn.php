<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * CustomerGroupOptionCdn
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2015 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3.5.4
 */
 
class CustomerGroupOptionCdn extends OptionCustomerCdn
{
    public function behaviors()
    {
        $behaviors = array(
            'handler' => array(
                'class'         => 'backend.components.behaviors.CustomerGroupModelHandlerBehavior',
                'categoryName'  => $this->_categoryName,
            ),
        );
        return CMap::mergeArray($behaviors, parent::behaviors());
    }

    public function save()
    {
        return $this->asa('handler')->save();
    }
    
    public function getGroupsList()
    {
        $groups = parent::getGroupsList();
        if ($group = $this->asa('handler')->getGroup()) {
            foreach ($groups as $groupId => $name) {
                if ($groupId == $group->group_id) {
                    unset($groups[$groupId]);
                    break;
                }
            }    
        }
        return $groups;
    }
}
