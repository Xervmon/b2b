<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		shyam@readybytes.in
*/
if(defined('_JEXEC')===false) die();
?>
<div class="row-fluid">

	<!-- Header -->
	<div class="row-fluid page-header">
		<h2>
			<?php echo XiText::_('COM_PAYPLANS_DASHBOARD');?>
		</h2>
	</div>

	
	<!-- Content -->
	<div class="row-fluid">	
		<!-- Main -->
		<div class="span8 clearfix pp-gap-bottom10">
			<?php echo $this->loadTemplate('template_message'); ?>
			<?php echo $this->loadTemplate($this->dashboard_main_template); ?>
		</div>
		
		<!-- Right-->
		<div class="span4 clearfix">
			<?php echo $this->loadTemplate('template_action'); ?>
			<?php echo $this->loadTemplate('template_right'); ?>
		</div>
		
	</div>
	
	
	<!-- Footer -->
	<div class="row-fluid">
		<?php echo $this->loadTemplate('template_footer'); ?>
	</div>
</div>
<?php
