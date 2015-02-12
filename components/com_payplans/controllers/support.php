<?php
/**
* @copyright	Copyright (C) 2009 - 2013 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @package		PayPlans
* @subpackage	Frontend
* @contact 		payplans@readybytes.in
*/
if(defined('_JEXEC')===false) die();

class PayplanssiteControllerSupport extends XiController
{
	protected 	$_defaultTask = 'notask';
  
	function emailform($user = null)
	{
		return true;
	}
	
	function sendemail()
	{
		$application = JFactory::getApplication();
		$args 	= $application->input->get('event_args',array(),'array');
		
		// IMP : we are working for ajax only for now
		if($application->input->getBool('isAjax',	false) == false || empty($args)){
			return false;
		}
		
		$user 	 = PayplansFactory::getUser();
		$subject = $args[0];
		$from	 = (empty($args[1])) ? $user->email : $args[1];
	
		
		//if from email address is wrong then what is should be checked
		if(!filter_var($from,FILTER_VALIDATE_EMAIL))
		{
			return false;
		}
		
		$body	 = sprintf(XiText::_('COM_PAYPLANS_SUPPORT_EMAIL_BODY'),$user->username,$from,$args[2]);	
		
		$admins  = XiHelperJoomla::getUsersToSendSystemEmail();		
		
		$first  = array_shift($admins);
		// get other super admin users email
		$cc = null;
		foreach ( $admins as $admin )
		{
			$cc[] = $admin->email;
		}
		
        $mail = XiFactory::getMailer();
        $sentMail = $mail->sendMail($from, $from, $first->email, $subject, $body, 0, null, $cc);

		if(empty($sentMail) || $sentMail instanceof Exception){
			$this->setTemplate('error');
			return true;
		}
		
		$this->setTemplate('sent');
		return true;
	}
	
	// render the data in formatted way
	function format()
	{
		$this->setTemplate('partial_format_'.JRequest::getVar('object',''));
		$this->getView()->assign('timer', JRequest::getVar('timer', null));		
		return true;
	}
}

