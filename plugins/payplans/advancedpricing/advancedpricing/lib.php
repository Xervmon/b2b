<?php
/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Advanced pricing
* @contact 		shyam@readybytes.in
*/
if(defined('_JEXEC')===false) die();


class PayplansAdvancedpricing extends XiLib
{
	// Table fields
	protected $advancedpricing_id;
	protected $plans;
	protected $title;
	protected $description;
	protected $published;
	protected $units_title;
	protected $params;
	
	/**
	 * @return PayplansAdvancedpricing
	 */
	static public function getInstance($id=0, $type=null, $bindData=null, $dummy=null)
	{
		return parent::getInstance('advancedpricing',$id, $type, $bindData);
	}
	
	// 	not for table fields
	public function reset(Array $config = array())
	{
		$this->advancedpricing_id 	= 0;
		$this->plans          		= array();
		$this->title		  		= null;
		$this->description	  		= null;
		$this->published	  		= 1; 
		$this->units_title    		= null;
		$this->params	      		= new XiParameter();
		
		// data of child table
		$this->_min_value			= 0;
		$this->_max_value 			= 0;
		$this->_details				=	null;
		
		return $this;
	}
	
	//bind data
	public function bind($data, $ignore=array())
	{
		if(is_object($data)){
			$data = (array) ($data);
		}

		parent::bind($data, $ignore=array());

		if(isset($data['plans'])){
			$this->plans = (is_array($data['plans']))? ','.implode(',',$data['plans']).',': ','.$data['plans'].',';
		}
		
		$details = array();
		
		if(isset($data['min_value'])){
			$this->_min_value = $data['min_value'];
		}
		
		if(isset($data['max_value'])){
			$this->_max_value = $data['max_value'];
		}
		
		
		if(isset($data['advanced_pricing'])){
			$slab_details = $data['advanced_pricing'];
			$details['price'] = array_shift($slab_details);
			$details['expiration_time'] = array_shift($slab_details);
			$this->_details = json_encode($details);
		}
		
		return $this;
	}
	
	public function afterBind($id = 0)
	{
		if(!$id){
			return $this;
		}
		
		$this->plans = JString::trim($this->plans, ',');
		//load dependent records
		return $this->_loadSlabs($id);
	}
	
	protected function _loadSlabs($advanced_pricing_id)
	{
		// get all subscription records of this order
		$slabRecord = XiFactory::getInstance('pricingslab','model')
									->loadRecords(array('advancedpricing_id'=>$advanced_pricing_id));

		if(!empty($slabRecord)){
			$record = array_shift($slabRecord);
			
			$this->_min_value 	= $record->min_value;
			$this->_max_value 	= $record->max_value;
			$this->_details 	= $record->details;
		}

		return $this;
	}
	
	public function save()
	{
		// if error in saving parent data, 
		// then do not save child data
		if(!parent::save()){
			return false;
		}

		return $this->_savePriceSlab();
	}
	
	public function _savePriceSlab()
	{
		$model = XiFactory::getInstance('pricingslab', 'model');
		$model->deleteMany(array('advancedpricing_id' => $this->getId()));
		
		$data['advancedpricing_id'] 	= $this->getId();
		$data['min_value'] 		= $this->_min_value;
		$data['max_value'] 	= $this->_max_value;
		$data['details'] 			= $this->_details;
		
		$model->save($data);
		
		return $this;
	}
	
	//get plan_id
	public function getPlans()
	{
		return $this->plans;
	}
	
	//get whether discount is core or not
	public function getTitle()
	{
		return $this->title;
	}
	
	public function getMinValue()
	{
		return $this->_min_value;
	}
	
	public function getMaxValue()
	{
		return $this->_max_value;
	}
	
	public function getPrice()
	{
		$details 	= json_decode($this->_details, true);
		
		if(!isset($details['price'])){
			return array();
		}
		
		$price 	=	$details['price']; 
		return is_array($price) ? $price : array($price);
	}
	
	public function setPrice($amount = array())
	{
		
	}
	
	public function getExpirationTime()
	{
		$details 	= json_decode($this->_details, true);
		
		if(!isset($details['expiration_time'])){
			return array();
		}
		
		$time 		=	$details['expiration_time']; 
		return is_array($time) ? $time : array($time);
	}
	
	//	get whether discount coupon is published or not
	public function getDescription()
	{
		return $this->description;
	}
	
	//get whether discount coupon is published or not
	public function getPublished()
	{
		return $this->published;
	}
	
	//set published as true/false
	public function setPublished($published)
	{
		return $this->published = $published;
	}
	
	//get unit's title
	public function getUnitsTitle()
	{
		return $this->units_title;
	}
	
	public function createSlab()
	{
		
	}
	
	public function getSlabDetails($min_value = 0, $max_value = 0)
	{
		
	}
	
}
