<?php 

class EmailService{
	
	public static function sendPaymentEmail($company, $paymentDetails){
	
		$applicationSettings = JBusinessUtil::getInstance()->getApplicationSettings();
	
		$billingInformation = self::getBillingInformation($company);
		
		$templ = self::getEmailTemplate("Order Email");
		
		$content = self::prepareEmail($paymentDetails, $company, $applicationSettings->company_name, $billingInformation, $templ->email_content, $applicationSettings->vat);
		$subject = str_replace(EMAIL_COMPANY_NAME, $applicationSettings->company_name, $templ->email_subject);
		$toEmail = $company->email;
		$from = $applicationSettings->company_email;
		$fromName = $applicationSettings->company_name;
		$isHtml = true;
		$bcc = array($from);
		
		return self::sendEmail($from, $fromName, $from, $toEmail, null, $bcc, $subject, $content, $isHtml);
	}
	
	public static function sendPaymentDetailsEmail($company, $paymentDetails){

		$applicationSettings = JBusinessUtil::getInstance()->getApplicationSettings();
	
		$billingInformation = self::getBillingInformation($company);
	
		$templ = self::getEmailTemplate("Payment Details Email");
	
		$content = self::prepareEmail($paymentDetails, $company, $applicationSettings->company_name, $billingInformation, $templ->email_content, $applicationSettings->vat);
		$content = str_replace(EMAIL_PAYMENT_DETAILS, $paymentDetails->details->details, $content);
	
		$subject = str_replace(EMAIL_COMPANY_NAME, $applicationSettings->company_name, $templ->email_subject);
		$toEmail = $company->email;
		$from = $applicationSettings->company_email;
		$fromName = $applicationSettings->company_name;
		$isHtml = true;
		$bcc = array($from);

		$result = self::sendEmail($from, $fromName, $from, $toEmail, null, $bcc, $subject, $content, $isHtml);

		return $result;
	}
	
	public static function sendNewCompanyNotificaitonEmail($company){
		$applicationSettings = JBusinessUtil::getInstance()->getApplicationSettings();
		
		$templ = self::getEmailTemplate("New Company Notification Email");
		
		$content = str_replace(EMAIL_BUSINESS_NAME, $company->name, $templ->email_content);
		$subject = $templ->email_subject;
		$toEmail = $applicationSettings->company_email;
		$from = $applicationSettings->company_email;
		$fromName = $applicationSettings->company_name;
		$isHtml = true;
		$bcc = array();
		
		return self::sendEmail($from, $fromName, $from, $toEmail, null, $bcc, $subject, $content, $isHtml);
	}
	
	public static function sendApprovalEmail($company){
		$applicationSettings = JBusinessUtil::getInstance()->getApplicationSettings();
	
		$templ = self::getEmailTemplate("Approve Email");
	
		$content = str_replace(EMAIL_COMPANY_NAME, $applicationSettings->company_name, $templ->email_content);
		$content = str_replace(EMAIL_BUSINESS_NAME, $company->name, $content);
		$subject = $templ->email_subject;
		$toEmail = $company->email;
		$from = $applicationSettings->company_email;
		$fromName = $applicationSettings->company_name;
		$isHtml = true;
		$bcc = array();
	
		return self::sendEmail($from, $fromName, $from, $toEmail, null, $bcc, $subject, $content, $isHtml);
	}
	
	public static function getBillingInformation($company){
		$user = JFactory::getUser($company->userId);
		$inf = $user->username."<br/>";
		$inf = $inf.$company->name."<br/>";
		$inf = $inf.$company->address."<br/>";
		$inf = $inf.$company->city.", ".$company->county."<br/>";
	
		return $inf;
	}
	
	public static function getEmailTemplate($template)
	{
		$db =JFactory::getDBO();
		$query = ' SELECT * FROM #__jbusinessdirectory_emails WHERE email_type = "'.$template.'"';
		$db->setQuery( $query );
		$templ= $db->loadObject();
		return $templ;
	}
	
	public static function prepareEmail($data, $company, $siteName, $billingInformation, $templEmail, $vat)
	{
		$user = JFactory::getUser($company->userId);
		$customerName= $user->username;
	
		$templEmail = str_replace(EMAIL_CUSTOMER_NAME,$customerName,	$templEmail);
	
		$siteAddress = JURI::root();
		$templEmail = str_replace(EMAIL_SITE_ADDRESS, $siteAddress,	$templEmail);
		$templEmail = str_replace(EMAIL_COMPANY_NAME, $siteName, $templEmail);
		$templEmail = str_replace(EMAIL_ORDER_ID,$data->order_id, $templEmail);
	
		$paymentMethod=$data->details->processor_type;
		$templEmail = str_replace(EMAIL_PAYMENT_METHOD, $paymentMethod, $templEmail);

		
		if(!empty($data->paid_at))
			$templEmail = str_replace(EMAIL_ORDER_DATE, JBusinessUtil::getDateGeneralFormat($data->paid_at), $templEmail);
		else
			$templEmail = str_replace(EMAIL_ORDER_DATE, JBusinessUtil::getDateGeneralFormat($data->details->payment_date), $templEmail);
		
		$totalAmount = $data->amount_paid;
		if(empty($data->amount_paid))
			$totalAmount = $data->amount;
			
		$vat = intval($vat);
		$totalAmount= intval($totalAmount);
		
		$templEmail = str_replace(EMAIL_TOTAL_PRICE, $totalAmount." ".$data->currency, $templEmail);
		
		$templEmail = str_replace(EMAIL_TAX_AMOUNT, $data->package->price * $vat/100 ." ".$data->currency, $templEmail);
		$templEmail = str_replace(EMAIL_SUBTOTAL_PRICE, $data->package->price." ".$data->currency, $templEmail);
		
		$templEmail = str_replace(EMAIL_SERVICE_NAME, $data->service, $templEmail);
		$templEmail = str_replace(EMAIL_UNIT_PRICE, $data->package->price." ".$data->currency, $templEmail);
		$templEmail = str_replace(EMAIL_BILLING_INFORMATION, $billingInformation, $templEmail);
	
		return "<div style='width: 600px;'>".$templEmail.'</div>';
	}
	
	
	public static function sendEmail($from, $fromName, $replyTo, $toEmail, $cc, $bcc, $subject, $content, $isHtml){
		jimport('joomla.mail.mail');
	
		$mail = new JMail();
		$mail->setSender(array($from, $fromName));
		if(isset($replyTo))
			$mail->addReplyTo($replyTo);
		$mail->addRecipient($toEmail);
		if(isset($cc))
			$mail->addCC($cc);
		if(isset($bcc))
			$mail->addBCC($bcc);
		$mail->setSubject($subject);
		$mail->setBody($content);
		$mail->IsHTML($isHtml);

		
		$ret = $mail->send();
		
		$log = Logger::getInstance();
		$log->LogDebug("E-mail with subject ".$subject." sent from ".$from." to ".$toEmail." ".serialize($bcc)." result:".$ret);
		
		return $ret;
	}
}

?>