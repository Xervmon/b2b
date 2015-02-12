/**
* @copyright	Copyright (C) 2009 - 2013 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		Payplans
* @subpackage	Aup Discounts
* @contact 		payplans@readybytes.in
*/

payplans.aupdiscount={
        apply: function(orderId){
            var discountCode = xi.jQuery('#app_aupdiscount_code_id').val();
                var currentAup = xi.jQuery('#auppoints').html();
                xi.jQuery('#auppoints').html(Number(currentAup) - Number(discountCode) );
            var url = "index.php?option=com_payplans&view=order&task=trigger&event=onPayplansAupDiscountRequest&id="+orderId;
            //remove the error message
            payplans.aupdiscount.displayError('');
            var args   = { 'event_args' : {'orderId' :orderId,'discountCode' : discountCode}} ;
            xi.ajax.go(url, args);
        },
        
        displayError: function(message){
            xi.jQuery('#app-aupdiscount-apply-error').html(message);
            if(message !== ''){
                xi.jQuery('#app-aupdiscount-apply-error').css('display','block');
                var discountCode = xi.jQuery('#app_aupdiscount_code_id').val();
                var currentAup = xi.jQuery('#auppoints').html();
                xi.jQuery('#auppoints').html(Number(currentAup) + Number(discountCode) );
            }
            else{
                xi.jQuery('#app-aupdiscount-apply-error').css('display','none');
            }
        }
};


