<?php

/**
* @copyright	Copyright (C) 2009 - 2013 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		Payplans
* @subpackage	AUP Discounts
* @contact 		payplans@readybytes.in
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Payplans AUP Discount Plugin
 *
 * @author rimjhim
 */
class plgPayplansAupDiscount extends XiPlugin
{

	public function onPayplansSystemStart()
	{
        $path = JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_alphauserpoints';
        //lets include some jomsocial libraries
        if( !JFolder::exists($path))
        {
            return false;
        }

        //add AUPdiscount app path to app loader
        $appPath = dirname(__FILE__).DS.'aupdiscount'.DS.'app';
        PayplansHelperApp::addAppsPath($appPath);

		return true;
	}


	// on render of order, display output
	public function onPayplansViewBeforeRender(XiView $view, $task)
	{

        if(!($view instanceof PayplanssiteViewInvoice)){
            return true;
        }

        if($task != 'confirm'){
            return true;
        }
        //prevents loading jomsocial on the backend.
        $app = JFactory::getApplication(); if(!$app->isSite()){ return true; }
	
	    //Check if aup installed or not
        if( !JFolder::exists(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_alphauserpoints'))
        {
            return false;
        }

        require_once( JPATH_SITE.DS.'components'.DS.'com_alphauserpoints'.DS.'helper.php' );
        $AUP = new AlphaUserPointsHelper();
        $user = JFactory::getUser();

        //can't apply AUP if they are not logged in.
       if( $user->id == 0)
       {
           return true;
       }

        $document = JFactory::getDocument();
        $document->addScript( JURI::root().'/plugins/payplans/aupdiscount/aupdiscount/media/js/xi.aupdiscount.js');

        JHTML::_('behavior.tooltip');

        $invoiceId  	= $view->getModel()->getId();
        $invoice		= PayplansInvoice::getInstance($invoiceId);

        $args=array();
        $result  = PayplansHelperEvent::trigger('onAupDiscountTooltipFetch', $args, '', $invoice);

        $config = $result[0];
        $config->round?$round = XiText::_('COM_PAYPLANS_APP_AUP_ROUND_DOWN'):$round = XiText::_('COM_PAYPLANS_APP_AUP_ROUND_UP');
        $config->end == ''?$end=XiText::_('COM_PAYPLANS_APP_AUP_END_NO'):$end = XiText::_('COM_PAYPLANS_APP_AUP_END_TIME').$config->end;
        $tooltip = JHtml::tooltip(XiText::sprintf("COM_PAYPLANS_APP_AUP_TOOLTIP_TEXT",$config->ratio,$config->min,$config->max,$round,$end),XiText::_('COM_PAYPLANS_APP_AUP_TOOLTIP_TITLE'), 'tooltip.png', '');
        $this->_assign('tooltip', $tooltip);

        $this->_assign('orderId', $view->getModel()->getId());
        $this->_assign('points', $AUP->getCurrentTotalPoints('', $user->id));

        if(($view instanceof PayplanssiteViewInvoice) && $task == 'confirm'){
             $this->_assign('invoiceId', $invoiceId);
             return  array('payplans_order_confirm_payment' => $this->_render('orderconfirm'));
        }
        return true;
	}

	// on render of order, display output
	public function onPayplansAupDiscountRequest($invoiceId, $discountCode)
	{
		//trigger the AUPdiscount
        $invoice = PayplansInvoice::getInstance($invoiceId);
		$args  = array($invoice, $discountCode);
		$results = PayplansHelperEvent::trigger('onPayplansApplyDiscount', $args, '', $invoice);

		$error = '';
		$allFalse = true;
		foreach($results as $result){
			// check if app returned true/false OR error string
			if(is_bool($result)==false){
				$error .= $result . ' ';
			}

			if($result !== false){
				$allFalse = false;
			}
		}

		if($allFalse){
			$error = XiText::_('COM_PAYPLANS_APP_AUP_ERROR_INVALID_CODE');
		}

        // order have been updated
        $response = XiFactory::getAjaxResponse();

        // this is for when appliying discount through admin panel
        if(XiFactory::getApplication()->isAdmin()){
            if(!$error){
                $response->addScriptCall('payplans.jQuery(\'input[name="discount"]\').val', $invoice->getDiscount());
                $response->addScriptCall('payplans.jQuery(\'input[name="taxamount"]\').val', $invoice->getTaxAmount());
                $response->addScriptCall('payplans.jQuery(\'input[name="total"]\').val', $invoice->getTotal());
            }
            else{
                $response->addScriptCall('payplans.aupdiscount.error',$error);
            }

            $response->sendResponse();
        }

        $response->addScriptCall('payplans.aupdiscount.displayError',$error);
        $response->addScriptCall('payplans.jQuery(\'.payplans\').find(\'.discount-amount > .pp-amount\').html',  PayplansHelperFormat::displayAmount($invoice->getDiscount()));
        $response->addScriptCall('payplans.jQuery(\'.payplans\').find(\'.first-tax-amount > .pp-amount\').html',  PayplansHelperFormat::displayAmount($invoice->getTaxAmount()));
        $response->addScriptCall('payplans.jQuery(\'.payplans\').find(\'.first-discount-amount > .pp-amount\').html', PayplansHelperFormat::displayAmount($invoice->getDiscount()));

        //because of discount, tax will be updated so update that also
        $response->addScriptCall('payplans.jQuery(\'.payplans\').find(\'.tax-amount > .pp-amount\').html',  PayplansHelperFormat::displayAmount($invoice->getTaxAmount()));
        $response->addScriptCall('payplans.jQuery(\'.payplans\').find(\'.regular-amount > .pp-amount\').html',  PayplansHelperFormat::displayAmount($invoice->getRegularAmount()));
        $response->addScriptCall('payplans.jQuery(\'.payplans\').find(\'.first-amount > .pp-amount\').html', PayplansHelperFormat::displayAmount($invoice->getTotal()));
        $response->addScriptCall('payplans.jQuery(\'.total-first-amount\').show',"");
		
		$response->sendResponse();
	}

}
