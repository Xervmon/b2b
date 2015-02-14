<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		shyam@readybytes.in
*/
if(defined('_JEXEC')===false) die();?>
	<fieldset>
		<legend><h4><?php echo XiText::_('COM_PAYPLANS_PLAN_JOMSOCIAL_REGISTRATION');?></h4></legend>
		<div class="text-center">
				<button type="submit" name="payplansRegisterJomsocial" class="btn" onclick="this.onclick=function(){return false;}"><i class="icon-user"></i>&nbsp;<?php echo XiText::_('COM_PAYPLANS_PLAN_REGISTRATION_JOMSOCIAL');?></button>
		</div>
	</fieldset>
<?php  