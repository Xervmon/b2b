<?php
/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Advancedpricing
* @contact 		payplans@readybytes.in
*/
if(defined('_JEXEC')===false) die();


class PayplansadminViewAdvancedpricing extends XiView
{
	protected function _adminGridToolbar()
	{
		XiHelperToolbar::addNew('new');
		XiHelperToolbar::editList();
		XiHelperToolbar::divider();
		XiHelperToolbar::publish();
		XiHelperToolbar::unpublish();
		XiHelperToolbar::divider();
		XiHelperToolbar::delete();
		XiHelperToolbar::divider();
		XiHelperToolbar::openPopup('searchRecords', 'search', 'search.png', 'COM_PAYPLANS_TOOLBAR_SEARCH', true );
	}

	function _getTemplatePath($layout = 'default')
	{
		return array_merge(parent::_getTemplatePath($layout),$this->_path['template']);
	}
	
	function _displayGrid($records)
	{
		// for plans caching
		$planIds = array();
		$plans   = array();
		$advancedpricingIds = array();
		
		foreach ($records as $record){
			$value = JString::trim($record->plans,',');
			if(!empty($value)){
				$planIds[] = $value;
			}
			$advancedpricingIds[] = $record->advancedpricing_id;
		}
		
		if(!empty($planIds)){
			$planIds = array_filter($planIds);
			$planIds = array_unique($planIds);
			
			$filter = array('plan_id' => array(array('IN', "(".implode(",", $planIds).")")));
			$plans = PayplansHelperPlan::get($filter);
		}
		
		$filter = array();
		$filter = array('advancedpricing_id' => array(array('IN', "(".implode(",", $advancedpricingIds).")")));
		$slabs = XiFactory::getInstance('pricingslab', 'model')->loadRecords($filter, array(), false, 'advancedpricing_id');
		
		$this->assign('plans', $plans);
		$this->assign('slabs', $slabs);
		return parent::_displayGrid($records);
	}
	
	function edit($tpl=null, $itemId=null)
	{
		$itemId     		= ($itemId === null) ? $this->getModel()->getId() : $itemId;
		$adv_pricing   = PayplansAdvancedpricing::getInstance($itemId);

		$logRecords	= XiFactory::getInstance('log', 'model')
												->loadRecords(array('object_id'=>$itemId, 'class'=>'PayplansAdvancedpricing'));
												
		//needed to add path of this xml
		JForm::addFormPath(dirname(__FILE__));						
		$form     = $adv_pricing->getModelform()->getForm($adv_pricing);

		$this->assign('form',$form);											
		$this->assign('log_records',$logRecords);
		$this->assign('advanced_pricing', $adv_pricing);
		
		return true;
	}
	
	
public function _getDynamicJavaScript()
	{
	  ob_start(); ?>

        payplansAdmin.advancedpricing_apply = 
        payplansAdmin.advancedpricing_save =
        payplansAdmin.advancedpricing_savenew = function()
        {       
            var eles = payplans.jQuery('input[name="Payplans_form[plans][]"]');
   
            for(var i =0; i < eles.length; i++){
                if(eles.hasOwnProperty(i) && eles[i].value != undefined && eles[i].value !=0 && eles[i].value.length > 0){
                    return true;
                }
            }
            
            // this is done inorder to find the parent div.
            var eles = payplans.jQuery('input[name="Payplans_form[plans]"]');
            parent = eles.closest(".control-group").first();
            help   = parent.find('div[class="help-block"]');
            help.html("<ul><li class='text-error'>This is required</li></ul>");
 			return false;          

        }
	
        <?php
        $js = ob_get_contents();
        ob_end_clean();
        return $js;
	}
}
