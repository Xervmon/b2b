<?php
/**
* @copyright	Copyright (C) 2009 - 2011 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @package		PayPlans
* @subpackage	Frontend
* @contact 		shyam@readybytes.in
* website		http://www.jpayplans.com
* Technical Support : Forum -	http://www.jpayplans.com/support/support-forum.html
*/
if(defined('_JEXEC')===false) die();

class PayplansadminControllerApp extends XiController
{

	public function edit($itemId = null, $userId = null)
	{
		$userId = XiFactory::getUser($userId)->id;

		//set editing template
		$this->setTemplate('edit');

		//if it was a new task, simply return true
		// as we cannot checkout non-existing record
		if($this->getTask() ==='new' || $this->getTask() === 'newItem'){
			return true;
		}

		//user want to edit record
		if($this->_edit($itemId, $userId)===false){
			//XITODO : enqueue message that item is already checkedout
			$this->setRedirect(null,$this->getError());
			return false;
		}

		return true;
	}
	
	public function display($cachable = false, $urlparams = false)
	{	
		    $compInfo =	XiAbstractHelperJoomla::getExtension('com_rbinstaller');

			if(empty($compInfo)){
				$this->install_rbinstaller();
				return true;
			}
			
			$compInfo = array_shift($compInfo);
			if($compInfo->enabled == 1){
				return true;
			}
			$disabled =  JFactory::getApplication()->input->get('disabled', 0);
			if( 1 == $disabled){
				    return true;
			}
			$msg = XiText::_("COM_PAYPLANS_APP_RBINSTALLER_NOT_ENABLED");
			$this->setRedirect("index.php?option=com_payplans&view=app&disabled=1", $msg , 'error');

	}

	public function _save(array $data, $itemId=null, $type=null)
	{
		XiError::assert(isset($data['type']), XiText::_('COM_PAYPLANS_ERROR_TYPE_IS_NOT_DEFINED_FOR_APP'));
		$app = PayplansApp::getInstance($itemId,$data['type']);

		// we need to collect params, and convert them into INI
		// it should be done via app
		$data['core_params'] = $app->collectCoreParams($data);
		$data['app_params']  = $app->collectAppParams($data);

		return parent::_save($data, $itemId, $data['type']);
	}

	
	public function selectApp()
	{
		$this->setTemplate('selectapp');
		return true;
	}
	
	public function myapps()
	{
		return true;
	}
	
	
	
	public function _copy($itemId)
	{
		$app = PayplansApp::getInstance($itemId);
		if($app === FALSE){
			$this->setError(XiText::_('COM_PAYPLANS_GRID_INVALID_APP'));
			return false;
		}
		
		$app->setId(0);
		$app->set('title', XiText::_("COM_PAYPLANS_COPY_OF").$app->getTitle());
		return $app->save();
	}
	
	
		public  function install_rbinstaller()
	   {
   			$url = "index.php?option=com_payplans&view=app&disabled=1";
	  
			$file_url   = 'http://pub.readybytes.net/rbinstaller/update/live.json';
			$link 		= new JURI($file_url);	
			$curl 		= new JHttpTransportCurl(new JRegistry());
			$response 	= $curl->request('GET', $link);
			if($response->code != 200){
				$msg = XiText::_("COM_PAYPLANS_APP_RBINSTALLER_FILE_NOT_ACCESSIBLE");
				$this->setRedirect($url, $msg, 'error');
			}
								
			$content   			  =  json_decode($response->body, true);
		    $file_path 			  = new JUri($content['rbinstaller']['file_path']);
		    $data                 = $curl->request('GET', $file_path);                
            $content_type         = $data->headers['Content-Type'];
		    
	        if ($content_type != 'application/zip'){
                $msg = XiText::_("COM_PAYPLANS_APP_RBINSTALLER_UNABLE_TO_FETCH_FILE");
       			$this->setRedirect($url, $msg, 'error');
                
		    }
            else {
                     $file = $data->body;
                     $response = self::install($file);  
            }
            if ($response['response_code'] != 200)
            {
            	$msg = XiText::_('COM_PAYPLANS_RBINSTALLER_NOT_INSTALLED_PROPERLY');
            	$this->setRedirect($url, $msg, 'error');
            	
            }
			
		    return true;    
		
	}
	    // install the rbinstaller
		public static function install($file)
          {
		         $random         = rand(1000, 999999);
		         $tmp_file_name = JPATH_ROOT.'/tmp/'.$random.'.zip';
		         $tmp_folder_name         = JPATH_ROOT.'/tmp/'.$random;
		        
		         // create a file
		         JFile::write($tmp_file_name, $file);
		        
		         jimport('joomla.filesystem.archive');
		         jimport( 'joomla.installer.installer' );
		         jimport('joomla.installer.helper');
		         JArchive::extract($tmp_file_name, $tmp_folder_name);
		         $installer = JInstaller::getInstance();
		        
		         if(!$installer->install($tmp_folder_name))
		         {
		         $response = array('response_code' => 0);
		          return $response;
		         }
		        
		         if (JFolder::exists($tmp_folder_name)){
		         JFolder::delete($tmp_folder_name);
		         }
		        
		         if (JFile::exists($tmp_file_name)){
		         JFile::delete($tmp_file_name);
		         }

				//we need to remove admin menu of rbinstaller
				$db = JFactory::getDbo();
				$query = "DELETE FROM `#__menu` WHERE `alias` = 'com-rbinstaller'";
				$db->setQuery($query);
				$db->execute();

		         $response = array('response_code' => 200);
		        
		         return $response;
  		} 

}

