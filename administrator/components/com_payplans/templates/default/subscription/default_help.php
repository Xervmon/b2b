<?php
/**
* @copyright	Copyright (C) 2009 - 2011 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @package		PayPlans
* @subpackage	Frontend
* @contact 		payplans@readybytes.in
* website		http://www.jpayplans.com
*/
if(defined('_JEXEC')===false) die();
?>
<div class="row-fluid">
    <table class="table">
	    <thead class="well">
			<tr>
				<th class="span5"><h4><?php echo XiText::_('COM_PAYPLANS_SUBSCRIPTION_STATUS_NAME');?></h4></th>
				<th class="span7"><h4><?php echo XiText::_('COM_PAYPLANS_SUBSCRIPTION_STATUS_DESCRIPTION');?></h4></th>
			</tr>
		</thead>
	
		<tbody>
		 	<?php $status = PayplansStatus::getStatusOf('subscription');?>
			<?php foreach ($status as $subscription): ?>
			<tr>
			    <td class="span5"><span><strong><?php echo XiText::_('COM_PAYPLANS_STATUS_'.$subscription); ?></strong></span></td>
			    <td class="span7"><span><?php echo XiText::_('COM_PAYPLANS_STATUS_'.$subscription.'_DESC'); ?></span></td>
			</tr>
		 <?php endforeach;?>
	
		</tbody>	
     </table>
</div>
<?php 