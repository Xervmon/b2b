<?php
/**
* @copyright	Copyright (C) 2009 - 2013 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		Payplans
* @subpackage	AUP Discounts
* @contact 		payplans@readybytes.in
*/
if(defined('_JEXEC')===false) die();
?>
<div id="app-aupdiscount-apply">
	<span class="span6">
		<?php echo XiText::_("COM_PAYPLANS_AUPDISCOUNT_AUP_POINTS");?>
	</span>
	<span class="span6">			
		<div class="input-append">
		    	<input class="span9" id="app_aupdiscount_code_id" type="text" name="app_aupdiscount_code" size="9" value=""/>
		    	<button type="button" id="app_aupdiscount_code_submit" class="btn" data-loading-text="wait..." title = "<?php echo XiText::_("COM_PAYPLANS_APP_AUP_APPLY");?>" onClick="payplans.aupdiscount.apply(<?php echo $orderId;?>);">Apply</button>
		</div>
		<div>
			<?php echo XiText::sprintf("COM_PAYPLANS_AVAILABLE_AUP",$points).'&nbsp;'.$tooltip; ?>
		</div>
		<div id="app-aupdiscount-apply-error" class="text-error">&nbsp;</div>
	</span>
</div>
