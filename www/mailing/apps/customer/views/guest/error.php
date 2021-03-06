<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2015 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
?>


<div class="box box-primary">
    <div class="box-header"><h3 class="box-title"><?php echo Yii::t('app', 'Error {code}!', array('{code}' => (int)$code));?></h3></div>
    <div class="box-body">
        <p class="info"><?php echo CHtml::encode($message);?></p>
    </div>
    <div class="box-footer">
        <div class="pull-right">
            <a href="javascript:history.back(-1);" class="btn btn-default"> <i class="glyphicon glyphicon-circle-arrow-left"></i> <?php echo Yii::t('app', 'Back')?></a>
        </div>
        <div class="clearfix"><!-- --></div>
    </div>
</div>