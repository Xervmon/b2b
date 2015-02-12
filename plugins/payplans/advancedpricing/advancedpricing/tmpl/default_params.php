<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		payplans@readybytes.in
*/
if(defined('_JEXEC')===false) die();
?>
<div class="control-group">
	<div class="control-label"><?php echo XiText::_('COM_PAYPLANS_APP_ADVANCED_PRICING_SUBSCRIPTION_PURCHASED_UNITS');?></div>
	<div class="controls"><input type="text" disabled="disabled" value="<?php echo $units;?>"/></div>
</div>