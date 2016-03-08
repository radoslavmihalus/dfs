<?php defined('MW_INSTALLER_PATH') || exit('No direct script access allowed');

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
    <div class="box-header">
        <h3 class="box-title">Congratulations, you've successfully installed MailWizz EMA!</h3>
    </div>
    <div class="box-body">
        You need to change the file permissions for the main configuration file (chmod 0555).<br />
        Main configuration file location is: "<code><?php echo MW_MAIN_CONFIG_FILE;?></code>"<br />
        <br />
        
        You also need to remove the install folder.<br />
        The install folder location is: "<code><?php echo MW_ROOT_PATH;?>/install</code>"<br />
        After you remove the install folder, you can login in the <a href="../backend">backend</a> and configure your new system.
        <br /><br />

        If you are having problems or suggestions, please visit <a href="http://www.mailwizz.com" target="_blank">mailwizz.com official website</a>.
        <br /><br />
        That's all, <br />
        Thank you for chosing MailWizz EMA.
        <div class="clearfix"><!-- --></div>      
    </div>
</div>