<?php
/**
* @copyright	Copyright (C) 2009 - 2013 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		payplans@readybytes.in
*/
if(defined('_JEXEC')===false) die();
?>
<div class="row-fluid">

	<div class="text-center">
		<h4>
			<?php echo XiText::_('COM_PAYPLANS_APP_STRIPE_SUBMIT_FORM_ERROR_MSG');?>
		</h4>
		
		<div>
			<p>
				<p><?php echo "Error-code : ".$error_code;?></p>			
				<p><?php echo "Error-msg  : ".$error_msg;?></p>
			</p>	
			<div>&nbsp;</div>
			<a class="btn btn-primary btn-large" href="<?php echo XiRoute::_('index.php?option=com_payplans&view=invoice&task=confirm&invoice_key='.$invoice->getKey()); ?>">
				<?php echo XiText::_('COM_PAYPLANS_PAYMENT_PAYNOW')?>
			</a>
			<?php $style = array('class'=> 'btn btn-large');?>
			<?php echo PayplansHtml::_('email.link', XiText::_('COM_PAYPLANS_ELEMENT_EMAIL'), $style);?>
		</div>
	</div>
</div>
<?php 
	