<?php
/**
* @copyright	Copyright (C) 2009 - 2011 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @package		PayPlans
* @subpackage	Frontend
* @contact 		shyam@readybytes.in
* website		http://www.jpayplans.com
* Technical Support : Forum -	http://www.jpayplans.com/support/support-forum.html
*/
if(defined('_JEXEC')===false) die();
?>

<form action="<?php echo XiRoute::_('index.php?option=com_payplans&view=advancedpricing', false); ?>" method="post" name="adminForm" id="adminForm">
	<?php echo $this->loadTemplate('filter'); ?>
	<table class="table table-striped">

		<thead>
		<!-- TABLE HEADER START -->
			<tr>
				<th class="default-grid-sno">
          			<?php echo PayplansHtml::_('grid.sort', "SNo.", 'advancedpricing_id', $filter_order_Dir, $filter_order);?>
        		</th>
        		<th class="default-grid-chkbox">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($records); ?>);" />
				</th>
				<th><?php echo PayplansHtml::_('grid.sort', 'COM_PAYPLANS_APP_ADVANCED_PRICING_GRID_TITLE', 'title', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo PayplansHtml::_('grid.sort', 'COM_PAYPLANS_APP_ADVANCED_PRICING_GRID_PLAN', 'plan_id', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo PayplansHtml::_('grid.sort', 'COM_PAYPLANS_APP_ADVANCED_PRICING_GRID_SLAB_MIN_VALUE', 'min_value', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo PayplansHtml::_('grid.sort', 'COM_PAYPLANS_APP_ADVANCED_PRICING_GRID_SLAB_MAX_VALUE', 'max_value', $filter_order_Dir, $filter_order);?></th>
				<th><?php echo XiText::_('COM_PAYPLANS_APP_ADVANCED_PRICING_GRID_PRICING');?></th>
				<th><?php echo XiText::_('COM_PAYPLANS_APP_ADVANCED_PRICING_GRID_TIME');?></th>
				<th><?php echo XiText::_('COM_PAYPLANS_APP_ADVANCED_PRICING_GRID_PUBLISHED');?></th>
			</tr>
		<!-- TABLE HEADER END -->
		</thead>

		<tbody>
		<!-- TABLE BODY START -->
			<?php $count= $limitstart;
			$cbCount = 0;
			foreach ($records as $record):?>
				<tr class="<?php echo "row".$count%2; ?>">
					<td> <?php echo $count+1; ?> </td>
					
					<th class="default-grid-chkbox"><?php echo PayplansHtml::_('grid.id', $cbCount++, $record->{$record_key} ); ?></th>
    				<td><?php  echo XiHtml::link($uri.'&task=edit&id='.$record->{$record_key}, $record->title); ?></td>
    				
    				<td><?php   $planIds = (!empty($record->plans))?explode(',',JString::trim($record->plans, ',')):null; 
								   if(!empty($planIds)){ 
									   foreach ($planIds as $planId){
									   	echo !empty($plans[$planId]) ? $plans[$planId]->get('title')."," : '';
									   }
								   } ?></td>
    				<td><?php  echo $slabs[$record->advancedpricing_id]->min_value; ?></td>
    				<td><?php  echo $slabs[$record->advancedpricing_id]->max_value; ?></td>
					<?php  $details = json_decode($slabs[$record->advancedpricing_id]->details, true);
										$price = $details['price'];
										$time  = $details['expiration_time'];
					?>
					<td>
							<?php 	foreach ($price as $amount):?>
										<?php
													$currency = PayplansHelperFormat::currency(XiFactory::getCurrency(XiFactory::getConfig()->currency, array(), 'symbol'));
													echo $this->loadTemplate('partial_amount', compact('currency', 'amount'), 'default'); 
										echo '<br><br>';?>
							<?php endforeach;?>
					</td>
					
					<td>
							<?php 	foreach ($time as $value):?>
										<?php echo PayplansHelperFormat::planTime(PayplansHelperPlan::convertIntoTimeArray($value)).'<br><br>';?>
							<?php endforeach;?>
					</td>
					
					<td><?php  echo PayplansHtml::_("boolean.grid", $record, 'published', $count);?></td>
				</tr>
			<?php $count++;?>
			<?php endforeach;?>
		<!-- TABLE BODY END -->
		</tbody>

		<tfoot>
		<!-- TABLE FOOTER START -->
			<tr>
				<td colspan="9">
					<?php echo $pagination->getListFooter(); ?>
				</td>
			</tr>
		<!-- TABLE BODY END -->
		</tfoot>
	</table>

	<input type="hidden" name="filter_order" value="<?php echo $filter_order;?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $filter_order_Dir;?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
</form>
<?php 
