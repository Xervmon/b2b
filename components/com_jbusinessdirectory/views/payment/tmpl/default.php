<?php // no direct accesss
/**
* @copyright	Copyright (C) 2008-2009 CMSJunkie. All rights reserved.
* 
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
* See the GNU General Public License for more details.
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

defined('_JEXEC') or die('Restricted access');
$user = JFactory::getUser();
$orderId = $this->state->get("payment.orderId");
?>

<form action="<?php echo JRoute::_('index.php?option=com_jbusinessdirectory&view=payment&layout=redirect'); ?>" method="post" name="payment-form" id="payment-form" >
	<?php if(!empty($orderId)){?>
		<fieldset>
			<h3><?php echo JText::_("LNG_PAYMENT_METHODS")?></h3>
			<dl class="sp-methods" id="checkout-payment-method-load">
				<?php
					$oneMethod = count($this->paymentMethods) <= 1;
				    foreach ($this->paymentMethods as $method){
				?>
				    <dt>
				    <?php if(!$oneMethod){ ?>
				        <input id="p_method_<?php echo $method->type ?>" value="<?php echo $method->type ?>" type="radio" name="payment_method" title="<?php echo $method->name ?>" onclick="switchMethod('<?php echo $method->type ?>')" class="radio validate[required]" />
				    <?php }else{ ?>
				        <span class="no-display"><input id="p_method_<?php echo $method->type ?>" value="<?php echo $method->type ?>" type="radio" name="payment_method" checked="checked" class="radio" /></span>
				        <?php $oneMethod = $method->type; ?>
				    <?php } ?>
				    	<img class="payment-icon" src="<?php echo JURI::base() ."components/".JBusinessUtil::getComponentName().'/assets/images/payment/'.strtolower($method->type).'.gif' ?>"  />
				        <label for="p_method_<?php echo $method->type ?>"><?php echo $method->name ?> </label>
				    </dt>
				   	 <?php if ($html = $method->getPaymentProcessorHtml()){ ?>
					    <dd>
					        <?php echo $html; ?>
					    </dd>
					<?php } ?>
				<?php } ?>
			</dl>
		</fieldset>
	<?php } ?>
	
	<input type="hidden" name="orderId" value="<?php echo $this->state->get("payment.orderId")?>" /> 
	<input type="hidden" name="companyId" value="<?php echo $this->companyId?>" /> 
	<input type="hidden" name="option" value="<?php echo JBusinessUtil::getComponentName()?>" /> 
	<input type="hidden" name="task" value="payment.processTransaction" /> 
	
	<button type="submit" class="ui-dir-button ui-dir-button-green">
		<span class="ui-button-text"><?php echo JText::_("LNG_CONTINUE")?></span>
	</button>
</form>
<script>

jQuery(document).ready(function(){
	jQuery("#payment-form").validationEngine('attach');
});

function switchMethod(method){
	jQuery("#checkout-payment-method-load ul").each(function(){
		jQuery(this).hide();
	});
	//console.debug(method);
	jQuery("#payment_form_"+method).show();
}

</script>