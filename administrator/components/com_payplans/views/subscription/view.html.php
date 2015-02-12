<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		shyam@readybytes.in
*/
if(defined('_JEXEC')===false) die();

class PayplansadminViewSubscription extends XiView
{
	protected function _adminGridToolbar()
	{
		XiHelperToolbar::addNew('new');
		XiHelperToolbar::editList();
		XiHelperToolbar::divider();
		XiHelperToolbar::delete();
		XiHelperToolbar::divider();
		XiHelperToolbar::custom( 'extend', 'extend.png', 'extend.png', 'COM_PAYPLANS_SUBSCRIPTION_TOOLBAR_EXTEND', true );
		XiHelperToolbar::openPopup('searchRecords', 'search', 'search.png', 'COM_PAYPLANS_TOOLBAR_SEARCH', true );
	}

	protected function _adminEditToolbar()
	{   
		$model = $this->getModel();
		XiHelperToolbar::apply();
		XiHelperToolbar::save();
		XiHelperToolbar::cancel();
		XiHelperToolbar::divider();
		//don't display delete button when creating new subscription
		if($model->getId() != null){
		   XiHelperToolbar::deleteRecord();
		 }
	}
	
	function edit($tpl=null)
	{
		$subscription = $this->get('subscription');
		$itemid 	  = $subscription->getId();		
		$logRecords	  = XiFactory::getInstance('log', 'model')
								->loadRecords(array('object_id'=>$subscription->getId(), 'class'=>'PayplansSubscription'));

		$resources	  = XiFactory::getInstance('resource', 'model')
								->loadRecords(array('subscription_ids'=> array(array('LIKE', "'%,".$itemid.",%'" ))));		
	
		$this->assign('resources', $resources);
		
		$order	= PayplansOrder::getInstance($subscription->getOrder());
		$this->assign('order', $order);
		$this->assign('user', PayplansUser::getInstance( $subscription->getBuyer()));
		$this->assign('log_records', 	 $logRecords);
		
		// display cancel button 
		$subscription_status = $subscription->getStatus();
		$order_status 		 = $order->getStatus();
			
		$status = array(PayplansStatus::ORDER_CONFIRMED, PayplansStatus::ORDER_CANCEL,PayplansStatus::ORDER_EXPIRED);
		
		if(!in_array($order_status, $status) && $subscription_status != PayplansStatus::SUBSCRIPTION_EXPIRED){
			if($itemid && $subscription->isRecurring()){
				$order   = $subscription->getOrder(PAYPLANS_INSTANCE_REQUIRE);
				$invoice = $order->getLastMasterInvoice(PAYPLANS_INSTANCE_REQUIRE);
				if($invoice && ($payment = $invoice->getPayment())){
					$payment = $invoice->getPayment();
					$app = $payment->getApp(PAYPLANS_INSTANCE_REQUIRE);
					$this->assign('show_cancel_option', $app->getAppParam('allow_recurring_cancel', false));
				}
			}
		}

			
		$invRecords		= $order->getInvoices();
		$txnRecords   = array();
		$invoice_ids  = array();
		foreach ($invRecords as $record){
			$invoice_ids[] = $record->getId();
		}
		
		//fetch all the related transaction records
		if(!empty($invoice_ids)){
			$txnRecords = XiFactory::getInstance('transaction', 'model')
									->loadRecords(array('invoice_id'=> array(array('IN', "(".implode(",", $invoice_ids).")"))));
		}
				
		$form = $subscription->getModelform()->getForm($subscription);
		$this->assign('form', $form );
		$this->assign('invoice_records',$invRecords);
		$this->assign('txn_records', 	$txnRecords);
		return true;
	}

	public function _getDynamicJavaScript()
	{
		$url	=	"index.php?option=com_{$this->_component}&view={$this->getName()}";
		ob_start(); ?>
		
		payplansAdmin.subscription_validationForUser = function()
		{
			// there will be always two element of user id so use second one
			var eles = payplans.jQuery('input[name="Payplans_form[user_id]"]');
	
			for(var i =0; i < eles.length; i++){
				if(eles.hasOwnProperty(i) && eles[i].value != undefined && eles[i].value !=0 && eles[i].value.length > 0){
					return true;
				}
			}
			
			parent = eles.parents(".control-group").first();
			help   = parent.find('div[class="help-block"]');
			help.html("<ul><li class='text-error'>This is required</li></ul>");
			
			return false;
		}
		
		payplansAdmin.subscription_apply = payplansAdmin.subscription_save = function()
		{
			return payplansAdmin.subscription_validationForUser();
		}
		
		payplansAdmin.subscription_extend = function()
		{
			var theurl = 'index.php?option=com_payplans&view=subscription&task=extend&tmpl=component';
			
			xi.ui.dialog.create(
				{url:theurl, data:{iframe:true, id:'pp-admin-subscription-extend'}},
				'<?php echo XiText::_('COM_PAYPLANS_AJAX_SUBSCRIPTION_SELECT_EXTEND_TIME');?>',
				600, 450
			);
			
    		xi.ui.dialog.button(
    			[
	    			{
	    				classes : 'btn btn-primary',
	    				click : 'xi.subscription.extend();',
	    				text  : '<?php echo XiText::_('COM_PAYPLANS_AJAX_APPLY_BUTTON');?>'
	    			},
	    			{
	    				classes : 'btn',
	    				click : 'xi.ui.dialog.close();',  
	    				text: '<?php echo XiText::_('COM_PAYPLANS_AJAX_CLOSE_BUTTON');?>'
	    			}
    			]
    		);
    		
    		return false;
		}
		
		<?php
		$js = ob_get_contents();
		ob_end_clean();

		return $js;
	}

	public function extend()
	{
		return true;
	}
	
	function _displayGrid($records)
	{
		$uesrids = array();
		$planids = array();
		foreach($records as $record){
			if(!isset($plans[$record->plan_id])){
				$planids[$record->plan_id] = $record->plan_id; 
			}
			
			$userids[] = $record->user_id;
		}
		
		$filter = array('plan_id' => array(array('IN', "(".implode(",", $planids).")")));
		$this->assign('plans', PayplansHelperPlan::get($filter));
		
		$users = PayplansHelperUser::get($userids);
		$this->assign('users', $users);
		
		$activeSub   		= $this->_getSubscription(PayplansStatus::SUBSCRIPTION_ACTIVE);
		$expiredSub   		= $this->_getSubscription(PayplansStatus::SUBSCRIPTION_EXPIRED);
		$holdSub   			= $this->_getSubscription(PayplansStatus::SUBSCRIPTION_HOLD);
		$nostatusSub   		= $this->_getSubscription(PayplansStatus::NONE);
		$subscriptionStats	= $this->_getSubscriptionStats($activeSub, $expiredSub, $holdSub, $nostatusSub);
		
		$this->assign('subscriptionStats', 	$subscriptionStats);
		
		return parent::_displayGrid($records);
	}
	
	function _displayBlank()
	{
		$activeSub   		= $this->_getSubscription(PayplansStatus::SUBSCRIPTION_ACTIVE);
		$expiredSub   		= $this->_getSubscription(PayplansStatus::SUBSCRIPTION_EXPIRED);
		$holdSub   			= $this->_getSubscription(PayplansStatus::SUBSCRIPTION_HOLD);
		$nostatusSub   		= $this->_getSubscription(PayplansStatus::NONE);
		$subscriptionStats	= $this->_getSubscriptionStats($activeSub, $expiredSub, $holdSub, $nostatusSub);
		
		$this->assign('subscriptionStats', 	$subscriptionStats);
		
		return parent::_displayBlank();
	}
	
	public function _getSubscription($status)
	{
        $query  = new XiQuery();
		return $query->select('Count(`subscription_id`)')
		                ->from('`#__payplans_subscription`')
		                ->where('`status` = '.$status)
		                ->dbLoadQuery()
		                ->loadResult();
	}
	
	public function _getSubscriptionStats($activeSub, $expiredSub, $holdSub, $nostatusSub)
	{
		$totalSub    	= $activeSub+$expiredSub+$holdSub+$nostatusSub;
		if(!$totalSub){
			return array();	
		}
             
        // Count : According to  Subscription Status
		$subscriptionStats['count'][PayplansStatus::SUBSCRIPTION_ACTIVE]		= $activeSub;
		$subscriptionStats['count'][PayplansStatus::SUBSCRIPTION_HOLD]			= $holdSub;
		$subscriptionStats['count'][PayplansStatus::SUBSCRIPTION_EXPIRED]		= $expiredSub;
		$subscriptionStats['count'][PayplansStatus::NONE]						= $nostatusSub;
		
		// Percentage : According to Subscription Status
		$subscriptionStats['width'][PayplansStatus::SUBSCRIPTION_ACTIVE]		= ($activeSub/$totalSub)*100;
		$subscriptionStats['width'][PayplansStatus::SUBSCRIPTION_HOLD]			= ($holdSub/$totalSub)*100;
		$subscriptionStats['width'][PayplansStatus::SUBSCRIPTION_EXPIRED]		= ($expiredSub/$totalSub)*100;
		$subscriptionStats['width'][PayplansStatus::NONE]						= ($nostatusSub/$totalSub)*100;
                
        // Tool-tip : According to the Status 
		$subscriptionStats['message'][PayplansStatus::SUBSCRIPTION_ACTIVE]		= XiText::_("PAYPLANS_PLAN_USAGE_ANALYTICS_ACTIVE_SUBCIPTION_DESC");
		$subscriptionStats['message'][PayplansStatus::SUBSCRIPTION_HOLD]		= XiText::_("PAYPLANS_PLAN_USAGE_ANALYTICS_HOLD_SUBCIPTION_DESC");
		$subscriptionStats['message'][PayplansStatus::SUBSCRIPTION_EXPIRED]		= XiText::_("PAYPLANS_PLAN_USAGE_ANALYTICS_EXPIRED_SUBCIPTION_DESC");
		$subscriptionStats['message'][PayplansStatus::NONE]						= XiText::_("PAYPLANS_PLAN_USAGE_ANALYTICS_NO_STATUS_SUBCIPTION_DESC");
		
		// Color Coding: According to Subscription Status
		$subscriptionStats['class'][PayplansStatus::SUBSCRIPTION_ACTIVE]		= 'bar-success';
		$subscriptionStats['class'][PayplansStatus::SUBSCRIPTION_HOLD]			= 'bar-warning';
		$subscriptionStats['class'][PayplansStatus::SUBSCRIPTION_EXPIRED]		= 'bar-danger';
		$subscriptionStats['class'][PayplansStatus::NONE]						= 'bar-info';
		
		return $subscriptionStats;
	}
	

	public function statusHelp()
	{
		$this->_setAjaxWinTitle(XiText::_('COM_PAYPLANS_SUBSCRIPTION_STATUS_DISPLAY'));
		$this->_setAjaxWinAction();
		return true;
		
    }
}

