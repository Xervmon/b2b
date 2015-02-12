<?php
/**
* @copyright	Copyright (C) 2009 - 2013 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @package		PayPlans
* @subpackage	Frontend
* @contact 		payplans@readybytes.in
* website		http://www.jpayplans.com
* Technical Support : Forum -	http://www.jpayplans.com/support/support-forum.html
*/
if(defined('_JEXEC')===false) die();?>
<div class="tab-pane active" id="export">
<form class="form-horizontal" action="<?php echo XiRoute::_('index.php?option=com_payplans&view=reports&task=trigger&event=onPayplansExportingData',false ); ?>" method="post">

<div class="row-fluid">

	<!-- what tables are need to export -->	
	 <div class="control-group">
		<label class="control-label" ><?php echo XiText::_("COM_PAYPLANS_REPORTS_EXPORT_WHICH_TABLE");?></label>
		<div class="controls">
			<select id="tableName" name="export">
				<?php foreach ($exportable as $exportable):?>
					<option value="<?php echo $exportable;?>"><?php echo $exportable;?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>

	<!-- on whih plans bases-->	
	 <div class="control-group">
		<label class="control-label" ><?php echo XiText::_("COM_PAYPLANS_SM_PLAN");?></label>
			<div class="controls">
			<select multiple="multiple" name="plan[]">
				<?php foreach ($plans as $plan):?>
					<option value="<?php echo $plan->plan_id;?>"><?php echo $plan->title;?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>

	<!-- on whih subscription status-->
	 <div class="control-group subStatus">
		<label class="control-label" ><?php echo XiText::_("COM_PAYPLANS_SUBSCRIPTION_GRID_STATUS");?></label>
			<div class="controls">
			<select multiple="multiple" name="subStatus[]">
				<?php foreach ($subStatus as $key => $val):?>
				<option value="<?php echo $key; ?>">
					<?php echo XiText::_('COM_PAYPLANS_STATUS_'.$val);?>
				</option>
				<?php endforeach;?>
			</select>
		</div>
	</div>

	<!-- on whih invoice status-->
	 <div class="control-group invStatus">
		<label class="control-label" ><?php echo XiText::_("COM_PAYPLANS_INVOICE_GRID_STATUS");?></label>
			<div class="controls">
			<select multiple="multiple" name="invStatus[]">
				<?php foreach ($invStatus as $key => $val):?>
				<option value="<?php echo $key; ?>">
					<?php echo XiText::_('COM_PAYPLANS_STATUS_'.$val);?>
				</option>
				<?php endforeach;?>
			</select>
		</div>
	</div>

	<!-- on whih gateway type-->	
	 <div class="control-group invStatus">
		<label class="control-label" ><?php echo XiText::_("COM_PAYPLANS_TRANSACTION_GRID_GATEWAY_TYPE");?></label>
			<div class="controls">
			<select multiple="multiple" name="gateway[]">
				<?php foreach ($gateways as $gateway):?>
					<option value="<?php echo $gateway->getId(); ?>"><?php echo $gateway->getType();?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>

	<!-- from which date range we need  -->
	 <div class="control-group">
		<label class="control-label" ><?php echo XiText::_("Date range");?></label>
		<div class="controls">
		<?php 
	        echo JHTML::_('behavior.calendar');
	        echo JHTML::_('calendar', '', 'export_from', 'export_from','%Y-%m-%d', array('class'=>'inputbox', 'maxlength'=>'19', 'placeholder'=>'From'));
		?>
		</div>
		<div class="controls">
		<?php 
			echo JHTML::_('behavior.calendar');
			echo JHTML::_('calendar', '', 'export_to', 'export_to','%Y-%m-%d', array('class'=>'inputbox', 'maxlength'=>'19', 'placeholder'=>'To'));
	    ?>	  
		</div>
	</div>
	
	 <div class="control-group">
		<div class="controls">
				<input id="exportbutton" type=submit value="<?php echo XiText::_('COM_PAYPLANS_REPORTS_CSV_EXPORT');?>" class="btn btn-primary"/>
		</div>
	</div>
</div>

</form>
</div>
<script src="<?php echo PayplansHelperUtils::pathFS2URL(dirname(__FILE__).DS.'export.js');?>" type="text/javascript"></script>
<?php 