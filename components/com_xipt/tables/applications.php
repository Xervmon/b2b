<?php
/**
* @Copyright Ready Bytes Software Labs Pvt. Ltd. (C) 2010- author-Team Joomlaxi
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
**/
// Disallow direct access to this file
if(!defined('_JEXEC')) die('Restricted access');

class XiptTableApplications extends XiptTable
{
	function load($id=null, $reset = true)
	{
		if( $id ){
			return parent::load( $id );
		}
		
		$this->id				= 0;
		$this->applicationid	= '';
		$this->profiletype		= '';
		return true;
	}
	
	function __construct()
	{
		parent::__construct('#__xipt_applications','id');
	}
	
}
