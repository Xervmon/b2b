<?php
/**
* @copyright	Copyright (C) 2008-2009 CMSJunkie. All rights reserved.
* 
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
* See the GNU General Public License for more details.
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
JHTML::_('stylesheet', 	'administrator/components/com_jbusinessdirectory/assets/css/validationEngine.jquery.css');
JHTML::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/validation/jquery.validationEngine-en.js');
JHTML::_('script', 'administrator/components/com_jbusinessdirectory/assets/js/validation/jquery.validationEngine.js');

class JBusinessDirectoryViewPayment extends JViewLegacy
{

	function __construct()
	{
		parent::__construct();
	}
	
	
	function display($tpl = null)
	{
	
		$layout = JRequest::getVar('layout',null);
		if(isset($layout)){
			$tpl = $layout;
		}
		
		$this->paymentMethods =  $this->get('paymentMethods');
		$this->order = $this->get('Order');
		$this->state = $this->get('State');
		$this->appSettings = JBusinessUtil::getInstance()->getApplicationSettings();
		$this->companyId = JRequest::getVar("companyId");
		parent::display($tpl);
		
	}
	
	function getPaymentMethodFormHtml($paymentMethod){
		return JText::_("LNG_PAYMENT_REDIRECT");
	}
}
?>