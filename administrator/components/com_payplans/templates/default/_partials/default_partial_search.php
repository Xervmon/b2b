<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @contact 		payplans@readybytes.in
*/
if(defined('_JEXEC')===false) die();
?>
<div class="row-fluid payplans">
	<form id="pp-search-box-form" action="" method="post" name="searchBox" >
		<div class="well">
			<input id="pp-search-box-form-search-text" class="inputbox" type="text" autocomplete="off" 
				onkeyup="return payplansAdmin.searchBoxKeyUp(event)" 
				onkeypress="return payplansAdmin.searchBoxKeyDown(event)" 
				title="<?php echo XiText::_('COM_PAYPLANS_MOD_SEARCH_TOOLTIP');?>" 
				name="payplans_search_text"  alt="payplans_search_text" size="30" 
				placeholder="<?php echo XiText::_('COM_PAYPLANS_SEARCH_HERE');?>"
			/>
			
			<select name="payplans_search_obj" id="pp-search-box-form-refrence-obj"
					onChange="return payplans.admin.search.go();" >
				<option value="all" selected><?php echo XiText::_('COM_PAYPLANS_SEARCH_SEARCH_IN_ALL');?></option>
				<option value="user"><?php echo XiText::_('COM_PAYPLANS_SEARCH_USER');?></option>
				<option value="plan"><?php echo XiText::_('COM_PAYPLANS_SEARCH_PLAN');?></option>
				<option value="group"><?php echo XiText::_('COM_PAYPLANS_SEARCH_GROUP');?></option>			
				<option value="subscription"><?php echo XiText::_('COM_PAYPLANS_SEARCH_SUBSCRIPTION');?></option>
				<option value="invoice"><?php echo XiText::_('COM_PAYPLANS_SEARCH_INVOICE');?></option>
<!--   this decided to not to show these fields available for searching, but can be shown in search results 
  				<option value="order"><?php echo XiText::_('COM_PAYPLANS_SEARCH_ORDER');?></option>
				<option value="payment"><?php echo XiText::_('COM_PAYPLANS_SEARCH_PAYMENT');?></option>
-->
			</select>
			
			<select name="payplans_search_match_criteria" id="pp-search-box-form-match-criteria"
				onChange="return payplans.admin.search.go();" >
				<option value="any" selected><?php echo XiText::_('COM_PAYPLANS_SEARCH_MATCH_ANY');?></option>
				<option value="exact"><?php echo XiText::_('COM_PAYPLANS_SEARCH_MATCH_EXACT');?></option>
			</select>
		</div>
	</form>
	<div id="payplans-search-results"></div>		
</div>
<?php 