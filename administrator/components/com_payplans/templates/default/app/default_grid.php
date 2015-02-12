<?php
if(defined('_JEXEC')===false) die();?>
<div class="pp-config-edit">

	<ul id="myTabTabs" class="nav nav-tabs">
		<li class="active"><a data-toggle="tab"href="#ppinstall" id="installedapps" ><img src=<?php echo JURI::root().'administrator/components/com_payplans/templates/default/_media/images/icons/my-pp-apps-icon.png'; ?> />&nbsp;&nbsp;<?php echo XiText::_('COM_PAYPLANS_APP_AVAILABLE_APPS'); ?> </a></li>
		<li class=""><a data-toggle="tab" id="manageapps" href="#ppmanage"><img src=<?php echo JURI::root().'administrator/components/com_payplans/templates/default/_media/images/icons/pp-apps-instance-icon.png'; ?> />&nbsp;&nbsp;<?php echo XiText::_('COM_PAYPLANS_APP_APPS_INSTANCE'); ?> </a></li>
        <li class=""><a data-toggle="tab" id="availableapps"  href="#ppavailable" onclick="location.href = 'index.php?option=com_rbinstaller&view=item&product_tag=rbappspayplans&tmpl=component';"><img src=<?php echo JURI::root().'administrator/components/com_payplans/templates/default/_media/images/icons/pp-app-store-icon.png'; ?> />  <?php echo XiText::_('COM_PAYPLANS_APP_APP_STORE'); ?> </a></li></ul>

	
	<div id="myTabContent" class="tab-content">
        <div class="tab-pane active" id="ppinstall">
	
			<?php echo $this->loadTemplate('selectapp');?>
		</div>
		
		<div class="tab-pane" id="ppmanage">
			<?php $this->assign('apps', PayplansHelperApp::getApps());
			  $this->assign('appdata', PayplansHelperApp::getXml());
		?>
			<?php echo $this->loadTemplate('installedapp');?>
		</div>
		<div class="tab-pane" id="ppavailable">
			<h3><?php echo XiText::_("COM_PAYPLANS_APP_REDIRECT_TO_APP_STORE");?></h3>
		</div>
	 </div>

    <input type="hidden" name="filter_order" value="<?php echo $filter_order;?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $filter_order_Dir;?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
</div>
<?php 