<?php
/**
* @copyright	Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Advancedpricing
* @contact 		shyam@readybytes.in
*/
if(defined('_JEXEC')===false) die();


class PayplansModelAdvancedpricing extends XiModel
{
	public $filterMatchOpeartor = array(
										'published'	    => array('='),
										'plan_id'	    	=> array('=')
										);
}

class PayplansModelPricingSlab extends XiModel
{
	public $filterMatchOpeartor = array(
										'min_value'	    => array('>=', '<='),
										'max_value'	    	=> array('>=', '<=')
										);
}

class PayplansModelformAdvancedpricing extends XiModelform{
	
	protected function loadFormData()
	{
		
		//this is need to be done just to bind this data to form, because toArray just ignore the keys with '_'.
		$this->_lib_data->set('min_value', $this->_lib_data->_min_value);
		$this->_lib_data->set('max_value', $this->_lib_data->_max_value);
		
		
		// when form load then we get processor's data into params, to bind this data into processor_config we assing params into this
		if(isset($this->_lib_data)){
			return $this->_lib_data->toArray();
		}
		
		return array();
	}
	
}
