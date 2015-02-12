<?php
/**
* @copyright	Copyright (C) 2009 - 2013 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		Payplans
* @subpackage	AUP Discounts
* @contact 		payplans@readybytes.in
*/
if(defined('_JEXEC')===false) die();

/**
 * Discount System
 * @author rimjhim
 */
class PayplansAppAupDiscount extends PayplansAppDiscounts
{
	//inherited properties
	protected $_location	    = __FILE__;
    protected $_discountCode, $_user, $_aupuser, $_aupuserpoints;

	// Entry Function 
	public function onPayplansApplyDiscount(PayplansIfaceDiscountable $object, $discountCode)
	{
        if(!is_numeric($discountCode)){
            return false;
        }else{
            //@todo this needs a new way of doing it, the getDiscount method is loading modifiers before they are set to apply.
            //this is needed because it's not naturally passed into the calculation routine
            $this->_discountCode = $discountCode;
        }

        $path = JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_alphauserpoints';
        //lets include some jomsocial libraries
        if( !JFolder::exists($path)) {
            return true;
        }else{
            require_once( JPATH_SITE.DS.'components'.DS.'com_alphauserpoints'.DS.'helper.php' );
            $AUP = new AlphaUserPointsHelper();
            $this->_user	=& JFactory::getUser();
            $this->_aupuser	= $AUP->getUserInfo('', $this->_user->id);
            $this->_aupuserpoints	= $AUP->getCurrentTotalPoints('', $this->_user->id);
        }

		$result = $this->_doCheckAllowed($object, $discountCode);

		//Important Check : use strict !== , Do not use != 
		if($result !== true){
			return $result;
		}

        $discountCode	= $this->_aupuserpoints - $discountCode;
        if($discountCode > 0){
            $discountUsed = $this->_doApplyDiscount($object);
            if($discountUsed){
                $this->_discountAupPoints($object); 
                return true;
            }
        }
        return false;
	}
	
	function onPayplansSubscriptionAfterSave($prev, $new)
	{
		if(!isset($prev) || $prev->getStatus() == $new->getStatus()){
			return true;
		}
		
		if($new->getStatus() == PayplansStatus::SUBSCRIPTION_ACTIVE){
			$reference = 'aup_'.$this->getId();
	        $this->setAppParam('totalConsumption' , PayplansHelperModifier::getActualConsumption($reference,'aupdiscount'));
	        $this->save();
		}
		 
	}
	
	function _doApplyDiscount(PayplansIfaceDiscountable $object)
	{
		// apply dicount on invoice
		$discountUsed = false;
		$price 		= $object->getSubTotal();
		$discount 	= $object->getDiscount();

		if($this->_doCheckApplicable($object, $price, $discount) ==false){
			return $discountUsed;
		}

		list($amount, $isPercentage) = $this->_doCalculateDiscount($object, $price, $discount);
		
		$modifier = PayplansModifier::getInstance();
		$modifier->set('message', XiText::_('COM_PAYPLANS_APP_BASIC_DISCOUNT_MESSAGE'))
				 ->set('invoice_id', $object->getId())
				 ->set('user_id', $object->getBuyer())
				 ->set('type', $this->getType())
				 ->set('amount', -$amount) // Discount should be negative
				 ->set('reference', 'aup_'.$this->getId())
				 ->set('percentage', $isPercentage ? true : false)
				 ->set('frequency', $this->getAppParam('onlyFirstRecurringDiscount', false) ? PayplansModifier::FREQUENCY_ONE_TIME : PayplansModifier::FREQUENCY_EACH_TIME);
				 				 
		/**
		 * V.V.IMP : this is very impotant for applying discount in which serial
		 * @see PayplansModifier
		*/
		$serial = ($isPercentage === true) 
							? PayplansModifier::PERCENT_DISCOUNT 
							: PayplansModifier::FIXED_DISCOUNT;
									
		// XITODO : add error checking
		$modifier->set('serial', $serial)->save();
		
		// refresh the object after applying discount
		$object->refresh();

		if($this->getAppParam('onlyFirstRecurringDiscount', false) && $object->isRecurring() == PAYPLANS_RECURRING){
				$params = $object->getParams()->toArray();
				$object->setParam('expirationtype', 'recurring_trial_1');
				$object->setParam('recurrence_count', ($params['recurrence_count']> 0 ) ? $params['recurrence_count']-1 : 0);
				$object->setParam('trial_price_1', $params['price']);
				$object->setParam('trial_time_1', $params['expiration']);
		}
		
		$object->save();		
		return true;
	}

	//Check if current discount should be applied as per discount purpose
	public function _doCheckAllowed(PayplansIfaceDiscountable $object, $discountCode)
	{

        // if no points then they should not be able to apply any
		if($this->_aupuserpoints <= 0){
			return false;
		}

        // is disount amount less than the max allowed
		if((int)$discountCode > $this->getAppParam('max_aup', 100)){
			return false;
		}

        // is disount amount more than the minimum required
		if((int)$discountCode < $this->getAppParam('min_aup', 1)){
			return false;
		}

        //do not allow user to apply the same
        //discount code again and again on the same invoice
        $modifiers = $object->getModifiers(array('type' => $this->getType(), 'reference' => $discountCode));
        if(!empty($modifiers)){
            return XiText::_('COM_PAYPLANS_APP_DISCOUNT_ERROR_ALREADY_USED');
        }

        //if multiple discount on same invoice is not allowed then check for the perviously applied discount
        if(!(XiFactory::_getConfig()->multipleDiscount) && $object->getDiscount() != 0){
            return XiText::_('COM_PAYPLANS_APP_DISCOUNT_CANT_APPLY_MULTIPLE_DISCOUNT');
        }

        $reusable   = $this->getAppParam('reusable', 'yes');

        $userId		    = $object->getBuyer();
        $modifiers	    = XiFactory::getInstance('modifier','model')
            ->loadRecords(array('user_id'=> $userId, 'reference' => 'aup_'.$this->getId(), 'type' => $this->getType() ));

        //restrict user to use the same discount code on different subscriptions if reusable parameter is set to no
        if(!$reusable){
            //user already used the mentioned discount code, not allowed to use it again
            if(count($modifiers) > 0 ){
                return XiText::_('COM_PAYPLANS_APP_DISCOUNT_ERROR_ALREADY_USED');
            }
        }

        $modifiers = XiFactory::getInstance('modifier','model')
            ->loadRecords(array('reference' => 'aup_'.$this->getId(), 'type' => $this->getType() ));

        // if coupon have been used completely
        // unlimited usage if allowed quantity is ''
        $allowedQuantity = $this->getAppParam('allowed_quantity', '');
        if($allowedQuantity !== '' 	&& $allowedQuantity <= count($modifiers)){
            return XiText::_('COM_PAYPLANS_APP_DISCOUNT_ERROR_CODE_ALLOWED_QUANTITY_CONSUMED');
        }
		
		return true;
	}

	public function _doCalculateDiscount(PayplansIfaceDiscountable $subscription, $price, $discount)
	{
		if($price <= 0){
			return 0;
		}

        $ratio = $this->getAppParam('ratio', 1);

        $this->getAppParam('round', 1)?
        $amount = ceil($this->_discountCode / $ratio):
        $amount = floor($this->_discountCode / $ratio);

        //Cant do a percentage when using direct AUP. so 2nd param is false here
		return array($amount, false);
	}


    public function onAupDiscountTooltipFetch()
    {
        $data = new stdClass();
        $data->ratio    = $this->getAppParam('ratio', 1);
        $data->min      = $this->getAppParam('min_aup', 0);
        $data->max      = $this->getAppParam('max_aup', 1);
        $data->round    = $this->getAppParam('round', 1);
        $data->end      = $this->getAppParam('publish_end','');

        return $data;
    }

    protected function checkRule()
    {
        $db	   = JFactory::getDBO();
        $query = "SELECT * FROM #__alpha_userpoints_rules WHERE `plugin_function`='plgaup_payplans_aupdiscount'";
        $db->setQuery( $query );
        $result  = $db->loadObjectList();

        if(!$result){
            $query = "INSERT IGNORE INTO `#__alpha_userpoints_rules` (`id`, `rule_name`, `rule_description`, `rule_plugin`, `plugin_function`, `access`, `component`, `calltask`, `taskid`, `points`, `points2`, `percentage`, `rule_expire`, `sections`, `categories`, `content_items`, `exclude_items`, `published`, `system`, `duplicate`, `blockcopy`, `autoapproved`, `fixedpoints`, `category`, `displaymsg`, `msg`, `method`, `notification`, `emailsubject`, `emailbody`, `emailformat`, `bcc2admin`, `type_expire_date`) VALUES
                      ('', 'JPayPlans AUP for discounts', 'AUP Discounts', 'JPayPlans', 'plgaup_payplans_aupdiscount', 1, '', '', '', 0.00, 0.00, 0, '0000-00-00 00:00:00', '', '', '', '', 1, 0, 0, 0, 1, 0, 'ot', 0, '', 4, 0, '', '', 0, 0, 0)";
            $db->setQuery( $query );
            $db->query();
        }
    }

    protected function _discountAupPoints($object)
    {
        $error 	= XiText::_('_AupDiscountPoints');
        $log_id 	= PayplansHelperLogger::log(XiLogger::LEVEL_INFO, $error, $object, 'Remove AUP Points: -'.$this->_discountCode);
        $Referreid = AlphaUserPointsHelper::getAnyUserReferreID( intval($object->getBuyer()) );
        $this->checkRule();
        AlphaUserPointsHelper::newpoints( 'plgaup_payplans_aupdiscount', $Referreid, $object->getId(), 'Discount Plan with Points', -$this->_discountCode, '', 1);
        return true;
    }


}