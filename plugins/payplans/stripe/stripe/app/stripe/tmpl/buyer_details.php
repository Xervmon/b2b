<?php
/**
 * @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * @package		PayPlans
 * @subpackage	Frontend
 * @contact 	payplans@readybytes.in
 */
if(defined('_JEXEC')===false) die();?>

<script type="text/javascript">

function process(publicKey)
{
	payplans.jQuery('#error').hide();
	payplans.jQuery('#pp-payment-app-buy').button('loading');
	
	var x= Stripe.setPublishableKey(publicKey);

	var cardcvcCode 		= payplans.jQuery('#card-cvc').val();
	var cardNO 				= payplans.jQuery('#card-number').val();
	var cardNumber			= cardNO.replace( /\s/g, "");
	var cardExpirationYear 	= payplans.jQuery('#card-expiry-year').val();
	var cardExpirationMonth = payplans.jQuery('#card-expiry-month').val();
	
//	if(Stripe.validateCardNumber(cardNO))
//	{
//		if(Stripe.validateCVC(cardcvcCode))
//		{
//			if(Stripe.validateExpiry(cardExpirationMonth,cardExpirationYear))
//			{
				Stripe.createToken({
				    number		: cardNumber,
				    cvc			: cardcvcCode,
				    exp_month	: cardExpirationMonth,
				    exp_year	: cardExpirationYear
				}, stripeResponseHandler);
//			}
//		}
//	}
//	payplans.jQuery('#error').show();
}

function stripeResponseHandler(status, response) {
    if (response.error) {
        // show the errors on the form
        payplans.jQuery("#errorData").html(response.error.message);
        payplans.jQuery('#error').show();
    	payplans.jQuery('#pp-payment-app-buy').button('reset');
    } else {
        var form$ = payplans.jQuery("#checkout_form");
        // token contains id, last4, and card type
        var token = response['id'];
        // insert the token into the form so it gets submitted to the server
        form$.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        // and submit
        form$.get(0).submit();
    }
}



</script>
<script src="https://js.stripe.com/v1/"></script>

<div class="row-fluid">
	<form method="post" autocomplete="off" action="<?php echo $post_url;?>" id="checkout_form" name="payment-form">

		<div class="span12 ">
			<fieldset>
			<legend><?php echo XiText::_('COM_PAYPLANS_APP_STRIPE_CREDIT_CARD_DETAIL')?></legend>
			<div id="error"	class="hide text-error text-center pp-gap-bottom05">
				<span id="errorData"><?php echo XiText::_('COM_PAYPLANS_APP_STRIPE_CREDIT_CARD_DETAIL_ERROR'); ?></span>
			</div>

			<div class="pp-gap-top10">
				<div class="control-group">
					<div class="control-label span3"><lable><?php echo XiText::_('COM_PAYPLANS_APP_STRIPE_CREDIT_CARD_NUMBER');?></label></div>
					<div class="controls span9"><input type="text" class="required" size=25 id=card-number /></div>
				</div>
				<div class="control-group">
					<div class="control-label span3"><lable><?php echo XiText::_('COM_PAYPLANS_APP_STRIPE_CREDIT_CARD_CVC');?></label></div>
					<div class="controls span9"><input type="text" class="required" size=25 id=card-cvc /></div>
				</div>

				<div class="control-group"><?php
				/*** array of months ***/
				$months = array(
				1=>XiText::_('JANUARY'),
				2=>XiText::_('FEBRUARY'),
				3=>XiText::_('MARCH'),
				4=>XiText::_('APRIL'),
				5=>XiText::_('MAY'),
				6=>XiText::_('JUNE'),
				7=>XiText::_('JULY'),
				8=>XiText::_('AUGUST'),
				9=>XiText::_('SEPTEMBER'),
				10=>XiText::_('OCTOBER'),
				11=>XiText::_('NOVEMBER'),
				12=>XiText::_('DECEMBER'));

				/*** current month ***/
				$select = '<div class="pp-gap-bottom05"><div class="control-label span3">'.XiText::_('COM_PAYPLANS_APP_STRIPE_CREDIT_CARD_EXPIRATION').'</div><div class="controls span9"><select id="card-expiry-month" class="span3">'."\n";
				foreach($months as $key=>$mon)
				{
					$select .= "<option value=".$key;
					$select .= ">$mon</option>\n";
				}
				$select .= '</select>';
				echo $select."&nbsp";

				/*** the current year ***/
				$start_year = date('Y');
				$end_year = $start_year + 20;

				/*** range of years ***/
				$rangeOfYear = range($start_year, $end_year);

				/*** create the select ***/
				$select = '<select id="card-expiry-year" class="span3">';
				foreach( $rangeOfYear as $year )
				{
					$select .= "<option value=".$year;
					$select .= ">$year</option>\n";
				}
				$select .= '</select></div></div>';

				echo $select;

				?>
				</div>
	
			</fieldset>
	</form>
</div>
<div>&nbsp;</div>
<div class="span12 text-center">		
	<button id="pp-payment-app-buy" onclick="process('<?php echo $publicKey;?>');"  class="btn btn-large btn-primary" data-loading-text="processing..."><?php echo XiText::_('COM_PAYPLANS_APP_STRIPE_PAYMENT_BUY')?></button>
	<a class="btn btn-large" href="<?php echo XiRoute::_("index.php?option=com_payplans&view=payment&task=complete&action=cancel&payment_key=$paymentKey"); ?>"><?php echo XiText::_('COM_PAYPLANS_APP_STRIPE_PAYMENT_CANCEL')?>
	</a>
</div>
<div>&nbsp;</div>
</div>
<?php
