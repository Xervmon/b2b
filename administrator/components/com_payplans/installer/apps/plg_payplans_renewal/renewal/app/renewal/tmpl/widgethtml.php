<?php
/**
 * @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * @package		PayPlans
 * @subpackage	Frontend
 * @contact 	payplans@readybytes.in


 */
if(defined('_JEXEC')===false) die(); ?>

<!-- display renew link -->
<?php
if ($subscription->isRecurring() && PayplansStatus::SUBSCRIPTION_EXPIRED == $subscription->getStatus() ) :
?>
	<a class="pp-renew-btn btn btn-large" href="<?php echo XiRoute::_('index.php?option=com_payplans&view=order&task=trigger&event=onPayplansOrderRenewalRequest&subscription_key='.$subscription->getKey());?>">
		<i class="pp-icon-repeat"></i>&nbsp;<?php echo XiText::_("COM_PAYPLANS_ORDER_RENEW_LINK");?>
	</a>
<?php 
elseif ( ('fixed' == $subscription->getExpirationType()) && in_array($subscription->getStatus(), array(PayplansStatus::SUBSCRIPTION_EXPIRED, PayplansStatus::SUBSCRIPTION_ACTIVE)) ) :
?>
	<a class="pp-renew-btn btn btn-large" href="<?php echo XiRoute::_('index.php?option=com_payplans&view=order&task=trigger&event=onPayplansOrderRenewalRequest&subscription_key='.$subscription->getKey());?>">
		<i class="pp-icon-repeat"></i>&nbsp;<?php echo XiText::_("COM_PAYPLANS_ORDER_RENEW_LINK");?>
	</a>
<?php
endif;