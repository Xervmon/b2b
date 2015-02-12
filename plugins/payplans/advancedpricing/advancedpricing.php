<?php 
/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license	    GNU/GPL, see LICENSE.php
* @package	    PayPlans
* @subpackage	Advanced Pricing
* @contact 	    payplans@readybytes.in
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.filesystem.archive' );
jimport( 'joomla.document.document' );

class plgPayplansAdvancedpricing extends XiPlugin
{
	var $_name = 'Advancedpricing';
	
	/**
	 * load plugin's view,controller,model,table and lib
	 */
	public function onPayplansSystemStart()
	{
		//autoload view,controller,model and table
        $dir = dirname(__FILE__).DS.'advancedpricing';
        PayplansHelperLoader::addAutoLoadFile($dir.DS.'view.php', 'PayplansadminViewAdvancedpricing');
		PayplansHelperLoader::addAutoLoadFile($dir.DS.'controller.php', 'PayplansadminControllerAdvancedpricing');
		PayplansHelperLoader::addAutoLoadFile($dir.DS.'table.php', 'PayplansTableAdvancedpricing');
		PayplansHelperLoader::addAutoLoadFile($dir.DS.'table.php', 'PayplansTablePricingSlab');
		PayplansHelperLoader::addAutoLoadFile($dir.DS.'model.php', 'PayplansModelAdvancedpricing');
		PayplansHelperLoader::addAutoLoadFile($dir.DS.'model.php', 'PayplansModelPricingSlab');
		PayplansHelperLoader::addAutoLoadFile($dir.DS.'lib.php', 'PayplansAdvancedpricing');
		
		// IMP: child table is not creating by model so we have to call table directly 
		$loadPricingSlabTable = new PayplansTablePricingslab();
		
        return true;
	}
	
	/**
	 * set plugin template for backend and front end
	 */
	public function onPayplansViewBeforeRender(XiView $view, $task)
	{
		//add admin-submenu when plugin in enabled
		if(XiFactory::getApplication()->isAdmin()){
			XiAbstractView::addSubmenus('advancedpricing');
		}
		
		//for admin side
		if(($view instanceof PayplansadminViewAdvancedpricing) && ($task == 'display' || $task == 'edit')){
			// we need to add the normal template overriding paths
			$templatePaths = $this->_getTemplatePath($this->_name);
			$view->addPathToView($templatePaths);
		}
		
		if(($view instanceof PayplansadminViewSubscription) && ($task == 'edit')){
			$subscription = $view->get('subscription');
			$units = $subscription->getParams()->get('units', 0);
			$this->_assign('units', $units);
			$html = $this->_render('default_params');
			
			return array('pp-subscription-details'=> $html);
		}
		
		if($view instanceof PayplanssiteViewPlan && ($task == '' || $task == 'subscribe')){
			$plans 	= $view->get('plans');
			$prices = array();
			$times	= array();
			$mins 	= array();
			$maxs	= array();
			$actual = array();
			$ret    = array();
			
			$model = XiFactory::getInstance('pricingslab', 'model');
			if(XiHelperTable::isTableExist('#__payplans_advancedpricing') == false)
			{
				return true;
			}
			$unit_title = '';
			foreach($plans as $plan_id => $plan){
				$query = new XiQuery();
				$query->select('advancedpricing_id, units_title')
							->from('#__payplans_advancedpricing')
							->where("plans LIKE '%,$plan_id,%'")
							->where('published = 1');
				
				$records = $query->dbLoadQuery()->loadAssocList();
				
				if(empty($records)){
					continue;
				}

				$advanced_ids = array();
				$units_title  = array();
				foreach ($records as $record){
					$advanced_ids[] = $record['advancedpricing_id'];
					$units_title[]  = $record['units_title'];
				}
				
				
				
				$filter = array();
				$count	= 1;
				
				$filter['advancedpricing_id'] = array(array('IN', "(".implode(",", $advanced_ids).")"));
				$records = $model->loadRecords($filter);
				
				
				foreach ($records as $slab_id => $slab){
					$key 	= 'slab_'.$count;
					$details= json_decode($slab->details,true);

					$mins[$plan_id][$key] 	= $slab->min_value;
					$maxs[$plan_id][$key]	= $slab->max_value;
					$prices[$plan_id][$key] = $details['price'];
					$times[$plan_id][$key]  = $details['expiration_time'];
					$actual[$plan_id][$key]	= $this->_getPlanPriceForEachSlabTime($plan, $details['expiration_time']);

					$count++;
				}
				
				$minimum = $mins[$plan_id]; 
				$maximum = $maxs[$plan_id];
				sort($maximum);
				sort($minimum);
				
				foreach ($units_title as $title){
					if(!empty($title)){
						$unit_title[$plan_id] = $title;
						break;
					}
				}
				
				$tmpTitle = (isset($unit_title[$plan_id])) ?  $unit_title[$plan_id]  :  '';
				
				$this->_assign('minimum', array_shift($minimum));
				$this->_assign('maximum', array_pop($maximum));
				$this->_assign('plan', $plan);
				$this->_assign('unit_title', $tmpTitle);
				$ret['plan-block-bottom_'.$plan_id] = $this->_render('default_plan');
			}
			
			
			// set values into the session
			$session = XiFactory::getSession();
			
			$session->clear('adv_mins');
			$session->clear('adv_maxs');
			$session->clear('adv_prices');
			$session->clear('adv_times');
			$session->clear('adv_actualprice');
			$session->clear('adv_unit_title');
			$session->clear('adv_plan_data');
			
			$session->set('adv_mins',   $mins);
			$session->set('adv_maxs',   $maxs);
			$session->set('adv_prices', $prices);
			$session->set('adv_times',  $times);
			$session->set('adv_unit_title', $unit_title);
			$session->set('adv_actualprice', $actual);
			
			PayplansHtml::script(dirname(__FILE__).DS.'advancedpricing'.DS.'tmpl'.DS.'advancedpricing.js');		
			return $ret;
		}

		return true;
	}
	
	public function onPayplansPlanCalculateAdvancedPricing($plan_id, $units)
	{
		$session 	= XiFactory::getSession();
		$allMins 	= $session->get('adv_mins');
		$allMaxs 	= $session->get('adv_maxs');
		$allPrices 	= $session->get('adv_prices');
		$allTimes 	= $session->get('adv_times');
		$allActualPrices = $session->get('adv_actualprice');
		$unit_title = $session->get('adv_unit_title');
		
		$mins = $allMins[$plan_id];
		$maxs = $allMaxs[$plan_id];
		
		foreach ($mins as $slab_id => $min){
			if($min <= $units && $maxs[$slab_id] >= $units){
				$slab = $slab_id;
				break;
			}
		}
		
		if(isset($slab)){
			$this->_assign('plan_id', $plan_id);
			$this->_assign('units',   round($units));
			$this->_assign('prices',  $allPrices[$plan_id][$slab]);
			$this->_assign('times',   $allTimes[$plan_id][$slab]);
			$this->_assign('slab_id', $slab);
			$this->_assign('actualprices', $allActualPrices[$plan_id][$slab]);
			$this->_assign('unit_title', $unit_title[$plan_id]);
			$html = $this->_render('calculate_price');
		}
		else {
			$html = '<div class="pp-left">'.XiText::_('COM_PAYPLANS_APP_ADVANCED_PRICING_RANGE_NOT_AVAILABLE').'</div>';
		}
		
		
		$response	= XiFactory::getAjaxResponse();
		$response->addScriptCall('payplans.jQuery(\'#pp-pricing-details-'.$plan_id.'\').html', $html);
		$response->sendResponse();	
		
		return true;
		
	}
	//onPayplansPlanSetAdvancedPricing
	public function onPayplansPlanSetAdvancedPricing($plan_id, $units, $slab, $child_slab)
	{
		$session 		= XiFactory::getSession();
		$allPrices 	= $session->get('adv_prices');
		$allTimes 	= $session->get('adv_times');
		
		$price = $allPrices[$plan_id][$slab][$child_slab];
		$time = $allTimes[$plan_id][$slab][$child_slab];
		
		$data = array('units' => round($units), 'price' => $price, 'expiration_time' => $time);
		
		$session->clear('adv_plan_data');
		$session->set('adv_plan_data', $data);
		
		return true;
	}
	
	public function onPayplansSubscriptionBeforeSave($prev, $new)
	{
		// do nothing if prev instance is not null
		if($prev != null){
			return true;
		}
		
		$session 	= XiFactory::getSession();
		$modify 	= $session->get('adv_plan_data', array());
		
		if(empty($modify)){
			// do nothing
			return true;
		}
		
		$price = $modify['price'] * $modify['units'];
		$new->setPrice($price);
		$new->setExpiration($modify['expiration_time']);
		$new->setParam('units', $modify['units']);
		
		return true;
	}
	
	// IMP: $plan must be object of stdclass 
	protected function _getPlanPriceForEachSlabTime($plan, $slab_time)
	{
		$jsonObject		=   JRegistryFormatJSON::getInstance('JSON');
		$plan_details 	=	$jsonObject->stringToObject($plan->details);
		$plan_price		=	$plan_details->price;
		$plan_time		=	$plan_details->expiration;
		$plan_time		=	PayplansHelperPlan::convertIntoTimeArray($plan_time);
		$one_day_price  = 	0;

		$price_variations = array();
		
		$days = (!empty($plan_time['day'])) ? intval($plan_time['day']) : 0;
		$days += (!empty($plan_time['month'])) ? intval($plan_time['month']) * 30 : 0;
		$days += (!empty($plan_time['year'])) ? intval($plan_time['year']) * 365 : 0;
		
		if($days != 0){
			$one_day_price = $plan_price / $days;
		}
		
		// for life-time plan there will not be any price variations exists
		if($one_day_price == 0){
			return $price_variations;
		}
		
		$slab_time = is_array($slab_time) ? $slab_time : array($slab_time);
		foreach($slab_time as $time){
			
			$time = PayplansHelperPlan::convertIntoTimeArray($time);
			$sdays = (!empty($time['day'])) ? intval($time['day']) : 0;
			$sdays += (!empty($time['month'])) ? intval($time['month']) * 30 : 0;
			$sdays += (!empty($time['year'])) ? intval($time['year']) * 365 : 0;
			$price_variations[] = $one_day_price * $sdays; 
		}
		
		return $price_variations;
	}
	
	function onPayplansRewriterDisplayTokens()
	{
		$contentLi   = '<li><a href="#Advancedpricing" data-toggle="tab">Advancedpricing</a></li>';
		$contentsTab = '<div class="tab-pane" id="Advancedpricing">[[ADVANCEDPRICING_UNITS]]</div>';

		return array($contentLi, $contentsTab);
	}
	
	/**
	 *  Replace tokens value
	 */
	function onPayplansRewriterReplaceTokens($refObject, $rewriter)
	{
		$subscription    = false; 
		if($refObject instanceof PayplansSubscription){
			$subscription = $refObject;
		}
		
		elseif($refObject instanceof PayplansOrder){
			$subscription =  $refObject->getSubscription();
		}
		
		elseif( $refObject instanceof PayplansInvoice && $refObject->getReferenceObject(PAYPLANS_INSTANCE_REQUIRE) instanceof PayplansOrder){
			$subscription = $refObject->getReferenceObject(PAYPLANS_INSTANCE_REQUIRE)->getSubscription();
		}
		
		if(!$subscription){
			return true;
		}
		
		if(!$subscription && !($refObject instanceof PayplansSubscription)){
			return true;
		}
		
		$param 		= (!$subscription) ? $refObject->getParams() : $subscription->getParams();
		$data 		= (object) $param->toArray();
		$data->name = 'Advancedpricing';
		
		$rewriter->setMapping($data, false);
		return true;

	}
	
}
