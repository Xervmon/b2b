/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Javascript
* @contact 		payplans@readybytes.in
*/
(function($){
// START : 	
// Scoping code for easy and non-conflicting access to $.
// Should be first line, write code below this line.
if (typeof(payplans.apps)=='undefined'){
		payplans.apps = {};
}
payplans.apps.advancedpricing = {
	calculatePricing : function(plan_id, units){
		var url = "index.php?option=com_payplans&view=plan&task=trigger&event=onPayplansPlanCalculateAdvancedPricing";	
		var args   = { 'event_args' : {'plan_id' : plan_id, 'units' : units} };
		payplans.ajax.go(url, args);
	},
	
	setPricing : function(plan_id, units, slab_id, child_slab){
		var url = "index.php?option=com_payplans&view=plan&task=trigger&event=onPayplansPlanSetAdvancedPricing";	
		var args   = { 'event_args' : {'plan_id' : plan_id, 'units' : units, 'slab_id' : slab_id, 'child_slab' : child_slab} };
		payplans.ajax.go(url, args);
	}
}

payplans.jQuery(document).ready(function(){
	
	$(".pp-pricing-calculate").click(function(){
		var plan_id = $(this).attr('value');
		var units 	= $('#pp-pricing-units-'+plan_id).val();
		
		payplans.apps.advancedpricing.calculatePricing(plan_id, units);
	});
	

	$("input[name^='pp-pricing-select-']").live('click' , function(){
		var name 			= $(this).attr('name');
		var plan_id 		= name.substr(18);
		var slab_id 		= $(this).attr('slab');
		var child_slab		= $(this).attr('childslab');
		var units			= $(this).attr('units');
			
		payplans.apps.advancedpricing.setPricing(plan_id, units, slab_id, child_slab);
		//$('#testPlan'+plan_id).attr('onclick', '');
		$('#testPlan'+plan_id).show();
	});
	
});

// ENDING :
// Scoping code for easy and non-conflicting access to $.
// Should be last line, write code above this line.
})(payplans.jQuery);