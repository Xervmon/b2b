<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license	GNU/GPL, see LICENSE.php
* @package	PayPlans
* @subpackage	Router
* @contact 	shyam@readybytes.in
*/
if(defined('_JEXEC')===false) die();

class PayplansRouter extends XiRouter
{
    protected $_component  = 'com_payplans';   

    function _routes($key)
    {
        $routes =  array(
                'plan/'         => array(),
                'plan/subscribe' => array('plan_id'),
                'plan/login'    => array('plan_id'),
        
        		'plan/subscribe/group' => array('group_id'),

                'order/'        => array(),
                'order/display' => array('order_key'),

        		'subscription/'        => array(),
                'subscription/display' => array('subscription_key'),
        
                'invoice/'          => array(),
                'invoice/display'   => array('invoice_key'),
                'invoice/confirm'   => array('invoice_key'),
                'invoice/thanks'    => array('invoice_key'),

                'payment/pay'       => array('payment_key'),
                'payment/complete'  => array('payment_key'),


                'dashboard/' => array(),
                'dashboard/noaccess' => array(),
                'dashboard/frontview' => array(),

            );
    
        if(isset($routes[$key])==false){
            return array();
        }

        return $routes[$key];
    }
    
    public static function getInstance($name='Router', $prefix='Payplans')
    {
        return XiFactory::getInstance($name, '', $prefix);
    }
    
	public function getParseKey($view, $task, &$segments)
    {
    	if (in_array('group', $segments)){
    		array_shift($segments);
    		return $view.'/'.$task.'/'.'group';
    	}
    	
    	return parent::getParseKey($view, $task, $segments);
    }
    
    function getBuildKey(&$query, &$segments, &$selMenu)
    {
    	$keys 		= array_keys($query);
  		if(in_array('group_id', $keys) && $query['group_id']){
  			
			//if no menu available for payplans then do not change anything in segment
  			if (empty($selMenu->query)){
  				return parent::getBuildKey($query, $segments, $selMenu);
  			}

	    	$key = 'plan/subscribe/group';
	    	
	    	if(!isset($selMenu->query['group_id']) || empty($selMenu->query['group_id'])){
	    		$segments[] = 'group';
	    	}
	    	return $key;
	     }
	     
	     return parent::getBuildKey($query, $segments, $selMenu);
    }
}