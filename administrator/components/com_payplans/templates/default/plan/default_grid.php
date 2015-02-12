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
if(defined('_JEXEC')===false) die();?>

<form action="<?php  echo $uri; ?>" method="post" name="adminForm" id="adminForm">
	
	<?php echo $this->loadTemplate('filter'); ?>
	<table class="table table-striped">
		
		<thead>
		<!-- TABLE HEADER START -->
			<tr>		
			    <th>
					<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" />
				</th>
				<th><?php echo PayplansHtml::_('grid.sort', "COM_PAYPLANS_PLAN_GRID_PLAN_TITLE", 'title', $filter_order_Dir, $filter_order);?></th>
				
				<!--Plan Group Enabled then show Group Column-->
				<th class="hidden-phone">
					<?php $grpConfig = PayplansFactory::getConfig()->useGroupsForPlan;
						  if($grpConfig == 1){
						  	echo XiText::_("PAYPLANS_PLAN_GRID_FIELD_GROUP");
						  }?>
				</th>

				<th class="hidden-phone"><?php echo XiText::_("COM_PAYPLANS_PLAN_GRID_PLAN_PRICE");?></th>
				<th><?php echo XiText::_("COM_PAYPLANS_PLAN_GRID_PLAN_TYPE");?></th>
				<th class="hidden-phone"><?php echo PayplansHtml::_('grid.sort', "COM_PAYPLANS_PLAN_GRID_PLAN_PUBLISHED", 'published', $filter_order_Dir, $filter_order);?></th>
				<th class="hidden-phone"><?php echo PayplansHtml::_('grid.sort', "COM_PAYPLANS_PLAN_GRID_PLAN_VISIBLE", 'visible', $filter_order_Dir, $filter_order);?></th>
				<th class="hidden-phone"><?php echo PayplansHtml::_('grid.sort', "COM_PAYPLANS_PLAN_GRID_PLAN_ORDERING", 'ordering', $filter_order_Dir, $filter_order);?></th>
				<th class="hidden-phone"><?php echo XiText::_("PAYPLANS_PLAN_GRID_FIELD_USAGE_ANALYTICS");?></th>
			</tr>
		<!-- TABLE HEADER END -->
		</thead>
		
		<tbody>
		<!-- TABLE BODY START -->
			<?php $count= $limitstart;
			$cbCount = 0;
			
			//For Usage Analytics of Plans
			$planStats = array();
			
			$subscriptionStats = PayplansHelperPlan::getSubscriptionStats();
			foreach($subscriptionStats as $stat){
				$planStats[$stat->plan_id]['count'][$stat->status] = isset($stat->count) ? $stat->count : 0;
			}
			
			foreach ($records as $record):?>
				<tr class="<?php echo "row".$count%2; ?>">
					<th class="default-grid-chkbox">
		    			<?php echo PayplansHtml::_('grid.id', $cbCount++, $record->{$record_key} ); ?>
		    		</th>
					<td><?php echo PayplansHtml::link($uri.'&task=edit&id='.$record->{$record_key}, $record->title).'('.$record->plan_id.')';?></td>
					<?php $plan = PayplansPlan::getInstance( $record->plan_id, null, $record); ?>
					<td class="hidden-phone">
						<?php if($grpConfig == 1){
									$groupsIds = $plan->getGroups();
									foreach($groupsIds as $groupId){
										$group = PayplansGroup::getInstance($groupId);?>
										<div><?php echo PayplansHtml::link("index.php?option=com_payplans&view=group&task=edit&id=".$group->getId(), $group->getTitle()); ?></div>
							<?php 	}
								}?>
					</td>
					<td class="hidden-phone"><?php
					   $amount   = $plan->getPrice();
					   $currency = $plan->getCurrency(); 
					   echo $this->loadTemplate('partial_amount', compact('currency', 'amount'));
					
					?></td>
					<td><?php echo $plan->getExpirationType(); ?></td>
					
					<td class="hidden-phone"><?php echo PayplansHtml::_("boolean.grid", $record, 'published', $count);?></td>
					<td class="hidden-phone"><?php echo PayplansHtml::_("boolean.grid", $record, 'visible', $count);?></td>
					<td class="hidden-phone">
						<span><?php echo $pagination->orderUpIcon( $count , true, 'orderup', 'Move Up'); ?></span>
						<span><?php echo $pagination->orderDownIcon( $count , count($records), true , 'orderdown', 'Move Down', true ); ?></span>
					</td>

					<td class="hidden-phone">
							
						<?php if(array_key_exists($plan->getId(), $planStats)){
								
									// Total number of subscriptions of current plan
									$subscriptionCount  =  array_sum($planStats[$plan->getId()]['count']);
									
									// Tool-tip : According to the Status 
									$currentPlanStats['message'][PayplansStatus::SUBSCRIPTION_ACTIVE]	= XiText::_("PAYPLANS_PLAN_USAGE_ANALYTICS_ACTIVE_SUBCIPTION_DESC");
									$currentPlanStats['message'][PayplansStatus::SUBSCRIPTION_HOLD]		= XiText::_("PAYPLANS_PLAN_USAGE_ANALYTICS_HOLD_SUBCIPTION_DESC");
									$currentPlanStats['message'][PayplansStatus::SUBSCRIPTION_EXPIRED]	= XiText::_("PAYPLANS_PLAN_USAGE_ANALYTICS_EXPIRED_SUBCIPTION_DESC");
									$currentPlanStats['message'][PayplansStatus::NONE]					= XiText::_("PAYPLANS_PLAN_USAGE_ANALYTICS_NO_STATUS_SUBCIPTION_DESC");
									
									// Color coding for status
									$currentPlanStats['class'][PayplansStatus::SUBSCRIPTION_ACTIVE]		= 'bar-success';
									$currentPlanStats['class'][PayplansStatus::SUBSCRIPTION_HOLD]		= 'bar-warning';
									$currentPlanStats['class'][PayplansStatus::SUBSCRIPTION_EXPIRED]	= 'bar-danger';
									$currentPlanStats['class'][PayplansStatus::NONE]					= 'bar-info';?>
									
									<!-- Bar for color codings-->
									<div class="progress">
										<?php // Available Subscription status
									  		  $ppStatus = array(PayplansStatus::SUBSCRIPTION_ACTIVE, PayplansStatus::SUBSCRIPTION_HOLD, PayplansStatus::SUBSCRIPTION_EXPIRED, PayplansStatus::NONE);							  	
									  		  
									  		  // Process Plan stats according to status
									  		  foreach($ppStatus as $status) :
									  		  	
									  		  	  // Set width accroding to the number of Subscription
									  		  	  $currentPlanStats['width'][$status]	 	= isset($planStats[$plan->getId()]['count'][$status]) ? $planStats[$plan->getId()]['count'][$status] / $subscriptionCount * 100 :0;
									  		  	  $totalSubscription						= isset($planStats[$plan->getId()]['count'][$status]) ? $planStats[$plan->getId()]['count'][$status] : ''; 
									  		  	  $currentPlanStats['message'][$status]    	= isset($currentPlanStats['message'][$status]) ? $totalSubscription." ".$currentPlanStats['message'][$status] : '';?>
												  
												  <div class="bar <?php echo isset($currentPlanStats['class'][$status]) ? $currentPlanStats['class'][$status] : '';?>"
												  	   title="<?php echo isset($currentPlanStats['message'][$status]) ? $currentPlanStats['message'][$status] : '';?>"
												  	   style="width: <?php echo isset($currentPlanStats['width'][$status]) ? $currentPlanStats['width'][$status] : '';?>%;">
												  	   		
												  	   		<bold><?php echo isset($planStats[$plan->getId()]['count'][$status]) ? $planStats[$plan->getId()]['count'][$status] : '';?></bold>
												  </div>
											<?php endforeach;?>
									</div>
						<?php } ?>
						
					</td>		
				</tr>
			<?php $count++;?>
			<?php endforeach;?>
		<!-- TABLE BODY END -->
		</tbody>
		
		<tfoot>
			<tr>
				<td colspan="8">
					<?php echo $pagination->getListFooter(); ?>
				</td>
				<?php if(PAYPLANS_JVERSION_FAMILY !== '16'): ?>
					<td>
						<?php echo $pagination->getLimitBox();?>	
					</td>
				<?php endif;?>
			</tr>
		</tfoot>
	</table>
	<input type="hidden" name="filter_order" value="<?php echo $filter_order;?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $filter_order_Dir;?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
</form>
<?php 
