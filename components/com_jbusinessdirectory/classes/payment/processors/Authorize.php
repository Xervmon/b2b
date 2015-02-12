<?php
require_once JPATH_COMPONENT_SITE.DS.'classes'.DS.'payment'.DS.'processors'.DS.'authorize'.DS.'AuthorizeNet.php';

class authorize{    

    private $AUTHORIZENET_API_LOGIN_ID = "";
    private $AUTHORIZENET_TRANSACTION_KEY = "";
    private $AUTHORIZENET_SANDBOX = 'false';
	
	public function authorize(){
		
		if (!function_exists('curl_init')) {
			throw new Exception('AuthorizeNetSDK needs the CURL PHP extension.');
		}
		$credentials = $this->getAuthorizeCredentials();

		$this->AUTHORIZENET_API_LOGIN_ID = $credentials->paymentprocessor_username;
		$this->AUTHORIZENET_TRANSACTION_KEY = $credentials->paymentprocessor_password;
		if(trim($credentials->paymentprocessor_mode)=='test')		
			$this->AUTHORIZENET_SANDBOX =  'true';
		else 	
			$this->AUTHORIZENET_SANDBOX =  'false';
	}
	
	function getAuthorizeCredentials(){
		$db = JFactory::getDBO();
		$query = "SELECT c.*
		  			    FROM 	#__hotelreservation_paymentprocessors c
						WHERE  c.paymentprocessor_type = 'PROCESSOR_AUTHORIZE'
		 				and is_available =1";
		$db->setQuery( $query );
		$credentials = $db->loadObject();
		return $credentials;
	}
	      // Set multiple line items:
	public function chargeCreditCard($creditCard,$order,$customer)
    {
        $responseArray = array();
    	$sale = new AuthorizeNetAIM($this->AUTHORIZENET_API_LOGIN_ID,$this->AUTHORIZENET_TRANSACTION_KEY);
    	if($this->AUTHORIZENET_SANDBOX=='false')
			$sale->setSandbox(false);
		else 
			$sale->setSandbox(true);
        $sale->setFields($creditCard);
        $sale->setFields($order);
        $sale->setFields($customer);        
        $response = $sale->authorizeAndCapture();
		return $this->translateResponse($response);
        
    }
    function translateResponse($response){
    	if(isset($response->approved) && $response->approved==1)
    		$responseArray[0] = 0;
    	else
    		$responseArray[0] = 1;
    	
    	$responseArray[1] = $response->response_reason_text;

    	return $responseArray;
    }
}
?>