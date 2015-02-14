<?php
/**
* @copyright    Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license        http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @package        PayPlans
* @subpackage    Backend
* @contact         payplans@readybytes.in
* website        http://www.jpayplans.com
* Technical Support : Forum -    http://www.jpayplans.com/support/support-forum.html
*/
if(defined('_JEXEC')===false) die();
?>
       
       
<form action="<?php echo $uri; ?>" method="post" name="adminForm" id="adminForm">
<fieldset class="form-horizontal">
<ul id="myTabTabs" class="nav nav-tabs">
		<li ><a data-toggle="tab"href="#ppinstall" id="installedapps" ><img src=<?php echo JURI::root().'administrator/components/com_payplans/templates/default/_media/images/icons/my-pp-apps-icon.png'; ?> />&nbsp;&nbsp;<?php echo XiText::_('COM_PAYPLANS_APP_AVAILABLE_APPS'); ?> </a></li>
		<li class="active"><a data-toggle="tab" id="manageapps" href="#ppmanage"><img src=<?php echo JURI::root().'administrator/components/com_payplans/templates/default/_media/images/icons/pp-apps-instance-icon.png'; ?> />&nbsp;&nbsp;<?php echo XiText::_('COM_PAYPLANS_APP_APPS_INSTANCE'); ?> </a></li>
        <li class=""><a data-toggle="tab" id="availableapps"  href="#ppavailable" ><img src=<?php echo JURI::root().'administrator/components/com_payplans/templates/default/_media/images/icons/pp-app-store-icon.png'; ?> />  <?php echo XiText::_('COM_PAYPLANS_APP_APP_STORE'); ?> </a></li></ul>
	
	<div id="myTabContent" class="tab-content">

<div class="tab-pane" id="ppinstall">

			<?php echo $this->loadTemplate('selectapp');?>
			</div>
			  <div class="tab-pane active"  id="ppmanage">
				  <?php echo $this->loadTemplate('filter'); ?>
		        <div class='hero-unit'>
		            <h1><?php echo $heading; ?></h1>
		            <p><?php echo $msg; ?></p>
		        </div>
			</div>
			<div class="tab-pane" id="ppavailable">
				<?php echo XiText::_("COM_PAYPLANS_APP_REDIRECT_TO_APP_STORE");?>
		    </div>
    	</div>
    </fieldset>
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="active_tab" value="manageapps" />
    <input type="hidden" name="active_tab_content" value="ppmanage" />
    <input type="hidden" name="boxchecked" value="0" />
</form>