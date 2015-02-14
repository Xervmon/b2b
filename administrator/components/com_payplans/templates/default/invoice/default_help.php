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
				<th class="span5"><h4><?php echo XiText::_('COM_PAYPLANS_INVOICE_STATUS_NAME');?></h4></th>
				<th class="span7"><h4><?php echo XiText::_('COM_PAYPLANS_INVOICE_STATUS_DESCRIPTION');?></h4></th>
			</tr>
		</thead>
	
		<tbody>
		 	<?php $status = PayplansStatus::getStatusOf('invoice');?>
			<?php foreach ($status as $invoice): ?>
			<tr>
			    <td class="span5"><span><strong><?php echo XiText::_('COM_PAYPLANS_STATUS_'.$invoice); ?></strong></span></td>
			    <td class="span7"><span><?php echo XiText::_('COM_PAYPLANS_STATUS_'.$invoice.'_DESC'); ?></span></td>
			</tr>
		 <?php endforeach;?>
	
		</tbody>	
     </table>
</div>
<?php 