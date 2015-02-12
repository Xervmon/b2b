/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Javascript
* @contact 		payplans@readybytes.in
*/
(function($){
	
payplans.jQuery(document).ready(function(){

	payplans.jQuery(".subStatus").hide();
	payplans.jQuery(".exportwaiting").hide();
	
	payplans.jQuery("#tableName").change(function(){
		var tablename = payplans.jQuery("#tableName option:selected").val();
		if(tablename == "subscription" ){
			payplans.jQuery(".subStatus").show();
			payplans.jQuery(".invStatus").hide();
			payplans.jQuery("#gateway").val("");
			payplans.jQuery("#invoiceStatus").val("");
		}
		if(tablename == "invoice"){
			payplans.jQuery(".subStatus").hide();
			payplans.jQuery(".invStatus").show();
			payplans.jQuery("#subscriptionStatus").val("");
		}
		if(tablename == "user"){
			payplans.jQuery(".subStatus").show();
			payplans.jQuery(".invStatus").hide();
			payplans.jQuery("#gateway").val("");
			payplans.jQuery("#invoiceStatus").val("");
		}
		
	});

});

})(payplans.jQuery);