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
<div class="pp-advanced-pricing">
	<br/>
	<div class="span12"><?php echo XiText::_('COM_PAYPLANS_APP_ADVANCED_PRICING_PLAN_PRICING_FOR').' '.$units.' '. XiText::_($unit_title).':'; ?></div>

	<table class="table">
		<tr>
				<th><?php echo XiText::_('COM_PAYPLANS_APP_ADVANCED_PRICING_CALCULATE_PRICE_SELECT');?></th>
				<th><?php echo XiText::_('COM_PAYPLANS_APP_ADVANCED_PRICING_CALCULATE_PRICE_TIME_FRAME');?></th>
				<th><?php echo XiText::_('COM_PAYPLANS_APP_ADVANCED_PRICING_CALCULATE_PRICE_PER_UNIT');?></th>
				<th><?php echo XiText::_('COM_PAYPLANS_APP_ADVANCED_PRICING_CALCULATE_PRICE_ACTUAL_PRICE');?></th>
				<th><?php echo XiText::_('COM_PAYPLANS_APP_ADVANCED_PRICING_CALCULATE_PRICE_PRICE_TO_PAY');?></th>
				<th><?php echo XiText::_('COM_PAYPLANS_APP_ADVANCED_PRICING_CALCULATE_PRICE_SAVING');?></th>
		</tr>

	<?php $count = count($prices);?>
	<?php for($i = 0; $i < $count; $i++):?>	
		<tr>
				<td><input type="radio" name="pp-pricing-select-<?php echo $plan_id;?>" style="margin-top:0.7em;" slab="<?php echo $slab_id?>" childslab="<?php echo $i;?>" units="<?php echo $units;?>"></td>
				
				<td><?php echo PayplansHelperFormat::planTime(PayplansHelperPlan::convertIntoTimeArray($times[$i]));?></td>
				
				<td>
						<?php $amount = $prices[$i];
							$currency = PayplansHelperFormat::currency(XiFactory::getCurrency(XiFactory::getConfig()->currency, array(), 'symbol'));
							echo $this->_render('partial_amount', compact('currency', 'amount'), 'default');?>
				</td>
				
				<td>
				<?php 		$actualprices[$i] = isset($actualprices[$i])?$actualprices[$i]:0;
							$actual = $amount = $units * $actualprices[$i];
							$currency = PayplansHelperFormat::currency(XiFactory::getCurrency(XiFactory::getConfig()->currency, array(), 'symbol'));
							echo $this->_render('partial_amount', compact('currency', 'amount'), 'default');?>
				</td>
				
				<td>
						<?php $discounted = $amount = $units * $prices[$i];
							$currency = PayplansHelperFormat::currency(XiFactory::getCurrency(XiFactory::getConfig()->currency, array(), 'symbol'));
							echo $this->_render('partial_amount', compact('currency', 'amount'), 'default');?>
				</td>
				<td>
						<?php $amount = $actual - $discounted;
							$currency = PayplansHelperFormat::currency(XiFactory::getCurrency(XiFactory::getConfig()->currency, array(), 'symbol'));
							echo $this->_render('partial_amount', compact('currency', 'amount'), 'default');?>
				</td>
		</tr>
	<?php endfor;?>
	</table>
</div>


<?php 
